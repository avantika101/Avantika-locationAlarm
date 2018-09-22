from django.conf.urls import url
from . import views
from django.contrib.staticfiles.urls import staticfiles_urlpatterns
from django.contrib.auth.views import login
app_name='articles' #NoReverseMatch error
urlpatterns = [

    url(r'finalmap/$',views.map,name="finalmap"),
    url(r'settings/$',views.settings_view,name="settings"),
    url(r'locations/$',views.locations_view,name="locations"),
    url(r'contacts/$',views.contacts_view,name="contacts"),
    url(r'deletecontact/(?P<user_id>\d+)/$',views.delete_contact_view,name="delete_contact_view"),
    url(r'deletelocation/(?P<user_id>\d+)/$',views.delete_location_view,name="delete_location_view"),


]

#consists of

urlpatterns += staticfiles_urlpatterns() #check for debug mode and serve static files
