<?php
if (isset($_POST['delete_btn'], $_POST['delete_id'])) {
    $connection = mysqli_connect("localhost", "root", "", "data");
    if (!$connection) die("Connection failed: " . mysqli_connect_error());
    $delete_id = mysqli_real_escape_string($connection, $_POST['delete_id']);
    if (mysqli_query($connection, "DELETE FROM dash WHERE user_id = '$delete_id'")) {
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
    mysqli_close($connection);
} else {
    header("Location: error.php");
    exit();
}
?>
