@use('\App\Helpers\Users\Enums\UserPersonalInformationType')
@use('App\Helpers\QrTags\Enums\QrTagDataFieldType')
<x-filament-panels::page.simple>
    <div class="grid gap-4 md:grid-cols-2 max-w-full p-2">
        @if($tag->include_personal_information && $tag->user->makeVisible('personal_information')->personal_information !== null)
            @foreach($tag->user->makeVisible('personal_information')->personal_information as $dataElement)
                <div class="max-w-full w-full overflow-hidden">
                    <div class="max-w-full flex flex-col">
                        <p class="font-medium mb-1">
                            {{ $dataElement->label }}:
                        </p>
                        <div class="flex justify-between gap-4 items-center flex-1 truncate">
                            @switch($dataElement->type)
                                @case(UserPersonalInformationType::Email)
                                    <x-filament::link href="mailto:{{ $dataElement->value }}"
                                                      target="_blank"
                                                      class="truncate">
                                        {{ $dataElement->value }}
                                    </x-filament::link>
                                    @break
                                @case(UserPersonalInformationType::Phone)
                                    <x-filament::link href="tel:{{ $dataElement->value }}" target="_blank"
                                                      class="truncate">
                                        {{ $dataElement->value }}
                                    </x-filament::link>
                                    @break
                                @case(UserPersonalInformationType::Address)
                                    <x-filament::link
                                        href="https://www.google.com/maps/search/?api=1&query={{ urlencode($dataElement->value) }}"
                                        target="_blank"
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
        @endif
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
                                <x-filament::link href="mailto:{{ $dataElement->value }}"
                                                  target="_blank"
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
                            @case(QrTagDataFieldType::Address)
                                <x-filament::link
                                    href="https://www.google.com/maps/search/?api=1&query={{ urlencode($dataElement->value) }}"
                                    target="_blank"
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
    <div class="w-full flex justify-center">
        <div x-on:click="
            navigator.geolocation.getCurrentPosition((pos) => {
                const crd = pos.coords;

                $wire.sendLocation(crd.latitude, crd.longitude, crd.accuracy);
            }, (err) => {
                console.warn(`ERROR(${err.code}): ${err.message}`);

                $tooltip('{{ __('Error while attempting to get location. Did you allow this site to access your location?') }}', {
                    theme: $store.theme,
                    delay: [0, 7500]
                });
            }, {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });
        ">
            <x-filament::button outlined="true">
                @lang('Share current location')
            </x-filament::button>
        </div>
    </div>
    <p class="text-center text-gray-400">@lang('Powered by') <span class="text-primary-500 font-medium">QrTagger</span>
    </p>
</x-filament-panels::page.simple>
