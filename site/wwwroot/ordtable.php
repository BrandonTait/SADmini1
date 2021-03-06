<?php

/**
 */

require "../config.php";
require "../common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_GET["id"];

    $sql = "DELETE FROM orders WHERE ord_id = :ord_id";

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

  $sql = "SELECT * FROM orders";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>



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
            background-color: rgba(45, 125, 246, 0.5);
        }

    </style>
        <script>
        function filterTable(event) {
            var filter = event.target.value.toUpperCase();
            var rows = document.querySelector("#myTable tbody").rows;

            for (var i = 0; i < rows.length; i++) {
                var firstCol = rows[i].cells[0].textContent.toUpperCase();
                var secondCol = rows[i].cells[1].textContent.toUpperCase();
                var thirdCol = rows[i].cells[2].textContent.toUpperCase();
                var fourthCol = rows[i].cells[3].textContent.toUpperCase();
                var fifthCol = rows[i].cells[4].textContent.toUpperCase();
                var sixthCol = rows[i].cells[5].textContent.toUpperCase();

                if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || fourthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1 || sixthCol.indexOf(filter) > -1 ) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        document.querySelector('#myInput').addEventListener('keyup', filterTable, false);
    </script>
    <div class="container-fluid">

            <center><h2><span class="badge badge-primary">All Orders</span></h2></center>
    <center><input type="text" id="myInput" onkeyup="filterTable(event)" placeholder="Search for anything.."></center>

<!-- Search Bar -->

<center>
<table class = "table table-striped table-hover table-sm table-bordered" id="myTable">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Product ID</th>
      <th>Quantity</th>
      <th>Balance</th>
      <th>Ship Address</th>
      <th>Type</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["ord_id"]); ?></td>
      <td><?php echo escape($row["p_id"]); ?></td>
      <td><?php echo escape($row["ord_quant"]); ?></td>
      <td><?php echo escape($row["ord_balance"]); ?></td>
      <td><?php echo escape($row["ord_shipadd"]); ?></td>
      <td><?php echo escape($row["ord_type"]); ?></td>
      <td><center><a class ="btn btn-warning" href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></center></td>
      <td><center><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');" href="custtable.php?id=<?php echo escape($row["id"]); ?>">Delete</a></center></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</center>
        </div>


<?php require "templates/footer.php"; ?>