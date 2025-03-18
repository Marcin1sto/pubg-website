<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Sezony')
                ->icon('bs.book')
                ->title('PUBG API')
                ->route('seasons.index'),

            Menu::make('Gracze')
                ->icon('bs.book')
                ->title('Baza danych')
                ->route('player.index'),

            Menu::make('Stremerzy')
                ->icon('bs.book')
                ->route('streamers.index'),

            Menu::make('API')
                ->icon('bs.book')
                ->title('Dostęne endpointy')
                ->route('api.index')
                ->permission('api.index'),

            Menu::make(__('Boost Statystyk'))
                ->icon('bs.people')
                ->route('platform.configuration.stats')
                ->permission('platform.configuration.stats')
                ->title(__('Konfiguracja')),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Dostęp')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Użytkownicy'))
                ->addPermission('platform.systems.players', __('Gracze'))
                ->addPermission('seasons.index', __('Sezony')),

            ItemPermission::group('Stremerzy')
                ->addPermission('platform.systems.streamers', __('Streamy'))
                ->addPermission('platform.streamers.index.add', __('Stremerzy dodawanie')),

            ItemPermission::group(__('API'))
                ->addPermission('api.index', __('Dostępne endpointy')),

            ItemPermission::group(__('Konfiguracja'))
                ->addPermission('platform.configuration.stats', __('Boost Statystyk'))

        ];
    }
}
