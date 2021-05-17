<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Season;
use App\Http\Traits\PostTrait;

class PlayoffCrud extends Component
{
	use WithPagination;
	use WithFileUploads;
	use PostTrait;

	public $firstRender = true;

    public $season;

    // Mount & Render
    public function mount(Season $season)
    {
        $this->season = $season;
    }

    public function render()
    {
        return view('admin.playoffs')->layout('adminlte::page');
    }
}
