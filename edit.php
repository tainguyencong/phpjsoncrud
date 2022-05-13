<?php
session_start();

if (!$_SESSION['user'])
{
    header("location: login.php");
}
include 'class.php';

$id = $_GET['id'];

$index = $user->find_index($id);
$users = $user->fetch();

$err = [];

if (isset($_POST['status']) && $_POST['status'] == 'update') {
  if (isset($_POST['fullname']))
{
    if ($_POST['fullname'] == '')
    {
        $err['fullname'] = 'Khong duoc de trong';
    }
    else
    {
        $new_fullname = $_POST['fullname'];
    }

}
if (isset($_POST['username']))
{
    if ($_POST['username'] == '')
    {
        $err['username'] = 'Khong duoc de trong';
    }
    else
    {
        $new_username = $_POST['username'];
    }
}

if (isset($_POST['email']))
{
    if ($_POST['email'] == '')
    {
        $err['email'] = 'Khong duoc de trong';
    }
    else
    {
        $new_email = $_POST['email'];
    }
}
if (isset($_POST['phone']))
{
    if ($_POST['phone'] == '')
    {
        $err['phone'] = 'Khong duoc de trong';
    }
    else
    {
        $new_phone = $_POST['phone'];
    }
}

if (isset($_POST['password']))
{
    if ($_POST['password'] == '')
    {
        $err['password'] = 'Khong duoc de trong';
    }
    else
    {
        $new_password = md5($_POST['password']);
    }
}
if (isset($_POST['address']))
{
    if ($_POST['address'] == '')
    {
        $err['address'] = 'Khong duoc de trong';
    }
    else
    {
        $new_address = $_POST['address'];
    }
}
if (isset($_POST['gender']))
{
    if ($_POST['gender'] == '')
    {
        $err['gender'] = 'Khong duoc de trong';
    }
    else
    {
        $new_gender = $_POST['gender'];
    }
}

if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '')
{

    $new_avatar = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    if (file_exists($users[$index]['avatar']))
    {
        # code...
        unlink($users[$index]['avatar']);
    }

    move_uploaded_file($tmp_name, "upload/$new_avatar");
}
else
{
    $new_avatar = $users[$index]['avatar'];
}

if (isset($new_fullname) && isset($new_username) && isset($new_password) && isset($new_email) && isset($new_phone) && isset($new_address) && isset($new_gender))
{
    $user->update($users, $index, $new_fullname, $new_username,$new_password, $new_email, $new_phone, $new_address, $new_gender, $new_avatar);
    header("location: users.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <form
            action=""
            method="post"
            enctype="multipart/form-data"
          >
          <input type="hidden" name="status" value="update">
            <div class="form-group">
              <label for="fullname">Fullname</label>
              <input
                type="text"
                class="form-control"
                id="fullname"
                name="fullname"
                aria-describedby=""
                placeholder=""
                value="<?= $users[$index]['fullname']; ?>"
              />
              <small id="" class="form-text text-danger"
                ><?= array_key_exists('fullname', $err) ? $err['fullname'] : '' ;?></small
              >
            </div>
            <div class="form-group">
              <label for="username">username</label>
              <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                aria-describedby=""
                placeholder=""
                value="<?= $users[$index]['username'] ?>"
              />
              <small id="" class="form-text text-danger"
                ><?= array_key_exists('username', $err) ? $err['username'] : '' ;?></small
              >
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                aria-describedby=""
                placeholder=""
                value="<?= $users[$index]['password'] ?>"
              />
              <small id="" class="form-text text-danger"
                ><?= array_key_exists('password', $err) ? $err['password'] : '' ;?></small
              >
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                aria-describedby=""
                placeholder=""
                value="<?= $users[$index]['email'] ?>"
              />
              <small id="" class="form-text text-danger"
                ><?= array_key_exists('email', $err) ? $err['email'] : '' ;?></small
              >
            </div>

            <div class="form-group">
              <label for="phone">phone</label>
              <input
                type="text"
                class="form-control"
                id="phone"
                name="phone"
                aria-describedby=""
                placeholder=""
                value="<?= $users[$index]['phone'] ?>"
              />
              <small id="" class="form-text text-danger"
                ><?= array_key_exists('phone', $err) ? $err['phone'] : '' ;?></small
              >
            </div>

            <div class="form-group">
              <label for="address">address</label>
              <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                aria-describedby=""
                placeholder=""
                value="<?= $users[$index]['address'] ?>"
              />
              <small id="" class="form-text text-danger"
                ><?= array_key_exists('address', $err) ? $err['address'] : '' ;?></small
              >
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id=""
              value="1"
              <?= $users[$index]['gender'] == 1 ? 'checked' : '' ?>>
              <label class="form-check-label" for=""> Nam </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id=""
              value="2"
              <?= $users[$index]['gender'] == 2 ? 'checked' : '' ?>>
              <label class="form-check-label" for=""> Nữ </label>
            </div>
            <div class="form-group">
              <label for="">Ảnh đại diện</label>
              <img
                src="./upload/<?= $users[$index]['avatar'] ?>"
                alt=""
                width="100px"
              />
              <input type="file" class="form-control-file" id="" name="file" />
            </div>
            <button type="submit" class="btn btn-info">Update</button>
          </form>
        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
