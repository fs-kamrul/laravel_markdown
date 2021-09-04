<?php

namespace kamrul\Press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use kamrul\Press\Post;
use kamrul\Press\Press;
use kamrul\Press\PressFileParser;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';
    protected $description = 'Update blog posts.';
    public function handle()
    {
//        $this->info('hello');

        if (Press::configNotPublished()){
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }
        try {
            $posts = Press::driver()->fetchPosts();

            foreach ($posts as $post) {
                Post::created([
                    'identifier' => $post['identifier'],
                    'slug' => Str::slug($post['title']),
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'extra' => $post['extra'] ?? [],
                ]);
            }
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }


    }
}
