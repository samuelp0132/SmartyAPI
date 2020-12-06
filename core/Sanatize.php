<?php
/*Developed by Samuel Peralta*/

namespace Smarty\Core;

class Sanatize{

    /**
     * Previene sql injection
     * @access	public
     * @param	string $input_str
     * @return	sanitized string
     */

    public static function xss_cleaner($input_str)
    {
        $return_str = str_replace(array('<', ';', '|', '&', '>', "'", '"', ')', '('), array('&lt;', '&#58;', '&#124;', '&#38;', '&gt;', '&apos;', '&#x22;', '&#x29;', '&#x28;'), $input_str);
        $return_str = str_ireplace('%3Cscript', '', $return_str);

        return htmlspecialchars(strip_tags($return_str));
    }
}
?>