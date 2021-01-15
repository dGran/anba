<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $blockHeader;

    public function __construct($blockHeader)
    {
        $this->blockHeader = $blockHeader;
    }

    public function render()
    {
        return view('layouts.app');
    }
}
