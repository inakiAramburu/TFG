from django.db import migrations
from django.db.backends.base.schema import BaseDatabaseSchemaEditor
from django.db.migrations.state import StateApps

from patient.models import Patient


def insert_sample_data(
        apps: StateApps,  # noqa: ARG001
        schema_editor: BaseDatabaseSchemaEditor  # noqa: ARG001
    ) -> None:
    Patient.objects.create(id=1, name="Patient_1", surname="Surname1")
    Patient.objects.create(id=2, name="Patient_2", surname="Surname2")
    Patient.objects.create(id=3, name="Patient_2", surname="Surname3")


class Migration(migrations.Migration):
    dependencies = [
        ("patient", "0001_initial"),
    ]

    operations = [
        migrations.RunPython(insert_sample_data),
    ]
