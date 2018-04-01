<?php
/**
 * Created by PhpStorm.
 * User: KIBB
 * Date: 3/31/2018
 * Time: 11:57 PM
 */
namespace App;
use Exception;
use Log;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

/**
 * Class KMApplication
 * @package Kibb Application
 */
class KMApplication extends Application{

    /**
     * Current Version
     *
     */
    const KIBB_VERSION = 'v1';

    /**
     * Public path to base path
     * @return string
     */
    public function publicPath()
    {
        return $this->basePath;
    }

    /**Load's a revison asset file, making use of gulp-rev
     * @param $file
     * @param null $manifestFile
     * @return string
     */
    public function kibb_rev($file, $manifestFile = null){
        static $manifest = null;
        $manifestFile = $manifestFile ? : public_path('public/mix.json');

        if ($manifest === null){
            $manifest = json_decode(file_get_contents($manifestFile), true);
        }
        if (isset($manifest[$file])){
            return file_exists(public_path('public/hot')) ? "http://localhost:8080{$manifest[$file]}" :
                $this->staticUrl("public{$manifest[$file]}");
        }

        throw  new InvalidArgumentException("File {$file} not defined in asset manifest");
    }

    /**
     * Get a URL for static file requests.
     * If this installation of Kibb cdn, use it as the base. not done yet
     * Otherwise, just use a full URL to the asset.
     *
     * @param string $name The additional resource name/path.
     *
     * @return string
     */
    public function staticUrl($name = null){
        $cdnURL = trim('kibb.cdn.url', '/');

        return $cdnURL ? $cdnURL.'/'.trim(ltrim($name,'/')) : trim(asset($name));
    }

    /**
     * Get Latest version of KM
     * @param Client $client
     * @return mixed
     */
    public function getLatestVersion(Client $client){
        return Cache::remember('latestKMVersion', 1* 24* 60, function () use ($client){
            $client = $client ? : new Client();
           try{
               $v = json_decode(
                   $client->get('github-ulr')->getBody()
               )[0]->name;
               return $v;
           } catch (Exception $e){
               Log::error($e);

               return self::KIBB_VERSION;
           }
        });
    }
}