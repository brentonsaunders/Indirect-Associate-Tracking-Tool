<?php
require_once '../functions.php';

$pdo = getPdo();

$locations = getLocations($pdo);

require '../header.php';
?>
<div id="dashboard">
        <h1>Dashboard</h1>
        <div id="all-locations">
            <table>
                <tr>
                    <th>Location</th>
                    <th>Associates</th>
                    <th>Notes</th>
                </tr>
<?php
foreach($locations as $location) {
    echo "<tr>";
    echo "<td class=\"location\"><a href=\"location.php?location-id=${location['id']}\">${location['name']}</a></td>";
    echo "<td class=\"associates\">";

    if(count($location['associates']) === 0) {
        echo "--";
    } else {
        echo "<ul>";

        foreach($location['associates'] as $associate) {
            $now = strtotime('now');
            $then = strtotime($associate['time']);
            $seconds = $now - $then;
            $timeAgo = getTimeAgo($seconds);

            echo "<li><a href=\"find-associate.php?associate-id=${associate['associate_id']}\">${associate['associate_name']} (${associate['associate_id']})<span>($timeAgo ago)</span></a></li>";
        }

        echo "</ul>";
    }

    echo "</td>";
    echo "<td class=\"notes\">";

    echo "<ul>";

    foreach($location['associates'] as $associate) {
        echo "<li><a href=\"location.php?location-id=${location['id']}\">${associate['note']}</a></li>";
    }

    echo "</ul>";

    echo "</td>";
    echo "</tr>";
}
?>
        </table>
    </div>
</div>
<?php
require '../footer.php';
?>
