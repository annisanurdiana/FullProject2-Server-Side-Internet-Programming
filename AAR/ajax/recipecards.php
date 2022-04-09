<?php 
// REQUIRE function to connect another php file
// so no need to write it over and over
require("../../AAR/config.php");

// ISSET to check whether the keyword and username already exist or not
// if the username and keyword are available, the recipes will be displayed according to the uploader
if (isset($_GET["keyword"]) && isset($_GET["username"])) {
    // Declare "username" variable with $username
    $username = $_GET["username"];
    // Declare "keyword" variable with $kw
    $kw = $_GET["keyword"];
    // retrieve
    // Where this $recipes variable will read the SQL query according to the 'username' and 'keyword' that have been inputted
    // The display shown will be adjusted based on name/desc/ingredients/uploader both first and last name and sorted by name
    $recipes = retrieve("SELECT id, name, description, uploader, photoloc
                        FROM recipe WHERE uploader = '$username' AND (
                            name LIKE '%$kw%' OR
                            description LIKE '%$kw%' OR
                            ingredients LIKE '%$kw%' OR
                            uploader LIKE '%$kw%')
                        ORDER BY name");
}
// if when checking only "keyword" is available, it will display recipes in general
elseif (isset($_GET["keyword"])) {
    // Declare "keyword" variable with $kw
    $kw = $_GET["keyword"];
    // retrieve
    // Where this $recipes variable will read the SQL query according to the inputted 'kw' variable
    // Display shown directly by name/desc/ingredients/uploader and sorted by name
    $recipes = retrieve("SELECT id, name, description, uploader, photoloc
                        FROM recipe WHERE
                        name LIKE '%$kw%' OR
                        description LIKE '%$kw%' OR
                        ingredients LIKE '%$kw%' OR
                        uploader LIKE '%$kw%'
                        ORDER BY name");
}
// if when checking only "keyword" is available, it will display recipes only belonging to the user
elseif (isset($_GET["username"])) {
    // Declare "username" variable with $username
    $username = $_GET["username"];
    // Where this $recipes variable will read SQL queries in general and not specific because it doesn't have a variable '$kw'
    // So that the display shown is directly based on name/desc/ingredients and sorted by name
    $recipes = retrieve("SELECT id, name, description, uploader, photoloc
    FROM recipe WHERE uploader = '$username' ORDER BY name");
}
// But if the USERNAME and KEYWORD variables are not found
// Then this $recipes variable will read the SQL query as a whole and not specific and also not sorted
else {
    $recipes = retrieve("SELECT id, name, description, uploader, photoloc
    FROM recipe");
}

?>

<!-- 
   We give a for loop here according to the number of recipes in the database declared with the variable name $recipes
 -->
<?php for($i = 0; $i < count($recipes); $i++): ?>

    <!-- Here is the HTML structure where the contents have been adjusted with PHP variables-->
    <div value="<?= $recipes[$i]['id'] ?>" class="card_ openDetails" data-target="#dish-content">
        <a href="#" title="Add dish..." data-target="#addDish" onclick="document.getElementById('id02').style.display='block'">
            <?php if ($recipes[$i]['photoloc']): ?>
            <img src="<?= $recipes[$i]["photoloc"] ?>" style="width: 100%; height: 200px">
            <?php else: ?>
            <img src="../AAR/assets/images/default-photo.png" style="width: 100%; height: 200px">    
            <?php endif; ?>
            <div class="card_contents">
                <h2><b><?= $recipes[$i]["name"] ?></b></h2>
                <div>
                    <br> 
                    <p class="card_title">
                    <?php 
                        $desc = $recipes[$i]["description"];
                        $desc = join('<br>', explode('`', $desc));
                        echo($desc);
                        // EXPLODE as string separator, so the solved string will be an array
                        // This is the anticipation that if the user types the `(BACK TICK) sign it will turn into a space
                    ?>    
                    </p>
                </div>
            </div>
            <p><button class="card_btn">Uploaded by <?= $recipes[$i]["uploader"] ?></button></p>
        </a>
    </div>

<?php endfor; ?>







