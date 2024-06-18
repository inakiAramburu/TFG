from django.db import migrations
from django.db.backends.base.schema import BaseDatabaseSchemaEditor
from django.db.migrations.state import StateApps

from symptom.models import Symptom


def insert_sample_data(
        apps: StateApps,  # noqa: ARG001
        schema_editor: BaseDatabaseSchemaEditor  # noqa: ARG001
    ) -> None:
    Symptom.objects.create(id=1, symptom="fever", patient_id=1)
    Symptom.objects.create(id=2, symptom="pain", patient_id=1)
    Symptom.objects.create(id=3, symptom="fever", patient_id=2)


class Migration(migrations.Migration):
    dependencies = [
        ("symptom", "0001_initial"),
    ]

    operations = [
        migrations.RunPython(insert_sample_data),
    ]
