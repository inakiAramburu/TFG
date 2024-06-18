from typing import Self

from django.test import TestCase
from django.urls import reverse

from .models import Patient


class PatientListViewTest(TestCase):
    def setUp(self: Self) -> None:
        Patient.objects.create(name="Name 1", surname="Surname 1")
        Patient.objects.create(name="Name 2", surname="Surname 2")

    def test_patient_list_view_status_code(self: Self) -> None:
        url = reverse("patients_list")
        response = self.client.get(url)
        self.assertEqual(response.status_code, 200)

    def test_patient_list_view_content(self: Self) -> None:
        url = reverse("patients_list")
        response = self.client.get(url)
        self.assertContains(response, "Name 1")
        self.assertContains(response, "Name 2")


class PatientDetailViewTest(TestCase):
    def setUp(self: Self) -> None:
        self.patient = Patient.objects.create(name="Name 1", surname="Surname 1")

    def test_patient_detail_view_status_code(self: Self) -> None:
        url = reverse("patient_detail", args=[self.patient.id])
        response = self.client.get(url)
        self.assertEqual(response.status_code, 200)

    def test_patient_detail_view_content(self: Self) -> None:
        url = reverse("patient_detail", args=[self.patient.id])
        response = self.client.get(url)
        self.assertContains(response, "Name 1")
        self.assertContains(response, "Surname 1")

    def test_patient_detail_view_not_found(self: Self) -> None:
        url = reverse("patient_detail", args=[999])
        response = self.client.get(url)
        self.assertEqual(response.status_code, 404)
