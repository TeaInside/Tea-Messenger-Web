<?php

namespace IceTea\View;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class CacheHandler
{

    /**
     * sha1 hash file.
     *
     * @var string
     */
    private $hash;

    /**
     * Cache file.
     *
     * @var string
     */
    private $cacheFile;

    /**
     * Content.
     *
     * @var string
     */
    private $content;

    /**
     *
     * @var string
     */
    private $file;


    /**
     * Constructor.
     *
     * @param string $hash
     */
    public function __construct($file, $content)
    {
        $this->file      = $file;
        $this->content   = $content;
        $this->hash      = sha1($content);
        $this->cacheFile = basepath('storage/framework/views/'.$this->hash.'.php');
        if (file_exists($this->mapFile = basepath('storage/framework/handler/view.map'))) {
            $this->cacheMap = json_decode(file_get_contents($this->mapFile), true);
            if (! is_array($this->cacheMap)) {
                $this->cacheMap = [];
            }
        } else {
            $this->cacheMap = [];
        }

    }//end __construct()


    public function makeCache()
    {
        isset(
            $this->cacheMap[$this->file]
        ) and file_exists(
            basepath(
                'storage/framework/views/'.$this->cacheMap[$this->file].'.php'
            )
        ) and unlink(
            basepath(
                'storage/framework/views/'.$this->cacheMap[$this->file].'.php'
            )
        );
        $this->cacheMap[$this->file] = $this->hash;
        $handle = fopen($this->mapFile, 'w');
        flock($handle, LOCK_EX);
        fwrite($handle, json_encode($this->cacheMap));
        fclose($handle);
        $handle = fopen($this->cacheFile, 'w');
        flock($handle, LOCK_EX);
        $out = fwrite($handle, $this->content);
        fclose($handle);
        return $out;

    }//end makeCache()


    public function getCacheFileName()
    {
        return $this->cacheFile;

    }//end getCacheFileName()


    public function isCached()
    {
        return
            isset($this->cacheMap[$this->file]) &&
            $this->cacheMap[$this->file] === $this->hash &&
            file_exists($this->cacheFile);

    }//end isCached()


}//end class
