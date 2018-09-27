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
            "ord_id"  => $_POST['ord_id'],
            "tran_amt" =>$_POST['tran_amt'],
            "tran_type"=>$_POST['tran_type'],
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "transaction",
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
    <blockquote>Transaction successfully processed.</blockquote>
<?php endif; ?>

<br>
<style>
    .form-sec{width:100%; background: #90b3cc; padding:20px;
        background: rgba(245, 243, 250, 0.65);padding: 20px;box-shadow: 0 0 4px #90b3cc;}
</style>
<div class="container">
    <div class="form-sec">
        <center><h2><span class="badge badge-primary">Make a Payment</span></h2></center>

        <form name="qryform" id="qryform" method="post">
            <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
            <div class="form-group">
                <label>Order ID:</label>
                <input class="form-control" id="ord_id" placeholder="Enter Product ID" name="ord_id">
            </div>
            <div class="form-group">
                <label>Amount:</label>
                <input type="text" class="form-control" id="tran_amt" placeholder="Enter Order Quantity" name="tran_amt">
            </div>
            <div class="form-group">
                <label>Pay Type:</label>
                <input type="text" class="form-control" id="tran_type" placeholder="Enter Order Balance" name="tran_type">
            </div>
            <form type="post">
                <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button" value="submit"
                        data-key="pk_test_TYooMQauvdEDq54NiTphI7jx"
                        data-amount=""
                        data-name="Giardini Art"
                        data-description="Credit Payment"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-locale="auto"
                        data-zip-code="true">
                </script>
            </form>
        </form>
    </div>

</div>


<?php require "templates/footer.php"; ?>
