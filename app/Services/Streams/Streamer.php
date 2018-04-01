<?php
/**
 * Created by PhpStorm.
 * User: KIBB
 * Date: 4/1/2018
 * Time: 1:02 AM
 */
namespace App\Services\Streams;

use App\Model\Song;

class Streamer

{    /**
 * @var Song|string
 */
    protected $_song;

    /**
     * @var string
     */
    protected $_contentType;

    /**
     * BaseStreamer constructor.
     *
     * @param $song Song
     */
    public function __construct(Song $song)
    {
        $this->_song = $song;

        abort_unless($this->_song->s3_params || file_exists($this->_song->path), 404);

        // Hard code the content type instead of relying on PHP's fileinfo()
        // or even Symfony's MIMETypeGuesser, since they appear to be wrong sometimes.
        $this->_contentType = 'audio/'.pathinfo($this->_song->path, PATHINFO_EXTENSION);

        // Turn off error reporting to make sure our stream isn't interfered.
        @error_reporting(0);
    }
}