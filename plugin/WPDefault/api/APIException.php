<?php

namespace WPDefault\api;

use WPDefault\PluginException;

/**
 * Class APIException
 * @package WPDefault\api
 */
final class APIException extends PluginException
{

    /**
     * @return string
     */
    public function get_name(): string
    {
        return "APIException";
    }

}