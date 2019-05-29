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

$title = "ICTDBS504 | Sample | Tags | Delete";
require_once "header.php";
require_once "connection.php";

if (!isset($_POST)||!isset($_POST['tag'])) {
    $error = ["warning" => "Cannot come directly to this page"];
} else {

    $tagToFind = trim($_POST['tag']);
// Read the tags from the db into an array
    $sqlRead = "SELECT t.id, t.tag, t.description, t.created_at, t.updated_at FROM tags as t WHERE tag = :tagToFind";
// execute the SQL
    $stmt = $conn->prepare($sqlRead);
    $stmt->bindParam(':tagToFind', $tagToFind);
    $stmt->execute();
// store results in array
    $tag = $stmt->fetch();

    ?>
    <!-- Details about this demo file -->
    <div class="row">
        <div class="col">
            <h1 class="mt-4"><?= $title; ?></h1>
            <h2 class="text-muted">Delete Tag</h2>
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
                    </tbody>
                </table>
                <form action="tags-browse.php" method="post">
                    <input type="hidden" name="tag" value="<?= $tag->tag ?>">
                    <input type="hidden" name="currentTag" value="<?= $tag->id ?>">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-danger" formaction="tags-remove.php">
                            <i class="fa fa-exclamation"></i> Confirm Delete
                        </button>
                        <a class="btn btn-dark" href="tags-browse.php">
                            <i class="fa fa-smile"></i> Cancel Delete
                        </a>
                    </div>
                </form>

        </div>
    </div>
    <!-- end demo HTML code -->
    <?php
}
