<?php

namespace App\Http\Livewire\Players;

use Livewire\Component;
use App\Models\Player;
use App\Models\Team;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $order = 'name';
    //filters
    public $fteam = "all";
    public $fposition = "all";
    public $fcollege = "all";
    public $fnation = "all";
    public $fstate = "active";
    public $foutnba = "all";

    // queryString
    protected $queryString = [
        'search' => ['except' => ''],
        'fteam' => ['except' => "all"],
        'fposition' => ['except' => "all"],
        'fcollege' => ['except' => "all"],
        'fnation' => ['except' => "all"],
        'fstate' => ['except' => "active"],
        'foutnba' => ['except' => "all"],
        // 'perPage' => ['except' => '25'],
        'order' => ['except' => 'name'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setCurrentPage(){
        // $this->setPage($this->page);
        $this->gotoPage($this->page);
    }

    public function toPage($page)
    {
        $this->gotoPage($page);
    }

    public function nextPage($lastPage)
    {
        if (($this->page + 1) <= $lastPage) {
            $this->setPage($this->page + 1);
        } else {
            $this->setPage(1);
        }
    }

    public function previousPage($lastPage)
    {
        if ($this->page > 1) {
            $this->setPage($this->page - 1);
        } else {
            $this->setPage($lastPage);
        }
    }

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    protected function getOrder($order) {
        $order_ext = [
            'name' => [
                'field'     => 'name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'name',
                'direction' => 'desc'
            ],
            'team' => [
                'field'     => 'teams.name',
                'direction' => 'asc'
            ],
            'team_desc' => [
                'field'     => 'teams.name',
                'direction' => 'desc'
            ],
            'position' => [
                'field'     => 'position',
                'direction' => 'asc'
            ],
            'position_desc' => [
                'field'     => 'position',
                'direction' => 'desc'
            ],
            'height' => [
                'field'     => 'height',
                'direction' => 'asc'
            ],
            'height_desc' => [
                'field'     => 'height',
                'direction' => 'desc'
            ],
            'weight' => [
                'field'     => 'weight',
                'direction' => 'asc'
            ],
            'weight_desc' => [
                'field'     => 'weight',
                'direction' => 'desc'
            ],
            'nation' => [
                'field'     => 'nation_name',
                'direction' => 'asc'
            ],
            'nation_desc' => [
                'field'     => 'nation_name',
                'direction' => 'desc'
            ],
            'college' => [
                'field'     => 'college',
                'direction' => 'asc'
            ],
            'college_desc' => [
                'field'     => 'college',
                'direction' => 'desc'
            ],
        ];
        return $order_ext[$order];
    }

    public function render()
    {
        $players = Player::
            leftJoin('teams', 'teams.id', 'players.team_id')
            ->select('players.*', 'teams.name as team_name')
            ->name($this->search)
            ->team($this->fteam)
            ->position($this->fposition)
            ->college($this->fcollege)
            ->nation($this->fnation)
            ->retired($this->fstate)
            ->outnba($this->foutnba)
            ->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
            ->orderBy('name', 'asc')
            ->paginate(15)->onEachSide(1);

        $teams = Team::orderBy('medium_name', 'asc')->get();
        $nations = Player::select('nation_name')->distinct()->whereNotNull('nation_name')->orderBy('nation_name', 'asc')->get();
        $colleges = Player::select('college')->distinct()->whereNotNull('college')->orderBy('college', 'asc')->get();

        return view('players.index', [
            'players' => $players,
            'teams' => $teams,
            'nations' => $nations,
            'colleges' => $colleges,
        ]);
    }
}
