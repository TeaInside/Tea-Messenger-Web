<?php

namespace IceTea\View\Compilers;

use IceTea\Utils\Config;
use IceTea\View\ViewSkeleton;
use IceTea\View\Compilers\Components\Layout;
use IceTea\View\Compilers\Components\Comments;
use IceTea\View\Compilers\Components\Conditionals;
use IceTea\View\Compilers\Components\CurlyInvoker;
use IceTea\View\Compilers\Components\RawPhp;

class TeaTemplateCompiler
{

    /**
     * @var \IceTea\View\ViewSkeleton $skeleton
     */
    private $skeleton;

    /**
     * @var string
     */
    private $rawViewFileHash;

    /**
     * @var string
     */
    private $mapFile;

    /**
     * @var array
     */
    private $map = [];

    /**
     * @var string
     */
    private $name;

    /**
     * Constructor.
     *
     * @param \IceTea\View\ViewSkeleton $skeleton
     */
    public function __construct(ViewSkeleton $skeleton)
    {
        $this->skeleton = $skeleton;
        $this->rawViewFileHash = sha1($skeleton->__toString());
        $this->mapFile  = Config::get("views_cache_map");
        $this->cacheDir = Config::get("views_cache_dir");
        if (file_exists($this->mapFile)) {
            $this->map      = json_decode(file_get_contents($this->mapFile), true);
            $this->map      = is_array($this->map) ? $this->map : [];
        } else {
            $this->map      = [];
        }
    }

    /**
     * @return bool
     */
    public function isIceTeaHasCompiledViewPerfectly()
    {
        return isset($this->map[$this->name = $this->skeleton->getName()]) && $this->map[$this->name] === $this->rawViewFileHash && file_exists($this->cacheDir."/".$this->rawViewFileHash.".php");
    }

    /**
     * @return bool
     */
    public function compile()
    {
        $this->buildComponent();
    }

    public function writeMap()
    {
        if (isset($this->map[$this->name]) && file_exists($oldFile = $this->cacheDir."/".$this->map[$this->name].".php")) {
            unlink($oldFile);
        }
        $this->map[$this->name] = $this->rawViewFileHash;
        file_put_contents($this->mapFile, json_encode($this->map, JSON_UNESCAPED_SLASHES));
    }

    public function writeCache()
    {
        $handle = fopen($this->cacheDir."/".$this->rawViewFileHash.".php", "w");
        flock($handle, LOCK_EX);
        fwrite($handle, $this->skeleton->getRaw());
        fclose($handle);
    }

    public function compact()
    {
        ___viewIsolator($this->cacheDir."/".$this->rawViewFileHash.".php", $this->skeleton->variables()->toArray());
    }

    private function buildComponent()
    {
        $comp = new Layout($this->skeleton);
        $comp->compile();
        $this->skeleton = $comp->getSkeleton();
        $comp = new Comments($this->skeleton);
        $comp->compile();
        $this->skeleton = $comp->getSkeleton();
        $comp = new Conditionals($this->skeleton);
        $comp->compile();
        $this->skeleton = $comp->getSkeleton();
        $comp = new CurlyInvoker($this->skeleton);
        $comp->compile();
        $this->skeleton = $comp->getSkeleton();
        $comp = new RawPhp($this->skeleton);
        $comp->compile();
        $this->skeleton = $comp->getSkeleton();
    }
}
