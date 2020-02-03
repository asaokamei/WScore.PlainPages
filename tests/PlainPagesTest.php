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

    public function tearDown(): void
    {
        unset($this->pages);
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
        $this->pages->onSetContent(function ($name, $contents) {
            return "{$name}: $contents";
        });
        $this->pages->set('tests', 'testOnSet');
        $this->assertEquals('tests: testOnSet', $this->pages->get('tests'));
    }

    public function testSectionAndEnd()
    {
        $this->assertEquals('', $this->pages->get('tests'));
        $this->pages->section('tests');
        echo 'tested';
        $this->pages->end();
        $this->assertEquals('tested', $this->pages->get('tests'));
        $this->assertEquals('tested', $this->pages->emit());
    }
}
