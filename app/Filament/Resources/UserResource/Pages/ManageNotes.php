<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;

use App\Models\Note;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ManageNotes extends Page
{
    use InteractsWithRecord;

    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.pages.manage-notes';

    public Collection $notes;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-chat-bubble-bottom-center';
    }

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        static::authorizeResourceAccess();

        $this->form->fill();
        $this->notes = $this->record->notes()->get();
    }

    public function createAction(): Action
    {
        return CreateAction::make('create_note')->model(Note::class)->form([
            TextInput::make('title')->required(),
            Textarea::make('body')->required(),
            Toggle::make('is_pinned')
        ])->using(function (array $data, string $model): Model {
            $data['pinned_at'] = $data['is_pinned'] ? now() : null;

            return $this->record->notes()->create($data);
        })->after(fn () => $this->notes = $this->record->notes()->get());
    }

    public function getHeaderActions(): array
    {
        return [
            $this->createAction(),
        ];
    }

    public function togglePinnedStatus(int $noteId): void
    {
        $note = Note::findOrFail($noteId);

        $note->update([
            'pinned_at' => $note->pinned_at ? null : now(),
        ]);

        $this->notes = $this->record->notes()->get();
    }

    public function delete(int $noteId): void
    {
        $note = Note::findOrFail($noteId);

        $note->delete();

        $this->notes = $this->record->notes()->get();
    }
}
