<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\UseCases\PatientSummaryUseCase;
use App\Http\Requests\PatientSummaryGetRequest;

class PatientSummaryGetController extends Controller
{

    public function __construct(private PatientSummaryUseCase $patientsSummary)
    {
    }

    public function __invoke(PatientSummaryGetRequest $request): JsonResponse
    {        
        $summary = $this->patientsSummary->get($request->patient_id);        

         return new JsonResponse($summary, status: 200);
    }

}
