<?php 
// digunakan untuk membuka koneksi ke server MYSQL dan memilih database yang digunakan
// database yang kita gunkan disini adalah ...
$con = mysqli_connect("localhost", "root", "", "recol");

// Dengan mysqli_connect_errno kita akan mengecek apakah ada error
// Jika ada error maka akan ditampilkan pesan error
if (mysqli_connect_errno()) {
    echo "Error: " . mysqli_connect_error();
    exit();
}

/*>> FUNCTION = suatu sub program untuk menjalankan perintah tertentu sesuai fungsi method itu sendiri <<*/

// REATRIVE atau READ 
// Function ini berguna untuk mengambil informasi dari dalam tabel di dalam database MYSQL
function retrieve($query) {
    // kita deklarasikan $con dengan variable global agar dapat dibaca di dalam function ini
    global $con;
    // kita deklarasikan $res di sini dengan fungsi MYSQLI_QUERY
    // yaitu untuk eksekusi sintaks sql yang ada di dalam file PHP Script
    $res = mysqli_query($con, $query);
    // Kita cek di sini jika variable $res tidak tampil maka akan ditampilkan error
    if (!$res) echo ("Error: " . mysqli_error($con));
    // Deklarasi variable $items dengan array kosong
    $items = [];
    // fungsi mysqli_fetch_assoc() akan mengembalikan nilai berupa array assosiatif 
    // selama masih ada baris ditabel tersebut maka akan ditampilkan data nya 
    while ($item = mysqli_fetch_assoc($res)) {
        $items[] = $item;
    }
    // Setelah itu nilai dikembalikan ke pemanggil fungsi dengan return $items
    return $items;
}

//...
function query($query) {
    // kita deklarasikan $con dengan variable global agar dapat dibaca di dalam function ini
    global $con;
    // kita deklarasikan $res di sini dengan fungsi MYSQLI_QUERY
    // yaitu untuk eksekusi sintaks sql yang ada di dalam file PHP Script
    $res = mysqli_query($con, $query);
    // Kita cek di sini jika variable $res tidak tampil maka akan ditampilkan error
    if (!$res) echo("Error: " . mysqli_error($con));
}
?>