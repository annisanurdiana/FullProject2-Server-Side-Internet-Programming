<?php 
// Include function to connect other php files
// so no need to write it over and over
include("../../AAR/config.php");

// ISSET to check whether the 'key' already exists or not
// if the KEYWORD 'key' exists it will display recipeDetails
if (isset($_GET["keyword"])) {
    $kw = $_GET["keyword"];
   
   // REATRIV or READ
   // This function is useful for retrieving information from a table in a MYSQL database
   // Where the $recipeDetails variable will read the SQL query according to 'id' and input $kw arranged by name
    $recipeDetails = retrieve("SELECT id, name, description, ingredients, instructions FROM recipe WHERE id = $kw ORDER BY name");
}

// variable $fromBrowse only to check from file browse.php exists or not
$fromBrowse = false;
if (isset($_GET["browse"])) {
   $fromBrowse = true;
}

?>
<form class="modal-content animate" action="" method="post">

   <div class="iconcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close"
         title="Close Modal">&times;</span>
   </div>

   <div class="modal_container">
      <h2 id="name-con" class="upload-title" style="text-align: left; font-weight:700">
         <?php echo $recipeDetails[0]["name"] ?>
      </h2>
   </div>

   <hr style="color:rgb(189, 189, 189); font-weight:200;">

   <div class="modal_container2" style="padding-left:29px">
      <div style="font-size: 20pt; font-weight: 700; text-decoration: underline; text-align: center">
         Description
      </div>
      <div>
         <p id="description-con" style="text-align: center; font-size:14px;">
            <?php
               $desc = $recipeDetails[0]["description"];
               $desc = join("<br>", explode("`", $desc));
               echo $desc;
            ?>
         </p>
      </div>
      <div class="row">
         <div class="" style="font-size: 20pt; font-weight: 700; text-decoration: underline; padding-bottom:10px;">
            Ingredients
         </div>
         <div>
            <p id="ingredient-con" style="color: black; font-weight:100; font-size: 14px; padding: bottom 8px;">
               <?php 
                  $ingr = $recipeDetails[0]["ingredients"];
                  $ingr = join("<br>", explode("`", $ingr));
                  echo $ingr;
               ?>
            </p>
         </div>
      </div>

      <div class="row">
         <div style="font-size: 20pt; font-weight: 700; text-decoration: underline; padding-bottom:8px;">
            Instructions
         </div>
         <div>
            <p id="instruction-con" style="color: black; font-weight:100; font-size: 14px;">
               <?php   
                  $inst = $recipeDetails[0]["instructions"];
                  $inst = join("<br>", explode("`", $inst));
                  echo $inst;
               ?>
            </p>
         </div>
      </div>
   </div>

   <br>
   <hr>

   <div class="modal_container" style="padding: 17px; text-align:right;">
      <?php if (!$fromBrowse): ?>
      <div class="modal-btn">
         <button type="submit" formaction="../AAR/home.php" formmethod="POST" name="delete" value=<?= $recipeDetails[0]["id"] ?> class="deletebtn" style="padding-bottom:7px;">Delete</button>
      </div>

      <div id="edit-container" class="modal-btn">
         <button id="editbtn" value="<?= $recipeDetails[0]["id"] ?>" name="update" type="button" class="editbtn" style="padding-bottom:7px;">Edit</button>
      </div>
      <?php endif; ?>
   </div>
</form>