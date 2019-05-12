<?php
/**
 * Connection to MySQL database
 *
 * Require this file in any PHP page that needs access to
 * the MySQL database, and then use the $conn variable to
 * provide the connection to the database.
 *
 *              require_once("connection.php");
 *
 * This file is NOT a class, but a plain PHP file. This is
 * used as a simple demonstration.
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        connection.php
 * @version     1.0
 * @created     2019-04-30
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

/**
 * Define constants for the MySQL database connection
 */

if (!defined('DB_NAME')) {
    define('DB_NAME', 'ajg_links');
}

if (!defined('DB_TYPE')) {
    define('DB_TYPE', 'mysql');
}

if (!defined('DB_HOST')) {
    define('DB_HOST', '127.0.0.1');
}

if (!defined('DB_PORT')) {
    define('DB_PORT', 3306);
}
if (!defined('DB_USER')) {
    define('DB_USER', 'ajg_links');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', 'Password1');
}


/**
 * if there is no connection, create it!
 * Use PDO (PHP Data Objects) for this.
 */
if (!isset($conn) || $conn == null) {
    // connection string (concatenation uses .)

    $connectionString = sprintf("%s:dbname=%s;host=%s;port=%s", DB_TYPE, DB_NAME, DB_HOST, DB_PORT);
    try {
        $conn = new PDO($connectionString, DB_USER, DB_PASSWORD);
    }
    catch (PDOException $exception) {
        echo "<h1>OOPS!</h1>";
        echo "<p>We have a problem connecting to the database.</p>";
        echo "<p>Please inform the administrator at errors@example.com</p>";
        die(0); // terminate script
    }
}