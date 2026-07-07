<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Pages;

use BackedEnum;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail as Mailer;
use Illuminate\Validation\ValidationException;
use Panelis\Branch\Models\Branch;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\MailDriver;
use Panelis\Setting\Events\SettingUpdated;
use Panelis\Setting\Mail\TestMail;
use Panelis\Setting\Models\Setting;
use Panelis\Setting\Panel\Clusters\Settings;
use Panelis\Setting\Panel\Clusters\Settings\Enums\MailPermission;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\DriverForm;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Mail\SenderForm;
use Panelis\Setting\Panel\Clusters\Settings\HasUpdateableForm;
use Panelis\Setting\Panel\Clusters\Settings\UpdateSettingPage;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Mail extends UpdateSettingPage implements HasSchemas, HasUpdateableForm
{
    use InteractsWithForms;
    use Settings\Traits\AddUpdateButton;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAtSymbol;

    protected string $view = 'filament.clusters.settings.pages.setting';

    protected static ?string $cluster = Settings::class;

    protected static ?int $navigationSort = 30;

    public array $mail;

    public array $services;

    public function getTitle(): string|Htmlable
    {
        return __('setting::mail.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('setting::mail.navigation');
    }

    public static function canAccess(): bool
    {
        return user_can(MailPermission::Browse);
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('test_mail')
                ->visible(user_can(MailPermission::SendTest))
                ->label(__('setting::mail.btn.test_send'))
                ->modalWidth(Width::Medium)
                ->modalSubmitActionLabel(__('setting::mail.btn.test_send'))
                ->schema([
                    Radio::make('send_from')
                        ->label(__('setting::mail.send_from'))
                        ->default('mail')
                        ->live()
                        ->required()
                        ->disableOptionWhen(function (string $value): bool {
                            return $value === 'branch' && ! config('panelis.multitenant');
                        })
                        ->options([
                            'mail' => __('setting::mail.app_email'),
                            'branch' => __('setting::mail.branch_email'),
                        ]),

                    TextInput::make('from')
                        ->label(__('setting::mail.from_address'))
                        ->default(config('mail.from.address'))
                        ->readOnly()
                        ->visible(fn (Get $get): bool => $get('send_from') === 'mail')
                        ->required(),

                    Select::make('branch')
                        ->label(__('setting::mail.from_address'))
                        ->searchable()
                        ->visible(fn (Get $get): bool => $get('send_from') === 'branch')
                        ->helperText(__('setting::mail.branch_empty_help'))
                        ->required()
                        ->options(
                            Branch::whereNotNull('email')
                                ->orderBy('name')
                                ->get()
                                ->mapWithKeys(fn (Branch $branch): array => [
                                    $branch->id => sprintf('%s (%s)', $branch->name, $branch->email),
                                ])
                        ),

                    TextInput::make('to')
                        ->label(__('setting::mail.to_address'))
                        ->helperText(__('setting::mail.email.helper'))
                        ->email()
                        ->required(),
                ])
                ->action(function (array $data): void {
                    try {
                        $from = [
                            'address' => config('mail.from.address'),
                            'name' => config('mail.from.name'),
                        ];

                        if (! empty($data['branch'])) {
                            $branch = Branch::find($data['branch']);
                            if (! empty($branch)) {
                                $from = [
                                    'address' => $branch->email,
                                    'name' => $branch->name,
                                ];
                            }
                        }

                        Mailer::to($data['to'])
                            ->send(new TestMail(...$from));

                        Notification::make()
                            ->success()
                            ->title(__('setting::mail.test_success'))
                            ->body(__('setting::mail.test_instruction'))
                            ->send();
                    } catch (Exception $e) {
                        Log::error($e);

                        Notification::make()
                            ->danger()
                            ->color('danger')
                            ->title(__('setting::mail.test_failed'))
                            ->body($e->getMessage())
                            ->persistent()
                            ->send();
                    }
                }),
        ];
    }

    public function mount(): void
    {
        $this->form->fill([
            'mail' => [
                'default' => config('mail.default'),
                'mailers' => config('mail.mailers'),
                'from' => [
                    'address' => config('mail.from.address', config('app.email')),
                    'name' => config('mail.from.name', config('app.name')),
                ],
            ],

            'services' => config('services'),

            'isButtonDisabled' => user_cannot(MailPermission::Edit),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components($this->getDriverForms())
            ->disabled(! user_can(MailPermission::Edit));
    }

    /**
     * @throws ValidationException
     */
    public function update(): void
    {
        abort_unless(user_can(MailPermission::Edit), Response::HTTP_FORBIDDEN);

        $this->validate();

        try {
            foreach (Arr::dot($this->form->getState()) as $key => $value) {
                if (empty($value)) {
                    $value = '';
                }
                Setting::updateOrCreate(compact('key'), compact('value'));
            }

            event(new SettingUpdated);

            Notification::make()
                ->success()
                ->title(__('setting::setting.notifications.updated.title'))
                ->send();
        } catch (Throwable $e) {
            Log::error($e);

            Notification::make()
                ->title(__('setting::setting.notifications.update_failed.title'))
                ->body($e->getMessage())
                ->warning()
                ->send();
        }
    }

    protected function getDriverForms(): array
    {
        $forms = [
            SenderForm::schema(),
            DriverForm::schema(),
        ];

        foreach (app(DriverManager::class)->all(MailDriver::class) as $driver) {
            if ($section = $driver->schema()) {
                $forms[] = $section;
            }
        }

        return $forms;
    }
}
