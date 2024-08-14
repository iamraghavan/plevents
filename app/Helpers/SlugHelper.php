<?php

namespace App\Helpers;

class SlugHelper
{
    public static function str_slug($title)
    {
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));
    }
}
