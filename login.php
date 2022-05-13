<?php
include 'class.php';
$users = $user->fetch();

if (isset($_POST['username']) && $_POST['username'] != '')
{
    foreach ($users as $value)
    {
        if ($value['username'] == $_POST['username'] && $value['password'] == md5($_POST['password']))
        {   
            $user = search( $users, 'username', $value['username'] );
            session_start();
            $_SESSION['user'] = $user[0];
            header("location: users.php ");
        }
    }
} ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <title>Login</title>
  </head>

  <body>
    <div id="wrapper">
      <div class="container">
        <div class="row justify-content-around mt-5">
          <form
            action=""
            method="post"
            class="col-7 bg-light p-4 my-5 rounded-3"
          >
          <h1 class="text-center">Login</h1>
            <div class="form-group">
              <label for="username">User name</label>
              <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                aria-describedby="emailHelp"
                placeholder="User name"
              />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
            <input
              type="submit"
              name="submit"
              class="btn btn-primary"
              value="Login"
            />
          </form>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
