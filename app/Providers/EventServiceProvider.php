<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SongLikeToggled' => [
            'App\Listeners\LoveTrackOnLastfm',
        ],

        'App\Events\SongStartedPlaying' => [
            'App\Listeners\UpdateLastfmNowPlaying',
        ],

        'App\Events\LibraryChanged' => [
            'App\Listeners\TidyLibrary',
            'App\Listeners\ClearMediaCache',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Generate a unique hash for a song from its path to be the ID
        Song::creating(function ($song) {
            $song->id = File::getHash($song->path);
        });

        // Remove the cover file if the album is deleted
        Album::deleted(function ($album) {
            if ($album->hasCover) {
                try {
                    unlink(app()->publicPath()."/public/img/covers/{$album->cover}");
                } catch (Exception $e) {
                }
            }
        });
    }
}
