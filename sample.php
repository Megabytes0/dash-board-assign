<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Member</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="edit.php" method="POST">
                                                <input type="hidden" name="id" id="memberId">
                                                <div class="form-group">
                                                    <label for="memberFirstName">First Name</label>
                                                    <input type="text" class="form-control" id="memberFirstName" name="fname">
                                                </div>
                                                <div class="form-group">
                                                    <label for="memberLastName">Last Name</label>
                                                    <input type="text" class="form-control" id="memberLastName" name="lname">
                                                </div>
                                                <div class="form-group">
                                                    <label for="memberAge">Age</label>
                                                    <input type="number" class="form-control" id="memberAge" name="age">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <tr>
                        <th>First Name</th>
                        <th>Lastname</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
               
                <tbody>
                    <?php
                    // Assume connection to database 'finaloutput'
                    $connection = mysqli_connect("localhost", "root", "", "finaloutput");
                    if (!$connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = mysqli_query($connection, "SELECT * FROM members");
                    if ($query) {
                        while ($rows = mysqli_fetch_assoc($query)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($rows['fname']) . '</td>';
                            echo '<td>' . htmlspecialchars($rows['lname']) . '</td>';
                            echo '<td>' . htmlspecialchars($rows['age']) . '</td>';
                            echo '<td>
                                  <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . $rows['id'] . '" data-fname="' . $rows['fname'] . '" data-lname="' . $rows['lname'] . '" data-age="' . $rows['age'] . '">Edit</button>
                                  <form action="delete.php" method="POST" style="display:inline-block" onsubmit="return confirm(\'Are you sure?\')">
                                      <input type="hidden" name="id" value="' . $rows['id'] . '"/>
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                  </form>
                                  </td>';
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

    <!-- Load necessary scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/umd/simple-datatables.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const datatablesSimple = document.getElementById('datatablesSimple');
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var fname = $(this).data('fname');
                var lname = $(this).data('lname');
                var age = $(this).data('age');

                $('#memberId').val(id);
                $('#memberFirstName').val(fname);
                $('#memberLastName').val(lname);
                $('#memberAge').val(age);

                $('#editModal').modal('show');
            });
        });
    </script>
</body>

</html>