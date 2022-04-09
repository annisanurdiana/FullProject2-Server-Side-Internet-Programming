<?php 
session_start();
require("../AAR/config.php");

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
}

if (isset($_SESSION['username']) && isset($_SESSION['admin'])) {
    header("Location: ../AAR/admin.php");
}
elseif (isset($_SESSION['username'])) {
    header("Location: ../AAR/home.php");
}

function toError($string) {
    echo "<span class='form-err'>*" . $string . "</span>";
}

$not_registered = false;

if(isset($_POST["login-submit"])) {
    
    if (isset($_POST["email"]) && isset($_POST["pword"])) {
        $email = $_POST["email"];
        $pword = $_POST["pword"];
        $res = retrieve("SELECT uname, email, pswd FROM mm2021 WHERE email = '$email' AND pswd = '$pword'");

        if (empty($res)) $not_registered = true;
        
        if (!empty($res)) {
            if ($email === $res[0]["email"] && $res[0]["uname"] === "admin") {
                var_dump($res[0]);
                $_SESSION["username"] = $res[0]["uname"];
                $_SESSION["admin"] = true;
                header("Location: ../AAR/admin.php");
            }
            elseif (!$not_registered) {
                $_SESSION["username"] = $res[0]["uname"];
                header("Location: ../AAR/home.php");
            }
        }
    }
}

?>

<?php include("../AAR/header.php"); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<title>Log into your account - Recol</title>
</head>

<body id="login-body">

    <form class="form-signin p-5 bg-light" id="form-signup" action="../AAR/login.php" method="post">
        <h1 class="h3 mb-3 text-center h1-signup">Log into your account</h1>
        <div class="row">

            <div class="col-12 my-form-column">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" maxlength="40" required>
            </div>

            <div class="col-12 my-form-column">
                <label for="inputPassword">Password</label>
                <input type="password" name="pword" id="inputPassword" class="form-control" placeholder="Password" maxlength="20" required>
            </div>
            <?php if($not_registered) toError("The data you inputted is incorrect.");?>
        </div>

        <button class="btn btn-lg btn-outline-success btn-block mt-4" type="submit" id="login-submit" name="login-submit">Log in</button>
        <div class="row mt-2">
            <div class="col-6">
                <label>Haven't got an account? <a href="../AAR/signup.php">Create one</a></label>
            </div>
            <div class="col-6 text-right">
                <label><a href="../AAR/signup.php">Forgot password?</a></label>
            </div>
        </div>
    </form>

    <?php include("../AAR/footer.php"); ?>