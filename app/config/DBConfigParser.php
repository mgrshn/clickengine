<?php

namespace App\Config;

class DBConfigParser
{
    private array $confParams = [];

    public function __construct($configName)
    {
        $this->setConfParams($configName);
    }

    private function getConf(string $configName): array|null
    {
        $configPath = __DIR__ . "/../../$configName.php";

        if (!file_exists($configPath)) {
            return null;
        }

        $config = require_once $configPath;
        return $config;
    }

    private function setConfParams(string $configName): void
    {
        $config = $this->getConf($configName);
        
        if (isset($config))
        foreach ($config as $confKey => $confValue) {
            $this->confParams[$confKey] = $confValue; 
        } 
    }

    public function get(string $confKey): string|null
    {
        return $this->confParams[$confKey] ?? null;
    }
}
