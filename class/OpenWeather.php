<?php
class OpenWeather {

      private $apiKey;

      public function __construct(string $apiKey)
      {
            $this->apiKey = $apiKey;
      }
      public function getForecast(string $city): ?array
      {
            $curl = curl_init("http://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&APPID={$this->apiKey}");
            curl_setopt_array($curl,[
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_CAINFO => dirname(__DIR__). DIRECTORY_SEPARATOR. 'cert.cer',
                  CURLOPT_TIMEOUT => 1
            ]);
            $data = curl_exec($curl);
            if ($data === false){
                  return null;
            }
            $results = [];
            $data = json_decode($data, true);
            foreach($data['list'] as $day) {
                 $results[]= [
                       'temp' => $day['main']['temp'],
                'description' => $day['weather'][0]['description'],
               'date'         => new DateTime('@' . $day['dt'])
           ];
            }
            return $results;
      }
}

?>
