<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "profile_photo_path",
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                        $q->where('users.name', 'LIKE', "%{$value}%")
                            ->orWhere('users.id', 'LIKE', "%{$value}%")
                            ->orWhere('users.email', 'LIKE', "%{$value}%");
                        });
        }
    }

    public function scopeState($query, $state)
    {
        switch ($state) {
            case 'all':
                break;
            case 'active':
                return $query->whereNotNull('email_verified_at');
                break;
            case 'inactive':
                return $query->whereNull('email_verified_at');
                break;
        }
    }

    public function getImg()
    {
        return $this->profile_photo_url;
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

    public function adminlte_image()
    {
        return $this->profile_photo_url;
    }

    public function adminlte_desc()
    {
        return 'Administrador';
    }

    public function adminlte_profile_url()
    {
        return "user/profile";
    }

    public function currentSeasonMatches()
    {
        $currentSeason = Season::where('current', 1)->first();
        $user_id = $this->id;
        $matches = Match::where('season_id', $currentSeason->id)
            ->where(function($q) use ($user_id) {
                $q->where('matches.local_manager_id', $user_id)
                    ->orWhere('matches.visitor_manager_id', $user_id);
                })
            ->get();
        return $matches;
    }

    public function pendingMatchesReports()
    {
        $user_id = $this->id;
        $matches = $this->currentSeasonMatches();

        $pending_reports = 0;
        foreach ($matches as $match) {
            if ($match->played()) {
                if ($match->local_manager_id == $user_id) {
                    if (!$match->hasLocalPlayerStats() || !$match->hasLocalTeamStats()) {
                        $pending_reports++;
                    }
                } else {
                    if (!$match->hasVisitorPlayerStats() || !$match->hasVisitorTeamStats()) {
                        $pending_reports++;
                    }
                }
            }
        }

        return $pending_reports;
    }

    public function canDestroy()
    {
        // apply logic
        if (Team::where('manager_id', $this->id)->count() > 0) { return false; }
        if (Statement::where('manager_id', $this->id)->count() > 0) { return false; }
        if (Match::where('local_manager_id', $this->id)->orWhere('visitor_manager_id', $this->id)->count() > 0) { return false; }
        if (MatchPoll::where('user_id', $this->id)->count() > 0) { return false; }
        if (Score::where('updated_user_id', $this->id)->count() > 0) { return false; }
        if (TeamStat::where('updated_user_id', $this->id)->count() > 0) { return false; }
        if (PlayerStat::where('updated_user_id', $this->id)->count() > 0) { return false; }
        if (AdminLog::where('user_id', $this->id)->count() > 0) { return false; }

        return true;
    }
}
