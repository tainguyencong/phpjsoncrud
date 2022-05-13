<?php

session_start();
            
if(!$_SESSION['user']) {
    header("location: login.php");
}
include './class.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <span>Xin chào <?= $_SESSION['user']['fullname']; ?><img src="./upload/<?= $_SESSION['user']['avatar']; ?>" alt="" width="100px"></span>
   <a class="btn btn-danger" href="logout.php">Logout</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">fullname</th>
                <th scope="col">username</th>
                <th scope="col">gender</th>
                <th scope="col">email</th>
                <th scope="col">avatar</th>
                <th scope="col">phone</th>
                <th scope="col">address</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $value) { ?>
                <tr>
                    <td><?= $value['id']; ?></td>
                    <td><?= $value['fullname']; ?></td>
                    <td><?= $value['username']; ?></td>
                    <td><?= $value['gender']; ?></td>
                    <td><?= $value['email']; ?></td>
                    <td><img src="./upload/<?= $value['avatar']; ?>" alt="" width="100px"></td>
                    <td><?= $value['phone']; ?></td>
                    <td><?= $value['address']; ?></td>
                    <td>
                        <a class="btn btn-danger" href="delete.php?id=<?= $value['id'] ?>">Delete</a>
                        <a class="btn btn-warning" href="edit.php?id=<?= $value['id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
    <a class="btn btn-primary" href="add.php">Add</a>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>