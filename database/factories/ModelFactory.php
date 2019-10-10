<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * Authentication - Users, Roles, Permissions
 */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

/**
 * NewsCRUD
 */

$factory->define(Backpack\NewsCRUD\app\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(Backpack\NewsCRUD\app\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(Backpack\NewsCRUD\app\Models\Article::class, function (Faker\Generator $faker) {
    return [
        'category_id' => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(Backpack\NewsCRUD\app\Models\Category::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
        'title'    => ucfirst($faker->unique()->sentence()),
        'content'  => $faker->text(800),
        'status'   => $faker->shuffle(['PUBLISHED', 'DRAFT'])[0],
        'date'     => $faker->date(),
        'featured' => $faker->boolean(),
    ];
});


/**
 * Demo Entities
 */

$factory->define(App\Models\Monster::class, function (Faker\Generator $faker) {
    return [
        'text'            => ucfirst($faker->unique()->sentence()),
        'wysiwyg'         => $faker->text(800),
        'simplemde'       => $faker->text(800),
        'summernote'      => $faker->text(800),
        'tinymce'         => $faker->text(800),
        'textarea'        => $faker->text(250),
        'text'            => $faker->text(120),
        'date'            => $faker->date(),
        'start_date'      => $faker->date(),
        'end_date'        => $faker->date(),
        'datetime'        => $faker->datetime(),
        'datetime_picker' => $faker->datetime(),
        'email'           => $faker->email(),
        'checkbox'        => $faker->boolean(),
        'number'          => rand(),
        'float'           => rand(),
        'select'          => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(Backpack\NewsCRUD\app\Models\Category::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name'        => ucfirst($faker->unique()->sentence()),
        'description' => $faker->text(50),
        'details'     => $faker->text(800),
        // 'features',

        'price'       => rand(),
        'category_id' => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(Backpack\NewsCRUD\app\Models\Category::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
    ];
});
