# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.db import models
from django.contrib.auth.models import User
from django.core.validators import RegexValidator
# Create your models here.


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
    number = models.CharField(max_length=12,null=True,default='none')
    def __unicode__(self):
        return self.number
