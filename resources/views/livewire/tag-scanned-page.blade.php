<x-filament-panels::page.simple>
    @foreach($tag->data as $dataElement)
        <x-filament::section>
            <x-slot name="heading">
                {{ $dataElement->label }}
            </x-slot>
            <div class="flex justify-between items-center">
                {{ $dataElement->value }}
                <button x-on:click="
                    window.navigator.clipboard.writeText('{{ $dataElement->value }}');
                    $tooltip('Copied!', {
                        theme: $store.theme
                    });
                ">
                    <x-icon name="heroicon-o-clipboard" class="w-5 h-5 text-gray-400 inline"/>
                </button>
            </div>

        </x-filament::section>

    @endforeach

</x-filament-panels::page.simple>
