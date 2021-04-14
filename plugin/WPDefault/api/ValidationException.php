<?php

namespace WPDefault\api;

use WPDefault\PluginException;

/**
 * Class ValidationExceptions
 * @package WPDefault\api
 */
final class ValidationException extends PluginException
{

    /**
     * @return string
     */
    public function get_name(): string
    {
        return "ValidationException";
    }

}