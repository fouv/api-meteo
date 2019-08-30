<?php
require_once 'class/OpenWeather.php';
$weather = new OpenWeather('5228063350a4e4c7d5a1c770159434a3');
$forecast = $weather->getForecast('Lyon,fr');

?>
<div class="container">
      <ul>
            <?php foreach ($forecast as $day) : ?>
            <li> Nous sommes le <?= $day['date']->format('d/m/Y')?>.
            il fait <?= $day['description'] ?>
             la température extérieure est de <?= $day['temp']?>C°.</li>
            <?php endforeach ?>
      </ul>
</div>
