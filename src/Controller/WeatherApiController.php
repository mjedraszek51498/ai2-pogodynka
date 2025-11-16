<?php

namespace App\Controller;

use App\Entity\Measurement;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherApiController extends AbstractController
{
    public function __construct(private WeatherUtil $WeatherUtil)
    {
    }
    #[Route('/api/v1/weather', name: 'app_weather_api')]
    public function index(
        #[MapQueryParameter('city')] string $city,
        #[MapQueryParameter('country')] string $country,
        #[MapQueryParameter('format')] string $format,
        #[MapQueryParameter('twig')] bool $twig = false,
    ): Response
    {

        $measurements = $this->WeatherUtil->getWeatherForCountryAndCity( $country, $city);

        if ($format === 'json') {
            if($twig === true){
                return $this->render('weather_api/index.json.twig', [
                    'city' => $city,
                    'country' => $country,
                    'measurements' => $measurements,
                ]);

            }
            return $this->json([
                'city' => $city,
                'country' => $country,
                'measurements' => array_map(fn(Measurement $m) => [
                    'date' => $m->getDate()->format('Y-m-d'),
                    'celsius' => $m->getCelsius(),
                    'fahrenheit' => $m->getFahrenheit(),
                    'pressure' => $m->getPressure(),
                    'humidity' => $m->getHumidity(),
                    'description' => $m->getDescription(),
                ], $measurements),
            ]);
        }elseif ($format=== 'csv') {
            $csvData = [];
            foreach ($measurements as $m) {

                $csvData[] = sprintf(
                    "%s,%s,%s,%s,%s",
                    $city,
                    $country,
                    $m->getDate()->format('Y-m-d'),
                    $m->getCelsius(),
                    $m->getFahrenheit(),
                );

            }
            if($twig === true){
                return $this->render('weather_api/index.csv.twig', [
                    'city' => $city,
                    'country' => $country,
                    'measurements' => $measurements,
                ]);

            }
            $out = implode("\n", $csvData);
            return new Response($out);


        }
        return new Response('Unsupported format', Response::HTTP_BAD_REQUEST);
    }
}
