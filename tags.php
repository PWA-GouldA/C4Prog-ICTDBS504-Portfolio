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
$sqlBrowse = "SELECT tag, date(created_at) as dateAdded FROM tags ORDER BY created_at DESC LIMIT 5;";

// execute the SQL
$stmt = $conn->prepare($sqlBrowse);
$stmt->execute();

// store results in array
$tags = $stmt->fetchAll();
// To show a variable for debugging: var_dump($tags);


$sqlNumberTags = "SELECT count(id) as totalTags FROM tags;";

// execute the SQL and get the number of tags
$stmtNumTags = $conn->prepare($sqlNumberTags);
$stmtNumTags->execute();
$numTags = $stmtNumTags->fetch();


$searchTerm = '';
$search = '%';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $search = '%' . $searchTerm . '%';
}

?>
    <!-- Details about this demo file -->
    <div class="row">
        <div class="col">
            <h1 class="mt-4"><?= $title; ?></h1>
            <h2 class="text-muted">Last Five Tags Added</h2>
            <div class="row">
                <p class="col"><a href="tags-browse.php" class="btn btn-primary mb-1">Browse all</a></p>
                <p class="col text-right"><a href="tags-add.php" class="btn btn-success mb-1">Add new tag</a></p>
                <div class="col">
                    <form class="form-inline" method="post" action="tags-browse.php">
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
            <div class="card w-100">
                <div class="card-body m-0 p-0">
                    <h5 class="card-title m-1 p-3">Last Five Tags</h5>
                    <ul class="list-group list-group-flush">
                        <?php
                        foreach ($tags as $tag) {
                            ?>
                            <li class="list-group-item">
                                <?= $tag->tag ?>
                                <small class="small">(<?= $tag->dateAdded ?>)</small>
                            </li>
                            <?php
                        } // end for each
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card bg-dark text-white" style="width: 100%;">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Tags</h5>
                    <p class="card-text fa-5x"><?= $numTags->totalTags ?></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Tags vs Date</h5>
                    <div class="card-text">
                        <div id="chart-container">
                            <canvas id="graphCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2"></div>
    <!-- end demo HTML code -->
<?php
require_once "footer.php";
