@php
    use Filament\Support\Enums\MaxWidth;use Filament\Support\Facades\FilamentView;
@endphp

    <!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ])
>
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>
        {{ filled($title = strip_tags($livewire->getTitle())) ? "{$title} - " : null }}
        {{ filament()->getBrandName() }}
    </title>

    @vite('resources/css/app.css')

    <style>
        [x-cloak=''],
        [x-cloak='x-cloak'],
        [x-cloak='1'] {
            display: none !important;
        }

        @media (max-width: 1023px) {
            [x-cloak='-lg'] {
                display: none !important;
            }
        }

        @media (min-width: 1024px) {
            [x-cloak='lg'] {
                display: none !important;
            }
        }
    </style>

    @filamentStyles

    {{ filament()->getTheme()->getHtml() }}
    {{ filament()->getFontHtml() }}

    <style>
        :root {
            --font-family: {!! filament()->getFontFamily() !!};
            --sidebar-width: {{ filament()->getSidebarWidth() }};
            --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
        }
    </style>

    @stack('styles')

    @if (! filament()->hasDarkMode())
        <script>
            localStorage.setItem('theme', 'light')
        </script>
    @elseif (filament()->hasDarkModeForced())
        <script>
            localStorage.setItem('theme', 'dark')
        </script>
    @else
        <script>
            const theme = localStorage.getItem('theme') ?? 'system'

            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)')
                        .matches)
            ) {
                document.documentElement.classList.add('dark')
            }
        </script>
    @endif

</head>

<body
    class="fi-body min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white"
>
@props([
    'after' => null,
    'heading' => null,
    'subheading' => null,
])

<div class="fi-simple-layout flex min-h-screen flex-col items-center">
    <div
        class="fi-simple-main-ctn flex w-full flex-grow items-center justify-center"
    >
        <main
            @class([
                'fi-simple-main my-16 w-full bg-white mx-6 px-6 py-12 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 sm:rounded-xl sm:px-12',
                match ($maxWidth ?? null) {
                    MaxWidth::ExtraSmall, 'xs' => 'sm:max-w-xs',
                    MaxWidth::Small, 'sm' => 'sm:max-w-sm',
                    MaxWidth::Medium, 'md' => 'sm:max-w-md',
                    MaxWidth::ExtraLarge, 'xl' => 'sm:max-w-xl',
                    MaxWidth::TwoExtraLarge, '2xl' => 'sm:max-w-2xl',
                    MaxWidth::ThreeExtraLarge, '3xl' => 'sm:max-w-3xl',
                    MaxWidth::FourExtraLarge, '4xl' => 'sm:max-w-4xl',
                    MaxWidth::FiveExtraLarge, '5xl' => 'sm:max-w-5xl',
                    MaxWidth::SixExtraLarge, '6xl' => 'sm:max-w-6xl',
                    MaxWidth::SevenExtraLarge, '7xl' => 'sm:max-w-7xl',
                    default => 'sm:max-w-lg',
                },
            ])
        >
            {{ $slot }}
        </main>
    </div>
</div>

@filamentScripts(withCore: true)

@if (config('filament.broadcasting.echo'))
    <script data-navigate-once>
        window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

        window.dispatchEvent(new CustomEvent('EchoLoaded'))
    </script>
@endif

@stack('scripts')
</body>
</html>
