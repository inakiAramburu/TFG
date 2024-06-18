<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientSummaryGetRequest extends FormRequest
{

    protected function prepareForValidation() {
        $this->merge(['patient_id' => (int)$this->route('patient_id')]); //Route parameters are not request inputs :-(
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules() :array
    {
        return [
            'patient_id' => 'integer|required|min:1',
        ];
    }
}
