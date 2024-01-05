<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class LocationSharedDto extends Data
{
    public function __construct(
        public ViewQrTagDto $qrTag,
        public float        $latitude,
        public float        $longitude,
        public float        $accuracy,
    )
    {
    }
}
