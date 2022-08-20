<?php

$sql = "SELECT  bg.id,
                bg.name, 
                accbar.name AS barrel, 
                accmag.name AS magazine, 
                accrec.name AS receiver, 
                accsig.name AS sights, 
                bg.totalAccuracy, 
                bg.totalCapacity, 
                bg.totalDamage
        FROM build_gun AS bg
        INNER JOIN acc_barrel AS accbar
            ON bg.barrel = accbar.id
        INNER JOIN acc_magazine as accmag
            ON bg.magazine = accmag.id
        INNER JOIN acc_receiver AS accrec
            ON bg.receiver = accrec.id
        INNER JOIN acc_sights AS accsig
            on bg.sights = accsig.id";

$resbuild_gun = mysqli_query($conn, $sql);



$sql = "SELECT *
        FROM base_pistol";
$resBasePistol = mysqli_query($conn, $sql);

$sql = "SELECT *
        FROM acc_barrel";
$resBarrel = mysqli_query($conn, $sql);

$sql = "SELECT *
        FROM acc_magazine";
$resMagazine = mysqli_query($conn, $sql);

$sql = "SELECT *
        FROM acc_receiver";
$resReceiver = mysqli_query($conn, $sql);

$sql = "SELECT *
        FROM acc_sights";
$resSights = mysqli_query($conn, $sql);