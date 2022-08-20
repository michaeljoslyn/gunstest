<?php

include 'conn.php';

function getNewStats($conn, $selectBasePistol,  $selectBarrel, $selectMagazine, $selectReceiver, $selectSights) {
    $result = [];

    $sql = "SELECT *
            FROM base_pistol
            WHERE id = $selectBasePistol";
    $resBasePistol = mysqli_query($conn, $sql);
    $resBasePistol = mysqli_fetch_assoc($resBasePistol);
    $totalAccuracy = $resBasePistol['accuracy'];
    $totalDamage = $resBasePistol['damage'];
    $totalCapacity = $resBasePistol['capacity'];

    $sql = "SELECT *
            FROM acc_barrel
            WHERE id = $selectBarrel";
    $resBarrel = mysqli_query($conn, $sql);
    $resBarrel = mysqli_fetch_assoc($resBarrel);
    $totalAccuracy = $totalAccuracy + $resBarrel['accuracy'];

    $sql = "SELECT *
            FROM acc_magazine
            WHERE id = $selectMagazine";
    $resMagazine = mysqli_query($conn, $sql);
    $resMagazine = mysqli_fetch_assoc($resMagazine);
    $totalCapacity = $totalCapacity + $resMagazine['capacity'];

    $sql = "SELECT *
            FROM acc_receiver
            WHERE id = $selectReceiver";
    $resReceiver = mysqli_query($conn, $sql);
    $resReceiver = mysqli_fetch_assoc($resReceiver);
    $totalDamage = $totalDamage + $resReceiver['damage'];

    $sql = "SELECT *
            FROM acc_sights
            WHERE id = $selectSights";
    $resSights = mysqli_query($conn, $sql);
    $resSights = mysqli_fetch_assoc($resSights);
    $totalAccuracy = $totalAccuracy + $resSights['accuracy'];

    $result['totalDamage'] = $totalDamage;
    $result['totalAccuracy'] = $totalAccuracy;
    $result['totalCapacity'] = $totalCapacity;

    return $result;
}

extract($_POST);

switch ($action) {
    case 'getBuildGun':
        $sql = "SELECT  bg.id,
                        bg.name, 
                        accbar.id AS barrel, 
                        accmag.id AS magazine, 
                        accrec.id AS receiver, 
                        accsig.id AS sights, 
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
                    on bg.sights = accsig.id
                WHERE bg.id = $id";
        $resBasePistol = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($resBasePistol);

        $result = [];
        $result['id'] = $data['id'];
        $result['gunName'] = $data['name'];
        $result['barrel'] = $data['barrel'];
        $result['magazine'] = $data['magazine'];
        $result['receiver'] = $data['receiver'];
        $result['sights'] = $data['sights'];
        $result['accuracy'] = $data['totalAccuracy'];
        $result['capacity'] = $data['totalCapacity'];
        $result['damage'] = $data['totalDamage'];
        echo json_encode($result);
    break;

    case 'refresh':
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

        echo "
        <table class='table table-striped mt-3' id='gunsTable'>
        <thead class='table-secondary'>
            <tr>
                <th scope='col'>Name</th>
                <th scope='col'>Barrel</th>
                <th scope='col'>Magazine</th>
                <th scope='col'>Receiver</th>
                <th scope='col'>Sights</th>
                <th scope='col'>Accuracy</th>
                <th scope='col'>Capacity</th>
                <th scope='col'>Damage</th>
                <th scope='col'>Delete</th>
            </tr>
        </thead>
        <tbody>";
            while ($row = mysqli_fetch_assoc($resbuild_gun)) {
                echo "
                <tr>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[name]</td>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[barrel]</td>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[magazine]</td>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[receiver]</td>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[sights]</td>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[totalAccuracy]</td>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[totalCapacity]</td>
                    <td data-bs-toggle='modal' data-bs-target='#addGunModal' onclick= viewGun($row[id])> $row[totalDamage]</td>
                    <td class='d-flex justify-content-center'><button type='button' class='btn btn-danger btn-sm' onclick='deleteGun($row[id])'><i class='bi bi-trash'></i></button></td>
                </tr>";
            }
            echo "
        </tbody>
    </table>";
    
        break;

    case 'getBase':
        $sql = "SELECT *
                FROM base_pistol";
        $resBasePistol = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($resBasePistol);

        $result = [];
        $result['accuracy'] = $data['accuracy'];
        $result['capacity'] = $data['capacity'];
        $result['damage'] = $data['damage'];

        echo json_encode($result);

        break;

    case 'updateBase':
        
        echo json_encode(getNewStats($conn, $selectBasePistol,  $selectBarrel, $selectMagazine, $selectReceiver, $selectSights));

        break;

    case 'saveGun':
        $newStats = getNewStats($conn, $selectBasePistol,  $selectBarrel, $selectMagazine, $selectReceiver, $selectSights);

        if (empty($gunId)) {
        $sql = "INSERT INTO build_gun
                VALUES ( '', '$gunName', $selectBasePistol, $selectBarrel, $selectMagazine, $selectReceiver, $selectSights, $newStats[totalAccuracy], $newStats[totalCapacity], $newStats[totalDamage])";
        } else {
            $sql = "UPDATE build_gun
                    SET name = '$gunName',
                        base = $selectBasePistol,
                        barrel = $selectBarrel,
                        magazine = $selectMagazine,
                        receiver = $selectReceiver,
                        sights = $selectSights,
                        totalAccuracy = $newStats[totalAccuracy],
                        totalCapacity = $newStats[totalCapacity],
                        totalDamage = $newStats[totalDamage]
                    WHERE id = $gunId";
        }
        $result = mysqli_query($conn, $sql);
        break;

    case 'deleteGun':
        $sql = "DELETE FROM build_gun WHERE id = $id";
        mysqli_query($conn, $sql);
        break;
    
        default:
        echo 2;
        break;
}
