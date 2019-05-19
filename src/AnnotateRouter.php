<?php

namespace Tabtt\Sample;

use Illuminate\Routing\Router;
use Symfony\Component\Finder\SplFileInfo;

class AnnotateRouter
{
    const CONTROLLERS_NAMESPACE = '\\App\\Http\\Controllers\\';

    private $router;
    private $controllerPath;

    public function __construct()
    {
        $this->router = app()->make(Router::class);
        $this->controllerPath = 'app/Http/Controllers';
    }

    public function exec()
    {
        foreach ($this->getControllerFiles() as $file) {
            require_once $file->getPathname();

            $reflectionClass = new \ReflectionClass(
                $this->getControllerNamespace($file) . $file->getBasename('.php')
            );

            foreach ($reflectionClass->getMethods() as $method) {

                if ($reflectionClass->getName() === $method->getDeclaringClass()->getName()) {

                    $parser = new DocCommentParser($method->getDocComment());

                    // パーサでDocCommentをパースしてarrayにする
                    $docComment = new DocComment($method->getName(), $parser->parse());

                    if ($docComment->hasComment('method')) {
                        dump($docComment->getComment('method'));
                        $this->addRoute(
                            $docComment->getComment('method'),
                            $docComment->getComment('path'),
                            $reflectionClass->getName(),
                            $method->getName()
                        );
                    }
                }
            }
        }
    }

    private function addRoute(string $httpMethod, string $to, string $className, string $methodName)
    {
        $this->router->{ mb_strtolower($httpMethod) }($to, $className . '@' . $methodName);
    }

    public function getControllerFiles(): array
    {
        return \File::allFiles(base_path($this->controllerPath));
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
