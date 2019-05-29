<?php
/**
 * A simple API to get the number of tags added per date
 *
 * @author      5001775 <5001775@tafe.wa.edu.au>
 * @file        tags-api.php
 * @project     ICTDBS504-Portfolio
 * @version     1.0
 * @created     2019-05-28
 * @copyright   This work is licensed under the Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License. To view a copy of
 *              this license, visit http://creativecommons.org/licenses/by-sa/3.0/au/
 *              or send a letter to Creative Commons, PO Box 1866, Mountain View,
 *              CA 94042, USA.
 */
header('Content-Type: application/json');

require_once('connection.php');

$sqlQuery = "SELECT date(created_at) as theDate, count(tag) as totalTags FROM tags GROUP BY date(created_at) ORDER BY date(created_at) DESC LIMIT 8";

// execute the SQL and get the number of tags
$stmtNumTags = $conn->prepare($sqlQuery);
$stmtNumTags->execute();
$tags = $stmtNumTags->fetchAll();

$data = array();
foreach ($tags as $row) {
    $data[] = $row;
}


echo json_encode($data);
