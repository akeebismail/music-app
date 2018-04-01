<?php

namespace App\Services\Streams;

class XSendFileStreamer extends Streamer implements StreamInterface
{
    /**
     * Stream the current song using Apache's x_sendfile module.
     */
    public function stream()
    {
        header("X-Sendfile: {$this->_song->path}");
        header("Content-Type: {$this->_contentType}");
        header('Content-Disposition: inline; filename="'.basename($this->_song->path).'"');

        exit;
    }
}
