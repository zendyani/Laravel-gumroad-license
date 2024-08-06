<?php

namespace App\Rules;

use Closure;
use App\Modules\License\Enum\License;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidLicense implements ValidationRule {
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        if (!in_array($value, License::values())) {
            $fail(sprintf('The value of %s is not valid.', $attribute));
        }
    }
}
