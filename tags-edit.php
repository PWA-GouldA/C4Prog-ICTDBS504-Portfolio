<?php
/**
 * Browse tags
 *
 * A basic browse tags, listing ALL tags in the DB
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        tags-browse.php
 * @version     1.0
 * @editd     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

$title = "ICTDBS504 | Sample | Tags | Add";
require_once "functions.php";
require_once "connection.php";
require_once "header.php";


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
    $tag = $stmt->fetch();

    ?>
    <!-- Details about this demo file -->
    <div class="row">
        <div class="col">
            <h1 class="mt-4"><?= $title; ?></h1>
            <h2 class="text-muted">Edit Tag</h2>
            <div class="row">
                <p class="col mb-2"><a href="tags-browse.php" class="btn btn-primary mb-1">Browse all</a></p>
            </div>
        </div>
    </div>

    <!-- begin demo HTML code -->
    <div class="row">
        <form class="col" method="post" name="tagEditForm" action="tags-update.php">

            <input type="hidden" name="currentTag" value="<?= $tag->id ?>">

            <div class="form-group">
                <label for="theTag">Tag</label>
                <input type="text" class="form-control" id="theTag" name="theTag"
                       aria-describedby="tagCodeHelp"
                       placeholder="Enter the tag"
                       value="<?= $tag->tag ?>">
                <small id="tagCodeHelp" class="form-text text-muted">The word or phrase that makes up the new
                    hashtag (no # needed).
                </small>
            </div>

            <div class="form-group">
                <label for="tagDescription">Details/Description</label>
                <textarea class="form-control" id="tagDescription" name="tagDescription"
                          aria-describedby="tagDescriptionHelp"
                          placeholder="Enter the tag description (optional)"><?= $tag->description ?></textarea>
                <small id="tagDescriptionHelp" class="form-text text-muted">Tag description</small>
            </div>

            <div class="row">
            <span class="col-2">
            <button type="submit" class="btn btn-success w-100">Save</button>
            </span>
                <span class="col-2">
            <a href="tags.php" class="btn btn-danger w-100 ml-auto">Cancel</a>
            </span>
            </div>

        </form>
    </div>
    <!-- end demo HTML code -->
    <?php
}