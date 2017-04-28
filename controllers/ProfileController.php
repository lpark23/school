<?php
class ProfileController extends BaseController
{
    function onInit()
    {
        $this->authorize();
    }


    public function isIsReg()
    {
        return $this->isReg;
    }

    public function index()
    {
        $userID = $_SESSION['user_id'];
        $this->profiles = $this->model->getAllProfile();

        $school = $this->model->getSchool();
        $this->school = $school;

        $personprofile = $this->model->getPersonByUserId($userID);
        $this->personprofile = $personprofile;
        $username = $_SESSION['username'];

        if (($_SESSION['positionID'] == 2) && ($this->model->getPersonClass($userID))){
            $personcls = $this->model->getPersonClass($userID);
            $this->personcls = $personcls;

            $parent = $this->model->getParent($userID);
            $this->parents = $parent;
        }

    }

    function view(int $id)
    {
        if($_SESSION['positionID'] == 2){
            $profileBy  = $this->model->getProfileById($id);
            if(!$profileBy){
                $this->addErrorMessage("Не сте регистриран напълно в системата");
                $this->redirect("");
            }

            $personprofile = $this->model->getPersonByUserId($id);
            $this->personprofile = $personprofile;
            $personcls = $this->model->getPersonClass($id);
            $this->personcls = $personcls;
        }
        $personprofile = $this->model->getPersonByUserId($id);
        $this->personprofile = $personprofile;
        $personcls = $this->model->getPersonClass($id);
        $this->personcls = $personcls;
        $profilePosition = $this->model->getPositiondByUser($id);
        $this->profilePosition = $profilePosition;

        $school = $this->model->getSchool();
        $this->school = $school;
    }
    
    public function create()
    {
        $userID = $_SESSION['user_id'];
        $school = $this->model->getSchool();
        $this->school = $school;

        if ($this->isPost) {
            $fname =  mb_strtolower($_POST['person_fname']);
            if(strlen($fname) < 3 || strlen($fname) > 25){
                $this->setValidationError("person_fname", "Невалидно първо име. Между 3 и 25 символа");
            }
            $mname = mb_strtolower($_POST['person_mname']);
            if(strlen($mname) < 3 || strlen($mname) > 25){
                $this->setValidationError("person_mname", "Невалидно второ име. Между 3 и 25 символа");
            }
            $lname = mb_strtolower($_POST['person_lname']);
            if(strlen($lname) < 3 || strlen($lname) > 25){
                $this->setValidationError("lname", "Невалидно трето име. Между 3 и 25 символа");
            }
            $dateofbirth = $_POST['person_date'];
            $egn = $_POST['egn'];
            $paternEGN = "/^[0-9]{10}/";
            if (!preg_match($paternEGN, $egn)) {
                $this->setValidationError("egn", "Невалиден формат на ЕГН, 10 цифри");
            }
            $country = mb_strtolower($_POST['country']);
            if(strlen($country) < 3 || strlen($country) > 25){
                $this->setValidationError("country", "Грешна държава. Между 3 и 25 символа");
            }
            $city = mb_strtolower($_POST['city']);
            if(strlen($city) < 3 || strlen($city) > 25){
                $this->setValidationError("city", "Грешен град. Между 3 и 25 символа");
            }
            $street = "<p>".mb_strtolower($_POST['street'])."</p>";
            $gender = $_POST['gender'];
            $phoneN = $_POST['phonenumber'];
            $paternPhone = "/^[0][1-9]{3}[0-9]{6}/";
            if (!preg_match($paternPhone, $phoneN)) {
                $this->setValidationError("phone", "Невалиден телефонен номер, 0 XXX XXX XXX");
            }
            if ($this->formValid()) {
                $this->model->createAddress($country, $city, $street);
                $AddressID = $_SESSION['addressID'];
                if ($this->model->createProfile($userID, $fname, $mname, $lname, $dateofbirth, $egn, $AddressID, $gender, $phoneN)) {
                    $this->addInfoMessage("Профилът беше добавен");
                    $this->redirect("");
                } else {
                    $this->addErrorMessage("Грешка.");
                }
            }
        }
    }
        
