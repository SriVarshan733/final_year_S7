<!DOCTYPE html>
<html lang="en">
  <head>
    <title>cart</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        ?>

        
           <th>
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-4">
                        <div class="card" style="height: 8.8cm; width: 3.9cm;">
                        <div class="float-right align-top bid-tag">
                                         <span class="badge badge-pill badge-primary text-white"><i class="fa fa-tag"></i> <?php echo number_format($bit_amount) ?></span>
                                     </div>
                                     <img class="card-img-top" src="admin/assets/uploads/<?php echo $image ?>" alt="Card image cap">
                                      <div class="float-right align-top d-flex">
                                         <span style="width: 3.9cm;" class="badge badge-pill badge-warning text-white"><i class="fa fa-hourglass-half"></i> <?php echo $status ?></span>
                                     </div>
                                     <div class="card-body prod-item">
                                         <p><?php echo $name ?></p>
    
                                         <p class="truncate"><?php echo $description ?></p>
                                        
                                     </div>
                                 </div>
                             </div>
                    </div>                
                </div>
                </th>
       

        <?php

    }



   
    
}

?>
 
<?php
  } else {
    echo "Invalid credentials. Please try again.";
  }
  
$conns->close();
?>



</table>
</div>
  </body>
</html>