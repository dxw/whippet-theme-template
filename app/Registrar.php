<?php

namespace Dxw\MyTheme;

class Registrar
{
    protected static $singleton;
    protected $di;

    public function __construct()
    {
        $this->di = [];

        // Superglobals
        $this->addInstance('Dxw\\MyTheme\\SuperglobalPost', new \Dxw\MyTheme\SuperglobalPost());
        $this->addInstance('Dxw\\MyTheme\\SuperglobalGet', new \Dxw\MyTheme\SuperglobalGet());
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

    public function register()
    {
        foreach ($this->di as $instance) {
            if ($instance instanceof \Dxw\MyTheme\Registerable) {
                $instance->register();
            }
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }
}
