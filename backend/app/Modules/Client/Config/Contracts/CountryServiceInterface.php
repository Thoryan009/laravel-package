<?php
namespace App\Modules\Client\Contracts;

interface CountryServiceInterface
{
    public function getCountries(): array;
}
