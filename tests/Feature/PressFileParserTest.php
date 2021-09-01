<?php

namespace kamrul\Press\Tests\Feature;

use kamrul\Press\PressFileParser;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertStringContainsString('title: my title', $data[1]);
        $this->assertStringContainsString('description: description here', $data[1]);
        $this->assertStringContainsString('Block post body hear', $data[2]);
    }
    /** @test */
    public function each_head_field_gets_separated()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();
        $this->assertEquals('my title',$data['title']);
        $this->assertEquals('description here',$data['description']);
    }
    /** @test */
    public function the_body_gets_saved_and_trimmed()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();
        $this->assertEquals("# Heading\n\nBlock post body here",$data['body']);
    }
}
