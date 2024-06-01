<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $season_id
 * @property int $team_id
 * @property int $season_division_id
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 *
 * @property-read Team $team
 * @property-read Season $season
 * @property-read SeasonDivision $seasonDivision
 */
class SeasonTeam extends Model
{
    use HasFactory;

    protected $table = 'seasons_teams';

    protected $fillable = [
        'season_id', 'team_id', 'season_division_id'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): SeasonTeam
    {
        $this->team = $team;

        return $this;
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function getSeason(): Season
    {
        return $this->season;
    }

    public function setSeason(Season $season): SeasonTeam
    {
        $this->season = $season;

        return $this;
    }

    public function seasonDivision(): BelongsTo
    {
        return $this->belongsTo(SeasonDivision::class, 'season_division_id', 'id');
    }

    public function getSeasonDivision(): SeasonDivision
    {
        return $this->seasonDivision;
    }

    public function setSeasonDivision(SeasonDivision $seasonDivision): SeasonTeam
    {
        $this->seasonDivision = $seasonDivision;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSeasonId(): int
    {
        return $this->season_id;
    }

    public function setSeasonId(int $season_id): void
    {
        $this->season_id = $season_id;
    }

    public function getTeamId(): int
    {
        return $this->team_id;
    }

    public function setTeamId(int $team_id): void
    {
        $this->team_id = $team_id;
    }

    public function getSeasonDivisionId(): int
    {
        return $this->season_division_id;
    }

    public function setSeasonDivisionId(int $season_division_id): void
    {
        $this->season_division_id = $season_division_id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updated_at = $updatedAt;
    }



    public function getName(): string
    {
        return $this->getSeason()->getName().' - '.$this->team->name;
    }

    public function lastMatches()
    {
        return MatchModel::
        leftJoin('scores', 'scores.match_id', 'matches.id')
            ->leftJoin('seasons_teams', function ($join) {
                $join->on('seasons_teams.id', '=', 'matches.local_team_id');
                $join->orOn('seasons_teams.id', '=', 'matches.visitor_team_id');
            })
            // ->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
            // ->leftJoin('users', function($join){
            //     $join->on('users.id','=','matches.local_manager_id');
            //     $join->orOn('users.id','=','matches.visitor_manager_id');
            // })
            ->team($this->id)
            ->whereNotNull('scores.match_id')
            ->select('matches.*')
            ->orderBy('scores.created_at', 'desc')
            ->groupBy('matches.id', 'scores.created_at')
            ->take(5)
            ->get();
    }

    public function canDestroy()
    {
        // apply logic
        if (TeamStat::where('season_team_id', $this->id)->count() > 0) { return false; }
        if (PlayerStat::where('season_team_id', $this->id)->count() > 0) { return false; }
        if (MatchModel::where('local_team_id', $this->id)->orWhere('visitor_team_id', $this->id)->count() > 0) { return false; }
        //pending
        // RoundParticipant
        // RoundClash

        return true;
    }
}
