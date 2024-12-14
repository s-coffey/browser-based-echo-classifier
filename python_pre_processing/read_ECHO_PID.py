import pydicom
import os
from os import listdir
from os.path import isfile, join
#
for path, directories, files in os.walk("D:\ECHO_HRC_NEW"):
    if files:
        for echo in files:
            edi = pydicom.filereader.dcmread(join(path, echo))
            print(edi.PatientID[0:6])
            # f = open("ECHO_PIDs.txt", "a")
            # f.write(edi.PatientID)
            # f.write("\n")
# _END