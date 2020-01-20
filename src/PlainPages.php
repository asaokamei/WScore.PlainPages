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
     * PlainPages constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return PlainPages
     */
    public static function self()
    {
        if (!self::$self) {
            self::$self = new self();
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
        ob_start();
        $this->isStarted = true;
        $this->sectionName = $name;
    }

    /**
     *
     */
    public function end()
    {
        $this->set($this->sectionName, ob_get_contents());
        $this->isStarted = false;
        ob_end_clean();
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
     * @param $name
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
     *
     */
    public function emit()
    {
        if ($this->isStarted) {
            $this->end();
        }
        while ($this->extended) {
            $filename = $this->extended;
            $this->extended = null;
            /** @noinspection PhpIncludeInspection */
            include $filename;
        }
        if ($this->sectionName) {
            ob_end_clean();
            echo $this->get($this->sectionName);
        } else {
            ob_end_flush();
        }
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->emit();
    }

    /**
     * @param callable $converter
     */
    public function onSetContent($converter)
    {
        $this->onSetContent = $converter;
    }
}