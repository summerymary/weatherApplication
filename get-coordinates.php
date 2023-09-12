<?php
$myKey = '83ef3ed148d022c3cc0ea51d09d29092';
$getCityResult = getCity();
$cityName = 'London';
if ($getCityResult['cityName'] !== '')
{
    $cityName = $getCityResult['cityName'];
}
$getCoordinates = file_get_contents("http://api.openweathermap.org/geo/1.0/direct?q={$cityName}&limit=1&appid={$myKey}");
$coordinates = json_decode($getCoordinates, true);
$dataCity = $coordinates[0];
$lat = $dataCity['lat'];
$lon = $dataCity['lon'];

  
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getCity() {
    $cityName = '';
    $errorText = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $errorText = "Введите имя";
        } else {
            $cityName = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $cityName)) 
            {
                $errorText = "Имя должно содержать только буквы и пробелы";
            }
        }
    }
    return [
        "cityName" => $cityName,
        "errorText" => $errorText
    ];
}