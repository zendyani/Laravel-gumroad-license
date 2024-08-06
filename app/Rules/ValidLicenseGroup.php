<?php

namespace App\Rules;

use Closure;
use App\Modules\License\Enum\LicenseGroup;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidLicenseGroup implements ValidationRule {
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (!in_array($value, LicenseGroup::values())) {
            $fail(sprintf('The value of %s is not a valid License Group.', $attribute));
        }
    }
}
