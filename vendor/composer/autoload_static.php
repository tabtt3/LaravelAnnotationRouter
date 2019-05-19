<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit705d03f6d186c6647e5d0d3da5e0b7cf
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tabtt\\Sample\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tabtt\\Sample\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit705d03f6d186c6647e5d0d3da5e0b7cf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit705d03f6d186c6647e5d0d3da5e0b7cf::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}