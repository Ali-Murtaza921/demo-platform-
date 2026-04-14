<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public const DEFINITIONS = [
        'platform_name' => [
            'label' => 'Platform Name',
            'group' => 'General',
            'description' => 'The public-facing product name shown across the platform.',
        ],
        'contact_email' => [
            'label' => 'Contact Email',
            'group' => 'General',
            'description' => 'Primary public contact address for platform questions.',
        ],
        'support_email' => [
            'label' => 'Support Email',
            'group' => 'General',
            'description' => 'Support address used for help and account-related communication.',
        ],
        'amendment_threshold' => [
            'label' => 'Amendment Share Threshold',
            'group' => 'Engagement',
            'description' => 'Support count required before amendment sharing unlocks.',
        ],
        'proposal_threshold' => [
            'label' => 'Citizen Proposal Share Threshold',
            'group' => 'Engagement',
            'description' => 'Support count required before citizen proposal sharing unlocks.',
        ],
        'duplicate_threshold' => [
            'label' => 'Duplicate Detection Threshold',
            'group' => 'Engagement',
            'description' => 'Similarity percentage used to reject citizen proposals that match real bills.',
        ],
        'voting_deadline_hours' => [
            'label' => 'Voting Deadline Hours',
            'group' => 'Voting',
            'description' => 'Hours before the official vote when constituent voting closes.',
        ],
        'proposal_active_days' => [
            'label' => 'Citizen Proposal Active Days',
            'group' => 'Voting',
            'description' => 'Default time window that citizen proposals stay active for support.',
        ],
        'auto_hide_report_count' => [
            'label' => 'Auto-hide Report Threshold',
            'group' => 'Moderation',
            'description' => 'Number of reports required before content is hidden automatically.',
        ],
        'feature_amendments_enabled' => [
            'label' => 'Amendments Enabled',
            'group' => 'Features',
            'description' => 'Enable or disable citizen amendment submission and support.',
        ],
        'feature_citizen_proposals_enabled' => [
            'label' => 'Citizen Proposals Enabled',
            'group' => 'Features',
            'description' => 'Enable or disable citizen proposal submission and support.',
        ],
        'maintenance_mode' => [
            'label' => 'Maintenance Mode',
            'group' => 'Features',
            'description' => 'Use a truthy value to indicate planned maintenance mode messaging.',
        ],
    ];

    protected $fillable = ['key', 'value'];

    /**
     * Convenience getter.
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function options(): array
    {
        return collect(self::DEFINITIONS)
            ->mapWithKeys(fn (array $definition, string $key): array => [$key => $definition['label']])
            ->all();
    }

    public static function labelFor(string $key): string
    {
        return self::DEFINITIONS[$key]['label'] ?? $key;
    }

    public static function groupFor(string $key): string
    {
        return self::DEFINITIONS[$key]['group'] ?? 'Other';
    }

    public static function descriptionFor(string $key): ?string
    {
        return self::DEFINITIONS[$key]['description'] ?? null;
    }
}
