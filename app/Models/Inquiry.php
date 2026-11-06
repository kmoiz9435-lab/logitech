<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    public const STATUSES = [
        'new' => 'New',
        'in_progress' => 'In Progress',
        'contacted' => 'Contacted',
        'converted' => 'Converted',
        'closed' => 'Closed',
    ];

    protected $fillable = [
        'product_id',
        'name',
        'company_name',
        'email',
        'phone',
        'message',
        'status',
        'source',
        'ip_address',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
                ->orWhere('company_name', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('phone', 'like', "%{$term}%")
                ->orWhere('message', 'like', "%{$term}%");
        });
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'new' => 'gold',
            'in_progress' => 'blue',
            'contacted' => 'teal',
            'converted' => 'green',
            'closed' => 'gray',
            default => 'gray',
        };
    }
}
