<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit57a51f10ff18a0397f4d7593e688da74
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MathPHP\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MathPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/markrogoyski/math-php/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit57a51f10ff18a0397f4d7593e688da74::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit57a51f10ff18a0397f4d7593e688da74::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}