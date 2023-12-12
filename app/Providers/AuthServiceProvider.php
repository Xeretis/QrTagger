<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Note;
use App\Models\QrTag;
use App\Policies\ActivityPolicy;
use App\Policies\NotePolicy;
use App\Policies\QrTagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        QrTag::class => QrTagPolicy::class,
        Note::class => NotePolicy::class,
        Activity::class => ActivityPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

    }
}
