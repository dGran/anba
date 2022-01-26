<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\MatchModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ManagerController extends Controller
{
    public function pendingReports()
    {
        $user_id = Auth::id();
        $currentSeason = Season::where('current', 1)->first();

        $matches = MatchModel::with('scores', 'localTeam.team', 'visitorTeam.team', 'localManager', 'visitorManager')
            ->join('scores', 'scores.match_id', 'matches.id')
        	->where('season_id', $currentSeason->id)
        	->where('played', 1)
            ->where(function($q) use ($user_id) {
                $q->where('matches.local_manager_id', $user_id)
                    ->orWhere('matches.visitor_manager_id', $user_id);
                })
			->select('matches.*', 'scores.created_at as played_date')
            ->orderBy('played_date', 'desc')
            ->orderBy('matches.id', 'desc')
            ->get();

        $pending_reports = collect();

        foreach ($matches as $match) {
        	$date = Carbon::parse($match->played_date)->locale(app()->getLocale());
        	$date = $date->isoFormat("D MMMM YYYY");
            if ($match->local_manager_id == $user_id) {
                if (!$match->hasLocalPlayerStats() || !$match->hasLocalTeamStats()) {
			        $pending_reports->push([
			        	'id' => $match->id,
			        	'round_id' => $match->round_id,
			        	'date' => $date,
			            'localTeam_short_name' => $match->localTeam->team->short_name,
			            'localTeam_medium_name' => $match->localTeam->team->medium_name,
			            'localTeam_img' => $match->localTeam->team->getImg(),
			            'localTeam_manager' => $match->localManager->name,
			            'visitorTeam_short_name' => $match->visitorTeam->team->short_name,
			            'visitorTeam_medium_name' => $match->visitorTeam->team->medium_name,
			            'visitorTeam_img' => $match->visitorTeam->team->getImg(),
			            'visitorTeam_manager' => $match->visitorManager->name,
			            'score' => $match->score(),
			            'stadium' => $match->stadium,
			            'extra_times' => $match->extra_times,
			        ]);
                }
            } else {
                if (!$match->hasVisitorPlayerStats() || !$match->hasVisitorTeamStats()) {
			        $pending_reports->push([
			        	'id' => $match->id,
			        	'round_id' => $match->round_id,
			        	'date' => $date,
			            'localTeam_short_name' => $match->localTeam->team->short_name,
			            'localTeam_medium_name' => $match->localTeam->team->medium_name,
			            'localTeam_img' => $match->localTeam->team->getImg(),
			            'localTeam_manager' => $match->localManager->name,
			            'visitorTeam_short_name' => $match->visitorTeam->team->short_name,
			            'visitorTeam_medium_name' => $match->visitorTeam->team->medium_name,
			            'visitorTeam_img' => $match->visitorTeam->team->getImg(),
			            'visitorTeam_manager' => $match->visitorManager->name,
			            'score' => $match->score(),
			            'stadium' => $match->stadium,
			            'extra_times' => $match->extra_times,
			        ]);
                }
            }
        }

		return view('manager.pending_reports', ['pending_reports' => $pending_reports]);
    }

    public function pendingMatches()
    {
		return view('manager.pending_matches');
    }

	public function readyToPlaySwitcher($user_id)
	{
		$user = User::findOrFail($user_id);
		if ($user->readyToPlay()) {
			$user->ready_to_play = null;
			$user->save();
			$message_type = 'info';
			$message = 'Has abandonado el lobby';
		} else {
			if (!$user->pendingMatchesReports()) {
				$user->ready_to_play = Carbon::now()->addHour();
				$user->save();
				$match = $this->searchMatch($user_id);
				if ($match) {
					$this->notifyMatch($match);
					$match->localManager->ready_to_play = null;
					$match->localManager->save();
					$match->visitorManager->ready_to_play = null;
					$match->visitorManager->save();
					$message_type = 'success';
					$message = 'Partido encontrado!. Revisa el canal de discord!';
				} else {
					$message_type = 'info';
					$message = 'No se han encontrado partido, permanecerás en el lobby esperando rival durante 1 hora';
				}
			} else {
				$message_type = 'error';
				$message = 'No puedes buscar partido con reportes de partido pendientes';
			}
		}

		return redirect()->back()->with($message_type, $message);
	}

	public function searchMatch($user_id)
	{
        $current_season_id = Season::where('current', 1)->first()->id;
    	$seasonTeams = SeasonTeam::
    		with('team', 'team.user')
    		->leftJoin('teams', 'teams.id', 'seasons_teams.team_id')
    		->leftJoin('users', 'users.id', 'teams.manager_id')
    		->where('seasons_teams.season_id', $current_season_id)
    		->where('users.ready_to_play', '>', now())
            ->select('seasons_teams.*')
    		->orderBy('users.ready_to_play', 'asc')
    		->get();

        foreach ($seasonTeams as $key => $seasonTeam) {
            $userTeam_id = $seasonTeam->team->user->id;
            if ($user_id != $userTeam_id) {
                $priorityMatch = MatchModel::
                    where('season_id', $current_season_id)
                    ->where(function ($query) use ($user_id, $userTeam_id) {
                        $query->where('local_manager_id', $user_id)
                              ->where('visitor_manager_id', $userTeam_id)
                              ->where('played', 0);
                    })
                    ->orWhere(function ($query) use ($user_id, $userTeam_id) {
                        $query->where('local_manager_id', $userTeam_id)
                              ->where('visitor_manager_id', $user_id)
                              ->where('played', 0);
                    })
                    ->select('*')
                    ->first();

                if ($priorityMatch) {
                	return $priorityMatch;
                }
            }
        }
        return false;
	}

	public function notifyMatch($match)
	{
	    $webhook = config('discord.webhook_general');
	    $title = $match->localTeam->team->short_name . ' vs ' . $match->visitorTeam->team->short_name;
	    $description = 'Los ' . $match->localTeam->team->medium_name . ' y los ' . $match->visitorTeam->team->medium_name . ' saltan a la cancha.';
	    $link = route('match', $match->id);

	    return Http::post($webhook, [
	    	'content' => 'Próximo partido: ' . $match->localTeam->team->medium_name . ' vs ' . $match->visitorTeam->team->medium_name . ' <@&486604867293544458>',
	        'embeds' => [
	            [
	                'title' => $title,
	                'description' => $description,
	                'url' => $link,
	                // 'color' => '7506394',
	            ]
	        ],
	    ]);
	}


}
