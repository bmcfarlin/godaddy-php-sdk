<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9af601f74a8178cfc795a3f6f1d97a79
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'G' => 
        array (
            'GoDaddy\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'GoDaddy\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9af601f74a8178cfc795a3f6f1d97a79::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9af601f74a8178cfc795a3f6f1d97a79::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9af601f74a8178cfc795a3f6f1d97a79::$classMap;

        }, null, ClassLoader::class);
    }
}
