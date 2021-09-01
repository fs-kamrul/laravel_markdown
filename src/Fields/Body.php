<?php

namespace kamrul\Press\Fields;

use kamrul\Press\MarkdownParser;

class Body
{
    public static function process($type, $value)
    {
        return [
            $type => MarkdownParser::parse($value),
        ];
    }
}
