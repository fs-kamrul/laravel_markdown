<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
//namespace kamrul\Press\Database\Factories;

use kamrul\Press\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'identifier' => Str::random(),
        'slug' => Str::slug($faker->sentence),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'extra' => json_encode(['test' => 'value']),
    ];
});


//use Illuminate\Database\Eloquent\Factories\Factory;
//use Illuminate\Support\Str;
//use kamrul\Press\Models\Post;
//
//class PostFactory extends Factory
//{
//    /**
//     * The name of the factory's corresponding model.
//     *
//     * @var string
//     */
//    protected $model = Post::class;
//
//    /**
//     * Define the model's default state.
//     *
//     * @return array
//     */
//    public function definition()
//    {
//        return [
//            'identifier' => Str::random(),
//            'slug' => Str::slug($this->faker->sentence),
//            'title' => $this->faker->sentence,
//            'body' => $this->faker->paragraph,
//            'extra' => json_encode(['test' => 'value']),
//        ];
//    }
//}
