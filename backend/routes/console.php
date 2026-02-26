<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Artisan::command('make:module {module}', function ($module) {
//     $this->call('App\Console\Commands\MakeModule', ['module' => $module]);
// })->describe('Create a new module structure');

// Artisan::command('module:seed {module}', function ($module) {
//     $this->call('App\Console\Commands\ModuleSeed', ['module' => $module]);
// })->describe('Run seeder for a specific module');

// Artisan::command('module:install {module}', function ($module) {
//     $this->call('App\Console\Commands\ModuleInstall', ['module' => $module]);
// })->describe('Install a module (migrate + seed)');
