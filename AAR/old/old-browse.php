<?php include("header.php"); ?>

<?php 
    $images = array("carousel1", "carousel2", "carousel3", "login-bg", "signup-bg");
?>

<title>Find new recipes - Recol</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body id="browse-body">

    <div class="container-fluid">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Recol</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#my-navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="my-navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="" class="nav-link active" id="date"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
                            @Username
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#">About Recol</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Log out</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../AAR/home.php">My Collection</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Browse</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid mysearchbar">
        <div class="row m-0">

            <div class="col-12 text-center">
                <h1 style="color: white">
                    Find new recipes
                </h1>
            </div>

            <div class="col-lg-4 col-sm-2"></div>
            <div class="col-lg-6 col-sm-8 px-0">
                <form class="form-inline">
                    <input class="form-control mr-2 w-50" type="search" placeholder="Browse for recipes..."
                        aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search <i
                            class="fas fa-carrot"></i></button>
                </form>
            </div>

            <button class="btn btn-dark ml-3 px-3 py-0" style="font-size: 2rem; border-radius: 50%" title="Add dish..."
                data-toggle="modal" data-target="#addDish">+</button>
            <?php include("create-recipe.php"); ?>

        </div>
        <div class="row">
            <div class="col-12 text-center">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <?php for($i = 0; $i < count($images); $i++): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <img class="card-img-top" src="assets/images/<?= $images[$i] ?>.png">
                    <div class="card-body">
                        <h5 class="card-title">Dish <?= $i + 1 ?></h5>
                        <p class="card-text">The description will only be 30 words long at the very maximum.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Uploaded by Reinald</small>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>

    </div>
    <script>
        let date = new Date();
        let day = String(date.getDate()).padStart(2, '0');
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let year = date.getFullYear();

        date = month + '/' + day + '/' + year;
        document.getElementById('date').text = date;

        let dishName = document.getElementById("dish-name");
        let dishDesc = document.getElementById("dish-desc");
        let ingredients = document.getElementById("ingredient-post");
        let instructions = document.getElementById("instruction-post");

        function disableBt(element) {
            element.value = element.value.split("`").join(" ");
        }
        dishName.addEventListener("input", function() {
            disableBt(this);
        });
        dishDesc.addEventListener("input", function() {
            disableBt(this);
        });
        ingredients.addEventListener("input", function() {
            disableBt(this);
        });
        instructions.addEventListener("input", function() {
            disableBt(this);
        });
    </script>

    <?php include("footer.php"); ?>

