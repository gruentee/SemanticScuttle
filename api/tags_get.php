<?php
// Implements the del.icio.us API request for all a user's tags.

// del.icio.us behavior:
// - tags can't have spaces

// Force HTTP authentication first!
require_once('httpauth.inc.php');
require_once('../header.inc.php');

/* Service creation: only useful services are created */
$b2tservice =& ServiceFactory::getServiceInstance('Bookmark2TagService');


// Get the tags relevant to the passed-in variables.
$tags =& $b2tservice->getTags($userservice->getCurrentUserId());

// Set up the XML file and output all the tags.
header('Content-Type: text/xml');
echo '<?xml version="1.0" standalone="yes" ?'.">\r\n";
echo "<tags>\r\n";
foreach($tags as $row) {
    echo "\t<tag count=\"". $row['bCount'] .'" tag="'. filter(convertTag($row['tag'], 'out'), 'xml') ."\" />\r\n";
}
echo "</tags>";
?>
