<?php include_once "include/header.php"; ?>
<a href="create.php" class="btn btn-sm btn-outline-secondary mt-2 mb-2">Insert</a>

<!-- For Create  -->
<?php
if (isset($_GET["create"])) {
?>
    <div class="alert alert-success">Created Success</div>
<?php
}
?>

<!-- For Delete  -->
<?php
if (isset($_GET["delete"])) {
?>
    <div class="alert alert-success">Delete Success</div>
<?php
}
?>

<!-- For Delete  -->
<?php
if (isset($_GET["update"])) {
?>
    <div class="alert alert-success">Update Success</div>
<?php
}
?>


<table class="table table-striped">
    <tr>
        <td>No</td>
        <td>Image</td>
        <td>Name</td>
        <td>Options</td>
    </tr>
    <?php
    $query = "select * from crud";
    $data = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);


    foreach ($data as $k => $d) {


    ?>
        <tr>
            <td><?php echo ++$k ?></td>
            <td><?php echo $d['name'] ?></td>
            <td>
                <img src="<?php echo "images/" . $d["image"] ?>" height="100px" width="100px" style="border-radius: 5%" alt="">
            </td>
            <td>
                <a href="update.php?id= <?php echo $d["id"] ?>" class="btn btn-sm btn-warning">Update</a>
                <a href="delete.php?id= <?php echo $d["id"] ?>" class="btn btn-sm btn-danger">Delete</a>

            </td>
        </tr>

    <?php

    }
    ?>

</table>

<?php include_once "include/footer.php"; ?>