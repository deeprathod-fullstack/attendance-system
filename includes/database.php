<?php
/**
 * Database access. Every query goes through a prepared statement.
 */

/** Returns the shared connection, opening it on first use. */
function db(): mysqli
{
    static $connection = null;

    if ($connection === null) {
        $cfg = $GLOBALS['config']['db'];
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $connection = new mysqli($cfg['host'], $cfg['user'], $cfg['pass'], $cfg['name'], (int) $cfg['port']);
            $connection->set_charset('utf8mb4');
        } catch (mysqli_sql_exception $e) {
            http_response_code(500);
            $detail = $GLOBALS['config']['debug'] ? ' (' . $e->getMessage() . ')' : '';
            exit('Could not connect to the database. Check the settings in config.php' . htmlspecialchars($detail));
        }
    }

    return $connection;
}

/** Prepares and executes a statement, binding every parameter as a string. */
function db_execute(string $sql, array $params = []): mysqli_stmt
{
    $stmt = db()->prepare($sql);
    if ($params) {
        $values = array_values($params);
        $stmt->bind_param(str_repeat('s', count($values)), ...$values);
    }
    $stmt->execute();

    return $stmt;
}

/** Returns all rows as associative arrays. */
function db_all(string $sql, array $params = []): array
{
    return db_execute($sql, $params)->get_result()->fetch_all(MYSQLI_ASSOC);
}

/** Returns the first row, or null when there is none. */
function db_one(string $sql, array $params = []): ?array
{
    $row = db_execute($sql, $params)->get_result()->fetch_assoc();

    return $row ?: null;
}

/** Returns the first column of the first row, or null when there is none. */
function db_value(string $sql, array $params = [])
{
    $row = db_execute($sql, $params)->get_result()->fetch_row();

    return $row[0] ?? null;
}

/** MySQL error code for a duplicate UNIQUE / PRIMARY key. */
const DB_DUPLICATE_KEY = 1062;
