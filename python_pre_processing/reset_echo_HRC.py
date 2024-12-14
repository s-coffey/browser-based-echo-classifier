import os
import shutil
#
for path, directories, files in os.walk("D:\ECHO_HRC"):
    r_path = path.replace("ECHO_HRC", "ECHO_HRC_NEW")
    if not os.path.exists(r_path):
        os.makedirs(r_path)
    if directories:
        for sub_dir in directories:
            if not os.path.exists(os.path.join(r_path, sub_dir)):
                os.makedirs(os.path.join(r_path, sub_dir))
    if files:
        for echo_f in files:
            if echo_f != ".DS_Store":
                shutil.copy(os.path.join(path, echo_f), os.path.join(r_path, (str(echo_f) + ".dcm")))
#END