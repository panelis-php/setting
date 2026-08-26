<?php

namespace Panelis\Setting\Panel\Clusters\Settings\Pages;

use BackedEnum;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Panelis\Setting\Drivers\Avatar\UIAvatarsDriver;
use Panelis\Setting\Drivers\AvatarDriver;
use Panelis\Setting\Drivers\DriverManager;
use Panelis\Setting\Panel\Clusters\Settings;
use Panelis\Setting\Panel\Clusters\Settings\Enums\LibravatarStyle;
use Panelis\Setting\Panel\Clusters\Settings\Enums\UserPermission;
use Panelis\Setting\Panel\Clusters\Settings\HasUpdateableForm;
use Panelis\Setting\Panel\Clusters\Settings\UpdateSettingPage;
use Panelis\User\Models\Role;

class User extends UpdateSettingPage implements HasSchemas, HasUpdateableForm
{
    use InteractsWithForms;
    use Settings\Traits\AddUpdateButton;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected string $view = 'filament.clusters.settings.pages.setting';

    protected static ?string $cluster = Settings::class;

    protected static ?int $navigationSort = 20;

    public ?array $user;

    public function getTitle(): string|Htmlable
    {
        return __('setting::user.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('setting::user.navigation');
    }

    public function updatePermission(): BackedEnum
    {
        return UserPermission::Edit;
    }

    public function mount(): void
    {
        $this->form->fill([
            'user' => config('user'),
            'isButtonDisabled' => user_cannot(UserPermission::Edit),
        ]);
    }

    public static function canAccess(): bool
    {
        return user_can(UserPermission::Browse);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->disabled(user_cannot(UserPermission::Edit))
            ->components([
                Section::make(__('setting::user.label'))
                    ->description(__('setting::user.section_description'))
                    ->schema([
                        Select::make('user.default_role')
                            ->label(__('setting::user.default_role'))
                            ->native(false)
                            ->searchable()
                            ->options(Role::options())
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label(__('user::role.name'))
                                    ->required()
                                    ->unique(table: Role::class, column: 'name')
                                    ->minLength(3)
                                    ->maxLength(50),

                                TextInput::make('guard_name')
                                    ->label(__('user::role.guard_name'))
                                    ->default('web')
                                    ->datalist(['web', 'api'])
                                    ->required()
                                    ->alphaDash(),
                            ])
                            ->createOptionUsing(fn (array $data): int => Role::create($data)->getKey())
                            ->required(),

                        Radio::make('user.avatar_provider')
                            ->label(__('setting::user.avatar_provider'))
                            ->options(fn (): array => collect(app(DriverManager::class)->all(AvatarDriver::class))
                                ->mapWithKeys(fn (AvatarDriver $driver): array => [$driver->name() => $driver->label()])
                                ->all())
                            ->default(UIAvatarsDriver::NAME)
                            ->live()
                            ->required(),

                        Radio::make('user.avatar_libravatar_style')
                            ->label(__('setting::user.avatar_libravatar_style'))
                            ->visible(fn (Get $get): bool => $get('user.avatar_provider') === 'libravatar')
                            ->live()
                            ->enum(LibravatarStyle::class)
                            ->required(fn (Get $get): bool => $get('user.avatar_provider') === 'libravatar')
                            ->options(LibravatarStyle::class),

                        Image::make(
                            url: function (Get $get): ?string {
                                $provider = app(DriverManager::class)->find(AvatarDriver::class, $get('user.avatar_provider') ?? UIAvatarsDriver::NAME);
                                $style = $get('user.avatar_libravatar_style');

                                return $provider?->getImageUrl(Auth::user(), $style);
                            },
                            alt: 'Avatar',
                        ),
                    ]),
            ]);
    }
}
