<?php
class OpenWeatherSimplified {

      private $apiKey;

      public function __construct(string $apiKey)
      {
            $this->apiKey = $apiKey;
      }

      public function getToday(string $city): ?array
      {
            $data = $this->callAPI("weather?q={$city}");
            return [
                  'temp' => $data['main']['temp'],
                  'description' => $data['weather'][0]['description'],
                  'date'         => new DateTime()
            ];
      }

      public function getForecast(string $city): ?array
      {
            $data = $this->callAPI("forecast?q={$city}");

            $results = [];
            foreach($data['list'] as $day) {
                  $results[]= [
                        'temp' => $day['main']['temp'],
                        'description' => $day['weather'][0]['description'],
                        'date'         => new DateTime('@' . $day['dt'])
                  ];
            }
            return $results;
      }

      private function callAPI(string $endpoint): ?array
      {
            $curl = curl_init("http://api.openweathermap.org/data/2.5/{$endpoint}&units=metric&APPID={$this->apiKey}&lang=fr");
            curl_setopt_array($curl,[
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_CAINFO => dirname(__DIR__). DIRECTORY_SEPARATOR. 'cert.cer',
                  CURLOPT_TIMEOUT => 1
            ]);
            $data = curl_exec($curl);
            if ($data === false){
                  return null;
            }

            return json_decode($data, true);

      }
}
