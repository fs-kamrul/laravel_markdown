<?php

namespace kamrul\Press\Drivers;

use Illuminate\Support\Facades\File;
use kamrul\Press\Exceptions\FileDriverDirectoryNotFountException;


class FileDriver extends Driver
{
    public function fetchPosts()
    {
        $files = File::files($this->config['path']);
//        dd($files);

        foreach ($files as $file){
//            $this->posts[] = (new PressFileParser($file->getPathname()))->getData();
            $this->parse($file->getPathname(), $file->getFilename());
//            dd($post);
        }
        return $this->posts ?? [];
    }

    protected function validateSource()
    {
        if ( ! File::exists($this->config['path'])){
            throw new FileDriverDirectoryNotFountException(
                'Director at \'' . $this->config['path'] . '\' does not exist. Check the directory path in the congig file.'
            );
        }
    }

}
