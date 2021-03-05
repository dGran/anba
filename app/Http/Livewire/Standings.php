<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Season;
use App\Models\SeasonDivision;
use App\Models\SeasonConference;

class Standings extends Component
{
	public $season;
	public $view = "conference";
	public $order = "wavg";

	public $blank_view = false;

	// queryString
	protected $queryString = [
		'season',
		'view' => ['except' => 'conference'],
		'order' => ['except' => 'wavg'],
	];

	public function setOrder($name)
	{
    	$this->order = $name;
	}

	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season;
		} else {
			$this->blank_view = true;
		}
	}

    public function render()
    {
    	if (!$this->blank_view) {
    		$current_season = Season::where('slug', $this->season->slug)->first();
    		$seasons = Season::orderBy('id', 'desc')->get();
	    	$seasons_conferences = SeasonConference::
	    		leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
	    		->select('seasons_conferences.*', 'conferences.name')
	    		->where('season_id', $current_season->id)
	    		->orderBy('conferences.name')
	    		->get();
	    	$seasons_divisions = SeasonDivision::
	    		leftJoin('divisions', 'divisions.id', 'seasons_divisions.division_id')
	    		->leftJoin('seasons_conferences', 'seasons_conferences.id', 'seasons_divisions.season_conference_id')
	    		->leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
	    		->select('seasons_divisions.*', 'divisions.name')
	    		->where('seasons_divisions.season_id', $current_season->id)
	    		->orderBy('conferences.name', 'asc')
	    		->orderBy('divisions.name', 'asc')
	    		->get();

	        switch ($this->view) {
	            case 'conference':
	            	foreach ($seasons_conferences as $key => $conference) {
	                	$table_positions[$key] = $current_season->generateTable($this->view, $this->order, $conference->id, null);
	            	}
	                break;
	            case 'division':
	            	foreach ($seasons_divisions as $key => $division) {
	                	$table_positions[$key] = $current_season->generateTable($this->view, $this->order, null, $division->id);
	            	}
	                break;
	            case 'general':
	            	$table_positions = $current_season->generateTable($this->view, $this->order, null, null);
	                break;
	        }

	        return view('standings.index', [
	        	'current_season' => $current_season,
	        	'seasons' => $seasons,
	        	'seasons_conferences' => $seasons_conferences,
	        	'seasons_divisions' => $seasons_divisions,
				'table_positions' => $table_positions,
	        ]);
    	} else {
	        return view('standings.index', [
	        ]);
    	}
    }


}
