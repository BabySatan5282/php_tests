<?php include_once "include/header.php"; ?>
<a href="index.php" class="btn btn-sm btn-dark mt-2 mb-2">Back</a>
<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Enter User Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Choose Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <input type="submit" value="Create" class="btn btn-sm btn-warning mt-2 mb-2">

        </form>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // print_r($_FILES);
    $name = $_POST['name'];
    $imgName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $path = "images/" . $imgName;

    move_uploaded_file($tmpName, $path);

    $query = "insert into crud(name,image) values (?,?)";

    $res = $pdo->prepare($query);
    $res->execute([$name, $imgName]);

    header("Location:index.php?create=success");
}
?>


<?php include_once "include/footer.php"; ?>