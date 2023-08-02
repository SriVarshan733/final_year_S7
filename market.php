<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price List</title>
    <style>
        /* Table styling */
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
        }

        .responsive-table {
            list-style: none;
            padding: 0;
        }

        .table-header {
            background-color: #95A5A6;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            display: flex;
            justify-content: space-between;
            border-radius: 3px;
            padding: 25px 30px;
            margin-bottom: 25px;
        }

        .table-row {
            background-color: #ffffff;
            box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .col-1 {
            flex-basis: 10%;
        }

        .col-2 {
            flex-basis: 40%;
        }

        .col-3 {
            flex-basis: 25%;
        }

        .col-4 {
            flex-basis: 25%;
        }

        @media all and (max-width: 767px) {
            .table-header {
                display: none;
            }

            .table-row {
                flex-wrap: wrap;
            }

            .col-1,
            .col-2,
            .col-3,
            .col-4 {
                flex-basis: 100%;
            }

            .col-1::before,
            .col-2::before,
            .col-3::before,
            .col-4::before {
                color: #6C7A89;
                padding-right: 10px;
                content: attr(data-label);
                flex-basis: 50%;
                text-align: right;
            }
        }
    </style>
</head>

<body>
    <!-- Price List Section -->
    <section class="page-section">
        <div class="container">
            <h2>Price List</h2>
            <ul class="responsive-table" id="marketTable">
                <li class="table-header">
                    <div class="col col-1">S.No</div>
                    <div class="col col-2">Product Name</div>
                    <div class="col col-3">Product Price</div>
                    <div class="col col-4">Expected Date</div>
                </li>
            </ul>
            <h8 style="color:red;">*Please note that above shown content in the table is just a prediction made by our team</h8>
        </div>

        <script>
            // Replace this URL with the actual URL of your JSON file
            const jsonUrl = "https://api-bid.pages.dev/api.json";

            // Fetch JSON data from the URL
            fetch(jsonUrl)
                .then(response => response.json())
                .then(data => {
                    const table = document.getElementById("marketTable");
                    let serialNumber = 1; // Initialize serial number

                    // Loop through the JSON data and create rows for the table
                    data.forEach(product => {
                        const row = document.createElement("li");
                        row.classList.add("table-row");

                        const snoCell = document.createElement("div");
                        snoCell.classList.add("col", "col-1");
                        snoCell.setAttribute("data-label", "S.No");
                        snoCell.textContent = serialNumber;

                        const nameCell = document.createElement("div");
                        nameCell.classList.add("col", "col-2");
                        nameCell.setAttribute("data-label", "Product Name");
                        nameCell.textContent = product.name;

                        const priceCell = document.createElement("div");
                        priceCell.classList.add("col", "col-3");
                        priceCell.setAttribute("data-label", "Product Price");
                        priceCell.textContent = product.price;

                        const dateCell = document.createElement("div");
                        dateCell.classList.add("col", "col-4");
                        dateCell.setAttribute("data-label", "Expected Date");
                        dateCell.textContent = product.date;

                        row.appendChild(snoCell);
                        row.appendChild(nameCell);
                        row.appendChild(priceCell);
                        row.appendChild(dateCell);

                        table.appendChild(row);

                        // Increment the serial number for the next product
                        serialNumber++;
                    });
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                });
        </script>
    </section>
</body>

</html>


    </section>

