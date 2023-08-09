<!DOCTYPE html>
<html lang="en">

<head>
    <title>cart</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
    .button {
        width: 100%;
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .button:hover {
        background-color: #0056b3;
    }
    </style>
</head>


<body>

    <?php
$sessionId = $_SESSION['login_id'];
$conns = new mysqli('localhost', 'root', '', 'kk') or die("Could not connect to mysql" . mysqli_error($con));
$query = "SELECT * FROM bids WHERE user_id = '$sessionId'";
$result = $conns->query($query);
if ($result->num_rows > 0) {
?>
    <div class="col-md-12">
        <table>
            <?php
 while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $product_id = $row['product_id'];
    $bit_amount = $row['bid_amount'];
    $status = $row['status'];
    $date_created = $row['date_created'];
    $queryForProdcut = "SELECT * FROM products WHERE id = '$product_id'";
    $resultForProduct = $conns->query($queryForProdcut);
    while($row1 = $resultForProduct->fetch_assoc()) {
        $contact = $row1['contact'];
        $address = $row1['address'];
        $name = $row1['name'];
        $description = $row1['description'];
        $regularPrice = $row1['regular_price'];
        $image = $row1['img_fname'];
        $endDate = $row1['bid_end_datetime'];

        $sellerMobile = $row1['contact'];
        $userName = $row1['username'];
        $address = $row1['address'];


        $today = new DateTime();
        $targetDate = new DateTime($endDate);


        $statusText = "";

        if  ($status == 2) {
            $statusText = "Conformed";
        }else{
            $statusText = "pending";
        }

            ?>
            <th>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card" style="height: 15cm; width: 6.5cm;">
                                <div class="float-right align-top bid-tag">
                                    <span class="badge badge-pill badge-primary text-white"><i class="fa fa-tag"></i>
                                        <?php echo number_format($bit_amount) ?></span>
                                </div>
                                <img class="card-img-top" src="admin/assets/uploads/<?php echo $image ?>"
                                    alt="Card image cap">
                                <div class="float-right align-top d-flex">


                                    <span class="badge badge-success"
                                        style="width: 6.5cm;  height: .55cm;  text-align: center; margin-top:5px;"><?php echo $statusText ?></span>
                                </div>
                                <div class="card-body prod-item">
                                    <p><?php echo $name ?></p>
                                    <p class="truncate"><?php echo $description ?></p>
                                    <p class="truncate">Seller name : <?php echo $userName ?></p>
                                    <p class="truncate">Seller Address : <?php echo $address ?></p>
                                    <p class="truncate">Seller Mobile : <?php echo $sellerMobile ?></p>

                                    <form method="post" action="">
                                        <button class="button pay-button" type="submit" name="payButton"
                                            data-target="payment.html">Pay Now</button>
                                        <!-- Add more buttons with different data-target attributes -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </th>
            <?php
    } 
}

?><?php
  } else {
    echo "Invalid credentials. Please try again.";
  }

$conns->close();
?>
        </table>
    </div>
    <script>
    var payButtons = document.querySelectorAll('.pay-button');
    payButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var targetUrl = button.getAttribute('data-target');
            window.open(targetUrl, '_blank');
        });
    });
    </script>
</body>

</html>