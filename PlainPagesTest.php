<?php


use WScore\PlainPages\PlainPages;
use PHPUnit\Framework\TestCase;

class PlainPagesTest extends TestCase
{
    /**
     * @var PlainPages
     */
    private $pages;

    public function setUp(): void
    {
        $this->pages = new PlainPages();
    }

    public function testSet()
    {
        $this->assertFalse($this->pages->has('tests'));
        $this->pages->set('tests', 'tested');
        $this->assertTrue($this->pages->has('tests'));
        $this->assertEquals('tested', $this->pages->get('tests'));
    }

    public function testOnSetContent()
    {
        $this->pages->set('tests', 'testOnSet');
        $this->assertEquals('testOnSet', $this->pages->get('tests'));
    }
}
