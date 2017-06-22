# php-utils

## Insllation.

Add the following to your composer.json file.

```
    "require": {
        ... other stuff
        "skymaxlab/php-utils": "dev-master",
        ... other stuff
     }
     
     ...   
     
    "repositories": [
        {
            "url": "https://github.com/skymaxlab/php-utils.git",
            "type": "git"
        }
    ],
   
```

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
    'Carbon' => Carbon\Carbon::class,
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

### Register Commands 

```php
// app/Console/Console/Kernel.php
class Kernel extends ConsoleKernel
{
    protected $commands = [
        ...
        // php-utils
        \SkyMaxLab\Console\Commands\App\ModelColumns::class,
    ];
}
```
