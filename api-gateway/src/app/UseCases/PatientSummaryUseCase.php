<?php

declare(strict_types=1);

namespace App\UseCases;

use Illuminate\Support\Facades\Http;

final class PatientSummaryUseCase
{
    private readonly string $patientApiUrl;
    private readonly string $symptomApiUrl;
    const PATIENT_ENDPOINT_URL = '/patient';
    const SYMPTOM_ENDPOINT_URL = '/symptom/patient';

    public function __construct() 
    {
        $this->patientApiUrl = env('PATIENT_API_URL');
        $this->symptomApiUrl = env('SYMPTOM_API_URL');
    }

    public function get(int $patientId): array
    {
        return [
            'patient' => $this->patient($patientId),
            'symptoms' => $this->symptoms($patientId),
        ];
    }

    private function patient(int $patientId): array
    {
        $response = Http::acceptJson()->get($this->patientApiUrl.self::PATIENT_ENDPOINT_URL.'/'.$patientId, []);
        $result = json_decode(
            json: $response->getBody()->getContents(),
            associative: true,
            depth: 512,
            flags: JSON_THROW_ON_ERROR
        );
        return $result['patient'];
    }

    private function symptoms(int $patientId): array
    {
        $response = Http::acceptJson()->get($this->symptomApiUrl.self::SYMPTOM_ENDPOINT_URL.'/'.$patientId, []);
        $result = json_decode(
            json: $response->getBody()->getContents(),
            associative: true,
            depth: 512,
            flags: JSON_THROW_ON_ERROR
        );
        return $result['symptoms'];
    }
}