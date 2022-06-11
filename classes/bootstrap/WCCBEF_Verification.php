<?php

namespace wccbef\classes\bootstrap;

use wccbef\classes\helpers\Others;

class WCCBEF_Verification
{
    public static function is_active()
    {
        if (Others::isAllowedDomain()) {
            return 'yes';
        }

        $is_active = get_option('wccbef_is_active', 'no');
        return ($is_active == 'yes' || $is_active == 'skipped');
    }

    public static function skipped()
    {
        $skipped = get_option('wccbef_is_active', 'no');
        return $skipped == 'skipped';
    }
}
