<?php

namespace WPDefault\db;

use WPDefault\PluginException;

/**
 * Class DatabaseException
 * @package WPDefault\db
 */
final class DatabaseException extends PluginException
{

    /**
     * @return string
     */
    public function get_name(): string
    {
        return "DatabaseException";
    }

}