<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit37cea3a24bd5467cf3e1f60b5fcac901
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit37cea3a24bd5467cf3e1f60b5fcac901::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit37cea3a24bd5467cf3e1f60b5fcac901::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit37cea3a24bd5467cf3e1f60b5fcac901::$classMap;

        }, null, ClassLoader::class);
    }
}
