from typing import Self

from django.http import JsonResponse, request
from django.views import View

from .models import Symptom


class SymptomListView(View):
    def get(self: Self, request: request) -> JsonResponse:  # noqa: ARG002
        symptoms = Symptom.objects.all()

        symptom_list = []
        for symptom in symptoms:
            symptom_data = {
                "id": symptom.id,
                "symptom": symptom.symptom,
                "patient_id": symptom.patient_id,
            }
            symptom_list.append(symptom_data)

        return JsonResponse({"symptoms": symptom_list})


class PatientSymptomListView(View):
    def get(self: Self, request: request, patient_id: int) -> JsonResponse:  # noqa: ARG002
        try:
            symptoms = Symptom.objects.filter(patient_id=patient_id)

            symptom_list = []
            for symptom in symptoms:
                symptom_data = {
                    "id": symptom.id,
                    "symptom": symptom.symptom,
                    "patient_id": symptom.patient_id,
                }
                symptom_list.append(symptom_data)

            return JsonResponse({"symptoms": symptom_list})
        except Symptom.DoesNotExist:
            return JsonResponse({"error": "Symptoms not found"}, status=404)
