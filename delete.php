<?php

session_start();
require_once "pdo.php";

if ( isset($_POST['delete']) && isset($_POST['profile_id']) ) {
    $sql = "DELETE FROM profile WHERE profile_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['profile_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}


$stmt = $pdo->prepare("SELECT first_name , last_name FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for profile_id';
    header('Location: index.php');
    return;
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Iheb ben sassi</title>

</head>
<body>
<div class="container">
    <p>Deleting Profile</p>
    <p> First Name: <?= htmlentities($row['first_name']) ?> </p>
    <p> Last Name: <?= htmlentities($row['last_name']) ?> </p>
    <form method="post"><input type="hidden" name="profile_id" value="<?php echo $_GET['profile_id'] ?>"> <input
                type="submit" value="Delete"
                name="delete"><a
                href="index.php">Cancel</a>
    </form>
</div>
</body>