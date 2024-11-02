<?php

namespace App\Listeners;

use App\Events\PostStored;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class SendPostNotification
{
	public $activeNotifications = true;
	public $testMode = false;

    public function __construct()
    {
    	$config = \App\Models\Config::first();

    	if ($config) {
    		$this->activeNotifications = $config->active_notifications;
    		$this->testMode = $config->notifications_test_mode;
    	}

        $this->httpClient = new Client([
            'on_stats' => function (\GuzzleHttp\TransferStats $stats) {
                Log::info('HTTP Transfer Stats:', [
                    'total_time' => $stats->getTransferTime(),
                    'request_size' => $stats->getHandlerStats()['request_size'] ?? null,
                    'response_size' => $stats->getHandlerStats()['size_download'] ?? null,
                    'status_code' => $stats->getHandlerStats()['http_code'] ?? null,
                ]);
            }
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function handle(PostStored $event): void
    {
    	if ($this->activeNotifications) {
            $webhook = $this->getWebhookUrl($event->post->type);
            $post = $event->post;
            $category = $post->category;
            $title = $post->title;
            $description = $post->description;

            $data = [
                'embeds' => [
                    [
                        'title' => $title,
                        'description' => $description,
                        'color' => '7506394',
                    ]
                ],
            ];

            if ($post->match_id) {
                $data['embeds'][0]['url'] = route('match', $event->post->match_id);
            }

            $this->httpClient->request('POST', $webhook, [
                'json' => $data,
            ]);
        }
    }

    private function getWebhookUrl($type): string
    {
        if ($this->testMode) {
            return config('discord.webhook_dev');
        }

        switch ($type) {
            case 'general':
                return config('discord.webhook_general');
            case 'resultados':
            case 'rachas':
            case 'destacados':
                return config('discord.webhook_matches');
            case 'records':
                return config('discord.webhook_records');
            case 'lesiones':
                return config('discord.webhook_injuries');
            case 'movimientos':
                return config('discord.webhook_market');
            case 'declaraciones':
                return config('discord.webhook_statements');
            default:
                return config('discord.webhook_default');
        }
    }
}
