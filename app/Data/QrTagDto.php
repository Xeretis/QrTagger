<?php

namespace App\Data;

use App\Models\QrTag;
use Spatie\LaravelData\Data;

class QrTagDto extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
        public array  $data,
    )
    {

    }

    public static function createFromQrTag(QrTag $qrTag): self
    {
        return new self(
            id: $qrTag->id,
            name: $qrTag->name,
            data: $qrTag->data->toArray(),
        );
    }
}
