from django.urls import path

from .views import PatientSymptomListView, SymptomListView

urlpatterns = [
    path("", SymptomListView.as_view(), name="symptoms_list"),
    path("patient/<int:patient_id>/", PatientSymptomListView.as_view(), name="patient_symptoms_list"),
]
