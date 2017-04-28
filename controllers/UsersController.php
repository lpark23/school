<?php

class UsersController extends BaseController
{
    public function login()
    {
        if($this->isPost){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $loggedUserId = $this->model->login($username, $password);
            if($loggedUserId){
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $loggedUserId;

                $chekStatPosition = $this->model->getPositionById($loggedUserId);
                $_SESSION['positionID'] = $chekStatPosition['positionID'];
                $_SESSION['positiontype'] = $chekStatPosition['type'];
                $_SESSION['ustatus'] = $chekStatPosition['status'];

                $profileBy  = $this->model->getProfileById($loggedUserId);
                $profileID = $profileBy['pid'];

                $this->profID = $profileID;
                $_SESSION['profileID'] = $profileBy['pid'];
                $_SESSION['pstatus'] = $profileBy['pstatus'];
                if (!$chekStatPosition['positionID']) {
                    $this->addErrorMessage("Моля изчакайте одобрение от администратора");
                    $this->redirectToUrl("../profile/create");
                }
                else{
                    if($chekStatPosition['positionID'] == 1){
                        $this->addInfoMessage("Добре дошъл Администратор " . $profileBy['Fname'].$profileBy['Lname'].", разполагай се! :)");
                        $this->redirect("");
                    }
                    if($chekStatPosition['positionID'] == 2){
                        $personsid = $profileBy['pid'];
                        if($this->model->getClsGrpStpBy($personsid)){
                            $classgrpstp = $this->model->getClsGrpStpBy($personsid);
                            $_SESSION['classgrp'] = $classgrpstp['classgroupID'];
                            $_SESSION['classstp'] = $classgrpstp['studyperiodID'];
                        }
                        $position = "students";
                        $studentID = $this->model->setPosition($profileID,$position);
                        $_SESSION['studentID'] = $studentID;
                        $this->addInfoMessage("Здравей ".mb_convert_case($profileBy['Fname'],MB_CASE_TITLE).",");
                        $this->redirectToUrl("../profile/studentProfile/".$profileBy['pid']);
                    }
                    if($chekStatPosition['positionID'] == 3){
                        $position = "teachers";
                        $teacherID = $this->model->setPosition($profileID,$position);
                        $_SESSION['teacherID'] = $teacherID;
                        $teacher = $this->model->getUserBy($profileID);
                        $teacherName = $teacher[0]['Fname']." ".$teacher[0]['Lname'];

                        $_SESSION['teacherName'] = mb_convert_case($teacherName,MB_CASE_TITLE);

                        $this->addInfoMessage("Добър деннннн учителю, ".$_SESSION['teacherName']);
                        $this->redirectToUrl("../profile/");
                    }
                    if($chekStatPosition['positionID'] == 4) {
                        $position = "parents";
                        $parentID = $this->model->setPosition($profileID,$position);
                        $_SESSION['parentID'] = $parentID;
                        $this->addInfoMessage("Здравейте родители");
                        $this->redirect("");
                    }
                }
            }
            else{
                $this->addErrorMessage("Грешно потребителско име или парола.");
            }
        }
    }

    public function register()
    {
        if($this->isPost){
            $username = $_POST['username'];
            $allUsers = $this->model->getAllUsers();
            $this->alluser = $allUsers;

            foreach ($allUsers as $k => $oneuser){
                if ($username == $oneuser['username']){
                    $this->addErrorMessage("Потребителското име е заето");
                    $this->setValidationError("usernameExist", "Потребителското име е заето");
                }
            }
            if(strlen($username) < 3 || strlen($username) > 25 || $username == ""){
                $this->addErrorMessage("Невалидно потребителско име");
                $this->setValidationError("username", "Невалидно потребителско име");
            }

            $password = $_POST['password'];
            if(strlen($password) < 3 || strlen($password) > 25 || $password == ""){
                $this->addErrorMessage("Невалидна парола");
                $this->setValidationError("password", "Невалидна парола");
            }
            $passwordconfirm = $_POST['passwordconfirm'];
            if($password != $passwordconfirm){
                $this->addErrorMessage("Паролите не съвпадат");
                $this->setValidationError("passwordconfirm", "Паролите се различават");
            }

            $email = $_POST['email'];
            $paternEmail = "/[a-zA-Z0-9._%+-]+@[a-zA-Z]*.[a-z]{2,4}/";
            if (!preg_match($paternEmail, $email )) {
                $this->addErrorMessage("Неправилен email адрес : some_text4@some.domain");
                $this->setValidationError("email","Непрвилен email");
            } else {

            }
            if($this->formValid()){
                $userId = $this->model->register($username, $password, $email);
                if($userId){
                    $this->addInfoMessage("Регистрацията е успешна, но се налага да изчакате одобрение от Администратора.");
                    $this->redirect("");
                }
                else{
                    $this->addErrorMessage("Има проблем с Вашата регистрация. Моля опитайте по-късно.");
                }
            }
        }
    }

    public function logout()
    {
        $this->addInfoMessage("Излязаохте успешно от системата");
        $this->addErrorMessage("Моля изчакайте одобрение от администратора");
        session_destroy();
        $this->redirect("");
    }

    public function index()
    {
        $this->authorize();
        if ($_SESSION['ustatus'] == 'Активиран' && $_SESSION['pstatus'] == 'Активиран'){
            $this->users = $this->model->getAll();
            $school = $this->model->getSchool();
            $this->school = $school;
            $userID = $_SESSION['user_id'];

            $getposition = $this->model->getPosition();
            $this->getposition = $getposition;

            if (isset($_GET['position'])){
                if ($_GET['position'] != $_SESSION['positionID'] ) {
                    $this->addErrorMessage("нямате достатъчно права");
                    $this->redirectToUrl("../");
                }
                if($_GET['position'] == 2 ){
                    $classgrp = $_SESSION['classgrp'];
                    $classstp = $_SESSION['classstp'];
                    $studentinfo = $this->model->getAllStudents($classgrp,$classstp);
                    $this->studentsinfo = $studentinfo;
                    $subjects = $this->model->getSubjects();
                    $this->subjects = $subjects;
                }
                if($_GET['position'] == 3 ){
                    $this->teachers = $this->model->getAllTeachers();
                }

                if($_GET['position'] == 4 ){
                    $this->parents = $this->model->getAllParents();
                }
                if($_GET['position'] >= 5 ){
                    $this->addErrorMessage("няма такава страница");
                    $this->redirectToUrl("../");
                }
            }
            if (isset($_GET['teachers'])){
                $this->teachers = $this->model->getAllTeachers();
            }
            if (isset($_GET['students'])){
                $this->students = $this->model->getAllStudents();
            }
            if (isset($_GET['parents'])){
                $this->parents = $this->model->getAllParents();
            }
        }
        else{
            $this->addInfoMessage("Може би трябва да бъдете одобрен от Администратора");
            $this->redirect("");
        }
    }
}

