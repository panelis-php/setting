<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Pages;

use BackedEnum;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;
use Panelis\Setting\Drivers\CacheDriver;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Panel\Clusters\Settings;
use Panelis\Setting\Panel\Clusters\Settings\Enums\CachePermission;
use Panelis\Setting\Panel\Clusters\Settings\Forms\Cache\DriverForm;
use Panelis\Setting\Panel\Clusters\Settings\HasUpdateableForm;
use Panelis\Setting\Panel\Clusters\Settings\UpdateSettingPage;

class Cache extends UpdateSettingPage implements HasSchemas, HasUpdateableForm
{
    use InteractsWithForms;
    use Settings\Traits\AddUpdateButton;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedServerStack;

    protected string $view = 'filament.clusters.settings.pages.setting';

    protected static ?string $cluster = Settings::class;

    protected static ?int $navigationSort = 70;

    public array $cache;

    public array $database;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('test_cache')
                ->label(__('setting::cache.btn.test'))
                ->visible(false)
                ->action(function (): void {
                    try {
                        \Illuminate\Support\Facades\Cache::put('test', 'test', now()->addMinute(5));

                        Notification::make()
                            ->title(__('setting::cache.test_success'))
                            ->success()
                            ->send();
                    } catch (Exception $e) {
                        Log::error($e);

                        Notification::make()
                            ->title(__('setting::cache.test_failed'))
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

            Action::make('flush_cache')
                ->label(__('setting::cache.btn.flush'))
                ->requiresConfirmation()
                ->color('warning')
                ->hidden(user_cannot(CachePermission::Flush))
                ->action(function (): void {
                    try {
                        \Illuminate\Support\Facades\Cache::flush();

                        Notification::make()
                            ->title(__('setting::cache.flushed'))
                            ->success()
                            ->send();
                    } catch (Exception $e) {
                        Log::error($e);
                    }
                }),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('setting::cache.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('setting::cache.navigation');
    }

    public static function canAccess(): bool
    {
        return user_can(CachePermission::Browse);
    }

    public function updatePermission(): BackedEnum
    {
        return CachePermission::Edit;
    }

    public function mount(): void
    {
        $this->form->fill([
            'cache' => config('cache'),
            'database' => [
                'redis' => config('database.redis'),
            ],

            'isButtonDisabled' => user_cannot(CachePermission::Browse),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->disabled(user_cannot(CachePermission::Edit))
            ->schema($this->getDriverForms());
    }

    private function getDriverForms(): array
    {
        $forms = [
            DriverForm::schema(),
        ];

        foreach (app(DriverManager::class)->all(CacheDriver::class) as $driver) {
            if ($section = $driver->schema()) {
                $forms[] = $section;
            }
        }

        return $forms;
    }
}
