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
            "p_id"  => $_POST['p_id'],
            "ord_quant"     => $_POST['ord_quant'],
            "ord_balance" =>$_POST['ord_balance'],
            "ord_shipadd"=>$_POST['ord_shipadd'],
            "ord_type"=>$_POST['ord_type'],
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "orders",
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
    <blockquote>Order successfully added.</blockquote>
<?php endif; ?>

<br>
<style>
    .form-sec{width:100%; background: #90b3cc; padding:20px;
        background: rgba(245, 243, 250, 0.65);padding: 20px;box-shadow: 0 0 4px #90b3cc;}
</style>
<div class="container">
    <div class="form-sec">
        <center><h2><span class="badge badge-primary">Add New Order</span></h2></center>

        <form name="qryform" id="qryform" method="post">
            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
            <div class="form-group">
                <label>Product ID:</label>
                <input class="form-control" id="p_id" placeholder="Enter Product ID" name="p_id">
            </div>
            <div class="form-group">
                <label>Order Quantity:</label>
                <input type="text" class="form-control" id="ord_quant" placeholder="Enter Order Quantity" name="ord_quant">
            </div>
            <div class="form-group">
                <label>Balance:</label>
                <input type="text" class="form-control" id="ord_balance" placeholder="Enter Order Balance" name="ord_balance">
            </div>
            <div class="form-group">
                <label>Ship Address:</label>
                <input type="text" class="form-control" id="ord_shipadd" placeholder="Enter Ship Address" name="ord_shipadd">
            </div>
            <div class="form-group">
                <label>Type:</label>
                <input type="text" class="form-control" id="ord_type" placeholder="Enter Order Type" name="ord_type">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
        </form>
    </div>


</div>

<?php require "templates/footer.php"; ?>
