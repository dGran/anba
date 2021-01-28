<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $blockHeader;
    public $title;

    public function __construct($blockHeader, $title = null)
    {
        $this->blockHeader = $blockHeader;
        $this->title = $title;
    }

    public function render()
    {
        return view('layouts.app');
    }
}
