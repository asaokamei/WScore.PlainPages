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

    private function __construct()
    {
    }

    public static function self(): PlainPages
    {
        if (!self::$self) {
            self::$self = new self();
            self::$self->section('contents');
        }
        return self::$self;
    }

    public function extend(string $filename)
    {
        $this->extended = $filename;
    }

    public function section(string $name)
    {
        ob_start();
        $this->isStarted = true;
        $this->sectionName = $name;
    }

    public function end()
    {
        $this->sectionContents[$this->sectionName] = ob_get_contents();
        $this->isStarted = false;
        ob_end_clean();
    }

    public function has($name): bool
    {
        return isset($this->sectionContents[$name]);
    }

    public function get($name): string
    {
        return $this->sectionContents[$name] ?? '';
    }

    public function set($name, $contents)
    {
        $this->sectionContents[$name] = $contents;
    }

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
            echo $this->sectionContents[$this->sectionName] ?? '';
        } else {
            ob_end_flush();
        }
    }

    public function __destruct()
    {
        $this->emit();
    }
}