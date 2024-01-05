<?php

namespace App\Livewire\User;

use App\Helpers\Users\Data\UserPersonalInformationData;
use App\Helpers\Users\Enums\UserPersonalInformationType;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;
use Spatie\LaravelData\DataCollection;

class PersonalInformationMyProfileComponent extends MyProfileComponent
{
    public static $sort = 11;

    public ?array $data;

    protected string $view = 'livewire.user.personal-information-my-profile-component';

    public function getName()
    {
        return 'user.personal-information-my-profile-component';
    }

    public function mount(): void
    {
        $this->data = [
            'personal_information' => auth()->user()->personal_information !== null ? collect(auth()->user()->personal_information?->toArray()) : null
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('personal_information')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('value')
                            ->required()
                            ->maxLength(255),
                        Select::make('type')
                            ->required()
                            ->selectablePlaceholder(false)
                            ->options(UserPersonalInformationType::class)
                            ->default(UserPersonalInformationType::Other)
                            ->columnSpan(2)
                    ])->columns()->columnSpan(2)
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $personalInformationToSave = new DataCollection(UserPersonalInformationData::class, $this->data['personal_information']->toArray());

        auth()->user()->update([
            'personal_information' => $personalInformationToSave,
        ]);

        Notification::make()
            ->success()
            ->title('Personal information updated successfully!')
            ->send();
    }

    public function addPersonalInformation(): void
    {
        $temp = [
            'personal_information' => collect([])
        ];

        foreach (UserPersonalInformationType::cases() as $type) {
            $temp['personal_information']->push([
                'label' => $type->getLabel(),
                'value' => '',
                'type' => $type,
            ]);
        }

        $this->data = $temp;
    }

    public function removePersonalInformation(): void
    {
        auth()->user()->update([
            'personal_information' => null,
        ]);

        $temp = [
            'personal_information' => null
        ];

        $this->data = $temp;

        Notification::make()
            ->success()
            ->title('Personal information removed successfully!')
            ->send();
    }
}
