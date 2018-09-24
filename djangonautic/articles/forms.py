from django import forms
#from . import models
from django.contrib.auth.models import User
from .models import SavedLocations,UserContacts

class SavedLocations(forms.ModelForm):
    class Meta:
        model=SavedLocations
        fields=["username","source","destination"]

class UserContacts(forms.ModelForm):
    class Meta:
        model=UserContacts
        fields=["username","number"]
