<?php
/**
 * Created by PhpStorm.
 * User: KIBB
 * Date: 4/1/2018
 * Time: 12:55 AM
 */
namespace App\Services;

class Media {
    /**
     * All applicable tags in a media file that we cater for.
     * Note that each isn't necessarily a valid ID3 tag name.
     *
     * @var array
     */
    protected $allTags = [
        'artist',
        'album',
        'title',
        'length',
        'track',
        'disc',
        'lyrics',
        'cover',
        'mtime',
        'compilation',
    ];

    /**
     * Tags to be synced.
     *
     * @var array
     */
    protected $tags = [];

    public function sync($mediaPath = null, $tags =[], $force = false){

    }
}