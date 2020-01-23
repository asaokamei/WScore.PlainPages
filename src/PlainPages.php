<?php
namespace WScore\PlainPages;

class PlainPages
{
    /**
     * @var PlainPages
     */
    private static $self;

    /**
     * @var string[];
     */
    private $sectionContents = [];

    /**
     * @var string|null;
     */
    private $sectionName = null;

    /**
     * @var bool
     */
    private $isStarted = false;

    /**
     * @var string|null;
     */
    private $extended = null;

    /**
     * @var callable
     */
    private $onSetContent;

    /**
     * @var string|null
     */
    private $template_dir;

    /**
     * PlainPages constructor.
     * @param string|null $template_dir
     */
    public function __construct($template_dir = null)
    {
        $this->template_dir = $template_dir;
    }

    /**
     * @param string|null $template_dir
     * @return PlainPages
     */
    public static function self($template_dir = null)
    {

        if (!self::$self) {
            self::$self = new self($template_dir);
            self::$self->section('contents');
        }
        return self::$self;
    }

    /**
     * @param string $filename
     */
    public function extend($filename)
    {
        $this->extended = $filename;
    }

    /**
     * @param string $name
     */
    public function section($name)
    {
        $this->end();
        ob_start();
        $this->isStarted = true;
        $this->sectionName = $name;
    }

    /**
     *
     */
    public function end()
    {
        if ($this->isStarted) {
            $this->set($this->sectionName, ob_get_contents());
            $this->isStarted = false;
            ob_end_clean();
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->sectionContents[$name]);
    }

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function get($name, $default = '')
    {
        return array_key_exists($name, $this->sectionContents) ? $this->sectionContents[$name] : $default;
    }

    /**
     * @param string $name
     * @param string $contents
     */
    public function set($name, $contents)
    {
        if ($this->onSetContent) {
            $onSet = $this->onSetContent;
            $contents = $onSet($name, $contents);
        }
        $this->sectionContents[$name] = $contents;
    }

    /**
     * @param string $filename
     * @param array $options
     * @return string
     */
    public function render($filename, $options = [])
    {
        foreach ($options as $key => $value) {
            $this->set($key, $value);
        }
        $this->section('contents');
        /** @noinspection PhpIncludeInspection */
        include $this->template_dir . DIRECTORY_SEPARATOR . $filename;
        $this->end();

        return $this->emit();
    }

    /**
     *
     * @return string
     */
    public function emit()
    {
        $this->end();
        while ($this->extended) {
            $filename = $this->template_dir . DIRECTORY_SEPARATOR . $this->extended;
            $this->extended = null;
            /** @noinspection PhpIncludeInspection */
            include $filename;
        }
        if ($this->sectionName) {
            return $this->get($this->sectionName);
        }
        return '';
    }

    /**
     *
     */
    public function __destruct()
    {
        echo $this->emit();
    }

    /**
     * hook when set contents. signature:
     * function(string $name, string $contents): string {}
     *
     * @param callable $converter
     */
    public function onSetContent($converter)
    {
        $this->onSetContent = $converter;
    }

    /**
     * to cleanly destruct this object.
     */
    public function close()
    {
        $this->end();
        $this->sectionName = null;
        $this->extended = null;
    }
}