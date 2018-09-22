#from django.urls import path
from django.conf.urls import url,include
from .import views
from django.contrib.auth.views import login,logout

app_name='accounts'
urlpatterns=[
    url(r'^$',views.home,name="home"),
    url(r'^login/$',views.login_view,name="login"),
    url(r'^signup/$',views.signup_view,name="signup"),
    url(r'^logout/$',views.logout_view,name="logout"),
    url(r'^userhome/$',views.userhome_view,name="userhome"),
]
