

<?php
include '../dbconnect.php';
session_start();

// Fetch the admin's name from the database based on the stored user ID
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $admin_query = mysqli_query($conn, "SELECT * FROM users_table WHERE id = '$user_id'");
    $adminData = mysqli_fetch_assoc($admin_query);

    // Store the admin's name in a session variable
    $_SESSION['admin_name'] = $adminData['name'];

    $select = mysqli_query($conn, "SELECT * FROM `form` LIMIT 5") or die('query failed');
} else {
    echo "User ID is not set";
    header('location: admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/18e31dbed1.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Main Dashboard -->
    <section id="dashboard">
        <div class="left-dash-sec section-p1">
            <h2>Welcome To Admin Dashboard <?php echo $adminData['name']?></h2>
            <div class="recent-order">
                <div class="order-head">
                    <h3>Recent Customers</h3>
                    <button onclick="customerDetails.php">View All</button>
                </div>
                    <!-- Display data in a table -->
                <div class="container">
                    <!-- Display data in a table -->
                    <table class="user-table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Phone</th>
                        
                        
                            <th>Action</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($select)) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['password'] . '</td>';
                        
                            echo '<td>' . $row['phone'] . '</td>';
                        
                        
                            echo '<td><a href="../updateCustomer.php?id=' . $row['id'] . '">Update</a> | <a href="deleteCustomer.php?id=' . $row['id'] . '">Remove</a></td>';
                            echo '</tr>';
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="right-dash-sec">
            <div class="sidebar">
                <figure>
                    <img src="./img/people/upw.jpg" alt="admin">
                    <figcaption><?php echo $_SESSION['admin_name']; ?></figcaption>
                </figure>
                
                <nav>
                    <ul>
                        <li><a class="active" href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="manageProducts.php"><i class="fas fa-box-open"></i> Product Management</a></li>
                        <li><a href="addProduct.php"><i class="fas fa-tags"></i>Add Products</a></li>
                        <li><a href="#"><i class="fas fa-shopping-cart"></i> Order Management</a></li>
                        <li><a href="#"><i class="fas fa-credit-card"></i> Payment Option Management</a></li>
                        <li><a href="#"><i class="fas fa-file"></i> Page Management</a></li>
                        <li><a href="manageCustomer.php"><i class="fas fa-users"></i> Customer Management</a></li>
                    </ul>
                </nav>
                <div class="setting"> 
                    <a><i class="fa-solid fa-gear"></i>Setting</a>
                    <a href="adminLogout.php"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>