# php-utils

A collection of php utilities classes and functions.

## load typical packages for all projects

### Service Provider

```php
    Barryvdh\Debugbar\ServiceProvider::class,
    Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
    Yadakhov\Laradump\LaradumpServiceProvider::class,
```

### Alias

```php
    'Debug' => Barryvdh\Debugbar\Facade::class,
```
