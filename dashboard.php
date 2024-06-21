<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<h2>Welcome, <?php echo $user['first_name']; ?></h2>
<p>First Name: <?php echo $user['first_name']; ?></p>
<p>Last Name: <?php echo $user['last_name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<p>Profile Image: <img src="<?php echo $user['profile_image']; ?>" width="100"></p>
<a href="update.php">Update Profile</a>

<?php include 'footer.php'; ?>
