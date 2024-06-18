from typing import Self

from django.http import JsonResponse, request
from django.views import View

from .models import Patient


class PatientListView(View):
    def get(self: Self, request: request) -> JsonResponse:  # noqa: ARG002
        patients = Patient.objects.all()

        patient_list = []
        for patient in patients:
            patient_data = {
                "id": patient.id,
                "name": patient.name,
                "surname": patient.surname,
            }
            patient_list.append(patient_data)

        return JsonResponse({"patients": patient_list})


class PatientDetailView(View):
    def get(self: Self, request: request, patient_id: int) -> JsonResponse:  # noqa: ARG002
        try:
            patient = Patient.objects.get(id=patient_id)

            patient_data = {
                "id": patient.id,
                "name": patient.name,
                "surname": patient.surname,
            }

            return JsonResponse({"patient": patient_data})
        except Patient.DoesNotExist:
            return JsonResponse({"error": "Patient not found"}, status=404)
