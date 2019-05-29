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

// Read the links from the db into an array
// SQL to select all (fields) from the tags from the links
$sqlBrowse = "SELECT tags, created_at FROM links ORDER BY created_at DESC;";

// execute the SQL
$stmt = $conn->prepare($sqlBrowse);
$stmt->execute();

// store results in array
$linkTags = $stmt->fetchAll();

?>
    <!-- Details about this demo file -->
    <div class="row">
        <div class="col">
            <h1 class="mt-4"><?= $title; ?></h1>
            <h2 class="text-muted">Refreshing Tags from Links</h2>
            <div class="row">
                <p class="col"><a href="tags-browse.php" class="btn btn-primary mb-1">Browse all</a></p>
                <p class="col text-right"><a href="tags-add.php" class="btn btn-success mb-1">Add new tag</a></p>
            </div>
        </div>
    </div>

    <!-- begin demo HTML code -->
    <div class="row">

        <div class="col">
            <?php
            $allTags = [];
            $insertTagSQL = "INSERT IGNORE INTO tags ( tag, created_at, updated_at) VALUES ( :tag, :created, :updated);";
            $stmt = $conn->prepare($insertTagSQL);

            foreach ($linkTags as $link) {
                $tags = $link->tags;
                $created = $link->created_at;
                $tags = str_replace("\"", "", $tags);
                $tags = preg_replace("/^#/", "$", $tags);
                $theTags = explode(",", $tags);
                foreach ($theTags as $theTag) {
                    $allTags[] = [$theTag, $created];
                }
            }

            foreach ($allTags as $tagData) {
                $tag = trim($tagData[0]);
                $created = $tagData[1];
                if (strlen($tag) > 0) {
                    $stmt->bindParam(":tag", $tag, PDO::PARAM_STR);
                    $stmt->bindParam(":created", $created, PDO::PARAM_STR);
                    $stmt->bindParam(":updated", $created, PDO::PARAM_STR);
                    echo "<p> " . $tag . " " . $created . "</p>";
                    $ok = $stmt->execute();
                }
            }
            ?>
            <p>Completed</p>
        </div>


    </div>
    <div class="p-2"></div>
    <!-- end demo HTML code -->
<?php
require_once "footer.php";
