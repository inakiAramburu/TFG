<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\UseCases\AllPatientsUseCase;
use App\Http\Requests\AllPatientsGetRequest;

class AllPatientsGetController extends Controller
{

    public function __construct(private AllPatientsUseCase $allPatients)
    {
    }

    public function __invoke(AllPatientsGetRequest $request): JsonResponse
    {

        $patients = $this->allPatients->get();

        return new JsonResponse($patients, status: 200);
    }

}
