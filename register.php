<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO users (first_name, last_name, email, user_password, profile_image) VALUES ('$first_name', '$last_name', '$email', '$password', '$target_file')";
    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<div class=" header_nav form_div col-md-4">
    <h2>Register Form</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input class="form-control" type="text" id="first_name" name="first_name" required><br>
        <label for="last_name">Last Name:</label>
        <input class="form-control" type="text" id="last_name" name="last_name" required><br>
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br>
        <label for="profile_image">Profile Image:</label>
        <input class="form-control" type="file" id="profile_image" name="profile_image" required><br>
        <button class="btn btn-sucess" type="submit">Register</button>
    </form>
</div>

<?php include 'footer.php'; ?>
