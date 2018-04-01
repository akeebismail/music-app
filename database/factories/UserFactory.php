<?php
use Faker\Generator as Faker;
$factory->define(App\Model\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'is_admin' => false,
        'preferences' => [],
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\Model\User::class, 'admin', function ( Faker $faker) use ($factory) {
    $user = $factory->raw(App\Model\User::class);

    return array_merge($user, ['is_admin' => true]);
});

$factory->define(App\Model\Artist::class, function ( Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => md5(uniqid()).'.jpg',
    ];
});

$factory->define(App\Model\Album::class, function ( Faker $faker) {
    return [
        'artist_id' => factory(\App\Model\Artist::class)->create()->id,
        'name' => ucwords($faker->words(random_int(2, 5), true)),
        'cover' => md5(uniqid()).'.jpg',
    ];
});

$factory->define(App\Model\Song::class, function ( Faker $faker) {
    $album = factory(\App\Model\Album::class)->create();

    return [
        'album_id' => $album->id,
        'artist_id' => $album->artist->id,
        'title' => ucwords($faker->words(random_int(2, 5), true)),
        'length' => $faker->randomFloat(2, 10, 500),
        'track' => random_int(1, 20),
        'lyrics' => $faker->paragraph(),
        'path' => '/tmp/'.uniqid().'.mp3',
        'mtime' => time(),
    ];
});

$factory->define(App\Model\Playlist::class, function ( Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(\App\Model\Interaction::class, function ( Faker $faker) {
    return [
        'song_id' => factory(\App\Model\Song::class)->create()->id,
        'user_id' => factory(\App\Model\User::class)->create()->id,
        'liked' => $faker->boolean,
        'play_count' => $faker->randomNumber,
    ];
});

$factory->define(\App\Model\Setting::class, function ( Faker $faker) {
    return [
        'key' => $faker->slug,
        'value' => $faker->name,
    ];
});
