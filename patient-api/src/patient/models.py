from typing import Self

from django.db import models


class Patient(models.Model):
    name = models.CharField(
        max_length=255,
        null=False,
        blank=False,
    )
    surname = models.CharField(
        max_length=255,
        null=False,
        blank=False,
    )
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        ordering = ["created_at"]

    def __str__(self: Self) -> str:
        return f"{self.name} {self.surname}"
