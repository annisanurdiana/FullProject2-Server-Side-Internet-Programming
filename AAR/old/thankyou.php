<?php 
session_start();
if (!isset($_SESSION["signedup"])) {
    header("Location: ../AAR/login.php");
    exit();
}

session_unset();
session_destroy();

include("../AAR/header.php"); 

?>
<title>Thank you for signing up to Recol!</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>

<body>

    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <h1 class="display-3" style="font-family: 'Alfa Slab One';">Thanks for signing up!</h1>
            <p class="lead">You can now login to your Recol account.</p>
            <a href="../AAR/login.php" class="btn btn-primary">Go to login >></a>
        </div>
    </div>

    <?php include("../AAR/footer.php"); ?>