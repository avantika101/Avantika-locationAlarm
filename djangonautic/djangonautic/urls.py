from django.conf.urls import url,include
from django.contrib import admin
from . import views

urlpatterns = [
    url(r'^admin/', admin.site.urls),
    url(r'^',include('accounts.urls',namespace="accounts")),
    url(r'^accounts/',include('accounts.urls')),
    url(r'^articles/',include('articles.urls',namespace="articles")),

]
