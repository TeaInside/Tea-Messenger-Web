<?php

namespace Console\Commands;

use Console\ConsoleCommand;
use Console\Colors\Color as Cl;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Make extends ConsoleCommand
{
    /**
     * @var array
     */
    private $param = [];

    /**
     * @var string
     */
    private $what;

    /**
     * @param array $param
     */
    public function input($param)
    {
        if (!isset($param[0])) {
            // code...
        } else {
            $this->what = strtolower($param[0]);
            array_shift($param);
            $this->param = $param;
        }
    }

    public function execute()
    {
        switch ($this->what) {
            case 'controller':
                $this->make_controller(...$this->param);
                break;
            case 'model':
                $this->make_model(...$this->param);
                break;

            default:
                break;
        }
    }

    private function make_controller($name)
    {
        $apppath = BASEPATH."/app/Controllers";
        $ice     = BASEPATH."/src/sys.vendor/template/controller.ice";
        $namespace = "App\\Controllers";
        $a = explode("/", $name = str_replace("\\", "/", $name));
        if (($cn = count($a)) > 1) {
            $cn--;
            for ($i=0; $i < $cn; $i++) {
                $namespace .= "\\" .$a[$i];
                $apppath .= "/".$a[$i];
                is_dir($apppath) or mkdir($apppath);
            }
        }
        $apppath .= "/".($class = end($a)).".php";
        if (!file_exists($apppath)) {
            $a = decice(file_get_contents($ice), "icetea framework", true);
            $a = str_replace(["{{~~Name~~}}", "{{~~Namespace~~}}", "{{~~NOW~~}}"], [$class, $namespace, date("Y-m-d H:i:s")], $a);
            file_put_contents($apppath, $a);
            if (file_exists($apppath)) {
                print Cl::clr("Controller created successfully.", "green")."\n";
            }
        } else {
            print Cl::clr("Controller already exists!", null, "red")."\n";
        }
    }

    private function make_model($name)
    {
        $apppath = BASEPATH."/app/Models";
        $ice     = BASEPATH."/src/sys.vendor/template/model.ice";
        $namespace = "App\\Models";
        $a = explode("/", $name = str_replace("\\", "/", $name));
        if (($cn = count($a)) > 1) {
            $cn--;
            for ($i=0; $i < $cn; $i++) {
                $namespace .= "\\" .$a[$i];
                $apppath .= "/".$a[$i];
                is_dir($apppath) or mkdir($apppath);
            }
        }
        $apppath .= "/".($class = end($a)).".php";
        if (!file_exists($apppath)) {
            $a = decice(file_get_contents($ice), "icetea framework", true);
            $a = str_replace(["{{~~Name~~}}", "{{~~Namespace~~}}", "{{~~NOW~~}}"], [$class, $namespace, date("Y-m-d H:i:s")], $a);
            file_put_contents($apppath, $a);
            if (file_exists($apppath)) {
                print Cl::clr("Model created successfully.", "green")."\n";
            }
        } else {
            print Cl::clr("Model already exists!", null, "red")."\n";
        }
    }

    public function result()
    {
    }
}
