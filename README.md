# Browser Based Echo Classifier

Coded by Lahiru Ariyasinghe

Funded by the New Zealand Health Research Council, grant 19/734.



In contrast to many other forms of medical imaging, cardiac imaging relies on assessment of the function of the heart as it moves through the cardiac cycle. Heart ultrasound (echocardiography/echo) is the most widely used cardiac imaging modality worldwide, being portable, accessible, cost-effective, and scalable to multiple healthcare environments.

Similar to CT and MRI, echo images are typically stored as DICOM files, the standard for the communication and management of medical imaging information. However, in contrast to CT or MRI, images are usually acquired with minimal or no metadata to allow identification of the specific cardiac view being examined. Due to the requirement for manual labelling of images, this has limited the development of analysis software applications beyond a small subset of use-cases, most only available at considerable cost on vendor specific platforms. At a minimum, having a standalone software tool to perform view classification and image quality assessment rapidly by a human expert on a large set of echo images would be useful for echocardiographic teaching and research purposes. In particular, in echocardiography research, such a tool could aid researchers in cardiovascular medicine to swiftly create rich and labelled datasets required for the modern machine learning (ML) pipelines.

Although state-of-the-art DICOM viewers such as MicroDICOM and TomTec provide the functionality to view and analyze echo images, most of them lag in three areas:
(1) The critical use case presented in this proposal, to perform rapid view classification and quality assessment of echo images, and store that information automatically in the backend. This limitation primarily hinders the applicability of these tools to create rich and labelled datasets required for ML purposes. (2) The ability to scale up to meet modern big data requirements (i.e., handle 10K plus echo images efficiently). (3) Most of these tools have either limited functionality, or are commercial packages (fully or partially), with a high cost that is rarely within the budget of students or many researchers.

To this end, as part of a current project comparing echo images with cardiac MRI, we developed a browser-based echo view classifier (with a python backend) that loads and runs within a standard web browser. This tool reduced the time overhead of echo view classification and image quality assessment by nearly 70% compared to using a separate DICOM viewer.

The main functional steps of our software tool are as follows: 
- (1) Given a set of echo images, the backend python pipeline automatically separates them into two categories, single-frame echo images and multi- frame echo images.
- (2) The single-frame echo images are converted into png files (DICOM to PNG) and multi-frame echo images to cine mp4 video files (DICOM to MP4). In the case of multi-frame images, it converts the first frame into a png file in addition to the mp4 file (to provide more clarity for the user during view classification).
- (3) The files generated in step (2) (png and mp4 files) together with their metadata are loaded into a web server with a database backend.
- (4) After logging in to the web app via a browser window, a human expert can view, analyze, perform view classification (e.g. parasternal short axis view) and grade the image quality (e.g. very good, good, moderate, acceptable, etc.) of the echo files. The user's input is recorded in the backend database, and the actual echo image files (DICOM files) (at step (1)) will be automatically moved to an appropriate directory (i.e. into the PSAX directory) in a pre-defined directory tree.

