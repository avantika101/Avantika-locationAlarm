# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.db import models
from django.contrib.auth.models import User
from django.core.validators import RegexValidator
#from phonenumber_field.modelfields import PhoneNumberField

class SavedLocations(models.Model):

    username = models.ForeignKey(User,default=None)
    source = models.CharField(max_length=50,null=True)
    destination = models.CharField(max_length=50,null=True)
    def Source(self):
        return self.source
    def Destination(self):
        return self.destination

class UserContacts(models.Model):

    username = models.ForeignKey(User,default=None)
    number = models.CharField(max_length=12,default='None',blank=True) # validators should be a list
    def __unicode__(self):
        return self.number
