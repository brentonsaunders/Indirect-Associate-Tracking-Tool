<?php
if(isset($_POST['login']) &&
   !empty($_POST['associate-id']) &&
   !empty($_POST['associate-name'])) {
    $associateId = strtolower(sanitize($_POST['associate-id']));
    $associateName = sanitize($_POST['associate-name']);

    $pdo = getPdo();

    insertAssociate($pdo, $associateId, $associateName);

    $_SESSION['tracker'] = [
        'associate-id' => $associateId
    ];

    header('Location: index.php');

    exit;
}

require 'header.php';
?>
<div id="login">
    <form action="index.php" method="post">
        <label>
            <span>Enter your A to Z login</span>
            <input name="associate-id" type="text" />
        </label>
        <label>
            <span>Re-enter your A to Z login</span>
            <input name="associate-id2" type="text" />
        </label>
        <label>
            <span>Enter your name</span>
            <input name="associate-name" type="text" />
        </label>
        <input name="login" type="submit" value="Continue" />
    </form>
</div>
<?php
require 'footer.php';
?>