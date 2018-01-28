<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit24d560b4513002fb3fb6de502287a7b9
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/configuracoes',
            1 => __DIR__ . '/../..' . '/controllers',
            2 => __DIR__ . '/../..' . '/models',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit24d560b4513002fb3fb6de502287a7b9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit24d560b4513002fb3fb6de502287a7b9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
