<!--  search -->
<script>
	document.getElementById("myInput").addEventListener("keyup", function() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0]; 
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
});
</script>


<!-- register -->
<?php
include 'connn.php';
		if (isset($_POST['submit'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['password'];
			mysqli_query($connection,"INSERT INTO register(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')");
			echo "<script>alert('Saved Successfully!')</script>";
			echo "<script>window.location='index.php'</script>";
		}
	?> 


<!--  login  -->
<?php
include 'conn.php';
session_start();
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM register WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $_SESSION['id'] = $user['user_id']; 
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role']; // Store user role in session

        if($user['role'] == 'admin') {
            header("Location: admin.php"); // Redirect admin to admin dashboard
            exit();
        } else {
            header("Location: index.php"); // Redirect regular user to their dashboard
            exit();
        }
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>


<!-- table -->
  <?php
$connection = mysqli_connect("localhost", "root", "", "data");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = mysqli_query($connection, "SELECT * FROM dash");
if ($query) {
    while ($rows = mysqli_fetch_assoc($query)) {
        echo '<tr>';
        echo '<td>' . $rows['name'] . '</td>';
        echo '<td>' . $rows['position'] . '</td>';
        echo '<td>' . $rows['office'] . '</td>';
        echo '<td>' . $rows['age'] . '</td>';
        echo '<td>' . $rows['startdate'] . '</td>';
        echo '<td>' . $rows['salary'] . '</td>';
        echo '</tr>';
    }
} else {
    echo "Error: " . mysqli_error($connection);
}
mysqli_close($connection);
?>


<!-- entry for table -->
<?php
    include 'connn.php';
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$position = $_POST['position'];
			$office = $_POST['office'];
      $age = $_POST['age'];
      $startdate = $_POST['startdate'];
      $salary = $_POST['salary'];
			mysqli_query($connection,"INSERT INTO dash(name,position,office,age,startdate,salary) VALUES('$name','$position','$office','$age','$startdate','$salary')");
			echo "<script>alert('Saved Successfully!')</script>";
		}
	?>

  <!-- Edit -->
  <?php
if(isset($_GET['id'])) {
    $connection = mysqli_connect("localhost", "root", "", "data");
    if (!$connection) die("Connection failed: " . mysqli_connect_error());
    $edit_id = mysqli_real_escape_string($connection, $_GET['id']);
    $query = "SELECT * FROM dash WHERE id = '$edit_id'";
    $result = mysqli_query($connection, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
</head>
<body>
    <h2>Edit Record</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
        Position: <input type="text" name="position" value="<?php echo $row['position']; ?>"><br>
        Office: <input type="text" name="office" value="<?php echo $row['office']; ?>"><br>
        Age: <input type="text" name="age" value="<?php echo $row['age']; ?>"><br>
        Start Date: <input type="text" name="startdate" value="<?php echo $row['startdate']; ?>"><br>
        Salary: <input type="text" name="salary" value="<?php echo $row['salary']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
    } else {
        echo "Record not found.";
        mysqli_close($connection);
    }
} else {
    header("Location: error.php");
    exit();
}
?>
