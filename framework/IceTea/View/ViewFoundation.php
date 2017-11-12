<?php

namespace IceTea\View;

use InvalidArgumentException;

final class ViewFoundation
{

    /**
     *
     */
    private $variable;

    private $view;


    public function __construct($view, $variable)
    {
        $this->name     = $view;
        $this->variable = $variable;

    }//end __construct()


    public function getViewFile()
    {
        if ($file = $this->findViewFile()) {
            return file_get_contents($file);
        } else {
            throw new InvalidArgumentException("View [$this->name] not found.");
        }

    }//end getViewFile()


    public function getViewFileName()
    {
        return $this->view;

    }//end getViewFileName()


    private function findViewFile()
    {

    }//end findViewFile()


    public function getVariables()
    {
        return $this->variable;

    }//end getVariables()


}//end class
