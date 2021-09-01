<?php

namespace kamrul\Press\Tests\Feature;

use Carbon\Carbon;
use kamrul\Press\PressFileParser;
use Orchestra\Testbench\TestCase;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_gets_split()
    {
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: my title', $data[1]);
        $this->assertStringContainsString('description: description here', $data[1]);
        $this->assertStringContainsString('Block post body here', $data[2]);
    }
    /** @test */
    public function a_string_can_also_be_used_instead()
    {
        $pressFileParser = (new PressFileParser("---\ntitle: my title\n---\nBlock post body hear"));

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: my title', $data[1]);
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
        $this->assertEquals("<h1>Heading</h1>\n<p>Block post body here</p>",$data['body']);
    }
    /** @test */
    public function a_date_field_gets_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ndate: May 14 1988\n---\n"));

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('05/14/1988',$data['date']->format('m/d/Y'));
    }
}
