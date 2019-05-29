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

$title = "ICTDBS504 | Sample | Tags | Add";
require_once "functions.php";
require_once "connection.php";
require_once "header.php";


?>
<!-- Details about this demo file -->
<div class="row">
    <div class="col">
        <h1 class="mt-4"><?= $title; ?></h1>
        <h2 class="text-muted">Add Tag</h2>
        <div class="row">
            <p class="col mb-2"><a href="tags-browse.php" class="btn btn-primary mb-1">Browse all</a></p>
        </div>
    </div>
</div>

<!-- begin demo HTML code -->
<div class="row">
    <form class="col" method="post" name="tagCreateForm" action="tags-create.php">

        <div class="form-group">
            <label for="newTag">Tag</label>
            <input type="text" class="form-control" id="newTag" name="newTag"
                   aria-describedby="tagCodeHelp"
                   placeholder="Enter the tag">
            <small id="tagCodeHelp" class="form-text text-muted">The word or phrase that makes up the new
                hashtag (no # needed).
            </small>
        </div>

        <div class="form-group">
            <label for="tagDescription">Details/Description</label>
            <textarea class="form-control" id="tagDescription" name="tagDescription"
                      aria-describedby="tagDescriptionHelp"
                      placeholder="Enter the tag description (optional)"></textarea>
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
