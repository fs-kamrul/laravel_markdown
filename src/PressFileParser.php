<?php

namespace kamrul\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use kamrul\Press\Fields\Date;

class PressFileParser
{
    protected $filename;
    protected $rawdata;
    protected $data;
    public function __construct($filename)
    {
        $this->filename = $filename;

        $this->splitFile();
        $this->explodeData();
        $this->processFields();
    }
    public function getData()
    {
        return $this->data;
    }
    public function getRawData()
    {
        return $this->rawdata;
    }
    protected function splitFile()
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $this->rawdata
        );
//        dd($this->data);
    }
    protected function explodeData()
    {
//        dd(explode("\n",trim($this->data[1])));
        foreach (explode("\n",trim($this->rawdata[1])) as $fieldString){
            preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);

            $this->data[$fieldArray[1]] = $fieldArray[2];
        }
//        dd(trim($this->data[2]));
        $this->data['body'] = trim($this->rawdata[2]);
    }

    protected function processFields()
    {
        foreach ($this->data as $field => $value){
//            if($field === 'date'){
//                $this->data[$field] = Carbon::parse($value);
//            }else if($field === 'body'){
//                $this->data[$field] = MarkdownParser::parse($value);
//            }

                $class = 'kamrul\\Press\\Fields\\' . Str::title($field);
                if( ! class_exists($class) && ! method_exists($class, 'process')){
                    $class = 'kamrul\\Press\\Fields\\Extra';
                }
//                    dd($class::process($field, $value));
                    $this->data = array_merge(
                        $this->data,
                        $class::process($field, $value, $this->data)
                    );
        }
//        dd($this->data);
    }
}
