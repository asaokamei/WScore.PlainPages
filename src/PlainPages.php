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
    private $currentSectionName = null;

    /**
     * @var string|null;
     */
    private $extended = null;

    public function __construct()
    {
        ob_start();
    }

    public static function self(): PlainPages
    {
        if (!self::$self) {
            self::$self = new self();
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
        $this->currentSectionName = $name;
    }

    public function end()
    {
        $this->sectionContents[$this->currentSectionName] = ob_get_contents();
        ob_end_clean();
    }

    public function get($name): string
    {
        return $this->sectionContents[$name] ?? '';
    }

    public function emit()
    {
        while ($this->extended) {
            $filename = $this->extended;
            $this->extended = null;
            /** @noinspection PhpIncludeInspection */
            include $filename;
        }
        if ($this->currentSectionName) {
            ob_end_clean();
            echo $this->sectionContents[$this->currentSectionName] ?? '';
        } else {
            ob_end_flush();
        }
    }

    public function __destruct()
    {
        $this->emit();
    }
}