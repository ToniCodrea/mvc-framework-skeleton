<?php

namespace Framework\Regex;

use Framework\Router\Router;

class RegexConstructor
{
    /**
     * @param array $config
     * @return string
     */
    public function createRegex(array $config): string {
        $string = $config[Router::CONFIG_KEY_PATH];

        foreach ($config["attributes"] as $key => $value) {
            $pattern = "{".$key."}";
            $attributeValueReplace = "(?<". $key . ">". $value . ")";
            $string = str_replace($pattern, $attributeValueReplace, $string);
        }

        return "/^" . str_replace("/", "\/", $string) ."$/";
    }
}