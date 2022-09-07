<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';

$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$showalrt = false;
if (isset($_POST['submit'])) {
    $name = $_POST["p_name"];
    $img = $_FILES["uploadfile"]["name"];
    $temp = $_FILES["uploadfile"]["tmp_name"];
    $folder = 'C:\xampp\htdocs\upload_file\image'.$img;
    move_uploaded_file($temp, $folder);
    
    $sql = "INSERT INTO `next`(`img`, `name`) VALUES ('$img','$name')";

    if (mysqli_query($conn, $sql)) {
        $showalrt = true;
    } else {
        $showalrt = false;
    }

}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Upload and show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand">Navbar</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    if ($showalrt) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successful!</strong> Your Coustom Design oder is placed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" name="uploadfile" id="formFile">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="p_name" id="p_name">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="show.php"><button type="button" class="btn btn-outline-success mt-3">Show All input Images</button></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>