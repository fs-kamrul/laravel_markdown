<?php

namespace kamrul\Press\Fields;

use kamrul\Press\MarkdownParser;

class Body extends FieldContract
{
    public static function process($type, $value, $data)
    {
        return [
            $type => MarkdownParser::parse($value),
        ];
    }
}
