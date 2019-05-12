<?php
/**
 * Database Functions
 *
 * Collection of general database functions that are performed semi-regularly
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        functions.php
 * @version     1.0
 * @created     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

require_once "connection.php";

/** Tables used by this application */
$dbTableList = [
    'tags',
    'links',
    'dummy',
    'dummy_empty'
];

/**
 * retrieve a list of the tables in the SQLite database
 *
 * @param null $conn
 * @return array
 */
if (!function_exists('getTableList')) {
    function getTableList($conn = null)
    {
        try {
            $stmt = $conn->query("SELECT table_name FROM information_schema.tables WHERE table_schema = :database_name;");
            $tables = [];
            while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
                $tables[] = $row->name;
            }

            return $tables;
        }
        catch (PDOException $exception) {
            echo "<h1>ERROR!</h1>";
            echo "<h3>Error code: DBF001</h3>";
            echo "<p>We have an error gathering tables.</p>";
            die(0);
        }
    } // end function Get Table List
} // end if


/**
 * retrieve a list of the tables in the SQLite database
 *
 * @param null $conn
 * @return array
 */
if (!function_exists('getTableExists')) {
    function getTableExists($conn = null, $tableName = "")
    {
        $table=$tableName;
        $db = DB_NAME;
        try {
            $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = :database_name AND table_name = :table_name;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":table_name", $table, PDO::PARAM_STR);
            $stmt->bindParam(":database_name", $db, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_OBJ);
            $tableExists = false;
            if (is_object($row)) {
                $tableExists = true;
            }
            return $tableExists;
        }
        catch (PDOException $exception) {
            echo "<h1>ERROR!</h1>";
            echo "<h3>Error code: DBF002</h3>";
            echo "<p>We have an error verifying table exists.</p>";
            die(0);
        }
    } // end function Get Table List
} // end if

if (!function_exists('countTables')) {
    function countTables($conn = null)
    {
        $count=0;
        try {
            $stmt = $conn->query("SELECT count(table_name) as count FROM information_schema.tables WHERE table_schema = :database_name");
            $results = $stmt->fetch(\PDO::FETCH_OBJ);
            $count = $results->count;
        }
        catch (PDOException $exception) {
            echo "<h1>ERROR!</h1>";
            echo "<h3>Error code: DBF003</h3>";
            echo "<p>We have an error counting tables.</p>";
            die(0);
        }
        return $count;
    } // end function Get Table List
} // end if


if (!function_exists('rowCount')) {
    function rowCount($conn = null, $tableName)
    {
        try {
            $sql = "SELECT count(*) as count FROM " . $tableName;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetch(\PDO::FETCH_OBJ);
            $count = $results->count;
            return $count;
        }
        catch (PDOException $exception) {
            echo "<h1>ERROR!</h1>";
            echo "<h3>Error code: DBF004</h3>";
            echo "<p>We have an error with the row count.</p>";
            echo "<p>" . $exception->getMessage() . "</p>";
            echo "<p></p>";
            echo "<p>Table: {$tableName}</p>";
            die(0);
        }
    } // end function Get Table List
} // end if


if (!function_exists('textify')) {
    function textify($string)
    {
        try {
            $replacements = [
                "_"=>" ",
                "-"=>" ",
                "."=>" ",
                ":"=>" ",
            ];
            foreach($replacements as $replaceThis=>$withThis) {
                $string=str_replace($replaceThis,$withThis,$string);
            }
            return $string;
        }
        catch (exception $exception) {
            echo "<h1>ERROR!</h1>";
            echo "<h3>Error code: STR001</h3>";
            echo "<p>We have an error with textify.</p>";
            die(0);
        }
    } // end function Get Table List
} // end if

