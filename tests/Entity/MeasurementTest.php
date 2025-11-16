<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MeasurementTest extends TestCase
{
    public static function dataGetFahrenheit(): array
    {
        return [
            ['0', '32'],
            ['0.5', '32.9'],
            ['-0.5', '31.1'],
            ['25', '77'],
            ['36.6', '97.88'],
            ['12.3', '54.14'],
            ['42.7', '108.86'],
            ['215.2', '419.36'],
            ['-100', '-148'],
            ['100', '212'],
        ];
    }

    #[DataProvider('dataGetFahrenheit')]
    public function testGetFahrenheit(string $celsius, string $expectedFahrenheit): void
    {
        $measurement = new \App\Entity\Measurement();
        $measurement->setCelsius($celsius);
        $this->assertEquals($expectedFahrenheit, $measurement->getFahrenheit());

    }
}
