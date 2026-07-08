<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Pages;

use BackedEnum;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log as Logger;
use Illuminate\Validation\ValidationException;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Drivers\Log\PapertrailDriver;
use Panelis\Setting\Drivers\Log\SingleDriver;
use Panelis\Setting\Drivers\Log\SlackDriver;
use Panelis\Setting\Drivers\LogDriver;
use Panelis\Setting\Events\SettingUpdated;
use Panelis\Setting\Models\Setting;
use Panelis\Setting\Panel\Clusters\Settings;
use Panelis\Setting\Panel\Clusters\Settings\Enums\LogPermission;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Log\DriverForm;
use Panelis\Setting\Panel\Clusters\Settings\HasUpdateableForm;
use Panelis\Setting\Panel\Clusters\Settings\UpdateSettingPage;
use Symfony\Component\HttpFoundation\Response;

class Log extends UpdateSettingPage implements HasSchemas, HasUpdateableForm
{
    use InteractsWithForms;
    use Settings\Traits\AddUpdateButton;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected string $view = 'filament.clusters.settings.pages.setting';

    protected static ?string $cluster = Settings::class;

    protected static ?int $navigationSort = 60;

    public array $logging;

    public array $nightwatch = [];

    protected function getHeaderActions(): array
    {
        return [
            Action::make('send_log')
                ->label(__('setting::log.btn.test'))
                ->modalWidth(Width::Medium)
                ->schema([
                    Textarea::make('message')
                        ->label(__('setting::log.message'))
                        ->rows(4)
                        ->required(),

                    Toggle::make('notification')
                        ->label(__('setting::log.send_as_notification'))
                        ->default(config('logging.enable_notification')),
                ])
                ->action(function (array $data): void {
                    try {
                        Logger::debug($data['message'] ?? 'Testing log');

                        Notification::make()
                            ->title(__('setting::log.test_sent'))
                            ->success()
                            ->send();

                        if ($data['notification'] ?? false) {
                            Notification::make()
                                ->title(__('setting::log.label'))
                                ->body($data['message'])
                                ->danger()
                                ->sendToDatabase(Auth::user());
                        }
                    } catch (Exception) {
                    }
                }),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('setting::log.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('setting::log.navigation');
    }

    public static function canAccess(): bool
    {
        return user_can(LogPermission::Browse);
    }

    public function mount(): void
    {
        $logging = config('logging.channels.stack');

        $channel = 'logging.channels.stack.channels';
        $default = Setting::get($channel);
        if (empty($default)) {
            Setting::set($channel, [SingleDriver::NAME]);
        }

        $this->form->fill([
            'logging' => [
                'channels' => [
                    'stack' => [
                        'channels' => $logging['channels'],
                    ],

                    SlackDriver::NAME => [
                        'username' => config('logging.channels.slack.username'),
                        'url' => config('logging.channels.slack.url'),
                        'level' => config('logging.channels.slack.level'),
                    ],

                    PapertrailDriver::NAME => [
                        'level' => config('logging.channels.papertrail.level'),
                        'url' => config('logging.channels.papertrail.url'),
                        'port' => config('logging.channels.papertrail.port', 514),
                    ],
                ],

                'enable_notification' => config('logging.enable_notification'),
            ],

            'isButtonDisabled' => user_cannot(LogPermission::Browse),
        ]);
    }

    public function form(Schema $form): Schema
    {
        return $form->schema($this->getDriverForms())
            ->disabled(user_cannot(LogPermission::Edit));
    }

    /**
     * @throws ValidationException
     */
    public function update(): void
    {
        abort_unless(user_can(LogPermission::Edit), Response::HTTP_FORBIDDEN);

        $this->validate();

        try {
            $state = Arr::dot($this->form->getState()['logging']);

            if ($enableNotification = data_get($state, 'enable_notification')) {
                Setting::set('logging.enable_notification', $enableNotification);
                unset($state['enable_notification']);
            }

            $channels = array_map(function (string $channel) {
                return $channel;
            }, Arr::dot($this->form->getState()['logging']['channels']['stack']));
            Setting::set('logging.channels.stack.channels', array_values($channels));

            foreach ($state as $key => $value) {
                if (str_starts_with($key, 'channels.stack.channels')) {
                    continue;
                }

                Setting::set('logging.'.$key, $value);
            }

            Event::dispatch(new SettingUpdated);

            Notification::make()
                ->title(__('setting::setting.notifications.updated.title'))
                ->success()
                ->send();
        } catch (Exception $e) {
            Logger::error($e);

            Notification::make()
                ->title(__('setting::setting.notifications.update_failed.title'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    private function getDriverForms(): array
    {
        $forms = [
            DriverForm::schema(),
        ];

        foreach (app(DriverManager::class)->all(LogDriver::class) as $driver) {
            if ($section = $driver->schema()) {
                $forms[] = $section;
            }
        }

        return $forms;
    }
}
