from django.shortcuts import render,redirect
from django.contrib.auth.forms import UserCreationForm,AuthenticationForm
from django.contrib.auth import login,logout
from django.http import HttpResponse
from django.contrib import messages
from .forms import RegistrationForm

def home(request):
    return render(request,'accounts/homepage.html')

def signup_view(request):

    if request.method=='POST':
        form=RegistrationForm(request.POST)
        if form.is_valid():
            user=form.save()
            login(request,user) #pass the user credentials
            message = messages.success(request,('account saved!'))
            return redirect('accounts:userhome')
    else:
        form=RegistrationForm()
        return render(request,'accounts/signup.html',{'form':form})

def login_view(request):
    if request.method=='POST':
        form=AuthenticationForm(data=request.POST)
        if form.is_valid():
            #log in the User and display message!
            user=form.get_user() #retrieve the user
            login(request,user) #pass the user credentials
            if 'next' in request.POST:
                return redirect(request.POST.get("next")) #because we have a name of next in that hidden field
            else:
                return redirect('accounts:userhome')
    else:
        form=AuthenticationForm()
    return render(request,'accounts/login.html',{'form':form})

def logout_view(request):
    if request.method=='POST':
        logout(request)
        print("logout working !")
        return redirect('accounts:home')

def userhome_view(request):
    return render(request,'accounts/userhomepage.html')
