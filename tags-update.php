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

$title = "ICTDBS504 | Sample | Tags | Add";
require_once "header.php";
require_once "connection.php";

if (isset($_POST)) {

    // Check to see if the "newTag" was filled out
    if (isset($_POST['theTag']) && strlen($_POST['theTag']) > 0 && isset($_POST['currentTag']) && $_POST['currentTag'] > 0) {

        $tagID = (int)$_POST['currentTag'];
        $title = trim($_POST['theTag']);
        if (strpos($title, '#') === 0) {
            $title = substr_replace($title, '', 0, 1);
        }

        $description = '';
        // see if the description contained any content
        if (isset($_POST['tagDescription']) && strlen($_POST['tagDescription']) > 0) {
            $description = trim($_POST['tagDescription']);
        }

        // SQL to create the tag
        $sqlBrowse = 'UPDATE tags SET tag = :aTag, description = :aNote WHERE id = :bTag';
        // bind the parameters and execute the SQL
        $stmt = $conn->prepare($sqlBrowse);
        $stmt->bindParam(":aTag", $title, PDO::PARAM_STR);
        $stmt->bindParam(":bTag", $tagID, PDO::PARAM_INT);
        $stmt->bindParam(":aNote", $description, PDO::PARAM_STR);
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