<?php
/**
 * Template page
 *
 * This is the basic page we will insert PHP into for each
 * problem we solve.
 *
 * @author      Adrian Gould <adrian.gould@nmtafe.wa.edu.au>
 * @file        template.php
 * @version     1.0
 * @created     2019-05-07
 * @copyright   This work is licensed under Creative Commons
 *              Attribution-ShareAlike 3.0 Australia License.
 */

$siteTitle='';
$title = "";

require_once "connection.php";
require_once "functions.php";
require_once "header.php";
require_once "vendor/autoload.php";

use Plasticbrain\FlashMessages\FlashMessages;
use Carbon\Carbon;

// Instantiate the Flash Message class
$msg = new FlashMessages();

// Get this file's last updated date/time using the Carbon Package
$lastModified=new Carbon(getlastmod());
$lastModified->timezone('Australia/Perth');
?>

    <!-- Details about this portfolio file -->
    <div class="row">
        <div class="col">
            <h1 class="mt-4"><?= isset($siteTitle) && $siteTitle>"" ? $siteTitle : 'SET THE SITE TITLE' ?></h1>
            <h2 class="text-muted"><?= isset($title) && $title>"" ? $title : 'CHANGE THE TITLE' ?></h2>
            <p class="lead">Quick Description of Page as required</p>
        </div>
    </div>

<?php
// Delete this comment down to the end of the END SAMPLE ADD MESSAGES comment
// SAMPLE ADD MESSAGES
// this uses the package/class PhpFlashMessages https://github.com/plasticbrain/PhpFlashMessages
$msg->info('This is an info message');
$msg->success('This is a success message');
$msg->warning('This is a warning message');
$msg->error('This is an error message');
// END SAMPLE ADD MESSAGES

//Display any messages to the user
if ($msg->hasErrors()) {
    ?>
    <div class="row">
        <div class="col">
            <h3 class="mt-4">Notifications</h3>
        </div>
        <?php
        $msg->setMsgWrapper("<div class='%s col-12'>%s</div>");
        $msg->display();
        ?>
    </div>
    <?php
}
?>

    <!-- begin demo HTML code -->
    <h3>PAGE CONTENT HERE</h3>

    <!-- end demo HTML code -->
<?php
include_once "footer.php";