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
 * Table: s
 * Field name       Type        Size    Primary Key?
 * -------------------------------------------------------------
 * tag              VARCHAR     32      YES
 * description      VARCHAR     255
 * created_at       DATETIME
 * updated_at       DATETIME
 */

echo "<h3 class='alert alert-primary'>Creating tags table</h3>";


// delete the s table & data if it exists
$sqlDropTable = "DROP TABLE IF EXISTS tags";
// run the SQL command
try {
    $conn->exec($sqlDropTable);
    echo "<h4 class='alert alert-success'>Tags table dropped</h4>";
}
catch (PDOException $exception) {
    echo "<h4 class='alert alert-danger'>Problem creating tags</h4>";
    die(0);
}


$sqlCreateTable = <<<EOSQL
    CREATE TABLE IF NOT EXISTS tags (
        'tag'              VARCHAR (32),
        'description'      VARCHAR (255),
        'created_at'       DATETIME,
        'updated_at'       DATETIME,
        PRIMARY KEY (tag)
    );
EOSQL;

// run the SQL command
try {
    $conn->exec($sqlCreateTable);
    echo "<h4 class='alert alert-success'>Tags table created</h4>";
}
catch (PDOException $exception) {
    echo "<h4 class='alert alert-danger'>Problem creating tags</h4>";
    die(0);
}


require_once "footer.php";
