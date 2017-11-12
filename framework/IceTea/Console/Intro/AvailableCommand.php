<?php

namespace IceTea\Console\Intro;

use IceTea\Console\Color;

class AvailableCommand
{


    public function buildContext()
    {
        $this->str  = Color::clr('Available commands:', 'brown');
        $this->str .= PHP_EOL.$this->normal();
        $this->str .= PHP_EOL.$this->make();

    }//end buildContext()


    public function __toString()
    {
        return $this->str;

    }//end __toString()


    private function normal()
    {
        return '  '.Color::clr('serve', 'green').'                Serve the application on the PHP development server';

    }//end normal()


    private function make()
    {
        return ' '.Color::clr('make', 'brown').'
  '.Color::clr('make:controller', 'green').'      Create a new controller class
  '.Color::clr('make:model', 'green').'           Create a new model class'.PHP_EOL;

    }//end make()


}//end class
