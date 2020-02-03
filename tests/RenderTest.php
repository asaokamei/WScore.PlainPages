<?php


use PHPUnit\Framework\TestCase;
use WScore\PlainPages\PlainPages;

class RenderTest extends TestCase
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

    public function testRender()
    {
        $contents = $this->pages->render(__DIR__ . '/templates/render-me.php');
        $this->assertEquals('render-me', $contents);
    }

    public function testRenderWithTemplateDir()
    {
        $pages = new PlainPages(__DIR__ . '/templates-dir/');
        $contents = $pages->render('render-me.php');
        $this->assertEquals("Layout:\nrender-dir", $contents);
        $pages->close();
        unset($pages);
    }

    public function testRenderLayout()
    {
        $contents = $this->pages->render(__DIR__ . '/templates-layout/render-me.php');
        $this->assertEquals("Layout:\nrender-me", $contents);
    }

    public function testRenderNestedLayout()
    {
        $contents = $this->pages->render(__DIR__ . '/templates-nested/render-me.php');
        $this->assertEquals("Layout:\nNested:\nrender-me", $contents);
    }
}
