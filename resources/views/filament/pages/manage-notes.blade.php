<x-filament-panels::page>
    @if($notes->isEmpty())
        <p class="text-gray-400 text-center">It looks like there aren't any notes attached to this model yet...
            Create one using the action in the page header!
        </p>
    @endif
    @foreach($notes->sortByDesc('pinned_at') as $note)
        <x-filament::section wire:key="{{ $note->id }}">
            <x-slot name="heading">
                {{ $note->title }}
            </x-slot>

            <x-slot name="headerEnd">
                <x-filament::icon-button
                    :icon="isset($note->pinned_at) ? 'heroicon-m-star' : 'heroicon-o-star'"
                    wire:click="togglePinnedStatus({{ $note->id }})"
                />
                <x-filament::icon-button
                    icon="heroicon-m-trash"
                    color="danger"
                    wire:click="delete({{ $note->id }})"
                />
            </x-slot>

            {{ $note->body }}
        </x-filament::section>
    @endforeach
</x-filament-panels::page>
