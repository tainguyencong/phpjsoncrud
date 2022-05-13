<?php
session_start();
            
if(!$_SESSION['user']) {
    header("location: login.php");
}
include_once './class.php';

$err = [];

if (isset($_POST['status']) && $_POST['status'] == 'add') {
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



        // nhận file name
        $new_avatar = $_FILES['file']['name'];
        // nhận tmp name
        $tmp_name = $_FILES['file']['tmp_name'];
        // đẩy file vào upload
        move_uploaded_file($tmp_name, "upload/$new_avatar");
    } else {
        // nếu không chọn file thì avatar là rỗng
        $new_avatar = '';
    }
}
// kiem tra ton tai du lieu nhap form
if (isset($new_fullname) && isset($new_username) && isset($new_email) && isset($new_password) && isset($new_phone) && isset($new_address) && isset($new_gender)) {
    // khoi tao mảng ids để chứa các id
    $ids = [];

    // lặp qua các id để đẩy vào trong $ids
    foreach ($user->id as $key => $value) {
        array_push($ids, $value);
    }

    // bay gio ids co du lieu


    // lưu trữ dữ liệu trêm form vào các biến
    $new_id = max($ids) + 1;


    // kiểm tra có upload file hay không

    // thêm dữ liệu vào json
    $user->add( $new_id, $new_fullname, $new_username, $new_password, $new_gender, $new_email, $new_phone, $new_avatar, $new_address );

    // chuyển trang
    header('location: ./users.php');
    
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<div class="container">
      <div class="row">
          
        <div class="col-md-7">
        <h1>Add</h1>
        <a class="btn btn-info" href="./users.php">Back</a>
          <form
            action=""
            method="post"
            enctype="multipart/form-data"
          >
          <input type="hidden" name="status" value="add">
            <div class="form-group">
              <label for="fullname">Fullname</label>
              <input
                type="text"
                class="form-control"
                id="fullname"
                name="fullname"
                aria-describedby=""
                placeholder=""
                value=""
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
                value=""
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
                value=""
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
                value=""
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
                value=""
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
                value=""
              />
              <small id="" class="form-text text-danger"
                ><?= array_key_exists('address', $err) ? $err['address'] : '' ;?></small
              >
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" checked id=""
              value="1">
              <label class="form-check-label" for=""> Nam </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id=""
              value="2">
              <label class="form-check-label" for=""> Nữ </label>
            </div>
            <div class="form-group">
              <label for="">Ảnh đại diện</label>
              <input type="file" class="form-control-file" id="" name="file" accept="image/*" />
            </div>
            <button type="submit" class="btn btn-info">Add</button>
          </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>