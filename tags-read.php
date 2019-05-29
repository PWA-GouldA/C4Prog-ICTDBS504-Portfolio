<?php
/**
 * Read tags
 *
 * A basic read tags, listing ALL tags in the DB
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        tags-read.php
 * @version     1.0
 * @created     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

$title = "ICTDBS504 | Sample | Tags | Read";
require_once "header.php";
require_once "connection.php";

if (!isset($_POST)||!isset($_POST['tag'])) {
    $error = ["warning" => "Cannot come directly to this page"];
} else {

    $tagToFind = $_POST['tag'];
// Read the tags from the db into an array
    $sqlRead = "SELECT t.id, t.tag, t.description, t.created_at, t.updated_at FROM tags as t WHERE tag = :tagToFind";
// execute the SQL
    $stmt = $conn->prepare($sqlRead);
    $stmt->bindParam(':tagToFind', $tagToFind);
    $stmt->execute();
// store results in array
    $tags = $stmt->fetchAll();

// Find the number of times that 'tag' has been used in the links
    $sqlTimesUsed = "SELECT count(id) as timesUsed FROM links WHERE tags LIKE :findTag";
// execute the SQL
    $stmtUsed = $conn->prepare($sqlTimesUsed);
    $theTag='%'.$tagToFind.'%';
    $stmtUsed->bindParam(':findTag', $theTag, PDO::PARAM_STR);
    $stmtUsed->execute();

// store results in array
    $timesUsed = $stmtUsed->fetch();
    ?>
    <!-- Details about this demo file -->
    <div class="row">
        <div class="col">
            <h1 class="mt-4"><?= $title; ?></h1>
            <h2 class="text-muted">Read Tag</h2>
            <div class="row">
                <p class="col"><a href="tags-browse.php" class="btn btn-primary mb-1">Browse all</a></p>
                <p class="col text-right">
                    <a href="tags-add.php" class="btn btn-success mb-1"><i class="fa fa-plus"></i> New tag</a>
                </p>
            </div>
        </div>
    </div>

    <!-- begin demo HTML code -->
    <div class="row">
        <div class="col">
            <?php
            foreach ($tags as $tag) {
                ?>
                <table class="table">
                    <thead>
                    </thead>

                    <tbody>
                    <tr>
                        <th>Tag</th>
                        <td><?= $tag->tag ?></td>
                    </tr>
                    <tr>
                        <th>Notes</th>
                        <td><?= $tag->description ?></td>
                    </tr>
                    <tr>
                        <th>Date Added</th>
                        <td><?= $tag->created_at ?></td>
                    </tr>
                    <tr>
                        <th>Date Updated</th>
                        <td><?= $tag->updated_at ?></td>
                    </tr>
                    <tr>
                        <th>Tag used</th>
                        <td><b><?=$timesUsed->timesUsed?></b> times</td>
                    </tr>
                    </tbody>
                </table>
                <form action="tags-browse.php" method="post">
                    <input type="hidden" name="tag" value="<?= $tag->tag ?>">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-warning" formaction="tags-edit.php">
                            <i class="fa fa-pen"></i> Edit Tag
                        </button>
                        <button type="submit" class="btn btn-danger" formaction="tags-delete.php">
                            <i class="fa fa-times"></i> Delete
                        </button>
                    </div>
                </form>
                <?php
            } // end for each
            ?>
        </div>
    </div>
    <!-- end demo HTML code -->
    <?php
}
