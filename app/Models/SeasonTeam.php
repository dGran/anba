<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Team $team
 * @property Season $season
 * @property SeasonDivision $seasonDivision
 * @property string $created_at
 * @property string $updated_at
 */
class SeasonTeam extends Model
{
    use HasFactory;

    protected $table = 'seasons_teams';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->created_at = Carbon::now();
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function seasonDivision(): BelongsTo
    {
        return $this->belongsTo(SeasonDivision::class, 'season_division_id', 'id');
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): SeasonTeam
    {
        $this->attributes['team_id'] = $team->getId();

        return $this;
    }

    public function getSeason(): Season
    {
        return $this->season;
    }

    public function setSeason(Season $season): SeasonTeam
    {
        $this->attributes['season_id'] = $season->getId();

        return $this;
    }

    public function getSeasonDivision(): SeasonDivision
    {
        return $this->seasonDivision;
    }

    public function setSeasonDivision(SeasonDivision $seasonDivision): SeasonTeam
    {
        $this->attributes['season_division_id'] = $seasonDivision->getId();

        return $this;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['created_at']);
    }

    public function setCreatedAt($value): SeasonTeam
    {
        $this->attributes['created_at'] = $value;

        return $this;
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->attributes['updated_at']);
    }

    public function setUpdatedAt($value): SeasonTeam
    {
        $this->attributes['updated_at'] = $value;

        return $this;
    }
}
