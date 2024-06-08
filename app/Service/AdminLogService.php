<?php

declare(strict_types=1);

namespace App\Service;

use App\Events\TableWasUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AdminLogService
{
    public const TYPE_UPDATE = 'update';

    /**
     * @throws \JsonException
     * @throws \Throwable
     */
    public function register(Model $model, string $type, array $before, array $after): void
    {
        $diffBefore = \array_diff($before, $after);
        $diffAfter = \array_diff($after, $before);

        if (!empty($diffBefore) || !empty($diffAfter)) {
            return;
        }

        try {
            event(
                new TableWasUpdated(
                    $model,
                    $type,
                    \json_encode($diffAfter, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT),
                    \json_encode($diffBefore, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)
                )
            );
        } catch (\Throwable $exception) {
            Log::critical(__METHOD__.' - Error in register method', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'model' => $model,
                'type' => $type,
                'before' => $before,
                'after' => $after,
            ]);
        }
    }
}
