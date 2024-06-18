from django.http import HttpResponse

def index(request):
    return HttpResponse("/patient", content_type="text/plain")
