# php-utils

A collection of php utilities classes and functions.

## load typical packages for all projects

### Service Provider

```php
    Barryvdh\Debugbar\ServiceProvider::class,
    Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
    Collective\Html\HtmlServiceProvider::class,
    Laracasts\Flash\FlashServiceProvider::class,
    Laravel\Socialite\SocialiteServiceProvider::class,
    Spatie\Fractal\FractalServiceProvider::class,
    Yadakhov\Laradump\LaradumpServiceProvider::class,
```

### Alias

```php
    'Debug' => Barryvdh\Debugbar\Facade::class,
    'Form' => Collective\Html\FormFacade::class,
    'Fractal' => Spatie\Fractal\FractalFacade::class,
    'Html' => Collective\Html\HtmlFacade::class,
    'Socialite' => Laravel\Socialite\Facades\Socialite::class,
```

### Configs

```
    php artisan vendor:publish
```
