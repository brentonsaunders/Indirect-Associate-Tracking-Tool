<?php
require_once '../functions.php';

$pdo = getPdo();

$associateId = null;
$locations = [];

if(!empty($_GET['associate-id'])) {
    $associateId = $_GET['associate-id'];

    $associate = getAssociate($pdo, $associateId);

    if($associate) {
        $locations = getAssociateLocations($pdo, $associateId);
    }
}

require '../header.php';
?>
<div id="dashboard">
    <h1>Find Associate</h1>
    <div id="find-associate">
        <form action="find-associate.php" method="get">
            <input placeholder="Enter associate login" name="associate-id" type="text" />
        </form>
<?php
if($associateId) {
?>
        <h2>Activity for '<?php echo $associateId; ?>'</h2>
<?php
    if(count($locations) > 0) {
?>
        <table>
            <tr>
                <th>Location</th>
                <th>Time</th>
                <th>Duration</th>
                <th>Notes</th>
            </tr>
<?php
        foreach($locations as $location) {
            $duration = '';

            if($location['next_time']) {
                $duration = strtotime($location['next_time']) - strtotime($location['time']);
            } else {
                $duration = strtotime('now') - strtotime($location['time']);
            }

            $durationStr = getTimeAgo($duration);

            $timeStr = date('h:i A', strtotime($location['time']));

            echo "<tr>";
            echo "<td class=\"location\"><a href=\"location.php?location-id=${location['location_id']}\">${location['location_name']}</a></td>";
            echo "<td class=\"time\">$timeStr</td>";
            echo "<td class=\"duration\">$durationStr</td>";
            echo "<td class=\"notes\">${location['note']}</td>";
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
}
?>
    </div>
</div>
<?php
require '../footer.php';
?>
