<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Season;
use App\Models\SeasonConference;
use App\Models\Post;

use App\Http\Traits\PostTrait;

use App\Events\PostStored;

class Home extends Component
{
	use WithPagination;
	use PostTrait;

	public $season;
	public $filterType = "all";
	public $seasons_conferences;
	public $table_positions = [];

	// queryString
	protected $queryString = [
		'filterType' => ['except' => "all"],
	];

	public function setFilterType($type)
	{
		$this->filterType = $type;
		$this->page = 1;
	}

    // Pagination
    public function setNextPage()
    {
    	$this->page++;
    }

    public function setPreviousPage()
    {
		$this->page--;
    }

	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season;
		}
	}

    public function render()
    {
    	$posts = Post::with('match.visitorTeam.team', 'match.localTeam.team', 'team', 'player')
    		->type($this->filterType)->orderBy('created_at', 'desc')->paginate(16);
	    if (($posts->total() > 0 && $posts->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $posts->lastPage();
		}
		$posts = Post::with('match.visitorTeam.team', 'match.localTeam.team', 'team', 'player')
			->type($this->filterType)->orderBy('created_at', 'desc')->paginate(16);

    	if ($this->season) {
	    	$this->seasons_conferences = SeasonConference::
	    		join('conferences', 'conferences.id', 'seasons_conferences.conference_id')
	    		->select('seasons_conferences.*', 'conferences.name')
	    		->where('season_id', $this->season->id)
	    		->orderBy('conferences.name')
	    		->get();
	    	foreach ($this->seasons_conferences as $key => $conference) {
	        	$this->table_positions[$key] = $this->season->generateTable('conference', 'wavg', $conference->id, null);
	    	}
    	}

        return view('home.index', [
        	'posts' => $posts,
        ]);
    }
}