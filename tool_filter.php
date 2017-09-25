<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tool</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php

if (isset($_POST['account']) && isset($_POST['password'])) {
    if ('admin' == $_POST['account'] && 'admin@1234%' == $_POST['password']) {
        $_SESSION['login'] = true;
    }
}
?>
<?php if (!isset($_SESSION['login'])) : ?>
<form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Account</label>
    <input type="text" class="form-control" name="account">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn btn-primary">login</button>
</form>
<?php endif; ?>
<?php if (!isset($_SESSION['login'])) : ?>
<form>
    <div class="form-group">
        <label for="exampleFormControlFile1">Example file input</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
    </div>
</form>
<?php endif; ?>
</body>
</html>