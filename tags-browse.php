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

$title = "ICTDBS504 | Sample | Tags | Browse";
require_once "header.php";
require_once "connection.php";

// Read the tags from the db into an array
// SQL to select all (fields) from the tags
$sqlBrowse = "SELECT * FROM tags WHERE tag LIKE :findThis ORDER BY tag ";

$searchTerm = '';
$search = '%';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $search = '%' . $searchTerm . '%';
}

// execute the SQL
$stmt = $conn->prepare($sqlBrowse);
$stmt->bindParam(":findThis", $search);
$stmt->execute();

// store results in array
$tags = $stmt->fetchAll();
// To show a variable for debugging: var_dump($tags);
?>
<!-- Details about this demo file -->
<div class="row">
    <div class="col">
        <h1 class="mt-4"><?= $title; ?></h1>
        <h2 class="text-muted">Browse Tags</h2>
        <div class="row">
            <p class="col-2">
                <a href="tags-browse.php" class="btn btn-primary mb-1">Browse all</a>
            </p>
            <p class="col">
                <a href="tags-add.php" class="btn btn-success mb-1">
                    <i class="fa fa-plus"></i> New Tag
                </a>
            </p>
            <div class="col">
                <form class="form-inline" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                           name="search" value="<?= $searchTerm ?>">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
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
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach ($tags as $tag) {
                ?>
                <tr>
                    <td><?= $tag->tag ?></td>
                    <td><?= $tag->created_at ?></td>
                    <td>
                        <form action="tags-browse.php" method="post">
                            <input type="hidden" name="tag" value="<?= $tag->tag ?>">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" class="btn btn-success" formaction="tags-read.php" name="btnRead">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="submit" class="btn btn-warning" formaction="tags-edit.php" name="btnEdit">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button type="submit" class="btn btn-danger" formaction="tags-delete.php"
                                        name="btnDelete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php
            } // end for each
            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- end demo HTML code -->
