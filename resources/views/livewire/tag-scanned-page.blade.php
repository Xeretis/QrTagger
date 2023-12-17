@php use App\Helpers\QrTags\Enums\QrTagDataFieldType; @endphp
<x-filament-panels::page.simple>
    <div class="grid gap-4 md:grid-cols-2 max-w-full p-2">
        @foreach($tag->data as $dataElement)
            <div class="max-w-full w-full overflow-hidden">
                <div class="max-w-full flex flex-col">
                    <p class="font-medium mb-1">
                        {{ $dataElement->label }}:
                    </p>
                    <div class="flex justify-between gap-4 items-center flex-1 truncate">
                        @switch($dataElement->type)
                            @case(QrTagDataFieldType::Url)
                                <x-filament::link href="{{ $dataElement->value }}" target="_blank"
                                                  class="truncate">
                                    {{ $dataElement->value }}
                                </x-filament::link>
                                @break
                            @case(QrTagDataFieldType::Email)
                                <x-filament::link href="mailto:{{ $dataElement->value }}" target="_blank"
                                                  class="truncate">
                                    {{ $dataElement->value }}
                                </x-filament::link>
                                @break
                            @case(QrTagDataFieldType::Phone)
                                <x-filament::link href="tel:{{ $dataElement->value }}" target="_blank"
                                                  class="truncate">
                                    {{ $dataElement->value }}
                                </x-filament::link>
                                @break
                            @default
                                <p class="truncate">{{ $dataElement->value }}</p>
                        @endswitch
                        <button x-on:click="
                    window.navigator.clipboard.writeText('{{ $dataElement->value }}');
                    $tooltip('Copied!', {
                        theme: $store.theme
                    });
                ">
                            <x-icon name="heroicon-o-clipboard" class="w-5 h-5 text-gray-400 inline"/>
                        </button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page.simple>
