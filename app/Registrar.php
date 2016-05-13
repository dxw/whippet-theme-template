<?php

namespace Dxw\MyTheme;

class Registrar
{
    protected static $singleton;
    protected $di;

    public function __construct()
    {
        $this->di = [];

        $this->addInstance('Dxw\\MyTheme\\Value\\Post', new \Dxw\MyTheme\Value\Post());
        $this->addInstance('Dxw\\MyTheme\\Value\\Get', new \Dxw\MyTheme\Value\Get());
        $this->addInstance('Dxw\\MyTheme\\Helpers', new \Dxw\MyTheme\Helpers());
    }

    public function di($path)
    {
        call_user_func(function ($registrar) use ($path) {
            require $path;
        }, $this);
    }

    public function addInstance($class, $instance)
    {
        $this->di[$class] = $instance;
    }

    public function getInstance($class)
    {
        return $this->di[$class];
    }

    public function register()
    {
        foreach ($this->di as $instance) {
            if ($instance instanceof \Dxw\MyTheme\Registerable) {
                $instance->register();
            }
        }
    }

    public static function getSingleton()
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }
}
