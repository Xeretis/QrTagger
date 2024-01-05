<?php

namespace App\Helpers\Users\Data;

use App\Helpers\Users\Enums\UserPersonalInformationType;
use Spatie\LaravelData\Data;

class UserPersonalInformationData extends Data
{
    function __construct(
        public string                      $label,
        public string                      $value,
        public UserPersonalInformationType $type = UserPersonalInformationType::Other
    )
    {

    }
}
