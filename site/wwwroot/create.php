<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php"; /Users/brando/Downloads/pdo-master/config.php
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
        "birthdate" =>$_POST['birthdate'],
        "password"=>$_POST['password'],
        "address"=>$_POST['address'],
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "customers",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['firstname']); ?> successfully added.</blockquote>
  <?php endif; ?>

  <br>
<style>
    .form-sec{width:100%; background: #90b3cc; padding:20px;
        background: rgba(245, 243, 250, 0.65);padding: 20px;box-shadow: 0 0 4px #90b3cc;}
</style>
<div class="container">
    <div class="form-sec">
        <center><h2><span class="badge badge-primary">Add New Customer</span></h2></center>

        <form name="qryform" id="qryform" method="post">
            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname">
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
            </div>
            <div class="form-group">
                <label>Birthdate:</label>
                <input type="date" class="form-control" id="birthdate" placeholder="Enter Birthdate" name="birthdate">
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
        </form>
    </div>


</div>

<?php require "templates/footer.php"; ?>
