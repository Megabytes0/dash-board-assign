include 'conn.php';

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get form data
    $edit_id = $_POST['edit_id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Update query
    $update_query = "UPDATE dbziru SET username='$username', fullname='$fullname', course='$course', email='$email', contact='$contact' WHERE user_id='$edit_id'";
    
    // Execute update query
    if(mysqli_query($connection, $update_query)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }

    // Redirect to index.php after update
    header("Location: crud.php");
    exit();
} else {
    // Redirect if form is not submitted
    header("Location: crud.php");
    exit();
}
?>