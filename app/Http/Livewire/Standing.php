<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Season;
use App\Models\SeasonDivision;
use App\Models\SeasonConference;

class Standing extends Component
{
	public $view = "conferencia";

	// queryString
	protected $queryString = [
		'view' => ['except' => 'conferencia'],
	];

	// public function mount()
	// {
	// 	$this->view = "conferencia";
	// }

    public function render()
    {
    	if ($season = Season::find(5)) {
	    	$seasons_conferences = SeasonConference::
	    		leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
	    		->select('seasons_conferences.id', 'conferences.name')
	    		->where('season_id', $season->id)
	    		->orderBy('conferences.name')
	    		->get();
	    	$seasons_divisions = SeasonDivision::
	    		leftJoin('divisions', 'divisions.id', 'seasons_divisions.division_id')
	    		->select('seasons_divisions.id', 'divisions.name')
	    		->where('season_id', $season->id)
	    		->orderBy('divisions.name')
	    		->get();

	        switch ($this->view) {
	            case 'conferencia':
	            	foreach ($seasons_conferences as $key => $conference) {
	                	$table_positions[$key] = $season->generateConferencesTable($conference->id);
	            	}
	                break;
	            case 'division':
	            	foreach ($seasons_divisions as $key => $division) {
	                	$table_positions[$key] = $season->generateDivisionsTable($division->id);
	            	}
	                break;
	            case 'general':
	            	$table_positions = $season->generateGeneralTable();
	                break;
	        }

	        return view('standings.index', [
	        	'season' => $season,
	        	'seasons_conferences' => $seasons_conferences,
	        	'seasons_divisions' => $seasons_divisions,
				'table_positions' => $table_positions,
	        ]);
    	} else {
	        return view('livewire.standing', [
	        ]);
    	}
    }


}
