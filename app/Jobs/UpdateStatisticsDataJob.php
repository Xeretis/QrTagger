<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stevebauman\Location\Facades\Location;

class UpdateStatisticsDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        #[WithoutRelations]
        public User $user,
        public string $ip
    )
    {
    }

    public function handle(): void
    {
        $this->user->statistics_data->put('last_login_at', now()->toDateTimeString());

        $location = Location::get($this->ip);

        if ($location)
            $this->user->statistics_data->put('last_login_location', $location->toArray());

        $this->user->save();
    }
}
