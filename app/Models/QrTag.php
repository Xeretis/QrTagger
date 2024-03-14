<?php

namespace App\Models;

use App\Helpers\QrTags\Data\QrTagData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\LaravelData\DataCollection;

class QrTag extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'data',
        'secret',
        'include_personal_information',
        'user_id'
    ];

    protected $casts = [
        'data' => DataCollection::class . ':' . QrTagData::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
