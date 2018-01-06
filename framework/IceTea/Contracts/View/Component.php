<?php

namespace IceTea\Contracts\View;

interface Component
{
    public function __construct($skeleton);

    public function compile();
}