    public function studentProfile($studentID)
    {
        $school = $this->model->getSchool();
        $this->school = $school;
        $userID = $_SESSION['user_id'];
        $profileBy = $this->model->getProfileById($userID);
        $this->profileby = $profileBy;

        $studyperiod = $this->model->getStudyPeriod();
        $this->studyperiod = $studyperiod;

        $classgroup = $this->model->getClassGroup();
        $this->classgroup = $classgroup;

        $studparents = $this->model->getParents($userID);
        $this->parents = $studparents;
        if ($this->isPost) {
            if (isset($_POST['upload'])){
                $target_dir = "content/profileImages/";
                $image_name = $_FILES['image']['name'];
                $image_size = $_FILES['image']['size'];
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $target_file = $target_dir . $image_name;
                $username = $_SESSION['username'];

                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $target_file = $target_dir . $username . "." . $imageFileType;

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    $this->addInfoMessage("Снимката е във формат - ". $check["mime"]);
                    $uploadOk = 1;
                } else {
                    $this->addInfoMessage("Файлът не е снимка.");
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    $this->addInfoMessage("Снимката вече съществува.");
                    $uploadOk = 0;
                }
                // Check file size
                if ($image_size> 1400000) {
                    $this->addInfoMessage("Снимката е твърде голяма.");
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if(strtolower($imageFileType) != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    $this->addInfoMessage("Снимката не е в един от форматите JPG, JPEG, PNG или GIF ");
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $this->addInfoMessage("Снимката не може да бъде качена");
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($image_tmp_name, $target_file)) {
                        $this->redirect("profile");
                        $this->addInfoMessage("Профилната снимка успешно качена");
                    } else {
                        $this->addInfoMessage("Снимката не може да бъде качена");
                    }
                }
            }

            if (isset($_POST['classgroup']) && isset($_POST['period']) && isset($_POST['stNumber'])){

                $profileBy = $this->model->getProfileById($userID);
                $this->profileBy = $profileBy;
                $studentid = $profileBy['pid'];
                $classgr = $_POST['classgroup'];//validaciq
                $period = $_POST['period'];//validicaq
                $stnumber = $_POST['stNumber'];
                if ($this->formValid()) {
                    if ($this->model->setClass($classgr,$period)){

                        if ($this->model->setClassStudents($classgr, $period, $stnumber, $studentid)) {
                            $this->addInfoMessage("Класът беше добавен");
                            $this->redirect("profile");
                        } else {
                            $this->addErrorMessage("Нeуспешно записване в клас.");
                        }
                    }
                    else {
                        $this->addErrorMessage("Грешка");
                    }
                } else {
                    $this->addErrorMessage("Грешка");
                }
            }
        }
    }

    public function teacherProfile($teacherID)
    {
        $school = $this->model->getSchool();
        $this->school = $school;

        $userID = $_SESSION['user_id'];

        $profileBy = $this->model->getProfileById($userID);
        $this->profileby = $profileBy;

        if (isset($profileBy['FTeacher'])) {
            $getFormMaster = $this->model->getFormMaster($teacherID);
            $this->getFormMaster = $getFormMaster;
        }
        $subTeacher = $this->model->getSubjectsTeacher($teacherID);
        $this->subTeacher = $subTeacher;

        $subjects = $this->model->getAllSubjects();
        $this->subjects = $subjects;

        $classavailable = $this->model->getAvailableClass();
        $this->classavailable = $classavailable;

        $teachingClass = $this->model->getTeachingClass($teacherID);
        $this->teachingClass = $teachingClass;

        $teacherFormMaster = $this->model->getFormMaster($teacherID);
        $this->teacherFormMaster = $teacherFormMaster;

        $classWithoutFormMaster = $this->model->getClassWithoutFormMaster();
        $this->classWithoutFormMaster = $classWithoutFormMaster;

        $classManager = $this->model->getStudentTeachersClass($teacherID);
        $this->selectClassManager = $classManager;

        $chosenClassManager = $this->model->getClassManager($teacherID);
        $this->chosenClassManager = $chosenClassManager;


        if ($this->isPost){
            if (isset($_POST['subjectset'])){
                $subjectset = $_POST['subjectset'];
                if ($this->formValid()){
                    if ($this->model->setTeach($teacherID,$subjectset)) {
                        $this->addInfoMessage("Предмета, по който преподавате беше добавен");
                        $this->redirectToUrl($teacherID);
                    }
                    else {
                        $this->addErrorMessage("Грешка, ");
                    }
                }
            }
            if (isset($_POST['classInsert'])){
                $classInsertID = $_POST['classInsert'];
                if ($this->formValid()){
                    if ($this->model->setTeaching($teacherID,$classInsertID)) {
                        $this->addInfoMessage("Класът, на който преподавате беше добавен");
                        $this->redirectToUrl($teacherID);
                    }
                    else {
                        $this->addErrorMessage("Грешка, ");
                    }
                }
            }
            if (isset($_POST['formMasterInsert'])){
                $formMasterInsertID = $_POST['formMasterInsert'];
                if ($this->formValid()){
                    if ($this->model->setFormMaster($teacherID,$formMasterInsertID)) {
                        $this->addInfoMessage("Класът, на който сте класен беше добавен");
                        $this->redirectToUrl($teacherID);
                    }
                    else {
                        $this->addErrorMessage("Грешка, ");
                    }
                }
            }
            if (isset($_POST['classManagerInsert']) && isset($_POST['CMclassID'])){
                $classManagerInsertID = $_POST['classManagerInsert'];
                $ClassManagerID = $_POST['CMclassID'];
                if ($this->formValid()){
                    if ($this->model->setClassManager($classManagerInsertID,$ClassManagerID)){
                        $this->addInfoMessage("Отговорникът на класа, който избрахте беше добавен");
                        $this->redirectToUrl($teacherID);
                    }
                    else {
                        $this->addErrorMessage("Грешка, ");
                    }
                }
            }
            if (isset($_POST['delSubject'])){
                $TeacherID = $_SESSION['teacherID'];
                $deletesubject = $_POST['delSubject'];
                if($this->model->deleteSubject($deletesubject)){
                    if ($this->formValid()){
                        $this->addInfoMessage("Предметът беше премахнат");
                        $this->redirectToUrl("/school/profile/teacherProfile/".$TeacherID);
                    }
                    else {
                        $this->addErrorMessage("Грешка.");
                    }
                }
            }

            if (isset($_POST['delTeaching'])){
                $TeacherID = $_SESSION['teacherID'];
                $deleteTeaching = $_POST['delTeaching'];
                if($this->model->deleteTeaching($deleteTeaching)){
                    if ($this->formValid()){
                        $this->addInfoMessage("Периодът на преподаване беше премахнат");
                        $this->redirectToUrl("/school/profile/teacherProfile/".$TeacherID);
                    }
                    else {
                        $this->addErrorMessage("Грешка.");
                    }
                }
            }
        }
    }

    public function parentProfile()
    {
        $school = $this->model->getSchool();
        $this->school = $school;

        $userID = $_SESSION['user_id'];
        $profileBy = $this->model->getProfileById($userID);
        $this->profileby = $profileBy;

        $id = $profileBy['parentID'];
        $kid = $this->model->kidProfile($id);
        if (!$kid){
            $this->addErrorMessage("нямате регистрирани роднити");

        }
        $this->kids = $kid;

        if (!isset($_GET['subject']) || isset($_GET['subject'])){
            if (isset($_GET['search'])){
            $search = $_GET['search'];
            $sr = $this->model->searchEGN($search);
                if ($sr){
                    $this->search = $sr;
                }
                else{
                    $this->addErrorMessage("няма намерени резултати");
                    $this->redirectToUrl("/school/profile/parentProfile/");
                }
            }
        }

        if (isset($_GET['search'])){
            $search = $_GET['search'];//validaciq
            $search = $this->model->searchEGN($search);
            $this->search = $search;
        }


        if  ($this->isPost){
            if (isset($_POST['parentID']) && isset($_POST['studentID']) && isset($_POST['parentStudenType'])){
                $parentID = $_POST['parentID'];
                $studentID = $_POST['studentID'];
                $parenttype = $_POST['parentStudenType'];

                if($this->model->setParentConection($parenttype,$studentID,$parentID)){
                    if ($this->formValid()){
                        $this->addInfoMessage("Добавихте успешно ученика");
                        $this->redirectToUrl("/school/profile/parentProfile/".$parentID);
                    }
                    else {
                        $this->addErrorMessage("Грешка.");
                    }
                }
            }
            if (isset($_POST['delFamilyConn'])){
                $deletefamid = $_POST['delFamilyConn'];
                if($this->model->deleteFamConn($deletefamid)){
                    $this->addInfoMessage("Премахнахте роднина.");
                }
                else{
                    $this->addErrorMessage("Грешка");
                }
                $this->redirectToUrl("/school/profile/parentProfile/");

            }
        }
    }

    public function edit($id)
    {
        $school = $this->model->getSchool();
        $this->school = $school;
        $userID = $_SESSION['user_id'];
        $profileBy = $this->model->getProfileById($userID);
        $this->profileby = $profileBy;
        $profileID = $profileBy['pid'];
        $addressID = $profileBy['addressID'];
        if ($this->isPost) {
            $fname = $_POST['person_fname'];
            $mname = $_POST['person_mname'];
            $lname = $_POST['person_lname'];
            $dateofbirth = $_POST['person_date'];
            $egn = $_POST['egn'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $street = $_POST['street'];
            $gender = $_POST['gender'];
            $phoneN = $_POST['phonenumber'];

            if ($this->formValid()) {
                if ($this->model->editAddress($country, $city, $street, $addressID)){
                    $this->addInfoMessage("Местопопожението беше сменено");

                }
                else
                {
                    $this->redirect("profile");
                }

                if ($this->model->editProfile($fname, $mname, $lname, $dateofbirth, $egn, $gender, $phoneN, $profileID)) {
                    $this->addInfoMessage("Профилът беше променен");
                    $this->redirect("");
                } else {
                    $this->redirect("events");
                }
            }
        }
    }

    public function delete(int $id) 
    {
        if($this->isPost){
            if($this->model->delete($id)){
                $this->addInfoMessage("Профилът беше изтрит.");
            }
            else{
                $this->addErrorMessage("Грешка");
            }
            $this->redirect('notifications');
        }
        else {
            $profile = $this->model->getProfileById($id);
            if(!$profile){
                $this->addInfoMessage("Потребителят вече не съществува");
                $this->redirect("notifications");
            }
            $this->profile = $profile;
        }
    }
}

?>
