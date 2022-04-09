<?php 

require("../../AAR/config.php");
$username = $_GET["username"];

if (isset($_GET["keyword"])) {
    $kw = $_GET["keyword"];
    $recipes = retrieve("SELECT id, name, description, uploader, photoloc
                        FROM recipe WHERE uploader = '$username' AND (
                        name LIKE '%$kw%' OR
                        description LIKE '%$kw%' OR
                        ingredients LIKE '%$kw%' OR
                        uploader LIKE '%$kw%')
                        ORDER BY name");
}
else {
    $recipes = retrieve("SELECT id, name, description, uploader, photoloc
    FROM recipe WHERE uploader = '$username' ORDER BY name");
}

?>


<?php for($i = 0; $i < count($recipes); $i++): ?>
    <div class="col-lg-4 col-md-6 openDetails" data-toggle="modal" data-target="#dish-content" value="<?= $recipes[$i]['id'] ?>">
        <div class="card">
            <?php if ($recipes[$i]['photoloc']): ?>
            <img class="card-img-top" src="<?= $recipes[$i]["photoloc"] ?>">
            <?php else: ?>
            <img class="card-img-top" src="../AAR/assets/images/default-photo.png">    
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title">
                    <?= $recipes[$i]["name"] ?>
                </h5>
                <p class="card-text">
                    <?php 
                        $desc = $recipes[$i]["description"];
                        $desc = join('<br>', explode('`', $desc));
                        echo($desc);
                    ?>
                </p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Uploaded by <?= $recipes[$i]["uploader"] ?></small>
            </div>
        </div>
    </div>
<?php endfor; ?>