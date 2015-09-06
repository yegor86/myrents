#!/usr/bin/python
import os
import shutil

root = "."
cnt = 0
for item in os.listdir(root):
    
    source = os.path.join(root, item)
    if os.path.isdir(source):
        try:
            targetId = int(item)/1000
            target = os.path.join(root, str(targetId)) 
            print "Moving from {} to {}".format(source, target)
            if not os.path.exists(target):
                os.makedirs(target)
             
            shutil.move(source, target)
        except ValueError:
            print "Error when copying from: {}".format(item)
        except shutil.Error as e:
            print "Error when moving from: {} to: {} - {}".format(item, target, e.strerror)
