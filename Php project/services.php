<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-weight: bold;
        }

        .row.flex-align {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        }

        .col-md-4 {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div style="margin-bottom: 100px;">
        <?php include('header_seller.php') ?>
    </div>

    <div class="row flex-align">
        <!-- Card 1 -->
        <div class="col-md-4 mb-4 d-flex">
            <div class="card w-100">
                <img src="e-scrap1.jpg" class="card-img-top" alt="Card image 1">
                <div class="card-body">
                    <div>
                        <div class="card-title">E-Scrap</div>
                        <p class="card-text">E-scrap refers to discarded electronic devices and components that are no longer in use, functional, or wanted. It includes a wide variety of electronic waste such as:
                            Old computers, laptops, and servers
                            Mobile phones, tablets, and accessories
                            Televisions and monitors
                        </p>
                    </div>
                    <a href="E-scrap.php" class="btn btn-success mt-3">Inquiry</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4 mb-4 d-flex">
            <div class="card w-100">
                <img src="scrap-metal.jpg" class="card-img-top" alt="Card image 2">
                <div class="card-body">
                    <div>
                        <div class="card-title">Metal</div>
                        <p class="card-text">Metal scrap refers to discarded metal materials and products that are no longer useful in their current form but can be recycled and reused. It is generated from industries, construction, manufacturing, demolition, and household waste.</p>
                    </div>
                    <a href="metal.php" class="btn btn-success mt-3">Inquiry</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 mb-4 d-flex">
            <div class="card w-100">
                <img src="contruction.jpg" class="card-img-top" alt="Card image 3">
                <div class="card-body">
                    <div>
                        <div class="card-title">Construction Scrap</div>
                        <p class="card-text">The construction waste poses great danger to environment. This has put construction industries under pressure to consider suitable methods to protect the environment across all industries including construction.</p>
                    </div>
                    <a href="construction.php" class="btn btn-success mt-3">Inquiry</a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-4 mb-4 d-flex">
            <div class="card w-100">
                <img src="office.jpg" class="card-img-top" alt="Card image 4">
                <div class="card-body">
                    <div>
                        <div class="card-title">Office Scrap</div>
                        <p class="card-text">Every office generates scrap assets over time, from outdated equipment to damaged furniture. Recycling or disposing of these assets responsibly is crucial for maintaining a clutter-free workspace.</p>
                    </div>
                    <a href="office.php" class="btn btn-success mt-3">Inquiry</a>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-md-4 mb-4 d-flex">
            <div class="card w-100">
                <img src="plastic.jpg" class="card-img-top" alt="Card image 5">
                <div class="card-body">
                    <div>
                        <div class="card-title">Plastic</div>
                        <p class="card-text">Plastic scrap, a ubiquitous term in today’s waste management discourse, encapsulates the diverse array of discarded plastic materials. From household items to industrial leftovers, plastic scrap constitutes a significant portion of global waste.</p>
                    </div>
                    <a href="plastic.php" class="btn btn-success mt-3">Inquiry</a>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-md-4 mb-4 d-flex">
            <div class="card w-100">
                <img src="cable.jpg" class="card-img-top" alt="Card image 6">
                <div class="card-body">
                    <div>
                        <div class="card-title">Cable Scrap</div>
                        <p class="card-text">Cable scrap is a valuable resource in the recycling industry, known for its high demand and lucrative market. As one of the most efficient conductors of electricity, copper is widely used in electrical cables, making copper cable scrap a key material for recycling.</p>
                    </div>
                    <a href="cable.php" class="btn btn-success mt-3">Inquiry</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <?php include('footer.php') ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
