<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Facades\Http;
use App\UseCases\PatientSummaryUseCase;

class PatientSummaryGetTest extends TestCase
{

    const FAKE_PATIENT_RESPONSE = [
        "patient" => [
            "id" => 1, "name" => "Patient_1", "surname"=> "Surname1"
        ],
    ];
    const FAKE_SYMPTOMS_RESPONSE = [
        "symptoms" => [
            ["id" => 1, "symptom" => "fever", "patient_id" => 1], 
            ["id" => 2, "symptom" => "pain", "patient_id" => 1],
        ],
    ];

    private TestResponse $response;
    
    public function test_PatientSummaryGet_should_return_a_patient_summary():void
    {        

        $this->givenTheseParameters(
            [
                'patient_id' => fake()->randomNumber(),
            ]
        );

        $this->withThisMocks();

        $this->whenExecuted();

        $this->thenTheResponseIsAPatientSummary();
    }

    private function givenTheseParameters(array $data): void
    {
        $this->requestData = $data;
    }

    private function withThisMocks()
    {
        Http::fake([
            $this->buildPatientEndpointUrl() => Http::response(self::FAKE_PATIENT_RESPONSE, 200, []),
            $this->buildPatientSymptomsEndpointUrl() => Http::response(self::FAKE_SYMPTOMS_RESPONSE, 200, []),
        ]);
    }

    private function whenExecuted(): void
    {
        $this->response = $this->getJson('/api/v1/patient/summary/'.$this->requestData['patient_id']);
    }


    private function thenTheResponseIsAPatientSummary(): void
    {
        $this->response->assertStatus(200);   

        $result = json_decode(
            json: $this->response->getContent(),
            associative: true,
            depth: 512,
            flags: JSON_THROW_ON_ERROR
        );

        $expectedSummary = array_merge(self::FAKE_PATIENT_RESPONSE,self::FAKE_SYMPTOMS_RESPONSE);
        $this->assertSame($expectedSummary, $result);
    }

    private function buildPatientEndpointUrl():string
    {
        return env('PATIENT_API_URL').PatientSummaryUseCase::PATIENT_ENDPOINT_URL.'/'.$this->requestData['patient_id'];
    }
    private function buildPatientSymptomsEndpointUrl():string
    {
        return env('SYMPTOM_API_URL').PatientSummaryUseCase::SYMPTOM_ENDPOINT_URL.'/'.$this->requestData['patient_id'];
    }

}