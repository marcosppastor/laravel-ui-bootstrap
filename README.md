# Laravel UI with Laravel Fortify

## Introduction

While laravel is using new Jetstream for authentication, but you still want to use Bootstrap scaffolding and traditional old laravel authentication but backend supported by all new Laravel Fortify. So here we have laravel Bootstrap 4 scaffolding supported by Laravel Fortify.

### Installation

To get started, install LaravelUI Bootstrap4 using composer:

```bash
composer require shahvirag/laravel-ui-bootstrap
```

Add FortifyServiceProvider to config/app.php, and do not forgot to publish fortify files.

```php
'providers' => [
    ...
    App\Providers\FortifyServiceProvider::class,
    ...
]
```

```bash
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
```

Next install LaravelUI Bootstrap4 using artisan command:

```bash
php artisan laravelui:bootstrap4
npm install && npm run dev
```

This command will update package.json with Bootstrap4 dependencies, update resources/sass and resources/js, and resources/views with authentication views like login, register, reset passsword request, layouts files etc.

## Resources

[Laravel](https://github.com/laravel/laravel)
[Laravel Fortify](https://github.com/laravel/fortity)
[Bootstrap](http://getbootstrap.com)
[Laravel UI](https://github.com/laravel/ui)

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
