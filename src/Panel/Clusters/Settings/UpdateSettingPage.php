<?php

namespace Panelis\Setting\Panel\Clusters\Settings;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Panelis\Setting\Events\SettingUpdated;
use Panelis\Setting\Models\Setting;
use Throwable;

abstract class UpdateSettingPage extends Page
{
    protected BackedEnum $permission;

    public function update(): void
    {
        abort_unless(user_can(static::updatePermission()), Response::HTTP_FORBIDDEN);

        $states = $this->form->getState();

        $this->beforeValidate($states);

        $this->validate();

        $this->afterValidated($states);

        try {
            foreach (Arr::dot($states) as $key => $value) {
                Setting::updateOrCreate(compact('key'), compact('value'));
            }

            event(new SettingUpdated);

            $this->auditSettingUpdate();

            Notification::make()
                ->title(__('setting::setting.notifications.updated.title'))
                ->success()
                ->send();

            $this->afterUpdated($states);
        } catch (Throwable $e) {
            Log::error($e);

            $this->auditSettingUpdate(false, $e);

            Notification::make()
                ->title(__('setting::setting.notifications.update_failed.title'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function beforeValidate(array $forms): void {}

    protected function afterValidated(array $forms): void {}

    protected function afterUpdated(array $forms): void {}

    protected function auditSettingUpdate(bool $successful = true, ?Throwable $exception = null): void
    {
        if (! function_exists('audit')) {
            return;
        }

        $event = 'update_'.Str::snake(class_basename(static::class));
        if (! $successful) {
            $event .= '_failed';
        }

        $audit = audit('settings')
            ->event($event)
            ->withProperty('page', class_basename(static::class))
            ->withProperty('settings', array_keys(Arr::dot($this->form->getState())));

        if ($exception !== null) {
            $audit->withProperty('exception', $exception::class);
        }

        $audit->log('setting::activity.'.$event);
    }

    protected function auditSettingAction(string $action, bool $successful = true, ?Throwable $exception = null): void
    {
        if (! function_exists('audit')) {
            return;
        }

        $event = $successful ? $action : $action.'_failed';

        $audit = audit('settings')
            ->event($event)
            ->withProperty('page', class_basename(static::class))
            ->withProperty('action', $action);

        if ($exception !== null) {
            $audit->withProperty('exception', $exception::class);
        }

        $audit->log('setting::activity.'.$event);
    }
}
