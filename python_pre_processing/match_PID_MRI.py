import pydicom
import shutil
import os
from os import listdir
from os.path import isfile, join
#
for path, directories, files in os.walk("D:\MRI_HRC"):
    for sub_dir_name in directories:
        if sub_dir_name.find("FIESTA_CINE_short_axis_stack") != -1:
            PID_as_per_dir = (path[path.find("T"):(path.find("T") + 6)]).upper()
            if not os.path.exists(join("D:\MRI_ECHO_HRC", PID_as_per_dir)):
                os.makedirs(join("D:\MRI_ECHO_HRC", PID_as_per_dir))
                os.makedirs(join("D:\MRI_ECHO_HRC", PID_as_per_dir, "MRI_SAX"))
                os.makedirs(join("D:\MRI_ECHO_HRC", PID_as_per_dir, "ECHO"))
            onlyfiles = [f for f in listdir(join(path, sub_dir_name)) if isfile(join(join(path, sub_dir_name), f))]
            for dicom in onlyfiles:
                dhi = pydicom.filereader.dcmread(join(path, sub_dir_name, dicom))
                if dhi.PatientID == PID_as_per_dir:
                    shutil.copy(join(path, sub_dir_name, dicom), join("D:\MRI_ECHO_HRC", PID_as_per_dir, "MRI_SAX", dicom))
                else:
                    print("Patient IDs---NO match!" + "\t" + str(join(path, sub_dir_name, dicom)))
# _END