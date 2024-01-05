<?php

namespace App\Helpers\Users\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserPersonalInformationType: string implements HasLabel
{
    case Name = 'name';
    case Phone = 'phone';
    case Email = 'email';
    case Address = 'address';
    case Other = 'other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Name => 'Name',
            self::Phone => 'Phone',
            self::Email => 'Email',
            self::Address => 'Address',
            self::Other => 'Other',
        };
    }
}
