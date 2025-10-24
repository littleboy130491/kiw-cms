<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Littleboy130491\Sumimasen\SumimasenPlugin;
use Awcodes\Curator\CuratorPlugin;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Illuminate\Validation\Rules\Password;
use Outerweb\FilamentTranslatableFields\Filament\Plugins\FilamentTranslatableFieldsPlugin;
use Filament\Navigation\NavigationGroup;
use Datlechin\FilamentMenuBuilder\FilamentMenuBuilderPlugin;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Spatie\ResponseCache\Middlewares\DoNotCacheResponse;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use Filament\Forms\Components\TextInput;
use Datlechin\FilamentMenuBuilder\MenuPanel\ModelMenuPanel;
use Illuminate\Support\Facades\Storage;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                DoNotCacheResponse::class,
            ])
            ->brandName(config('cms.site_name'))
            ->brandLogo(Storage::url('media/' . app('settings')->site_logo ?? config('cms.site_logo')))
            ->favicon(Storage::url('media/' . app('settings')->site_favicon ?? config('cms.site_favicon')))
            ->theme(asset('css/filament/admin/theme.css'))
            ->plugins([
                SumimasenPlugin::make()
                    ->exceptResources(['post'])
                    ->settingsPage(false),
                CuratorPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterNavigation: true,
                        navigationGroup: 'Users'
                    )
                    ->passwordUpdateRules(
                        rules: [Password::default()->mixedCase()->uncompromised(3)], // you may pass an array of validation rules as well. (default = ['min:8'])
                        requiresCurrentPassword: true, // when false, the user can update their password without entering their current password. (default = true)
                    ),
                FilamentTranslatableFieldsPlugin::make(),
                FilamentShieldPlugin::make(),
                FilamentMenuBuilderPlugin::make()
                    ->usingMenuItemModel(\Littleboy130491\Sumimasen\Models\MenuItem::class)
                    ->showCustomTextPanel()
                    ->addLocations($this->getMenuLocations())
                    ->addMenuItemFields([
                        TextInput::make('classes'),
                    ])
                    ->addMenuPanels([
                        ModelMenuPanel::make()
                            ->model(\App\Models\Page::class)
                            ->collapsed(true)
                            ->collapsible(true),
                        ModelMenuPanel::make()
                            ->model(\App\Models\Category::class)
                            ->collapsed(true)
                            ->collapsible(true),
                        ModelMenuPanel::make()
                            ->model(\App\Models\Archive::class)
                            ->collapsed(true)
                            ->collapsible(true),
                        ModelMenuPanel::make()
                            ->model(\App\Models\Commercial::class)
                            ->collapsed(true)
                            ->collapsible(true),
                    ]),
                FilamentSpatieLaravelBackupPlugin::make()
                    ->authorize(fn(): bool => auth()->user()->hasRole(['admin', 'super_admin'])),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->unsavedChangesAlerts()
            ->sidebarCollapsibleOnDesktop()
            ->databaseNotifications()
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Contents')
                    ->icon('heroicon-o-document-text'),
                NavigationGroup::make()
                    ->label('Services')
                    ->icon('heroicon-o-building-office'),
                NavigationGroup::make()
                    ->label('Tenders')
                    ->icon('heroicon-o-presentation-chart-line'),
                NavigationGroup::make()
                    ->label('Achievements')
                    ->icon('heroicon-o-star'),
                NavigationGroup::make()
                    ->label('People')
                    ->icon('heroicon-o-user'),
                NavigationGroup::make()
                    ->label('Documents')
                    ->icon('heroicon-o-document-chart-bar'),
                NavigationGroup::make()
                    ->label('Users')
                    ->icon('heroicon-o-users'),
                NavigationGroup::make()
                    ->label('Patterns')
                    ->icon('heroicon-o-cube'),
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->globalSearch(false);
    }

    public function boot(): void
    {

    }

    private function getMenuLocations(): array
    {
        $languages = config('cms.language_available', []);
        $locations = [];

        $baseLocations = config('cms.navigation_menu_locations', [
            'header' => 'Header',
            'footer' => 'Footer',
        ]);

        foreach ($baseLocations as $key => $label) {
            foreach ($languages as $langCode => $langName) {
                $locations["{$key}_{$langCode}"] = "{$label} ({$langName})";
            }
        }

        return $locations;
    }
}
