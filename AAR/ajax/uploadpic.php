<?php 
// REQUIRE berfungsi untuk menyambungkan file php lain
// sehingga tida perlu menuliskannya berulang-ulang
require("../../AAR/config.php");

// ISSET untuk melakukan pengecekan 
// apakah dish-name, dish-desc, ingredient-post, dan instruction-post sudah ada atau belum
if (isset($_POST["dish-name"]) && isset($_POST["dish-desc"]) && isset($_POST["ingredient-post"]) && isset($_POST["instruction-post"])) {
    // jika instruction-post dan dish-name, dish-desc, ingredient-post tersedia
    // maka akan dideklarasikan inisialisasi variable sesuai dengan isi variable superglobal $_POST
    $name = join("`", explode("\n", $_POST["dish-name"]));
    $desc = join("`", explode("\n", $_POST["dish-desc"]));
    $ingredients = join("`", explode("\n", $_POST["ingredient-post"]));
    $instructions = join("`", explode("\n", $_POST["instruction-post"]));
    $username = $_POST["username"];
    
    // Setelah itu akan ada pengecekan lagi terhadap file yang diupload atau photo
    // Jika "photo" dan "name" tersedia maka akan dilakukakn inisialisasi variable
    if (isset($_FILES["photo"]["name"])) {
        // $filename akan diberikan nama sesuai dengan id dan tenggat waktu file tersebut diupload
        $filename = uniqid() . "-" . time();
        // $split dengan function explode 
        // EXPLODE yang berfungsi sebagai pemisah string, sehingga string yang telah dipecahkan akan menjadi array
        // ...
        $split = explode(".", $_FILES["photo"]["name"]);
        // END() adalah pointer internal untuk elemen terakhir dalam array dan output
        $ext = end($split);
        // file yang telah diupload nantinya akan disimpan di dalam server di dalam folder UPLOADS
        // dengan nama sesuai dengan $filename dan ekstensi $ext
        $location = "../../AAR/uploads/" . $filename . "." . $ext;
        // Fungsi move_uploaded_file() berguna untuk memindahkan file yang terupload. 
        // Untuk memindahkannya, kita akan menggunakan fungsi bawaan PHP 
        // dan diletakkan sesuai variable $location yang sudah dideklarasikan sebelumnya
        move_uploaded_file($_FILES['photo']['tmp_name'], $location);
        // terakhir data disimpan dengan QUERY FUNCTION 
        // dan QUERY FUNCTION akan melakukan update pada query sql sesuai dengan table recipe
        query("INSERT INTO recipe(name, description, ingredients, instructions, uploader, photoloc) 
            VALUES('$name', '$desc', '$ingredients', '$instructions', '$username', '$location')");
    }

    // Jika salah satu syarat "IF" tidak terpenuhi maka user akan dikembalikan pada form semula
    // form tersebut yang menyuruh user untuk mengisi data-data upload recipe secara lengkap
    else {
        query("INSERT INTO recipe(name, description, ingredients, instructions, uploader) 
            VALUES('$name', '$desc', '$ingredients', '$instructions', '$username')");
    }
}

?>