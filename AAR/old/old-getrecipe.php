<?php 
require("../../AAR/config.php");
if (isset($_GET["keyword"])) {
    $kw = $_GET["keyword"];
    $recipeDetails = retrieve("SELECT id, name, description, ingredients, instructions FROM recipe
                                WHERE id = $kw ORDER BY name");
}

?>
<div class="modal-header">
    <h5 class="modal-title upload-title" id="dishDetailName"><?= $recipeDetails[0]["name"] ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="recipeDetails">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12" style="font-size: 20pt; font-weight: 700; text-decoration: underline; text-align: center">
                Description
            </div>
            <div class="col-2 mb-2"></div>
            <div class="col-8 text-center">
                <?php
                $desc = $recipeDetails[0]["description"];
                $desc = join("<br>", explode("`", $desc));
                echo $desc;
                ?>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
            <div class="col-1"></div>
            <div class="col-11" style="font-size: 20pt; font-weight: 700; text-decoration: underline">
                Ingredients
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <?php 
                $ingr = $recipeDetails[0]["ingredients"];
                $ingr = join("<br>", explode("`", $ingr));
                echo $ingr;
                ?>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
            <div class="col-1"></div>
            <div class="col-11"
                style="font-size: 20pt; font-weight: 700; text-decoration: underline">
                Instructions
            </div>
            <div class="col-1"></div>
            <div class="col-10">
                <?php
                $inst = $recipeDetails[0]["instructions"];
                $inst = join("<br>", explode("`", $inst));
                echo $inst;
                ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</div>
<div class="modal-footer" id="modal-footer">
    <form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" formaction="../AAR/home.php" formmethod="POST" name="delete" value=<?= $recipeDetails[0]["id"] ?>>Delete</button>
        <button type="button" class="btn btn-primary">Edit</button>
    </form>
</div>