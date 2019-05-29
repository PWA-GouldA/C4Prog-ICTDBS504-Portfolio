<?php
/**
 * Home
 *
 * A Dashboard for the contacts demo
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        index.php
 * @version     1.0
 * @created     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

$siteTitle = "YOUR INITIALS Bookmarker App";
$title = "Dashboard";

require_once "header.php";
require_once "connection.php";
require_once "functions.php";

?>

    <!-- Details about this demo file -->
    <div class="row">
        <div class="col">
            <h1 class="mt-4"><?= isset($siteTitle) && $siteTitle > "" ? $siteTitle : 'CHANGE THE SITE TITLE' ?></h1>
            <h2 class="text-muted"><?= isset($title) && $title > "" ? $title : 'CHANGE THE TITLE' ?></h2>
            <p class="lead">Bookmarker Application dashboard.</p>
            <p>Use the menu (above) to select the table to work with, or go to the Management menu
                option and use the steps on that page to create and seed the database.</p>
            <p>On each page, you will be able to perform the <abbr class="text-secondary">BREAD</abbr> operations.
                <abbr class="text-secondary">BREAD</abbr> stands for Browse, Read, Edit, Add and Delete.</p>
        </div>
    </div>
    <!-- begin demo HTML code -->

    <div class="row">
        <div class="col-12">
            <h2>Database Status</h2>
            <?php
            if (isset($conn) && !is_null($conn)) {
                echo "<p class='alert alert-success'>Database connection active<p>";
            } else {
                echo "<p  class='alert alert-danger'>No database connection</p>";
            } ?>
        </div>
        <div class="col-12">
            <h2>Table(s)</h2>
        </div>
        <?php
        foreach ($dbTableList as $table) {
            $tableText = textify($table);
            ?>
            <div class="col-3">
                <h4>
                    <a href="<?= $table ?>.php" class="text-dark">
                        <?= ucwords($tableText); ?> <i class="fa fa-link"></i>
                    </a>
                </h4>
                <?php
                if (getTableExists($conn, $table)) {
                    echo "<p class='alert alert-success'>Table Exists</p>";

                    if (rowCount($conn, $table) > 0) {
                        echo "<p class='alert alert-success'>Data present</p>";
                    } else {
                        echo "<p  class='alert alert-danger'>Table empty</p>";
                    }
                } else {
                    echo "<p  class='alert alert-danger'>Table Missing</p>";
                }
                ?>

            </div>
            <?php
        } // end foreach table
        ?>
    </div>

    <!-- end demo HTML code -->
<?php

require_once "footer.php";