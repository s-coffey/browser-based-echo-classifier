import pydicom
#
dhi = pydicom.filereader.dcmread("C:\HRC_ preprocessing_test\J65JFEO2.dcm")
print(dhi.PatientID[0:6])