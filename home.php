<?php 
include 'header.php'; 
include 'db.php'; 

// Pagination logic
$limit = 1;  // Number of entries to show in a page.
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start_from = ($page-1) * $limit; 

$sql = "SELECT * FROM users LIMIT $start_from, $limit";
$result = $conn->query($sql);

// Count total records
$sql_total = "SELECT COUNT(*) FROM users";
$result_total = $conn->query($sql_total);
$total_records = $result_total->fetch_array()[0];
$total_pages = ceil($total_records / $limit);
?>

<div class="container">
<nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
          <a class="page-link" href="<?php if($page > 1){ echo "?page=".($page - 1); } ?>">Previous</a>
        </li>
        <?php for($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?php if($page == $i){ echo 'active'; } ?>">
            <a class="page-link" href="home.php?page=<?php echo  $i ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
          <a class="page-link" href="<?php if($page < $total_pages){ echo "?page=".($page + 1); } ?>">Next</a>
        </li>
      </ul>
    </nav>
    <h2>User List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Profile Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><img src="<?php echo $row['profile_image']; ?>" width="100"></td>
                    <td><a href="update.php?id=<?php echo $row['id']; ?>">Update Profile</a></td>
                </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='5'>No users found.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    
</div>

<?php include 'footer.php'; ?>
