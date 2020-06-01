
<?php

require_once('db.php');

// Pasiimti failus .csv formatu ir juos apdoroti

$csv = array_map('str_getcsv', file('./file.csv'));
foreach ($csv as  $key => $value) {
    if ($key < 1) continue;
    $result[] = explode(';', $value[0]);
}

function testInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Išvesti rezultatus į puslapį iš .csv failo.

foreach ($result as  $value) {

    // Pakeičiam iš numeric arrays to associative arrays

    $value['site'] = $value[0];
    unset($value[0]);
    $value['alexaRanks'] = $value[1];
    unset($value[1]);
    $value['visitors'] = $value[2];
    unset($value[2]);

    $site = testInput($value['site']);
    $alexaRank = testInput($value['alexaRanks']);
    $visitors = testInput($value['visitors']);

    echo '<tr class="value"><td>' . $site . '</td><td>' .
        $alexaRank . '</td><td>' . checkVisitors($visitors, $alexaRank)
        . '</td></tr>';
}

// Alexa Rank ^(-0.732) * 7,000,000 - formule visitors to found

// Funkcija patikrinti ar yra įvesti duomenys į visitor laukeli jeigu nėra apskaičiuoti
function checkVisitors($visitors, $alexa)
{
    if (empty($visitors)) {
        $visitors = pow($alexa, -0.732) * 7000000;
        return round($visitors);
    } else {
        return $visitors;
    }
}

$dublicate = "SELECT `site`, `alexa_ranks`, `visitors` FROM `duomenys` where site=?";

$add = "INSERT INTO `duomenys` (`id`, `site`, `alexa_ranks`, `visitors`, `data_created`, `data_updated`) VALUES (NULL, ?, ?, ?, current_timestamp(), current_timestamp())";

$update = "UPDATE `duomenys` SET `alexa_ranks` = ?, `visitors` = ? WHERE `duomenys`.`site` = ?";

foreach ($result as list($site, $alexaRank, $visitors)) {

    // // panaudojam funkcija patikrinti visitors
    $visitors = checkVisitors($visitors, $alexaRank);

    // // Pasirenkam ar yra tokie puslapiai
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $dublicate)) {
        mysqli_stmt_bind_param($stmt, "s", $site);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                // Jeigu randam atnaujinam
                mysqli_stmt_prepare($stmt, $update);
                mysqli_stmt_bind_param($stmt, "iis", $alexaRank, $visitors, $site);
                mysqli_stmt_execute($stmt);
            }
        }  //  Jeigu nera tokiu pat site pridedam i db
        else {
            mysqli_stmt_prepare($stmt, $add);
            mysqli_stmt_bind_param($stmt, "sii", $site, $alexaRank, $visitors);
            mysqli_stmt_execute($stmt);
        }
    }
}
