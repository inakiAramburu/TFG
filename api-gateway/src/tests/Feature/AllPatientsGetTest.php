<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Facades\Http;
use App\UseCases\AllPatientsUseCase;

class AllPatientsGetTest extends TestCase
{

    private const FAKE_PATIENTS = ['Patient 1','Patient 2'];
    private TestResponse $response;
    
    public function test_AllPatientsGet_should_return_a_collection_of_patients():void
    {        

        $this->withThisMocks();

        $this->whenExecuted();

        $this->thenTheResponseIsACollectionOfPatients();
    }

    private function withThisMocks()
    {
        Http::fake([
            env('PATIENT_API_URL').AllPatientsUseCase::ENDPOINT_URL => Http::response(self::FAKE_PATIENTS, 200, []),
        ]);
    }

    private function whenExecuted(): void
    {
        $this->response = $this->getJson('/api/v1/patient');
    }


    private function thenTheResponseIsACollectionOfPatients(): void
    {
        $this->response->assertStatus(200);        
        $this->assertSame(self::FAKE_PATIENTS, json_decode($this->response->getContent()));
    }

}