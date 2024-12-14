import pydicom
import shutil
import os
from os import listdir
from os.path import isfile, join
#
only_sub_dirs = [dI for dI in os.listdir("D:\MRI_ECHO_HRC") if os.path.isdir(os.path.join("D:\MRI_ECHO_HRC", dI))]
for PID in only_sub_dirs:
    print(PID)
    for path, directories, files in os.walk("D:\ECHO_HRC_NEW"):
        if files:
            for echo in files:
                edi = pydicom.filereader.dcmread(join(path, echo))
                if edi.PatientID[0:6] == PID:
                    shutil.copy(join(path, echo), join("D:\MRI_ECHO_HRC", PID, "ECHO", echo))
# _END