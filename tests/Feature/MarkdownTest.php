<?php

namespace kamrul\Press\Tests\Feature;

use kamrul\Press\MarkdownParser;
use Orchestra\Testbench\TestCase;

class MarkdownTest extends TestCase
{
    /** @test */
    public function simple_markdown_is_parsed(){

        $this->assertEquals('<h1>Heading</h1>', MarkdownParser::parse('# Heading'));


    }
}
