from __future__ import unicode_literals
from django.shortcuts import render,redirect
from .models import UserContacts,SavedLocations
from django.contrib import messages
from django.contrib.auth.decorators import login_required
from django.http import HttpResponse
from . import forms
from django.contrib.auth.models import User

#from django.views import Views


@login_required(login_url="/accounts/login/")
def map(request):
    if request.method=='POST':
        print(request.POST.get("submit"))
        if request.POST.get("submit")=='save':
            #save the values in db and dislay message
            form=forms.SavedLocations()
            instance=form.save(commit=False)
            instance.username=request.user
            instance.source=request.POST["source"]
            instance.destination=request.POST["destination"]
            instance.save()
            message = messages.success(request,('location saved!'))
            return render(request,'articles/finalmap.html',{'message':message})

        elif request.POST.get("submit")=='calculate':
            return HttpResponse("Calculate the distance and time!")
        else:
            return HttpResponse("Not Working!")
    else:
        return render(request,'articles/finalmap.html')

@login_required(login_url="/accounts/login/")
def settings_view(request):
        return render(request,'articles/settings.html')

def locations_view(request):
        objects=SavedLocations.objects.filter(username=request.user)
        print(objects)
        return render(request,'articles/locations.html',{'locations':objects})

def contacts_view(request):
    #saving the numbers
    if request.method=='POST':
        form=forms.UserContacts()
        instance=form.save(commit=False)
        instance.username=request.user
        instance.number=request.POST['number']
        instance.save()
        message = messages.success(request,('contact saved!'))
        objects=UserContacts.objects.filter(username=request.user)
        print(objects)
        return render(request,'articles/contacts.html',{'contacts':objects},{'message':message})
    else:
        form=forms.UserContacts()
        objects=UserContacts.objects.filter(username=request.user)
        print(objects)
        return render(request,'articles/contacts.html',{'contacts':objects})

def delete_contact_view(request,user_id):
    item=UserContacts.objects.get(pk=user_id)
    print(item)
    item.delete()
    messages.success(request,('number has been deleted!'))
    return redirect('articles:contacts')

def delete_location_view(request,user_id):
    item=SavedLocations.objects.get(pk=user_id)
    print(item)
    item.delete()
    messages.success(request,('location has been deleted!'))
    return redirect('articles:locations')
