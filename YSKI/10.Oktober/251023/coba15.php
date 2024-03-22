<?php

$umur = 19;
$menikah = false;

if($umur > 18){
    if($menikah){
        echo "Selamat datang pak!";
    } else {
        echo "Selamat datang kakak!";
    }
} else {
    echo "Maaf website ini hanya untuk yang sudah berumur 18+";
}
?>