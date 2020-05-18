
<?php

include('db.php');

// Pasiimti failus .csv formatu ir juos apdoroti

$csv = array_map('str_getcsv', file('./file.csv'));
for ($i = 1; $i < count($csv); $i++) {
    $result[] = (explode(';', $csv[$i][0]));
}

// Apdoroti duomenys

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}


// Išvesti rezultatus į puslapį iš .csv failo.

for ($i = 0; $i < count($result); $i++) {

    $site = test_input($result[$i][0]);
    $alexaRank = test_input($result[$i][1]);
    $visitors = test_input(($result[$i][2]));

    echo '<tr class="value"><td>' . $site . '</td><td>' .
        $alexaRank . '</td><td>' . checkvisitors($visitors, $alexaRank)
        . '</td></tr>';
}
// Alexa Rank ^(-0.732) * 7,000,000 - formule visitors to found

// Funkcija patikrinti visitorus ir apskaičiuoti
function checkvisitors($visitors, $alexa)
{
    if ($visitors == null) {
        $visitors = pow($alexa, -0.732) * 7000000;
        return round($visitors);
    } else {
        return $visitors;
    }
}

foreach ($result as $val) {
    // panaudojam funkcija patikrinti visitors
    $visitors = checkvisitors($val[2], $val[1]);
    // Pasirenkam ar yra tokie puslapiai
    $dublicate = "SELECT `site`, `alexa_ranks`, `visitors` FROM `duomenys` where site='$val[0]'";
    $querry = mysqli_query($conn, $dublicate);
    if (mysqli_num_rows($querry) > 0) {
        while ($row = mysqli_fetch_assoc($querry)) {

            // Jeigu randam atnaujinam
            $update = "UPDATE `duomenys` SET `alexa_ranks` = '$val[1]', `visitors` = '$visitors' WHERE `duomenys`.`site` = '$val[0]'";
            mysqli_query($conn, $update);
        }
        //  Jeigu nera tokiu pat site pridedam i db
    } else {

        $val[0] = mysqli_real_escape_string($conn, $val[0]);
        $val[1] = mysqli_real_escape_string($conn, $val[1]);
        $val[2] = mysqli_real_escape_string($conn, $val[2]);

        $add = "INSERT INTO `duomenys` (`id`, `site`, `alexa_ranks`, `visitors`, `data_created`, `data_updated`) VALUES (NULL, '$val[0]', '$val[1]', '$visitors', current_timestamp(), current_timestamp())";
        mysqli_query($conn, $add);
    }
}

?>