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

    public const TYPE_LIST = [
        self::TYPE_INSERT,
        self::TYPE_UPDATE,
        self::TYPE_DELETE,
    ];

    protected $table = 'admin_logs';

    private const TYPE_INSERT = 'INSERT';

    private const TYPE_UPDATE = 'UPDATE';

    private const TYPE_DELETE = 'DELETE';

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

    //TODO: Remove code below

    //TODO: estos dates van en un ViewModel o en el mismo Livewire
    public function getCreatedAtDate(): string
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("D MMMM YYYY");
    }

    public function getCreatedAtTime(): string
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("kk[:]mm");
    }

    //TODO: los scopes los vamos a sustituir por queries en su repository
    public function scopeName($query, $value)
    {
        if (trim($value) !== "") {
            return $query->where(function($q) use ($value) {
                $q->where('admin_logs.reg_name', 'LIKE', "%{$value}%")
                    ->orWhere('admin_logs.reg_id', 'LIKE', "%{$value}%")
                    ->orWhere('admin_logs.table', 'LIKE', "%{$value}%")
                    ->orWhere('admin_logs.id', 'LIKE', "%{$value}%");
            });
        }
    }

    public function scopeType($query, $value)
    {
        if ($value !== 'all') {
            return $query->where('type', '=', $value);
        }
    }

    public function scopeUser($query, $value)
    {
        if ($value !== 'all') {
            return $query->where('user_id', '=', $value);
        }
    }

    public function scopeTable($query, $value)
    {
        if ($value !== 'all') {
            return $query->where('table', '=', $value);
        }
    }

    public function canDestroy(): bool
    {
        return True;
    }
}
