<?php

namespace App\Helpers\Notes\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @method morphMany(string $string, string $string1)
 */
trait HasNotes
{
    public function notes(): MorphMany
    {
        return $this->morphMany('App\Models\Note', 'notable');
    }
}
