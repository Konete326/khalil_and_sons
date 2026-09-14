<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mime\MimeTypes;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        MimeTypes::setDefault(new MimeTypes([
            'application/octet-stream' => ['glb', 'stl', 'bin'],
            'model/gltf-binary' => ['glb'],
            'model/gltf+json' => ['gltf'],
            'model/stl' => ['stl'],
        ]));
    }
}

