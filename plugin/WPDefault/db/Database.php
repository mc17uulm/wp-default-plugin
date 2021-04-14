<?php

namespace WPDefault\db;

/**
 * Class Database
 * @package WPDefault\db
 */
final class Database
{

    private const TABLES = [
        // TODO: add tables
    ];

    /**
     * @var Database|null
     */
    private static ?Database $instance = null;

    /**
     * @var string
     */
    private string $base;

    /**
     * Database constructor.
     */
    protected function __construct()
    {
        global $wpdb;

        $this->base = $wpdb->base_prefix;
    }

    /**
     * @return Database
     */
    public static function get_database(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * @param string $key
     * @return string
     * @throws DatabaseException
     */
    public function get_table_name(string $key): string
    {
        if (!key_exists($key, self::TABLES)) throw new DatabaseException("Key '$key' not in tables");
        return $this->base . self::TABLES[$key];
    }

    /**
     * @param string $query
     * @param mixed ...$fields
     * @return array
     */
    public function select(string $query, ...$fields): array
    {
        global $wpdb;

        return $wpdb->get_results($wpdb->prepare($query, $fields), ARRAY_A);
    }

    /**
     * @param string $query
     * @param mixed ...$fields
     * @return int
     * @throws DatabaseException
     */
    public function insert(string $query, ...$fields): int
    {
        global $wpdb;

        $result = $wpdb->query($wpdb->prepare($query, $fields));
        if (!$result) throw new DatabaseException("Error inserting db entry: '{$wpdb->last_error}'");
        return $wpdb->insert_id;
    }

    /**
     * @param string $query
     * @param mixed ...$fields
     * @return bool
     */
    public function update(string $query, ...$fields): bool
    {
        global $wpdb;

        $result = $wpdb->query($wpdb->prepare($query, $fields));
        return $result > 0;
    }

    /**
     * @param string $query
     * @param mixed ...$fields
     * @return bool
     */
    public function delete(string $query, ...$fields): bool
    {
        return $this->update($query, $fields);
    }

    public static function initialize() : void {
        // TODO: create tables
    }

    public static function remove() : void {
        // TODO: remove tables
    }

}