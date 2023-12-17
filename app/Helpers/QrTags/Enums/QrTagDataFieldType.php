<?php

namespace App\Helpers\QrTags\Enums;

use Filament\Support\Contracts\HasLabel;

enum QrTagDataFieldType: string implements HasLabel
{
    case Phone = 'phone';
    case Email = 'email';
    case Url = 'url';
    case Text = 'text';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Phone => 'Phone',
            self::Email => 'Email',
            self::Url => 'Url',
            self::Text => 'Text',
        };
    }
}
