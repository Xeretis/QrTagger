<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ViewQrTagDto extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
        public array  $data,
    )
    {

    }
}
