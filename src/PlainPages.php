<?php
namespace WScore\PlainPages;

class PlainPages
{
    /**
     * @var string|null;
     */
    private $sectionName = null;

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
     * @var Contents
     */
    private $contents;

    /**
     * PlainPages constructor.
     * @param string|null $template_dir
     */
    public function __construct($template_dir = null)
    {
        $this->template_dir = rtrim($template_dir, DIRECTORY_SEPARATOR);
        $this->contents = new Contents();
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
        $this->sectionName = $name;
        $this->contents->section($name);
    }

    /**
     *
     */
    public function end()
    {
        $this->contents->end();
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return $this->contents->has($name);
    }

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function get($name, $default = '')
    {
        return $this->contents->get($name, $default);
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
        $this->contents->set($name, $contents);
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
        include $this->fullFilename($filename);
        $this->end();

        return $this->emit();
    }

    /**
     * @param string $filename
     * @return string
     */
    private function fullFilename($filename)
    {
        return $this->template_dir
            ? $this->template_dir . DIRECTORY_SEPARATOR . $filename
            : $filename;
    }

    /**
     *
     * @return string
     */
    public function emit()
    {
        $this->end();
        while ($this->extended) {
            $filename = $this->fullFilename($this->extended);
            $this->extended = null;
            /** @noinspection PhpIncludeInspection */
            include $filename;
        }
        $contents = $this->sectionName
            ? $this->get($this->sectionName)
            : '';
        $this->close();
        return $contents;
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
        $this->contents->close();
        $this->sectionName = null;
        $this->extended = null;
    }
}