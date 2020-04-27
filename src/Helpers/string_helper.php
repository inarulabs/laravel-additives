<?php
/**
 * iNaru String Helpers
 *
 * ----------------------------------------------------------------------------
 * @package inaru/additive
 * @author  razy.dev@gmail.com
 * @license http://opensource.org/licenses/MIT    MIT License
 * @link    https://github.com/inaru/laravel-additive
 * @since   Version 1.0.0
 * ----------------------------------------------------------------------------
 */

if (!function_exists('lang') && function_exists('__')) {
    function lang($key, $replace = [], $locale = null)
    {
        return __($key, is_array($replace) ? $replace : ['attribute' => $replace], $locale);
    }
}