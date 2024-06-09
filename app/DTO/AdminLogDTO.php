<?php

declare(strict_types=1);

namespace App\DTO;

use App\Models\User;

class AdminLogDTO
{
    private int $userId;

    private string $type;

    private string $table;

    private string $regId;

    private string $regName;

    private ?string $detail = null;

    private ?string $detailBefore = null;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): AdminLogDTO
    {
        $this->userId = $userId;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): AdminLogDTO
    {
        $this->type = $type;

        return $this;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): AdminLogDTO
    {
        $this->table = $table;

        return $this;
    }

    public function getRegId(): string
    {
        return $this->regId;
    }

    public function setRegId(string $regId): AdminLogDTO
    {
        $this->regId = $regId;

        return $this;
    }

    public function getRegName(): string
    {
        return $this->regName;
    }

    public function setRegName(string $regName): AdminLogDTO
    {
        $this->regName = $regName;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): AdminLogDTO
    {
        $this->detail = $detail;

        return $this;
    }

    public function getDetailBefore(): ?string
    {
        return $this->detailBefore;
    }

    public function setDetailBefore(?string $detailBefore): AdminLogDTO
    {
        $this->detailBefore = $detailBefore;

        return $this;
    }
}
