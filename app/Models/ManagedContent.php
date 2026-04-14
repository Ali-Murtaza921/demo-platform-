<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagedContent extends Model
{
    use HasFactory;

    public const TYPE_FAQ = 'faq';
    public const TYPE_GUIDELINE = 'guideline';
    public const TYPE_ANNOUNCEMENT = 'announcement';

    public const AUDIENCE_GLOBAL = 'global';
    public const AUDIENCE_REAL_BILLS = 'real_bills';
    public const AUDIENCE_AMENDMENTS = 'amendments';
    public const AUDIENCE_CITIZEN_PROPOSALS = 'citizen_proposals';

    protected $fillable = [
        'type',
        'audience',
        'title',
        'summary',
        'body',
        'display_order',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->where(function (Builder $builder): void {
                $builder
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public static function typeOptions(): array
    {
        return [
            self::TYPE_FAQ => 'FAQ',
            self::TYPE_GUIDELINE => 'Guideline',
            self::TYPE_ANNOUNCEMENT => 'Announcement',
        ];
    }

    public static function audienceOptions(): array
    {
        return [
            self::AUDIENCE_GLOBAL => 'Global',
            self::AUDIENCE_REAL_BILLS => 'Real Bills',
            self::AUDIENCE_AMENDMENTS => 'Amendments',
            self::AUDIENCE_CITIZEN_PROPOSALS => 'Citizen Proposals',
        ];
    }
}
