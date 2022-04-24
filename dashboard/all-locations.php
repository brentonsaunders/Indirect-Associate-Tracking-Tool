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
    echo "<td class=\"location\"><a href=\"index.php?location-id=${location['id']}\">${location['name']}</a></td>";
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

            echo "<li>${associate['associate_name']} (${associate['associate_id']})<span>($timeAgo ago)</span></li>";
        }

        echo "</ul>";
    }

    echo "</td>";
    echo "<td class=\"notes\">";

    echo "<ul>";

    foreach($location['associates'] as $associate) {
        echo "<li>${associate['note']}</li>";
    }

    echo "</ul>";

    echo "</td>";
    echo "</tr>";
}
?>
        </table>
    </div>
</div>