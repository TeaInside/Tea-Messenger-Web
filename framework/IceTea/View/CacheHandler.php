<?php

namespace IceTea\View;

use IceTea\View\Compilers\ComponentState;

class CacheHandler
{

    /**
     * @var \IceTea\View\ViewSkeleton
     */
    private $skeleton;

    private $state = [];

    private $content;

    private $filename;

    /**
     * Constructor.
     *
     * @param \IceTea\View\ViewSkeleton $skeleton
     */
    public function __construct(ViewSkeleton $skeleton)
    {
        $this->skeleton = $skeleton;
    }

    public function isCached()
    {
    }

    public function isPerfectCache()
    {
    }

    public function makeCache()
    {
        $this->skeleton->buildBody();
        $this->component = $this->skeleton->getComponent();
        $this->selfhash  = $this->skeleton->getSelfHash();
        $this->content = $this->skeleton->getContent();
        $this->state = ComponentState::getState();
        $this->writeCacheInfo();
        $this->writeCacheData();
    }

    private function writeCacheInfo()
    {
        if (file_exists($infofile = basepath("storage/framework/handler/view.map"))) {
            $info = json_decode(file_get_contents($infofile), true);
            $info = is_array($info) ? $info : [];
        }
        $info[$this->state['main']['file']] = $this->state['sub'];
        $handle = fopen($infofile, "w");
        flock($handle, LOCK_EX);
        fwrite($handle, json_encode($info));
        fclose($handle);
    }

    private function writeCacheData()
    {
        $handle = fopen(
            $this->filename = basepath("storage/framework/views/".$this->state['main']['hash'].".php"), 
            "w"
        );
        flock($handle, LOCK_EX);
        fwrite($handle, $this->content);
        fclose($handle);
    }

    public function getCacheFileName()
    {
        return $this->filename;
    }
}
