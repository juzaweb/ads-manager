<?php

namespace Juzaweb\Modules\Core\Facades;

class Theme
{
    public static function current()
    {
        return new class {
            public function name()
            {
                return 'default';
            }
        };
    }
}
