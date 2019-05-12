<?php
/**
 * Browse tags
 *
 * A basic browse tags, listing ALL tags in the DB
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        tags-browse.php
 * @version     1.0
 * @created     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

$title = "ICTDBS504 | Sample | Tags";
require_once "functions.php";
require_once "connection.php";
require_once "header.php";

// Read the tags from the db into an array
// SQL to select all (fields) from the tags
$sqlBrowse = "SELECT * FROM tags ORDER BY created_at DESC LIMIT 5;";

// SQL to select the given, family and email only
// SELECT given_name, family_name, email FROM tags

// execute the SQL
$stmt = $conn->prepare($sqlBrowse);
$stmt->execute();

// store results in array
$tags = $stmt->fetchAll();
// To show a variable for debugging: var_dump($tags);
?>
<!-- Details about this demo file -->
<div class="row">
    <div class="col">
        <h1 class="mt-4"><?= $title; ?></h1>
        <h2 class="text-muted">Last Five Tags Added</h2>
        <div class="row">
            <p class="col"><a href="tags-browse.php" class="btn btn-primary mb-1">Browse all</a></p>
            <p class="col text-right"><a href="tags-create.php" class="btn btn-success mb-1">Add new tag</a></p>
        </div>
    </div>
</div>

<!-- begin demo HTML code -->
<div class="row">
    <div class="col">
        <table class="table">
            <thead>
            <tr>
                <th>Tag</th>
                <th>Date Added</th>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach ($tags as $tag) {
                ?>
                <tr>
                    <td><?= $tag->tag ?></td>
                    <td><?= $tag->created_at ?></td>
                </tr>
                <?php
            } // end for each
            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- end demo HTML code -->
