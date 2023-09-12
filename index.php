<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
<?php include 'get-coordinates.php' ?>
 <?php
 $myKey = '83ef3ed148d022c3cc0ea51d09d29092';
 $getWeather = file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$myKey}&units=metric");
 $wheatherData = json_decode($getWeather, true);

 $main = $wheatherData['main'];
 $temp = (int)$main['temp'];
 $feelsLike = (int)$main['feels_like'];
 $cityName = $wheatherData['name'];
 $weather = $wheatherData['weather'];
 $weatherMain= $weather['0'];
 $weatherDescription = $weatherMain['description'];
 $maxTemp = $temp = (int)$main['temp_max'];
 $minTemp = $temp = (int)$main['temp_min'];
 $wind = $wheatherData['wind'];
 $windSpeed = $wind['speed'];
 $sys = $wheatherData['sys'];
 $sunriseTime = $sys['sunrise'];
 $sunsetTime = $sys['sunset'];
 $pressure = $main['pressure'];
 $humidity = $main['humidity'];
 $dt = $wheatherData['dt'];
 $timezone = $wheatherData['timezone'];

$dateTimeWithTimezone = $dt + $timezone;
$dateTime = new DateTime('@' . $dateTimeWithTimezone);
$currentHour = $dateTime->format('H');


 $dateSunrise = (new DateTime('@' . $sunriseTime))->setTimezone(new DateTimeZone('Europe/Moscow'));

 $dateSunset = (new DateTime('@' . $sunsetTime))->setTimezone(new DateTimeZone('Europe/Moscow'));

 ?>
 <script type="text/javascript">
    <?php
        echo 'data = {};';
        echo 'data.currentHour = ' . $currentHour . ';';
        echo 'data.currentWeather = "' . $weatherDescription. '";';
    ?>
 </script>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p class="small-text">Find the weather in your city</p>  
<div class="inputs-container">
    <input class="input"type="text" name="name" value="<?php echo $cityName;?>">
  <input class="searh"type="submit" name="submit" value="">  
</div>
</form>

<?php
// echo $nameOfCity;
?>
<main class="main">
    <div class="banner">
        <p class="city-name"><?php echo $cityName ?></p>
        <p class="deg"><?php echo $temp ?>&#0176;</p>
        <p class="subtitle"><?php echo $weatherDescription ?></p>
        <div class="description">
            <p class="small-text">feels like: <?php echo $feelsLike ?>&#0176;</p>
            <p class="small-text">wind: <?php echo $windSpeed ?> m/s</p>
            <p class="small-text">humidity: <?php echo $humidity ?>%</p>
            <p class="small-text">pressure: <?php echo $pressure ?> hPa</p>
            <p class="small-text">sunrise: <?php echo $dateSunrise->format('H:i:s'); ?></p>
            <p class="small-text">sunset: <?php  echo $dateSunset->format('H:i:s'); ?></p>
        </div>
    </div>
    <div id="rain"></div>
    <div id="clouds"></div>
    <div id="rain"></div>
</main>
<script type="text/javascript" src="/classes.js"></script> 
<script type="text/javascript" src="/main.js"></script> 
</body>
</html>