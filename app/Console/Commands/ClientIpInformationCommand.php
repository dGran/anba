<?php

namespace App\Console\Commands;

use App\Http\Util\ClientHelper;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ClientIpInformationCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'client:ip-information {--ip= : IP address}';

    /**
     * @var string
     */
    protected $description = 'Client ip information command';

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Request $request): int
    {
        $ip = $this->option('ip') ?? ClientHelper::getClientIP($request);
        $this->info("Obteniendo información para la IP: {$ip}");

        $location = ClientHelper::getGeoLocation($ip);

        if (isset($location['error'])) {
            $this->error("Error: {$location['error']}");
        } else {
            $this->info('Información geográfica:');
            $this->line("País: {$location['country']}");
            $this->line("Región: {$location['region']}");
            $this->line("Ciudad: {$location['city']}");
            $this->line("Latitud: {$location['latitude']}");
            $this->line("Longitud: {$location['longitude']}");
            $this->line("Zona Horaria: {$location['timezone']}");
            $this->line("ISP: {$location['isp']}");
        }

        return CommandAlias::SUCCESS;
    }
}
