<?php

namespace Shahvirag\LaravelUiBootstrap;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelui:bootstrap4
                    {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic login and registration views and routes';

    /**
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'auth/login.blade.php' => 'auth/login.blade.php',
        'auth/passwords/confirm.blade.php' => 'auth/passwords/confirm.blade.php',
        'auth/passwords/email.blade.php' => 'auth/passwords/email.blade.php',
        'auth/passwords/reset.blade.php' => 'auth/passwords/reset.blade.php',
        'auth/register.blade.php' => 'auth/register.blade.php',
        'auth/verify.blade.php' => 'auth/verify.blade.php',
        'layouts/app.blade.php' => 'layouts/app.blade.php',
        'home.blade.php' => 'home.blade.php',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->ensureDirectoriesExist();
        $this->exportViews();

        $this->updateRoute();

        $this->exportAssets();
        $this->updatePackage();
        $this->updateWebpackMix();

        $this->info('Bootstrap scaffolding installed successfully.');
    }

    /**
     * @return void
     */
    protected function ensureDirectoriesExist()
    {
        if (! is_dir($directory = $this->getViewPath('layouts'))) {
            mkdir($directory, 0755, true);
        }

        if (! is_dir($directory = $this->getViewPath('auth/passwords'))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * @return void
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = $this->getViewPath($value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(__DIR__.'/../resources/views/'.$key, $view);
        }
    }

    /**
     * @param  string  $path
     * @return string
     */
    protected function getViewPath($path)
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }

    /**
     * @return void
     */
    protected function updateRoute()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/../routes/web.php'),
            FILE_APPEND
        );
    }

    /**
     * @return void
     */
    protected function exportAssets()
    {
        copy(__DIR__.'/../resources/sass/_variables.scss', resource_path('sass/_variables.scss'));
        copy(__DIR__.'/../resources/sass/app.scss', resource_path('sass/app.scss'));
        copy(__DIR__.'/../resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
        copy(__DIR__.'/../resources/js/app.js', resource_path('js/app.js'));
    }

    /**
     * @return void
     */
    protected function updatePackage($dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $bootstrapPackages =  [
            'bootstrap' => '^4.0.0',
            'jquery' => '^3.2',
            'popper.js' => '^1.12',
            'sass' => '^1.15.2',
            'sass-loader' => '^8.0.0',
        ];

        $packages[$configurationKey] = array_merge(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $bootstrapPackages
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * @return void
     */
    protected function updateWebpackMix()
    {
        file_put_contents(
            base_path('webpack.mix.js'),
            file_get_contents(__DIR__.'/../resources/webpack.mix.js'),
        );
    }
}
