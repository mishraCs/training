<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    if (!empty($_FILES["profile_image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', profile_image='$target_file' WHERE id='$user_id'";
    } else {
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE id='$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<div class="form_div col-md-4">
    <h2>Update Profile</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input class="form-control" type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required><br>
        <label for="last_name">Last Name:</label>
        <input class="form-control" type="text" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required><br>
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <label for="profile_image">Profile Image:</label>
        <input class="form-control" type="file" id="profile_image" name="profile_image"><br>
        <button class="btn btn-success" type="submit">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
