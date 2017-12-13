<?php

namespace IceTea\Console\Command\Make;

use IceTea\Console\Color;
use IceTea\Console\Command\Make;
use App\Providers\RouteServiceProvider;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Controller extends Make
{
    private $name;

    private $namespace;

    private $absoluteNamespace;

    private $run = [];

    private $path;

    public function __construct($run)
    {
        parent::__construct();
        $this->run = $run;
    }


    public function buildContext()
    {
        $this->getName(); // Not enough arguments (missing: "name").
        $this->getNamespace();
        $this->makeAbsoluteNamespace();
    }

    private function getName()
    {
        if (isset($this->run['parameter'])) {
            foreach ($this->run['parameter'] as $val) {
                if ($val['type'] === "name") {
                    $this->name = $val['data'];
                }
            }
        }
    }

    private function getNamespace()
    {
        $route = new RouteServiceProvider();
        $this->namespace = $route->getControllerNamespace();
    }

    private function makeAbsoluteNamespace()
    {
        $file = str_replace("\\", "/", $this->namespace."/".$this->name);
        $a = explode("/", $file);
        $b = $a;
        unset($b[count($b) - 1]);
        $this->namespace = implode("\\", $b);
        do {
            $this->namespace = str_replace("\\\\", "\\", $this->namespace, $n);
        } while ($n);
        $this->namespace = implode("\\", $b);
        if ($a[0] === "App") {
            $a[0] = strtolower($a[0]);
        }
        $count = count($a) - 1;
        $path = "";
        for ($i=0; $i < $count; $i++) {
            if (! is_dir(basepath($path .= $a[$i]."/"))) {
                mkdir($path);
            }
        }
        $this->path = $path;
        $this->name = end($a);
    }

    public function run()
    {
        $file = $this->path.$this->name.".php";
        if (!file_exists($file) || $this->isForced()) {
            $handle     = fopen($stub = __DIR__."/stubs/controller.php.stub", "r");
            $handle2    = fopen($file, "w");
            fwrite(
                $handle2,
                $this->stubCreateContext(fread($handle, filesize($stub)))
            );
            fclose($handle);
            fclose($handle2);
            if (file_exists($file)) {
                // success
                print Color::clr("Controller created successfully.", "green") . PHP_EOL;
            } else {
                // failed
                
            }
        } else {
            print Color::clr("Controller already exists!", "dark_grey", "red") . PHP_EOL;
        }
    }

    private function isForced()
    {
        if (isset($this->run['arguments'])) {
            foreach ($this->run['arguments'] as $k => $v) {
                if ($v['data'] === "f") {
                    return true;
                }
            }
        }
        if (isset($this->run['optional-arguments'])) {
            foreach ($this->run['optional-arguments'] as $k => $v) {
                if ($v['data'] === "--force") {
                    return true;
                }
            }
        }
        return false;
    }

    private function stubCreateContext($str)
    {
        return str_replace(
            [
                "{{__VERSION__}}",
                "{{__DATE__}}",
                "{{NAME}}",
                "{{__NAMESPACE__}}"
            ],
            [
                ICETEA_VERSION,
                date('Y-m-d H:i:s'),
                $this->name,
                $this->namespace
            ],
            $str
        );
    }
}
