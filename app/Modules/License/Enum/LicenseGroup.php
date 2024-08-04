<?php

namespace App\Modules\License\Enum;

enum LicenseGroup: string {
    case THEME_COMPOSER = 'theme-composer';
    case THUMBLISHER = 'thumblisher';

    public static function values(): array
    {
        return array_column(LicenseGroup::cases(), 'value');
    }
}