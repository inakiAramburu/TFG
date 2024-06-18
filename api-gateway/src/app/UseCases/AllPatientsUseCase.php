<?php

declare(strict_types=1);

namespace App\UseCases;

use Illuminate\Support\Facades\Http;

final class AllPatientsUseCase
{
    private readonly string $patientApiUrl;
    const ENDPOINT_URL = '/patient';

    public function __construct() 
    {
        $this->patientApiUrl = env('PATIENT_API_URL');
    }

    public function get(): array
    {
        $response = Http::acceptJson()->get($this->patientApiUrl.self::ENDPOINT_URL, []);
        return json_decode(
            json: $response->getBody()->getContents(),
            associative: true,
            depth: 512,
            flags: JSON_THROW_ON_ERROR
        );
    }
}