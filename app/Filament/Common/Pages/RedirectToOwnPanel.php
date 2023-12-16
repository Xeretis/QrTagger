<?php

namespace App\Filament\Common\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class RedirectToOwnPanel extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.common.redirect-to-own-panel';

    /**
     * Redirect users with a given role to their own panel on boot
     */
    public function boot(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $user = auth()->user();

        $url = $user->is_admin ? '/admin' : '/user';

        return redirect($url);
    }
}
