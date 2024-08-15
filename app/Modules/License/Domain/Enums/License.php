<?php

namespace App\Modules\License\Domain\Enums;

enum License: string {
    case THEME_COMPOSER_FREELANCER = 'theme-composer-freelancer';
    case THEME_COMPOSER_TEAM = 'theme-composer-team';
    case THEME_COMPOSER_BUSINESS = 'theme-composer-business';
    case THUMBLISHER_FREELANCER = 'thumblisher-freelancer';
    case THUMBLISHER_TEAM = 'thumblisher-team';
    case THUMBLISHER_BUSINESS = 'thumblisher-business';

    public static function values(): array {
        return array_column(License::cases(), 'value');
    }

    public function details(): array {
        return match($this) {
            self::THEME_COMPOSER_FREELANCER => ['group' => LicenseGroup::THEME_COMPOSER, 'name' => 'Theme Composer Freelancer', 'seats' => 2],
            self::THEME_COMPOSER_TEAM => ['group' => LicenseGroup::THEME_COMPOSER, 'name' => 'Theme Composer Team', 'seats' => 10],
            self::THEME_COMPOSER_BUSINESS => ['group' => LicenseGroup::THEME_COMPOSER, 'name' => 'Theme Composer Business', 'seats' => 50],
            self::THUMBLISHER_FREELANCER => ['group' => LicenseGroup::THUMBLISHER, 'name' => 'Thumblisher freelancer', 'seats' => 1],
            self::THUMBLISHER_TEAM => ['group' => LicenseGroup::THUMBLISHER, 'name' => 'Thumblisher team', 'seats' => 5],
            self::THUMBLISHER_BUSINESS => ['group' => LicenseGroup::THUMBLISHER, 'name' => 'Thumblisher business', 'seats' => 20],
        };
    }

    public static function filterByGroup(LicenseGroup $group): array {
        return array_values(array_filter(self::cases(), fn ($license) => $license->details()['group'] === $group));
    }
}
