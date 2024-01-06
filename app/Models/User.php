<?php

namespace App\Models;

use App\Helpers\Notes\Traits\HasNotes;
use App\Helpers\Users\Data\UserPersonalInformationData;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\LaravelData\DataCollection;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasNotes, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'personal_information',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'personal_information'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'statistics_data' => AsCollection::class,
//        'personal_information' => DataCollection::class . ':' . UserPersonalInformationData::class,
    ];

    public function qrTags(): HasMany
    {
        return $this->hasMany(QrTag::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->is_admin,
            'user' => !$this->is_admin,
            default => true,
        };
    }

    public function canImpersonate(): bool
    {
        return $this->is_admin;
    }

    public function canBeImpersonated(): bool
    {
        return !$this->is_admin;
    }

    public function personalInformation(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value !== null ? UserPersonalInformationData::collection(json_decode(Crypt::decryptString($value), true)) : null,
            set: fn(?DataCollection $value) => $value !== null ? Crypt::encryptString(json_encode($value->all())) : null,
        );
    }
}
