<?php
/**
 * Created by PhpStorm.
 * User: KIBB
 * Date: 4/1/2018
 * Time: 1:45 AM
 */
namespace App\Services\Streams;

class S3Streamer extends Streamer implements StreamInterface{

    public function stream()
    {
        return redirect($this->_song->getObjectStoragePublicUrl());
    }
}