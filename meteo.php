<!-- <?php
//initialise une session

$curl = curl_init('http://api.openweathermap.org/data/2.5/weather?q=Lyon&units=metric&appid=5228063350a4e4c7d5a1c770159434a3');
curl_setopt_array($curl,[
      CURLOPT_CAINFO => __DIR__.DIRECTORY_SEPARATOR.'cert.cer',
     CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 1
]);

// pour executer curl
$data = curl_exec($curl);
//pour recuperer l'erreur
if ($data === false ||curl_getinfo($curl,CURLINFO_HTTP_CODE) !== 200){
     var_dump(curl_error($curl));
} else {
            $data = json_decode($data, true);
     echo 'il fait '.$data['main']['temp'].' C° 