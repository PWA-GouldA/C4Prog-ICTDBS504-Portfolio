<?php
/**
 * Add tag
 *
 * Add the tag into the
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        tag-creat.php
 * @version     1.0
 * @created     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

$title = "ICTDBS504 | Sample | Tags | Remove";
require_once "header.php";
require_once "connection.php";

if (isset($_POST)) {

    // Check to see if the "newTag" was filled out
    if (isset($_POST['currentTag'], $_POST['tag']) && (int)$_POST['currentTag'] > 0 && strlen($_POST['tag']) > 0) {

        $tagID = (int)$_POST['currentTag'];
        $title = trim($_POST['tag']);
        if (strpos($title, '#') === 0) {
            $title = substr_replace($title, '', 0, 1);
        }

        // SQL to create the tag
        $sqlBrowse = 'DELETE FROM tags WHERE id = :bTag AND tag = :aTag';
        // bind the parameters and execute the SQL
        $stmt = $conn->prepare($sqlBrowse);
        $stmt->bindParam(":aTag", $title, PDO::PARAM_STR);
        $stmt->bindParam(":bTag", $tagID, PDO::PARAM_INT);
        // execute the insert
        $stmt->execute();

    } else {
        // this will have a proper error message later
        echo "Sorry no tag given, aborting";
    }
} else {
    // this will have a proper error message later
    echo "cannot access this page directly";
}

// send the user back to the tags main page
header("Location:tags.php");