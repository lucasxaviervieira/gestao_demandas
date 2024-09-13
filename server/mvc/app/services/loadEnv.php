<?php

class EnvLoader
{
    private $path = __DIR__ . '/../../.env';

    public function load()
    {
        if (!file_exists($this->path)) {
            throw new Exception("The .env file does not exist.");
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }


            list($key, $value) = explode('=', $line, 2);


            $value = trim($value, "\"' ");


            $this->setEnv(trim($key), $value);
        }
    }

    private function setEnv($key, $value)
    {
        putenv(sprintf('%s=%s', $key, $value));
    }

    public function getEnv($key)
    {
        return getenv($key);
    }
}
