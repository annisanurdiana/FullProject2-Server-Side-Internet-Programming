<?php
session_start();
require("../AAR/config.php");
if (isset($_SESSION['username']) && !isset($_SESSION["admin"])) {
    header("Location: ../AAR/admin.php");
}
elseif (isset($_SESSION['username'])) {
    header("Location: ../AAR/home.php");
}

function toError($string) {
    echo "<span class='form-err'>*" . $string . "</span>";
}

$error_email = false;
$error_username = false;
$error_username_2 = false;
$error_username_3 = false;
$error_password = false;

if (isset($_POST["signup-submit"])) {
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["rpassword"]) && isset($_POST["email"])) {
        $email = $_POST["email"];
        $username = $_POST["username"];
        $pword = $_POST["password"];

        $res = retrieve("SELECT uname,email FROM mm2021 WHERE email = '$email'");
        if (!empty($res)) {
            $error_email = true;
        }
        
        unset($res);
        $res = retrieve("SELECT uname,email FROM mm2021 WHERE uname = '$username'");

        if (is_numeric($username[0])) {
            $error_username = true;
        }
        elseif (strpos($username, " ") !== false || strpos($username, '"') !== false || strpos($username, "'") !== false || strpos($username, "<") !== false || strpos($username, ">") !== false) {
            $error_username_2 = true;
        }
        elseif (!empty($res)) {
            $error_username_3 = true;
        }

        if ($pword !== $_POST["rpassword"]) {
            $error_password = true;
        }

        if (!$error_email && !$error_password && !$error_username_3 && !$error_username_2 && !$error_username) {
            query("INSERT INTO mm2021(uname, email, pswd) VALUES('$username', '$email', '$pword')");
            $_SESSION["signedup"] = true;
            header("Location: ../AAR/thankyou.php");
        }
    }
}

?>

<?php include("header.php");?>

<title>Sign up to Recol</title>
</head>

<body id="signup-body">
    <form class="form-signin p-5 bg-light" id="form-signup" action="../AAR/signup.php" method="post">
        <h1 class="h3 mb-3 text-center h1-signup">Sign up to Recol</h1>
        <div class="row">

            <div class="col-12 my-form-column">
                <label for="inputUsername">
                    Username
                    <?php if($error_username) toError("Your username needs to start with an alphabetical character."); ?>
                    <?php if($error_username_2) toError("Your username shouldn't contain any white spaces and some special characters."); ?>
                    <?php if($error_username_3) toError("This username has already been used."); ?>
                </label>
                <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" maxlength="20" minlength="5" required>
            </div>

            <div class="col-12 my-form-column">
                <label for="inputEmail">
                    Email
                    <?php if ($error_email) toError("This email has already been used."); ?>
                </label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" maxlength="40" required>
            </div>

            <div class="col-12 my-form-column">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" maxlength="20" minlength="6" required>
            </div>

            <div class="col-12 my-form-column">
                <label for="inputRPassword" id="labelRPassword">
                    Repeat password
                    <?php if ($error_password) toError("This doesn't match the password you inputted.") ?>
                </label>
                <input type="password" id="inputRPassword" name="rpassword" class="form-control" placeholder="Repeat password" maxlength="20" required>
            </div>

        </div>


        <button class="btn btn-lg btn-outline-success btn-block mt-4" type="submit" name="signup-submit" id="signup-submit">Sign up</button>

        <label>Already have an account? Log in <a href="../AAR/login.php">here</a></label>
    </form>


    <?php include("footer.php"); ?>