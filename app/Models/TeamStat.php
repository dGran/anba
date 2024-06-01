<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $match_id
 * @property int $season_id
 * @property int $season_team_id
 * @property int $counterattack
 * @property int $zone
 * @property int $second_oportunity
 * @property int $substitute
 * @property int $AST
 * @property int $DRB
 * @property int $ORB
 * @property int $STL
 * @property int $BLK
 * @property int $LOS
 * @property int $PF
 * @property \DateTime $updated_user_id
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 *
 * @method static Builder|TeamStat where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static Builder|TeamStat whereIn(string $column, array $values, string $boolean = 'and', bool $not = false)
 */
class TeamStat extends Model
{
    use HasFactory;

    public const STATE_ERROR = 'error';

    protected $table = "teams_stats";

    protected $fillable = [
        'match_id',
        'season_id',
        'season_team_id',
        'counterattack',
        'zone',
        'second_oportunity',
        'substitute',
        'advantage',
        'AST',
        'DRB',
        'ORB',
        'STL',
        'BLK',
        'LOS',
        'PF',
        'updated_user_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->created_at = new \DateTime();
    }

    public function match()
    {
        return $this->belongsTo(MatchModel::class, 'match_id', 'id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function seasonTeam()
    {
        return $this->belongsTo(SeasonTeam::class, 'season_team_id', 'id');
    }

    public function getName()
    {
        return "Estadísticas " . $this->seasonTeam->team->medium_name . ", partido " . $this->match->getName();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMatchId(): int
    {
        return $this->match_id;
    }

    public function setMatchId(int $match_id): void
    {
        $this->match_id = $match_id;
    }

    public function getSeasonId(): int
    {
        return $this->season_id;
    }

    public function setSeasonId(int $season_id): void
    {
        $this->season_id = $season_id;
    }

    public function getSeasonTeamId(): int
    {
        return $this->season_team_id;
    }

    public function setSeasonTeamId(int $season_team_id): void
    {
        $this->season_team_id = $season_team_id;
    }

    public function getCounterattack(): int
    {
        return $this->counterattack;
    }

    public function setCounterattack(int $counterattack): void
    {
        $this->counterattack = $counterattack;
    }

    public function getZone(): int
    {
        return $this->zone;
    }

    public function setZone(int $zone): void
    {
        $this->zone = $zone;
    }

    public function getSecondOportunity(): int
    {
        return $this->second_oportunity;
    }

    public function setSecondOportunity(int $second_oportunity): void
    {
        $this->second_oportunity = $second_oportunity;
    }

    public function getSubstitute(): int
    {
        return $this->substitute;
    }

    public function setSubstitute(int $substitute): void
    {
        $this->substitute = $substitute;
    }

    public function getAST(): int
    {
        return $this->AST;
    }

    public function setAST(int $AST): void
    {
        $this->AST = $AST;
    }

    public function getDRB(): int
    {
        return $this->DRB;
    }

    public function setDRB(int $DRB): void
    {
        $this->DRB = $DRB;
    }

    public function getORB(): int
    {
        return $this->ORB;
    }

    public function setORB(int $ORB): void
    {
        $this->ORB = $ORB;
    }

    public function getSTL(): int
    {
        return $this->STL;
    }

    public function setSTL(int $STL): void
    {
        $this->STL = $STL;
    }

    public function getBLK(): int
    {
        return $this->BLK;
    }

    public function setBLK(int $BLK): void
    {
        $this->BLK = $BLK;
    }

    public function getLOS(): int
    {
        return $this->LOS;
    }

    public function setLOS(int $LOS): void
    {
        $this->LOS = $LOS;
    }

    public function getPF(): int
    {
        return $this->PF;
    }

    public function setPF(int $PF): void
    {
        $this->PF = $PF;
    }

    public function getUpdatedUserId(): \DateTime
    {
        return $this->updated_user_id;
    }

    public function setUpdatedUserId(\DateTime $updated_user_id): void
    {
        $this->updated_user_id = $updated_user_id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
