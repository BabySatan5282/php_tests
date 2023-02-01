<?php
include_once "include/header.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $query = "select * from crud where id=?";
    $res =  $pdo->prepare($query);
    $res->execute([$id]);
    $data = $res->fetch(PDO::FETCH_ASSOC);
}

?>
<a href="index.php" class="btn btn-sm btn-dark mt-2 mb-2">Back</a>
<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Enter User Name</label>
                <input type="text" value="<?php echo $data["name"] ?>" name="name" class="form-control">
            </div>
            <div class="form-group mt-3 mb-3">
                <img src="<?php echo "images/" . $data["image"] ?>" height="80px" width="100px" style="border-radius: 5%" alt="">
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
include_once "include/footer.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    if ($_FILES["image"]['name'] != "") {
        $imgName = $_FILES["image"]["name"];
        $tmpName = $_FILES["image"]["tmp_name"];
        $path = "images/" . $imgName;
        move_uploaded_file($tmpName, $path);
    } else {
        $imgName = $data["image"];
    }

    $sql = "update crud set name=?,image=? where id=?";
    $res = $pdo->prepare($sql);
    $res->execute([$name, $imgName, $id]);

    header("Location:index.php?update=success");
}

?>