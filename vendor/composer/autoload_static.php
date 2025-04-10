<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd7653cd6ccff553977c54bf18dd1292e
{
    public static $prefixLengthsPsr4 = array (
        'k' => 
        array (
            'kenpru1\\quotesconsumer\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'kenpru1\\quotesconsumer\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitd7653cd6ccff553977c54bf18dd1292e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd7653cd6ccff553977c54bf18dd1292e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd7653cd6ccff553977c54bf18dd1292e::$classMap;

        }, null, ClassLoader::class);
    }
}
