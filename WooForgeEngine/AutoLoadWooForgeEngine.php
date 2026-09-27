<?php
class AutoLoadWooForgeEngine
{
    private static $_instance = null;
    private function __construct()
    {
        spl_autoload_register([$this, 'load']);
    }
    public static function _instance() {
        if (!self::$_instance)
        {
            self::$_instance = new AutoLoadWooForgeEngine();
        } return self::$_instance;
    }
    public function load($class) {
        $directories = [ 'class', 'helper', 'utility' , 'trait' ];
        foreach ($directories as $directory)
        {
            $file = trailingslashit(WOOEN_PLUGIN_DIR . $directory) . $class . '.php';
            if (is_readable($file)) {
                include_once $file;
                return;
            }
        }
    }
}
AutoLoadWooForgeEngine::_instance();