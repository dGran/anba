<?php

declare(strict_types=1);

namespace App\Services;

use App\Factories\DTO\AdminLogFactory;
use App\Factories\Models\AdminLogFactory;
use App\Managers\AdminLogManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AdminLogService
{
    public const TYPE_UPDATE = 'update';

    private AdminLogManager $adminLogManager;

    public function __construct(AdminLogManager $adminLogManager)
    {
        $this->adminLogManager = $adminLogManager;
    }

    /**
     * @throws \Throwable
     */
    public function register(Model $model, string $type, array $regData, array $regDataBefore): void
    {
        try {
            $adminLogDTO = AdminLogFactory::create([
                'model' => $model,
                'type' => \strtoupper($type),
                'reg_data' => $regData,
                'reg_data_before' => $regDataBefore
            ]);

            $adminLog = AdminLogFactory::buildFromAdminLogDTO($adminLogDTO);
            $this->adminLogManager->save($adminLog);
        } catch (\Throwable $exception) {
            Log::critical(__METHOD__.' - Exception: ', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'model' => $model,
                'type' => $type,
                'reg_data' => $regData,
                'reg_data_before' => $regDataBefore,
            ]);
        }
    }
}
