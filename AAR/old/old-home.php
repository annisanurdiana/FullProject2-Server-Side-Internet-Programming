<?php 
    session_start(); 
    require("../AAR/config.php");
    if (!isset($_SESSION["username"])) {
        header("Location: ../AAR/login.php");
        exit();
    }

    if (isset($_POST["delete"])) {
        $del = $_POST["delete"];
        query("DELETE FROM recipe WHERE id = $del");
    }

    $username = $_SESSION['username'];

    $recipes = retrieve("SELECT id, name, description, uploader, photoloc
                        FROM recipe WHERE uploader = '$username' ORDER BY name");
?>

<?php include("header.php"); ?>
<title><?= $username ?>'s Recol</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<body id="home-body">

    <div class="container-fluid">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">



            <a class="navbar-brand" href="#">Recol</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#my-navbar">
                <span class=" navbar-toggler-icon"></span>
            </button>





            <div class="collapse navbar-collapse" id="my-navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#date" class="nav-link active" id="date"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="username" data-toggle="dropdown">
                            <?= $username; ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#">About Recol</a>
                            <div class="dropdown-divider"></div>
                            <form action="../AAR/login.php" method=post>
                                <button type="submit" name="logout" class="btn btn-md btn-link w-100 text-left"
                                    style="color: red">Log out</button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">My Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../AAR/browse.php">Browse</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid mysearchbar">
        <div class="row m-0">
            <div class="col-12 text-center">
                <h1 style="color: white">
                    <?php echo ($username . "'s Collection"); ?>
                </h1>
            </div>

            <div class="col-lg-4 col-sm-2"></div>
            <div class="col-lg-6 col-sm-8 px-0">
                <form class="form-inline">
                    <input class="form-control mr-2 w-50" type="search" placeholder="Search collection..."
                        aria-label="Search" id="search-input">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search <i
                            class="fas fa-carrot"></i></button>
                </form>
            </div>

            <button class="btn btn-dark ml-3 px-3 py-0" style="font-size: 2rem; border-radius: 50%" title="Add dish..."
                data-toggle="modal" data-target="#addDish">+</button>
            <?php include("../AAR/create-recipe.php"); ?>
        </div>

        <div class="row">
            <div class="col-12 text-center">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row" id="recipe-cards">

            <!-- Ajax loaded content from recipecards.php -->
        </div>

    </div>
    <div class="modal fade" id="dish-content" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" id="modal-content">
                
                <!-- Ajax loaded content from getrecipe.php -->
            </div>
        </div>
    </div>

    <script src="../AAR/home.js" type="text/javascript"></script>

    <?php include("footer.php"); ?>