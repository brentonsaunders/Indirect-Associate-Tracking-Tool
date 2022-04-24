<?php
require_once '../functions.php';

$pdo = getPdo();

if(empty($_GET['location-id'])) {
    header('Location: index.php');
}

$locationId = $_GET['location-id'];

$location = getLocation($pdo, $locationId);

if(!$location) {
    header('Location: index.php');
}

$history = getLocationAssociateHistory($pdo, $locationId);

require '../header.php';
?>
<div id="dashboard">
        <h1>Location</h1>
        <div id="location">
            <h2>Activity for '<?php echo $location['name']; ?>'</h2>
<?php
if(count($history) > 0) {
?>
            <table>
                <tr>
                    <th>Associate</th>
                    <th>Time</th>
                    <th>Duration</th>
                    <th>Notes</th>
                </tr>
<?php
    foreach($history as $associate) {
        $duration = '';

        if($associate['next_time']) {
            $duration = strtotime($associate['next_time']) - strtotime($associate['time']);
        } else {
            $duration = strtotime('now') - strtotime($associate['time']);
        }

        $durationStr = getTimeAgo($duration);

        $timeStr = date('h:i A', strtotime($associate['time']));

        echo "<tr>";
        echo "<td class=\"associate\"><a href=\"find-associate.php?associate-id=${associate['associate_id']}\">${associate['associate_name']} (${associate['associate_id']})</a></td>";
        echo "<td class=\"time\">$timeStr</td>";
        echo "<td class=\"duration\">$durationStr</td>";
        echo "<td class=\"notes\">${associate['note']}</td>";
        echo "</tr>";
    }
?>
        </table>
<?php
} else {
?>
        <p>No activity found</p>
<?php
}
?>
    </div>
</div>
<?php
require '../footer.php';
?>
