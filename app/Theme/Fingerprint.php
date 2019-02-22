<?php

namespace Dxw\MyTheme\Theme;

class Fingerprint
{
    public function __construct($jsonPath)
    {
        $this->json = json_decode(file_get_contents($jsonPath), true);
    }

    public function get($filePath)
    {
        return $this->json['rewrittenFiles'][$filePath];
    }
}
