# Laravel UI Bootstrap

## Introduction

With the releaase of Laravel 8 ships with a default scraffolding with Tailwind CSS. Besides that also released, Laravel JetStream which provide authentication scraffolding includes login, registration, email verification, etc. API support via Laravel Sanctum which is headless authentication system.

However many of us still prefer to use treditional front-end framework like Bootstrap. So this package will provide you Bootstrap presets and authentication scraffolding includes login, register, email verification, etc. At backend support via all new Laravel Fortify.

### Installation

To get started, install package using composer:

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

Next, Run install artisan command to publish bootstrap scraffolding to application

```bash
php artisan laravelui:bootstrap
npm install && npm run dev
```

This command will update package.json with Bootstrap dependencies, update resources/sass and resources/js, and resources/views with authentication views like login, register, reset passsword request, layouts files etc.

## Build With

[Laravel](https://github.com/laravel/laravel)  
[Laravel Fortify](https://github.com/laravel/fortity)  
[Bootstrap](http://getbootstrap.com)

## Useful Links

[Official Laravel Ui Package](https://github.com/laravel/ui)

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[MIT](https://choosealicense.com/licenses/mit/)
