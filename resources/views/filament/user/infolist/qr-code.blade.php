@php
    $secret = $getRecord()->secret;
@endphp

<div class="flex flex-1 items-center flex-col">
    <div class="bg-white p-4 rounded-md mb-4">
        <!-- TODO: Add the actual url here -->
        {!! QrCode::errorCorrection('H')->generate($getRecord()->secret) !!}
    </div>
    <div class="flex gap-4 flex-wrap justify-center">
        <x-filament::button
            @click="$dispatch('qr-code-png-download-requested', { secret: '{{ $getRecord()->secret }}' })">
            Download PNG image
        </x-filament::button>

        <x-filament::button
            @click="$dispatch('qr-code-svg-download-requested', { secret: '{{ $getRecord()->secret }}' })">
            Download SVG image
        </x-filament::button>
    </div>
</div>
