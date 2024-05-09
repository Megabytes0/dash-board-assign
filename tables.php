<?php
	include 'conn.php';
	session_start();
	$user_id = $_SESSION['id'];
	if(!isset($_SESSION['id'])) {
	   echo '<script>alert("You do not have access to this page. Please log in first.");</script>';
	   header("Location: login.php");
		exit();
	   }
   
   $stmt = $conn->prepare("SELECT * FROM register WHERE user_id = ?");
   $stmt->execute([$user_id]);
   $user = $stmt->fetch(PDO::FETCH_ASSOC);
   if($user){
   } else {
	   echo 'failed to find';
   }
	?>

   
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
   

<!DOCTYPE html>
<html lang="en">
<style>
        span{
            color: white;
            margin-right: 10px;
        }
    </style>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">

                <?php
            $connection = mysqli_connect("localhost", "root", "", "data");

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Escape the email to prevent SQL injection
            $email = mysqli_real_escape_string($connection, $_SESSION['email']);

            // Fetch the first name associated with the email
            $query = mysqli_query($connection, "SELECT firstname FROM register WHERE email = '$email'");

            if ($query) {
                $row = mysqli_fetch_assoc($query);
                if ($row) {
                    $firstname = $row['firstname'];
                    echo '<span>Welcome, ' . htmlspecialchars($firstname) . '</span>';
                } else {
                    echo "User not found.";
                }
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            mysqli_close($connection);
            ?>

                    <input class="form-control" type="text" placeholder="Search for..." name= "search1" id= "search1"aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <?php if (isset($_SESSION['email'])): ?>
                            <li><a onclick="window.location.href='index.php';">Profile</a></li>
							<li><button onclick="window.location.href='logout.php';" class="btn btn-danger">Log-out</button></li>
                           
        					<?php else: ?>
        					<li><a onclick="window.location.href='login.php';">Log-in</a></li>
    					    <li><a onclick="window.location.href='register.php';">Register</a></li>
    					    <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.php">Static Navigation</a>
                                  <a class="nav-link" href="layout-sidenav-light.php">Light Sidenav</a>
                                    <?php if (isset($_SESSION['id'])): ?>
                        <?php else: ?>
                        <?php endif; ?>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Login</a>
                                            <a class="nav-link" href="register.php">Register</a>
                                            <a class="nav-link" href="password.php">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.php">401 Page</a>
                                            <a class="nav-link" href="404.php">404 Page</a>
                                            <a class="nav-link" href="500.php">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                        <div class="card-body">
                        <?php if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com'): ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add staff
                            </button>
                        <span>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></span>
                        <?php endif; ?>

                            

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <form action="" method="POST">
                    <div class="row mb-6">
                        <input type="hidden" name="edit_id">
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="name" id="inputName" type="text" />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="position" id="inputPosition" type="text" />
                            <label for="inputPosition">Position</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="office" id="inputOffice" type="text" />
                            <label for="inputOffice">Office</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="age" id="inputAge" type="number" />
                            <label for="inputEmail">Age</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="startdate" id="startdate" type="date" />
                            <label for="startdate">Start date</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="salary" id="inputSalary" type="decimal" />
                            <label for="inputSalary">Salary</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <form action="edit" method="POST">
                    <div class="row mb-6">
                        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="name" id="inputName" type="text" />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="position" id="inputPosition" type="text" />
                            <label for="inputPosition">Position</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="office" id="inputOffice" type="text" />
                            <label for="inputOffice">Office</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="age" id="inputAge" type="number" />
                            <label for="inputEmail">Age</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="startdate" id="startdate" type="date" />
                            <label for="startdate">Start date</label>
                        </div>
                        <div class="form-floating mb-3 p-1">
                            <input class="form-control" name="salary" id="inputSalary" type="decimal" />
                            <label for="inputSalary">Salary</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="edit_id" class="btn btn-primary">Save</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$edit_id = $_GET['edit_id'] ?? null;

if ($edit_id) {
    $sql = "SELECT * FROM dash WHERE user_id = $edit_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $position = $row["position"];
        $office = $row["office"];
        $age = $row["age"];
        $startdate = $row["startdate"];
        $salary = $row["salary"];
    } else {
        echo "0 results";
    }
}

$conn->close();
?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                   
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
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
                            // Delete button
                            echo '<td>';
                            echo '<form method="post" action="delete.php">';
                            echo '<input type="hidden" name="delete_id" value="' . $rows['user_id'] . '">';
                            if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@gmail.com'): 
                            echo '<button type="submit" class="btn btn-danger" name="delete_btn">Delete</button>';
                            echo '<button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" edit-id="' . $rows['user_id'] . '">Edit</button>';
                            
                            
                            endif;
                            echo '</form>';

                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "Error: " . mysqli_error($connection);
                    }

                    mysqli_close($connection);
                    ?>

                                      
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
	document.getElementById("search1").addEventListener("keyup", function() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search1");
  filter = input.value.toUpperCase();
  table = document.getElementById("datatablesSimple");
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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
