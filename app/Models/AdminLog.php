<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $user
 * @property int $id
 * @property int $userId
 * @property string $type
 * @property ?string $table
 * @property string $reg_id
 * @property string $reg_name
 * @property ?string $detail
 * @property ?string $detail_before
 * @property string $created_at
 * @property ?string $updated_at
 */
class AdminLog extends Model
{
    use HasFactory;

    public const TYPE_INSERT = 'INSERT';

    public const TYPE_UPDATE = 'UPDATE';

    public const TYPE_DELETE = 'DELETE';

    protected $table = 'admin_logs';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->created_at = Carbon::now();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(int $userId): AdminLog
    {
        $this->attributes['user_id'] = $userId;

        return $this;
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function setType(string $type): AdminLog
    {
        $this->attributes['type'] = $type;

        return $this;
    }

    public function getTableAttribute(): ?string
    {
        return $this->attributes['table'];
    }

    public function setTableAttribute(?string $table): AdminLog
    {
        $this->attributes['table'] = $table;

        return $this;
    }

    public function getRegId(): string
    {
        return $this->attributes['reg_id'];
    }

    public function setRegId(string $regId): AdminLog
    {
        $this->attributes['reg_id'] = $regId;

        return $this;
    }

    public function getRegName(): string
    {
        return $this->attributes['reg_name'];
    }

    public function setRegName(string $regName): AdminLog
    {
        $this->attributes['reg_name'] = $regName;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->attributes['detail'];
    }

    public function setDetail(?string $detail): AdminLog
    {
        $this->attributes['detail'] = $detail;

        return $this;
    }

    public function getDetailBefore(): ?string
    {
        return $this->attributes['detail_before'];
    }

    public function setDetailBefore(?string $detailBefore): AdminLog
    {
        $this->attributes['detail_before'] = $detailBefore;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function getCreatedAt(): \DateTime
    {
        return new \DateTime($this->attributes['created_at']);
    }

    public function setCreatedAt($value): AdminLog
    {
        $this->attributes['created_at'] = $value;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function getUpdatedAt(): ?\DateTime
    {
        if (empty($this->attributes['updated_at'])) {
            return null;
        }

        return new \DateTime($this->attributes['updated_at']);
    }

    public function setUpdatedAt($value): AdminLog
    {
        $this->attributes['updated_at'] = $value;

        return $this;
    }

    public function getName(): string{
        return $this->getRegName();
    }
}
