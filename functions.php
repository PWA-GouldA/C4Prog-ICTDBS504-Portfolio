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
    'missing_table'
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
        $table = $tableName;
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
        $count = 0;
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
                "_" => " ",
                "-" => " ",
                "." => " ",
                ":" => " ",
            ];
            foreach ($replacements as $replaceThis => $withThis) {
                $string = str_replace($replaceThis, $withThis, $string);
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

/*
 *
 * From: https://www.php.net/manual/en/function.money-format.php
 * That it is an implementation of the function money_format for the
 * platforms that do not it bear.
 *
 * The function accepts to same string of format accepts for the
 * original function of the PHP.
 *
 * (Sorry. my writing in English is very bad)
 *
 * The function is tested using PHP 5.1.4 in Windows XP
 * and Apache WebServer.
*/
if (!function_exists('money_format')) {
    function money_format($format, $number)
    {
        $regex = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?' .
            '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
        if (setlocale(LC_MONETARY, 0) == 'C') {
            setlocale(LC_MONETARY, '');
        }
        $locale = localeconv();
        preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
        foreach ($matches as $fmatch) {
            $value = floatval($number);
            $flags = array(
                'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                    $match[1] : ' ',
                'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
                'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                    $match[0] : '+',
                'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
                'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
            );
            $width = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
            $left = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
            $right = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
            $conversion = $fmatch[5];

            $positive = true;
            if ($value < 0) {
                $positive = false;
                $value *= -1;
            }
            $letter = $positive ? 'p' : 'n';

            $prefix = $suffix = $cprefix = $csuffix = $signal = '';

            $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
            switch (true) {
                case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                    $prefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                    $suffix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                    $cprefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                    $csuffix = $signal;
                    break;
                case $flags['usesignal'] == '(':
                case $locale["{$letter}_sign_posn"] == 0:
                    $prefix = '(';
                    $suffix = ')';
                    break;
            }
            if (!$flags['nosimbol']) {
                $currency = $cprefix .
                    ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                    $csuffix;
            } else {
                $currency = '';
            }
            $space = $locale["{$letter}_sep_by_space"] ? ' ' : '';

            $value = number_format($value, $right, $locale['mon_decimal_point'],
                                   $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
            $value = @explode($locale['mon_decimal_point'], $value);

            $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
            if ($left > 0 && $left > $n) {
                $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
            }
            $value = implode($locale['mon_decimal_point'], $value);
            if ($locale["{$letter}_cs_precedes"]) {
                $value = $prefix . $currency . $space . $value . $suffix;
            } else {
                $value = $prefix . $value . $space . $currency . $suffix;
            }
            if ($width > 0) {
                $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
                    STR_PAD_RIGHT : STR_PAD_LEFT);
            }

            $format = str_replace($fmatch[0], $value, $format);
        }
        return $format;
    } // end function money_format
} // end if


/**
 * retrieve a list of the tables in the SQLite database
 *
 * @param null $conn
 * @return array
 */
if (!function_exists('tagsExpand')) {
    function tagsExpand($taggingString = "")
    {
        $tags = "";
        $tagList = explode(",", $taggingString);
        foreach ($tagList as $tag) {
            $tag=htmlentities($tag);
            $tags .= "<span class='badge badge-pill badge-dark'>$tag</span> ";

        }
        return $tags;
    } // end function Get Table List
} // end if

/**
 * Take a multidimension array and flatten it
 *
 * @param $arrayToFlatten
 * @return array
 */
function flattenArray($arrayToFlatten) {
    $flatArray = array();
    foreach($arrayToFlatten as $element) {
        if (is_array($element)) {
            $flatArray = array_merge($flatArray, flattenArray($element));
        } else {
            $flatArray[] = $element;
        }
    }
    return $flatArray;
}