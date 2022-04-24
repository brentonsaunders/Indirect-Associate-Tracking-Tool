<?php
require 'functions.php';

$pdo = getPdo();

deleteAllAssociateLocations($pdo);
?>
<p>Purged all location history!</p>