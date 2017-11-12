<?php

namespace IceTea\View\Compilers;

use IceTea\View\View;

class TeaCompiler
{

    /**
     * View instance.
     *
     * @var \Icetea\View\View
     */
    private $view;


    /**
     * Constructor.
     *
     * @param \Icetea\View\View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;

    }//end __construct()


    public function compile()
    {

    }//end compile()


}//end class
