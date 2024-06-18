from django.urls import path

from .views import PatientDetailView, PatientListView

urlpatterns = [
    path("", PatientListView.as_view(), name="patients_list"),
    path("<int:patient_id>/", PatientDetailView.as_view(), name="patient_detail"),
]
