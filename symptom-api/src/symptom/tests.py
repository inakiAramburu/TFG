from typing import Self

from django.test import TestCase
from django.urls import reverse

from .models import Symptom


class SymptomListViewTest(TestCase):
    def setUpTestData() -> None:
        Symptom.objects.create(symptom="feverTest", patient_id="1")
        Symptom.objects.create(symptom="painTest", patient_id="2")

    def test_symptom_list_view_status_code(self: Self) -> None:
        url = reverse("symptoms_list")
        response = self.client.get(url)
        self.assertEqual(response.status_code, 200)

    def test_symptom_list_view_content(self: Self) -> None:
        url = reverse("symptoms_list")
        response = self.client.get(url)
        self.assertContains(response, "feverTest")
        self.assertContains(response, "painTest")


class PatientSymptomListViewTest(TestCase):
    def setUp(self: Self) -> None:
        self.patient_id = 1

    def setUpTestData() -> None:
        Symptom.objects.create(symptom="feverTest", patient_id="1")
        Symptom.objects.create(symptom="painTest", patient_id="2")

    def test_patient_symptom_list_view_status_code(self: Self) -> None:
        url = reverse("patient_symptoms_list", args=[self.patient_id])
        response = self.client.get(url)
        self.assertEqual(response.status_code, 200)

    def test_patient_symptom_list_view_content(self: Self) -> None:
        url = reverse("patient_symptoms_list", args=[self.patient_id])
        response = self.client.get(url)
        self.assertContains(response, "feverTest")
        self.assertNotContains(response, "painTest")

    def test_patient_symptom_list_view_not_found(self: Self) -> None:
        url = reverse("patient_symptoms_list", args=[999])
        response = self.client.get(url)
        self.assertEqual(response.content, b'{"symptoms": []}')
        self.assertEqual(response.status_code, 200)
        
