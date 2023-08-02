<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        body {
            font-family: 'lato', sans-serif;
            margin: 0;
            padding: 0;
        }
        /* Content styling */
        .container {
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 10px;
            padding-right: 10px;
        }

        .page-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: justify; /* Add this property to justify the content */
        }

    </style>
</head>

<body>
    <!-- Content Section -->
    <section class="page-section">
        <div class="container">
            <h2>About ous</h2>
            <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>
            <br><br>
            <h2>Agreement policy</h2>
            <p>By using this website <b> ( Bid.it ) </b> we assume that,He/She user has fullfilly & wholeheartedly accepted our Agreement policy and premit to future manipulation of the Data given by the user,And agree that ( Bid.it ) or ( srivarshan.org ) are not responsible for the future discomfortness & responsible in terms of making fault payments or misleading customer or seller behaviour.In terms on any misleading activities like handing the stock without making any kind of payment the person He/She who had won the auction should pay the fine amount to the seller ( fine amount same as the highest Bidding amount ) plus extra charges ₹1000 for misleading the the site Agreement policy.</p>
        </div>
    </section>
</body>

</html>
