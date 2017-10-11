<?php

/**
 * IceTea Framework
 */

namespace App\Controllers;

use App\Models\ContohModel;
use Handler\IceTeaController;

class ContohController extends IceTeaController
{
    public function index($param)
    {
        view("welcome", ["title"=>"Lorem ipsum"]);
    }

    public function testModel()
    {
        $model = new ContohModel();
        $model->test();
    }

    public function testRandomString()
    {
        print rstr(100);
    }

    public function testEncryption()
    {
        $a = rstr(32, "a");
        for ($i=0; $i < 1; $i++) {
            print "encrypted = ";
            print var_dump($dec = encice($a, "a"))."<br>";
            print "decrypted = ";
            var_dump(decice($dec, "a"));
            print "<br><br>";
        }
    }
}
