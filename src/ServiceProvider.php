<?php

namespace Tabtt\Sample;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONTROLLERS_NAMESPACE = '\\App\\Http\\Controllers\\';

    public function boot(): void
    {
        // app()->bind('\Symfony\Component\Finder\SplFileInfo', function() {
        //     return new \Tabtt\Sample\SplFileInfo();
        // });
        $router = new AnnotateRouter();

        $router->exec();
    }


    public function getControllerFiles(): array
    {
        return File::allFiles(base_path('app/Http/Controllers'));
    }

    public function selfMethod(reflectionClass $reflectionClass): boolean
    {
    }

    public function getControllerNamespace(SplFileInfo $file): string
    {
        $dir = $file->getRelativePath();

        if ($dir === '') {
            return self::CONTROLLERS_NAMESPACE;
        }

        return self::CONTROLLERS_NAMESPACE . $dir . '\\';
    }
}
