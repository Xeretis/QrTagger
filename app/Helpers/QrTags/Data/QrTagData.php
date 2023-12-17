<?php

namespace App\Helpers\QrTags\Data;

use App\Helpers\QrTags\Enums\QrTagDataFieldType;
use Spatie\LaravelData\Data;

class QrTagData extends Data
{
    function __construct(
        public string             $label,
        public string             $value,
        public QrTagDataFieldType $type = QrTagDataFieldType::Text
    )
    {

    }
}
