<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id',
        'manager_id',
        'medium_name',
        'short_name',
        'img',
        'stadium',
        'color',
        'active',
        'slug',
    ];

    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'manager_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('teams.name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.id', 'LIKE', "%{$value}%")
                                ->orWhere('teams.medium_name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.short_name', 'LIKE', "%{$value}%")
                                ->orWhere('teams.stadium', 'LIKE', "%{$value}%")
                                ->orWhere('divisions.name', 'LIKE', "%{$value}%")
                                ->orWhere('users.name', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function scopeDivision($query, $value)
    {
        if ($value != 'all') {
            return $query->where('division_id', '=', $value);
        }
    }

    public function scopeActive($query, $value)
    {
        if ($value != "all") {
            if ($value == "active") {
                return $query->where('divisions.active', 1);
            } else {
                return $query->where('divisions.active', 0);
            }
        }
    }

    public function storageImg()
    {
        if (substr($this->img, 0, 5) == "teams") {
            return true;
        }
        return false;
    }

    public function getImg()
    {
        $default = asset('storage/teams/default.png');
        $local = asset('storage/' . $this->img);
        $broken = asset('img/broken.png');

        if ($this->img) {
            if ($this->storageImg()) {
                if (Storage::disk('public')->exists($this->img)) {
                    return $local;
                } else {
                    return $broken;
                }
            } else {
                return $this->img;
            }
        } else {
            return $default;
        }
    }

    public function getUserImg()
    {
        if ($this->user) {
            return $this->user->getImg();
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreatedAtDate()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("D MMMM YYYY");
    }

    public function getCreatedAtTime()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("kk[:]mm");
    }

    public function getRGBColor()
    {
        list($r, $g, $b) = sscanf($this->color, "#%02x%02x%02x");
        return $r . "," . $g . "," . $b;
    }

    public function getDarkenColor($adjustPercent)
    {
        return $color = $this->adjustBrightness($this->color, $adjustPercent);
    }

    protected function adjustBrightness($hexCode, $adjustPercent) {
        $hexCode = ltrim($hexCode, '#');

        if (strlen($hexCode) == 3) {
            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
        }

        $hexCode = array_map('hexdec', str_split($hexCode, 2));

        foreach ($hexCode as & $color) {
            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
            $adjustAmount = ceil($adjustableLimit * $adjustPercent);

            $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
        }

        return '#' . implode($hexCode);
    }

    public function teamPlayersStats($season_id, $team_id)
    {
        $team_players = [];
        foreach ($team->players as $player) {
            array_push($team_players, $player->id);
        }
        $result = PlayerStat::
            leftJoin('matches', 'matches.id', 'players_stats.match_id')
            ->where('matches.season_id', $season)
            ->whereIn('players_stats.player_id', $team_players)
            ->select('players_stats.player_id')
            ->selectRaw("AVG(players_stats.PTS) as total_PTS")
            ->selectRaw("AVG(players_stats.REB) as total_REB")
            ->selectRaw("AVG(players_stats.AST) as total_AST")
            ->groupBy('players_stats.player_id')
            ->get();

        return $result;
    }

    public function get_playoffs_apparences()
    {
        $team_id = $this->id;

        $playoffs = Playoff::
            join('playoffs_rounds', 'playoffs_rounds.playoff_id', 'playoffs.id')
            ->join('playoffs_clashes', 'playoffs_clashes.round_id', 'playoffs_rounds.id')
            ->leftJoin('seasons_teams as localSeasonTeam', 'localSeasonTeam.id', 'playoffs_clashes.local_team_id')
            ->leftJoin('seasons_teams as visitorSeasonTeam', 'visitorSeasonTeam.id', 'playoffs_clashes.visitor_team_id')
            ->leftJoin('teams as localTeam', 'localTeam.id', 'localSeasonTeam.team_id')
            ->leftJoin('teams as visitorTeam', 'visitorTeam.id', 'visitorSeasonTeam.team_id')
            ->select('playoffs.*')
            ->whereNull('playoffs.playin_place')
            ->where(function($q) use ($team_id) {
                $q->where('localTeam.id', $team_id)
                    ->orWhere('visitorTeam.id', $team_id);
                })
            ->groupBy('playoffs.season_id')
            ->get()->count();

        return $playoffs;
    }

    public function get_championships()
    {
        $team_id = $this->id;

        $counter = 0;
        $playoffs = Playoff::whereNull('playin_place')->get();
        foreach ($playoffs as $playoff) {
            if ($playoff->winner()->team->id == $team_id) {
                $counter++;
            }
        }

        return $counter;
    }

    public function get_all_seasons_team_matches()
    {
        $team_id = $this->id;

        $matches = MatchModel::
            with('scores')
            ->select('matches.*')
            ->leftJoin('seasons_teams as localSeasonTeam', 'localSeasonTeam.id', 'matches.local_team_id')
            ->leftJoin('seasons_teams as visitorSeasonTeam', 'visitorSeasonTeam.id', 'matches.visitor_team_id')
            ->leftJoin('teams as localTeam', 'localTeam.id', 'localSeasonTeam.team_id')
            ->leftJoin('teams as visitorTeam', 'visitorTeam.id', 'visitorSeasonTeam.team_id')
            ->whereNull('matches.clash_id')
            ->where('matches.played', 1)
            ->where(function($q) use ($team_id) {
                $q->where('localTeam.id', $team_id)
                    ->orWhere('visitorTeam.id', $team_id);
                })
            ->get();

        return $matches;
    }

    public function get_all_seasons_team_record()
    {
        $data = [
            "w" => 0,
            "l" => 0,
        ];

        $team_id = $this->id;
        $matches = $this->get_all_seasons_team_matches();

        foreach ($matches as $key => $match) {
            if ($match->played()) {
                $local_score = $match->scores->sum('local_score');
                $visitor_score = $match->scores->sum('visitor_score');
                if ($team_id == $match->localTeam->team_id) {
                    if ($local_score > $visitor_score) {
                        $data['w'] += 1;
                    } else {
                        $data['l'] += 1;
                    }
                } else {
                    if ($local_score > $visitor_score) {
                        $data['l'] += 1;
                    } else {
                        $data['w'] += 1;
                    }
                }
            }
        }

        return $data;
    }

    public function get_season_team_matches($season_id)
    {
        $team_id = $this->id;
        $matches = MatchModel::
            with('scores')
            ->select('matches.*')
            ->leftJoin('seasons_teams as localSeasonTeam', 'localSeasonTeam.id', 'matches.local_team_id')
            ->leftJoin('seasons_teams as visitorSeasonTeam', 'visitorSeasonTeam.id', 'matches.visitor_team_id')
            ->leftJoin('teams as localTeam', 'localTeam.id', 'localSeasonTeam.team_id')
            ->leftJoin('teams as visitorTeam', 'visitorTeam.id', 'visitorSeasonTeam.team_id')
            ->whereNull('matches.clash_id')
            ->where('matches.played', 1)
            ->where('matches.season_id', $season_id)
            ->where(function($q) use ($team_id) {
                $q->where('localTeam.id', $team_id)
                    ->orWhere('visitorTeam.id', $team_id);
                })
            ->get();

        return $matches;
    }

    public function get_season_team_record($season_id)
    {
        $team_id = $this->id;
        $matches = $this->get_season_team_matches($season_id);
        $data = [
            "w" => 0,
            "l" => 0,
        ];

        foreach ($matches as $key => $match) {
            if ($match->played()) {
                $local_score = $match->scores->sum('local_score');
                $visitor_score = $match->scores->sum('visitor_score');
                if ($team_id == $match->localTeam->team_id) {
                    if ($local_score > $visitor_score) {
                        $data['w'] += 1;
                    } else {
                        $data['l'] += 1;
                    }
                } else {
                    if ($local_score > $visitor_score) {
                        $data['l'] += 1;
                    } else {
                        $data['w'] += 1;
                    }
                }
            }
        }

        return $data;
    }

    public function top_season_mvp($season_id)
    {
        $team_id = $this->id;

        return $top = PlayerStat::with('player')
            ->join('matches', 'matches.id', 'players_stats.match_id')
            ->leftJoin('seasons_teams', 'seasons_teams.id', 'players_stats.season_team_id')
            ->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
            ->select('players_stats.player_id', 'players_stats.season_team_id',
                \DB::raw('AVG(PTS) as AVG_PTS'),
                \DB::raw('AVG(REB) as AVG_REB'),
                \DB::raw('AVG(AST) as AVG_AST'),
                \DB::raw('SUM(PTS + REB + AST) / COUNT(player_id) as AVG_TOTAL')
            )
            ->whereNull('matches.clash_id')
            ->where('players_stats.season_id', $season_id)
            ->where('teams.id', $team_id)
            ->orderBy('AVG_TOTAL', 'desc')
            ->orderBy('AVG_PTS', 'desc')
            ->orderBy('AVG_REB', 'desc')
            ->orderBy('AVG_AST', 'desc')
            ->groupBy('player_id', 'season_team_id')
            ->first();
    }

    public function canDestroy()
    {
        // apply logic
        if (SeasonTeam::where('team_id', $this->id)->count() > 0) { return false; }
        if (Post::where('team_id', $this->id)->count() > 0) { return false; }
        if (Player::where('team_id', $this->id)->count() > 0) { return false; }

        return true;
    }
}
