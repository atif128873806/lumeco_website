<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'message',
        'status',
    ];

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', 'new');
    }

    public function isUnread(): bool
    {
        return $this->status === 'new';
    }
}
