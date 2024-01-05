<x-filament-breezy::grid-section md=2 title="Personal Information"
                                 description="Manage your personal information.">
    @if($data === null || $data['personal_information'] === null)
        <x-filament::card>
            <div>
                <h3 class="flex items-center gap-2 text-lg font-medium">
                    <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                    </svg>
                    You have not yet set up your personal
                    information.
                </h3>

                <p class="text-sm">Everything here is stored encrypted and is inaccessible to anyone but you and you can
                    attach the information here to any of your tags. Click the button below to get
                    started.</p>

                <div class="flex justify-between mt-3">
                    <x-filament::button wire:click="addPersonalInformation">
                        Get started
                    </x-filament::button>
                </div>
            </div>
        </x-filament::card>
    @else
        <x-filament::card>
            <form wire:submit.prevent="submit" class="space-y-6">

                {{ $this->form }}

                <div class="text-right">
                    <x-filament::button wire:confirm="Are you sure you want to delete all your personal information?"
                                        wire:click="removePersonalInformation" class="align-right mr-2"
                                        color="danger">
                        Delete Data
                    </x-filament::button>
                    <x-filament::button type="submit" form="submit" class="align-right">
                        Save
                    </x-filament::button>
                </div>
            </form>
        </x-filament::card>
    @endif
</x-filament-breezy::grid-section>
