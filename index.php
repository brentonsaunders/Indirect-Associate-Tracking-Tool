<?php
require_once 'functions.php';

$hideMenu = true;

if(empty($_SESSION['tracker']['associate-id'])) {
    require 'login.php';

    exit;
}

$associateId = $_SESSION['tracker']['associate-id'];

require 'header.php';
?>
<div id="location-changer">
    <script>
        const associateId = '<?php echo $associateId; ?>';
    </script>
    <div id="location-changed">
        <h1></h1>
        <div class="buttons">
            <textarea placeholder="Note" id="note"></textarea>
            <button id="add-note">Add Note</button>
            <button id="change-location">Change Location</button>
        </div>
    </div>
    <div id="opening-camera">
        <h1>Opening camera ...</h1>
    </div>
    <canvas hidden="true" id="qr-canvas"></canvas>
</div>
<?php
require 'footer.php';
?>
