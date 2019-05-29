<?php
/**
 * Create the database tables
 *
 * Using the connection to the database, we will create the
 * tables for this database: contacts, s and cities
 *
 * @author      Adrian Gould <Adrian.Gould@tafe.wa.edu.au>
 * @file        contacts-create-table.php
 * @project     C4Prog-JS-SQL-2019-S1
 * @version     1.1
 * @created     2019-04-30
 * @copyright   This work is licensed under the Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

require_once 'connection.php'; // must have this file to continue
require_once "functions.php";
require_once 'header.php'; // ensure we have added the header

use Plasticbrain\FlashMessages\FlashMessages;

/**
 * Table: Dummies
 * Field name       Type        Size    Notes
 * ----------------------------------------------------------------------------
 * id               INT         11      UNSIGNED AUTO INCREMENT,
 * product_code     VARCHAR     16      UNIQUE
 * product_name     VARCHAR     48      DEFAULT **NO PRODUCT NAME**
 * details          VARCHAR     255
 * unit_price       DECIMAL     7,2     Two decimal places
 * created_at       DATETIME            DEFAULT 1000-01-01 00:00:00
 * updated_at       DATETIME            DEFAULT 1000-01-01 00:00:00
 */

$table = "Dummy";
$tableName = mb_strtolower($table);

echo "<h3 class='alert alert-primary'>Creating table: $table</h3>";


// delete the s table & data if it exists
$sqlDropTable = "DROP TABLE IF EXISTS :table";
// run the SQL command
try {
    $stmt=$conn->query(str_replace(':table',$tableName, $sqlDropTable));
    $stmt->execute();
    echo "<h4 class='alert alert-success'>Table dropped: $table</h4>";
}
catch (PDOException $exception) {
    echo "<h4 class='alert alert-danger'>Problem dropping: $table</h4>";
    die(0);
}


$sqlCreateTable = "
    CREATE TABLE IF NOT EXISTS :table (
        id              INT(11) UNSIGNED AUTO_INCREMENT,
        product_code    VARCHAR(16) NOT NULL UNIQUE ,
        product_name    VARCHAR(48) NOT NULL,
        details         VARCHAR(255),
        unit_price      DECIMAL(7,2),
        tagging         VARCHAR(255),
        created_at      DATETIME DEFAULT '1000-01-01 00:00:00',
        updated_at      DATETIME DEFAULT '1000-01-01 00:00:00',
        PRIMARY KEY (id)
    )
";

// run the SQL command
try {
    $stmt=$conn->query(str_replace(':table',$tableName, $sqlCreateTable));
    $stmt->execute();
    echo "<h4 class='alert alert-success'>Table created: $table</h4>";
}
catch (PDOException $exception) {
    echo "<h4 class='alert alert-danger'>Problem creating table: $table</h4>";
//    $stmt->debugDumpParams();
//    var_dump(str_replace(':table',$tableName, $sqlCreateTable));
//    var_dump($exception);
    die(0);
}


require_once "footer.php";
