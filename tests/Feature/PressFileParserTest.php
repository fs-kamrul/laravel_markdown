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

        $this->assertContains('title: my title', $data[1]);
        $this->assertContains('description: description here', $data[1]);
        $this->assertContains('Block post body hear', $data[2]);
    }
}
