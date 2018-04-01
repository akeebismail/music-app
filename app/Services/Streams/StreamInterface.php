<?php
/**
 * Created by PhpStorm.
 * User: KIBB
 * Date: 4/1/2018
 * Time: 1:00 AM
 */

namespace App\Services\Streams;

interface StreamInterface
{
    /**
     * Stream the current song
     */
    public function stream();
}