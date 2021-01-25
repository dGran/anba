<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
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

    public function autopost()
    {
    	$post = $this->storePost(
			'declaraciones',
			null,
			null,
			null,
			'Categoria',
			'Título de prueba',
			'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa quaerat, sequi, ratione fugiat alias odio atque. Porro, quae perspiciatis repellendus omnis iste a dolore neque nam quaerat, molestias, et quisquam.',
			null
    	);
    	event(new PostStored($post));
    }

	public function mount()
	{
		if ($season = Season::where('current', 1)->first()) {
			$this->season = $season;
		}
	}

    public function render()
    {
    	if ($this->season) {
	    	$seasons_conferences = SeasonConference::
	    		leftJoin('conferences', 'conferences.id', 'seasons_conferences.conference_id')
	    		->select('seasons_conferences.*', 'conferences.name')
	    		->where('season_id', $this->season->id)
	    		->orderBy('conferences.name')
	    		->get();
	    	foreach ($seasons_conferences as $key => $conference) {
	        	$table_positions[$key] = $this->season->generateTable('conference', 'wavg', $conference->id, null);
	    	}
    	}

    	$posts = Post::type($this->filterType)->orderBy('created_at', 'desc')->paginate(15);
	    if (($posts->total() > 0 && $posts->count() == 0)) {
			$this->page = 1;
		}
		if ($this->page == 0) {
			$this->page = $posts->lastPage();
		}
		$posts = Post::type($this->filterType)->orderBy('created_at', 'desc')->paginate(15);

        return view('home.index', [
        	'posts' => $posts,
        	'seasons_conferences' => $this->season ? $seasons_conferences : null,
        	'table_positions' => $this->season ? $table_positions : null,
        ]);
    }
}