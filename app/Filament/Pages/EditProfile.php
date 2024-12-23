<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Components\Section;

use Filament\Forms\Components\FileUpload;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $user = [];
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.pages.edit-profile';

    public function mount(): void
    {
        // $this->form->fill();
        $this->form->fill(auth()->user()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('User Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('phone_number')
                            ->minLength(11)
                            ->maxLength(15)
                            ->numeric()
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                        FileUpload::make('avatar_path')
                            ->disk('public')
                            ->directory('user-photo')
                            ->label('Avatar')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(1024)
                            ->columnSpanFull()
                            ->imageEditor(),
                    ]),

            ])
            ->statePath('user');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $user = $this->form->getState();

            // Cek apakah `avatar_path` diisi atau tidak
            if (empty($user['avatar_path'])) {
                $user['avatar_path'] = ' ';
            }

            auth()->user()->update($user);
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
