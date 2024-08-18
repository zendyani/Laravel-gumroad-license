<?php

namespace App\Modules\License\Domain\Enums;

enum LicenseGroup: string {
    case THEME_COMPOSER = 'theme-composer';
    case THUMBLISHER = 'thumblisher';

    /**
     * @return string[]
     */
    public static function values(): array {
        return array_column(LicenseGroup::cases(), 'value');
    }
}
