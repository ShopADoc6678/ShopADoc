<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit_advanced_ads_tracking
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('AdvancedAdsTracking\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \AdvancedAdsTracking\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit_advanced_ads_tracking', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \AdvancedAdsTracking\Autoload\ClassLoader(\dirname(\dirname(__FILE__)));
        spl_autoload_unregister(array('ComposerAutoloaderInit_advanced_ads_tracking', 'loadClassLoader'));

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
            require __DIR__ . '/autoload_static.php';

            call_user_func(\AdvancedAdsTracking\Autoload\ComposerStaticInit_advanced_ads_tracking::getInitializer($loader));
        } else {
            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->setClassMapAuthoritative(true);
        $loader->register(true);

        return $loader;
    }
}
