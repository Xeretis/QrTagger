<?php

namespace App\Helpers\QrTags\Data;

use Spatie\LaravelData\Data;

class QrTagData extends Data
{
    function __construct(
        public string $label,
        public string $value,
    )
    {

    }
}
