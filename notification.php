<html>

<head>
    <title>Notification</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
    /**
 * Don't need this because
 * .woff is not accessible from cross domain
 */
    @font-face {
        font-family: 'atvice';
        src: url('https://github.com/Flat-Pixels/Notifications-card-animation/raw/master/fonts/atvice-webfont.woff') format('woff2'),
            url('https://github.com/Flat-Pixels/Notifications-card-animation/raw/master/fonts/atvice-webfont.woff2') format('woff');
        font-weight: normal;
        font-style: normal;
    }


    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
    }



    .wrapper {
        width: 580px;
        margin: 50px auto;
    }


    .notifications__item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 205px;
        margin-bottom: 20px;
        padding: 0 20px;

        background-color: white;
        border-radius: 5px;
        box-shadow: 0px 15px 20px 0px rgb(0, 0, 0, .2);

        transition: all .3s ease-in;
        cursor: pointer;
    }

    .notifications__item__avatar {
        width: 75px;
        height: 75px;
        overflow: hidden;
        margin-right: 20px;

        border-radius: 50%;
    }

    .notifications__item__avatar img {
        width: 100%;
        height: 100%;
    }

    .notifications__item__content {
        width: calc(100% - 105px);
    }

    .notifications__item__title,
    .notifications__item__message {
        display: block;
    }

    .notifications__item__title {
        letter-spacing: 2px;
        font-family: 'atvice', sans-serif;
        font-size: 17px;
    }

    .notifications__item__message {
        font-family: Roboto, sans-serif;
        font-size: 14px;
        color: #929292;
    }

    .notifications__item__option {
        width: 20px;
        height: 20px;
        margin: 8px 0;

        border-radius: 50%;
        color: white;
        opacity: 0;

        font-size: 10px;
        text-align: center;
        line-height: 20px;

        cursor: pointer;
        transition: all .2s;
    }

    .notifications__item__option.archive {
        background-color: #3dc98c;
    }

    .notifications__item__option.delete {
        background-color: #c93d4d;
    }


    /*
* Animation part
*/
    .notifications__item:hover {
        background-color: #f7f7f7;
        transform: scale(0.95);
        box-shadow: 0px 5px 10px 0px rgb(0, 0, 0, .2);
    }

    .notifications__item:hover .notifications__item__option {
        opacity: 1;
    }

    .notifications__item.archive .notifications__item__title,
    .notifications__item.delete .notifications__item__title {
        color: white;
    }

    .notifications__item.archive .notifications__item__message,
    .notifications__item.delete .notifications__item__message {
        color: #f3f3f3;
    }

    .notifications__item.archive {
        background-color: #3dc98c;
        animation: archiveAnimation 1.5s cubic-bezier(0, 0, 0, 1.12) forwards;
        animation-delay: .6s;
    }

    .notifications__item.delete {
        background-color: #c93d4d;
        animation: deleteAnimation 1.5s cubic-bezier(0, 0, 0, 1.12) forwards;
        animation-delay: .6s;
    }


    @keyframes archiveAnimation {
        to {
            transform: translateX(100px);
            opacity: 0;
        }
    }

    @keyframes deleteAnimation {
        to {
            transform: translateX(-100px);
            opacity: 0;
        }
    }
    </style>

</head>



<body>

    <?php
$sessionId = $_SESSION['login_id'];
$conns = new mysqli('localhost', 'root', '', 'kk') or die("Could not connect to mysql" . mysqli_error($con));

$queryForProdcut = "SELECT * FROM products WHERE seller_authid = '$sessionId'";
$result = $conns->query($queryForProdcut);

if ($result->num_rows > 0) {
    while ($row1 = $result->fetch_assoc()) {
        $description = $row1['description'];
        $regularPrice = $row1['regular_price'];
        $image = $row1['img_fname'];
        $endDate = $row1['bid_end_datetime'];
        $sellerMobile = $row1['contact'];
        $userName = $row1['username'];
        $address = $row1['address'];
        $productName = $row1['name'];
        $buyerId = $row1['buyer_id'];
        $bitAmt = $row1['bid_amt'];
        $querForBuyerProfile = "SELECT * FROM users WHERE id = '$buyerId'";
        $result1 = $conns->query($querForBuyerProfile);

        while ($row2 = $result1->fetch_assoc()) {
            $buyerName = $row2['name']; 
            $buyerEmail = $row2['email']; 
            $buyerAddress = $row2['address']; 
            $buyerMobile = $row2['contact']; 
            ?>

    <div class="wrapper">
        <div class="notifications">
            <div class="notifications__item">
                <div class="notifications__item__avatar">
                    <img src="admin/assets/uploads/<?php echo  $image ?>" />
                </div>

                <div class="notifications__item__content">
                    <span class="notifications__item__title"><?php echo $buyerName   ?></span>
                    <span class="notifications__item__title"><?php echo $buyerEmail   ?></span>

                    <span class="notifications__item__message">Poduct Name : <?php echo $productName   ?></span>
                    <span class="notifications__item__message">Product Description : <?php echo $description   ?></span>

                    <span class="notifications__item__title">Amount : <?php echo $bitAmt   ?></span>

                </div>

                <div>
                    <div class="notifications__item__option archive js-option">
                        <i class="fas fa-folder"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php

        }


     }


}



?>
</body>

</html>