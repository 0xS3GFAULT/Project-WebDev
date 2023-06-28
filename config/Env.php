<?php

namespace Config;

use Exception;

class Env
{
    private array $env = [];

    /**
     * @throws Exception
     */
    public function __construct() {
        if (empty($this->env)) {
            $this->env = $this->loadEnv();
        }
    }

    /**
     * @throws Exception
     */
    private function loadEnv(): array {
        $file = dirname(__DIR__) . "/.env.local";
        if (!file_exists($file)) {
            $file = dirname(__DIR__) . "/.env";
            if (!file_exists($file)) {
                throw new Exception("No .env file has been found");
            }
        }
        $f = file($file);
        $datas = [];
        foreach ($f as $a) {
            $a = explode("=", $a);
            $a[1] = str_replace("\r", "", $a[1]);
            $a[1] = str_replace("\n", "", $a[1]);
            $a[1] = str_replace("'", "", $a[1]);
            $datas[$a[0]] = $a[1];
        }
        return $datas;
    }

    protected function get(string $key) {
        return $this->env[$key];
    }

    public function getEnv(): array {
        return $this->env;
    }
}