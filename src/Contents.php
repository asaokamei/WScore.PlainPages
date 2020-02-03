<?php


namespace WScore\PlainPages;


class Contents
{
    /**
     * @var bool
     */
    private $isOpen = false;

    /**
     * @var string|null;
     */
    private $sectionName = null;

    /**
     * @var string[]
     */
    private $contents = [];

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function get($name, $default = '')
    {
        return array_key_exists($name, $this->contents) ? $this->contents[$name] : $default;
    }

    /**
     * @param string $name
     * @param string $contents
     */
    public function set($name, $contents)
    {
        $this->contents[$name] = $contents;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->contents[$name]);
    }

    /**
     *
     */
    public function open()
    {
        $this->isOpen = true;
        ob_start();
    }

    /**
     *
     */
    public function close()
    {
        $this->end();
        if ($this->isOpen) {
            ob_end_clean();
        }
        $this->isOpen = false;
    }

    /**
     * @param string $name
     */
    public function section($name)
    {
        $this->end();
        $this->sectionName = $name;
        ob_start();
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->sectionName;
    }

    /**
     * @return string
     */
    public function end()
    {
        if (is_null($this->sectionName)) {
            return '';
        }
        $currentName = $this->getName();
        $this->contents[$currentName] = ob_get_contents();
        ob_end_clean();
        $this->sectionName = null;
        return $currentName;
    }
}