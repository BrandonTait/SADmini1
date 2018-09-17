<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
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

  <h2>Add a user</h2>
<style>
    .form-sec{width:100%; background: #90b3cc; padding:15px;
        background: rgba(245, 243, 250, 0.65);padding: 15px;box-shadow: 0 0 4px #90b3cc;}
</style>
<div class="container">

    <div class="form-sec">
        <h4>Contact form</h4>

        <form name="qryform" id="qryform" method="post" action="mail.php" onsubmit="return(validate());" novalidate="novalidate">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" id="name" placeholder="Enter Email" name="email">
            </div>

            <div class="form-group">
                <label>Phone No.:</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter Phone no." name="phone">
            </div>
            <div class="form-group">
                <label>Subject:</label>
                <input type="text" class="form-control" id="name" placeholder="Subject" name="subject">
            </div>

            <div class="form-group">
                <label>Issues/query:</label>
                <textarea name="issues" class="form-control" id="iq" placeholder="Enter your Issues/query"></textarea>
            </div>


            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>


</div>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    <input type="submit" name="submit" value="Submit">
  </form>



  <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
