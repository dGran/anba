<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Http\Util\ClientHelper;
use App\Models\UserIpLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandAlias;

class UpdateUserIpLogLocationCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'user-ip-log:location-update';

    /**
     * @var string
     */
    protected $description = 'Update UserIpLog location command';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $userIpLogs = UserIpLog::where('location', null)->get();

        foreach ($userIpLogs as $userIpLog) {
            try {
                $geoLocation = ClientHelper::getGeoLocation($userIpLog->ip);
            } catch (\Exception $exception) {
                Log::error(\date(\DATE_W3C).' - '.__CLASS__.' - The user location could not be registered - Exception: '.$exception->getMessage());

                continue;
            }

            if (empty($geoLocation)) {
                continue;
            }

            $location = "{$geoLocation['city']} - {$geoLocation['region']} - {$geoLocation['country']}";

            $userIpLog->location = $location;
            $userIpLog->save();
        }

        return CommandAlias::SUCCESS;
    }
}
