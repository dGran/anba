<?php

namespace App\Listeners;

use App\Events\PostStored;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendPostNotification
{
    public function __construct()
    {
        //
    }

    public function handle(PostStored $event)
    {
    	switch ($event->post->type) {
    		case 'general':
    			$webhook = config('discord.webhook_general');
    			break;
    		case ($event->post->type == 'resultados' || $event->post->type == 'rachas' || $event->post->type == 'destacados'):
    			$webhook = config('discord.webhook_matches');
    			break;
    		case 'records':
    			$webhook = config('discord.webhook_records');
    			break;
    		case 'lesiones':
    			$webhook = config('discord.webhook_injuries');
    			break;
    		case 'movimientos':
    			$webhook = config('discord.webhook_market');
    			break;
    		case 'declaraciones':
    			$webhook = config('discord.webhook_statements');
    			break;
    	}
    	// dev
    	// $webhook = config('discord.webhook_dev');

    	$category = $event->post->category;
    	$title = $event->post->title;
    	$description = $event->post->description;
    	if ($event->post->match_id) {
    		$link = route('match', $event->post->match_id);
	        return Http::post($webhook, [
	            'embeds' => [
	                [
	                    'title' => $title,
	                    'description' => $description,
	                    'url' => $link,
	                    'color' => '7506394',
	                ]
	            ],
	        ]);
    	} else {
	        return Http::post($webhook, [
	            // 'content' => $category,
	            'embeds' => [
	                [
	                    'title' => $title,
	                    'description' => $description,
	                    'color' => '7506394',
	                ]
	            ],
	        ]);
    	}
    }
}