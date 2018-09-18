<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "id"        => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "birthdate"       => $_POST['birthdate'],
        "password" => $_POST['password'],
      "address"  => $_POST['address'],
        "zipcode" => $_POST['zipcode']
    ];

    $sql = "UPDATE customers 
            SET id = :id, 
              firstname = :firstname, 
              lastname = :lastname, 
              email = :email, 
              birthdate = :birthdate, 
              password = :password,
              address = :address, 
              zipcode = :zipcode
            WHERE id = :id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM customers WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['firstname']); ?> successfully updated.</blockquote>
<?php endif; ?>

<div class="container">
<div class="form-sec">
<form method="post">
    <center><h2><span class="badge badge-primary">Edit Customer</span></h2></center>
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <br>
    <button type="submit" class="btn btn-success" name="submit" value="Submit">Update Customer</button>
</form>
</div>
</div>
<br><br>
<style>
    .form-sec{width:100%; background: #90b3cc; padding:20px;
        background: rgba(245, 243, 250, 0.65);padding: 20px;box-shadow: 0 0 4px #90b3cc;}
</style>


<?php require "templates/footer.php"; ?>
