<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit186a2ab52369cc85bf7a5e23486214c7
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
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit186a2ab52369cc85bf7a5e23486214c7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit186a2ab52369cc85bf7a5e23486214c7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}