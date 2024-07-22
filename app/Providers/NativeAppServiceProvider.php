<?php

namespace App\Providers;

use Native\Laravel\Menu\Menu;
use Native\Laravel\Facades\Window;
use Native\Laravel\Facades\MenuBar;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {

        Menu::new()
            ->submenu(
                '',
                Menu::new()
                    ->link('https://nativephp.com', 'Learn more')
                    ->separator()
                    ->link('https://nativephp.com', 'Documentation')
            )
            ->register();

        MenuBar::create()
            // ->alwaysOnTop()
            ->width(700)
            ->height(500)
            ->withContextMenu(
                Menu::new()
                    ->label('Jayabsen')
                    ->separator()
                    ->link(route('home'), 'Home Page')
                    ->separator()
                    ->quit()
            );

        Window::open()
            ->width(1200)
            ->height(750);
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [];
    }
}
