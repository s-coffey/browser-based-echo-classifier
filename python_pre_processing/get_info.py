import os
from os.path import join
#
MRI_count = 0
ECHO_count = 0
#
for path, directories, files in os.walk("D:\MRI_ECHO_HRC"):
    if directories:
        for sub_dir_name in directories:
            if sub_dir_name == "MRI_SAX":
                mri_sax_dir = os.listdir(join(path, sub_dir_name))
                MRI_count = MRI_count + len(mri_sax_dir)
            if sub_dir_name == "ECHO":
                echo_dir = os.listdir(join(path, sub_dir_name))
                if len(echo_dir) == 0:
                    print("NO ECHO:" + path[16:])
                    f = open("MRI studies with no ECHO.txt", "a")
                    f.write(path[16:])
                    f.write("\n")
                    f.close()
                else:
                    ECHO_count = ECHO_count + len(echo_dir)
print("Total MRI:" + str(MRI_count))
print("Total ECHO:" + str(ECHO_count))
# _END