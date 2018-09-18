<?php

/**
 * Delete a user
 */

require "../config.php";
require "../common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_GET["id"];

    $sql = "DELETE FROM customers WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM customers";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>All Customers</h2>


<?php if ($success) echo $success; ?>
<!-- Search Bar -->
    <style>
        #myInput {
            background-image: url('/css/searchicon.png'); /* Add a search icon to input */
            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 30%; /* Full-width */
            font-size: 14px; /* Increase font-size */
            padding: 6px 6px 6px 6px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
            margin-right: 35px;
            float: right;
        }

        #myTable {
            border-collapse: collapse; /* Collapse borders */
            width: 95%; /* Full-width */
            border: 1px solid #ddd; /* Add a grey border */
            font-size: 16px; /* Increase font-size */
        }

        #myTable th, #myTable td {
            text-align: left; /* Left-align text */
            padding: 6px; /* Add padding */
        }

        #myTable tr {
            /* Add a bottom border to all table rows */
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header, #myTable tr:hover {
            /* Add a grey background color to the table header and on hover */
            background-color: #f1f1f1;
        }
    </style>
        <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <center><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."></center>

<!-- Search Bar -->
<center>
<table class = "table table-striped table-hover table-sm" id="myTable">
  <thead>
    <tr>
      <th>#</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email Address</th>
      <th>Birthday</th>
      <th>Address</th>
      <th>Zipcode</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["id"]); ?></td>
      <td><?php echo escape($row["firstname"]); ?></td>
      <td><?php echo escape($row["lastname"]); ?></td>
      <td><?php echo escape($row["email"]); ?></td>
      <td><?php echo escape($row["birthdate"]); ?></td>
      <td><?php echo escape($row["address"]); ?></td>
      <td><?php echo escape($row["zipcode"]); ?> </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</center>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>