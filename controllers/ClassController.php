<?php
class ClassController extends EventsController
{
    function onInit()
    {
        $this->authorize();
        if ($_SESSION['ustatus'] == 'Активиран' && $_SESSION['pstatus'] == 'Активиран' ){
        }
        else{
            $this->addInfoMessage("Може би трябва да бъдете одобрен от Администратора");
            $this->redirect("");
        }
    }

    public function index()
    {
        $school = $this->model->getSchool();
        $this->school = $school;
        $allclass = $this->model->getClassGroup();
        $this->classAll = $allclass;

        $classgroup = $this->model->getClassGroup();
        $this->classgroup = $classgroup;

        $classNumber = $this->model->selectClassNumber();
        $this->classNumber = $classNumber;

        $classLetter = $this->model->selectClassLetter();
        $this->classLetter = $classLetter;

        $studyperiod = $this->model->getStudyPeriod();
        $this->studyperiod = $studyperiod;

        $subjects = $this->model->getSubjects();
        $this->subjects = $subjects;

        if (isset($_GET['availablePeriod'])){
            $period = $_GET['availablePeriod'];

            $classByNumber = $this->model->selectClassByNumber($period);
            $this->classByNumber = $classByNumber;
            $subjects = $this->model->getSubjects();
            $this->subjects = $subjects;
        }

        if (isset($_GET['classletter']) && isset($_GET['period'])  ){

            $TeacherID = $_SESSION['teacherID'];
            $classID = $_GET['classletter'];
            $classgrp = $_GET['classletter'];
            $period = $_GET['period'];

            $classByID = $this->model->getClassBy($classID, $period);
            $this->classbyid = $classByID;

            $subjects = $this->model->getSubjects();
            $this->subjects = $subjects;


            $students = $this->model->getStudentBy($classgrp, $period);
            $this->students = $students;

            if (isset($_SESSION['teacherID'])){
                $teachercon = $this->model->teachersConectsBy($classgrp, $period, $TeacherID);
                $this->teachercon = $teachercon;
            }
            else {
//                $studentsubject = $this->model->getStudentSubjects();
            }
            if ($this->isPost){
                if (isset($_POST['mark']) && isset($_POST['TeacherID']) && isset($_POST['StudentID'])&& isset($_POST['SubjectID'])){
                    $mark = $_POST['mark'];
                    $teacherID = $_POST['TeacherID'];
                    $studentID = $_POST['StudentID'];
                    $subjectID = $_POST['SubjectID'];

                    if($this->model->setExamMark($studentID, $teacherID, $subjectID, $mark)){
                        if ($this->formValid()){
                            $this->addInfoMessage("Студентът беше оценен успешно.");
                            $this->redirectToUrl("/school/class/index/?classletter=".$classID."&period=".$period);
                        }
                        else {
                            $this->addErrorMessage("Грешка.");
                        }
                    }
                }
                if (isset($_POST['editmark']) && isset($_POST['MarkID'])){

                    $markID = $_POST['MarkID'];
                    $editmark = $_POST['editmark'];

                    if($this->model->updateEvaluation($editmark, $markID)){
                        if ($this->formValid()){
                            $this->addInfoMessage("Променихте оценка");
                            $this->redirectToUrl("/school/class/index/?classletter=".$classID."&period=".$period);
                        }
                        else {
                            $this->addErrorMessage("Грешка.");
                        }
                    }
                }
                if (isset($_POST['MarkIDdelete'])){
                    $markIDdelete = $_POST['MarkIDdelete'];


                    if($this->model->deleteEvaluation($markIDdelete)){
                        if ($this->formValid()){
                            $this->addInfoMessage("Променихте оценка");
                            $this->redirectToUrl("/school/class/index/?classletter=".$classID."&period=".$period);
                        }
                        else {
                            $this->addErrorMessage("Грешка.");
                        }
                    }
                }
            }
        }

        if ((isset($_GET['student']) && isset($_GET['subject'])) ){

            $studentid = $_GET['student'];

            $studentbyid = $this->model->getStudentByID($studentid);
            $this->studentbyid = $studentbyid;

            $this->HomeClass = $this->model->getHomeClassBy($studentid);
            $subject = $_GET['subject'];

            $subjects = $this->model->getSubjectBy($subject);
            $this->subjects = $subjects;

            $studentMarks = $this->model->getStudEvaluationBy($studentid,$subject);
            $this->studentmarks = $studentMarks;

            $this->teacherBySubject = $this->model->teachersteachingBy($subject);
            if (isset($_GET['evaluation'])){

                $markID = $_GET['evaluation'];
                $this->examMarkID = $this->model->getEvaluationBy($markID);

            }
            if ($this->isPost){
                if (isset($_POST['student']) && isset($_POST['subject']) && isset($_POST['evaluation']) && isset($_POST['teacher'])){
                    $studentpost = $_POST['student'];// validaciq zadyljitelno, ifove mifove kvoto e neobhodimo
                    $subjectpost = $_POST['subject'];//syshto
                    $mark = $_POST['evaluation'];
                    $teacherid = $_POST['teacher'];

                    if($this->model->setExamMark($studentpost, $teacherid, $subjectpost, $mark)){
                        if ($this->formValid()){
                            $this->addInfoMessage("Студентът беше оценен успешно.");
                            $this->redirectToUrl("/school/class/index/?student=".$studentid."&subject=".$subject);
                        }
                        else {
                            $this->addErrorMessage("Грешка.");
                        }
                    }
                }

                if (isset($_POST['editmark']) && isset($_POST['MarkID'])){

                    $markID = $_POST['MarkID'];
                    $editmark = $_POST['editmark'];


                    if($this->model->updateEvaluation($editmark, $markID)){
                        if ($this->formValid()){
                            $this->addInfoMessage("Променихте оценка");
                            $this->redirectToUrl("/school/class/index/?student=".$studentid."&subject=".$subject);
                        }
                        else {
                            $this->addErrorMessage("Грешка.");
                        }
                    }
                }
                if (isset($_POST['MarkIDdelete'])){
                    $markIDdelete = $_POST['MarkIDdelete'];


                    if($this->model->deleteEvaluation($markIDdelete)){
                        if ($this->formValid()){
                            $this->addInfoMessage("Изтрихте оценка");
                            $this->redirectToUrl("/school/class/index/?student=".$studentid."&subject=".$subject);
                        }
                        else {
                            $this->addErrorMessage("Грешка.");
                        }
                    }
                }
            }
        }
    }

    public function create()
    {
        $school = $this->model->getSchool();
        $this->school = $school;

        $studyperiod = $this->model->getStudyPeriod();
        $this->studyperiod = $studyperiod;
        $classgroup = $this->model->getClassGroup();
        $this->classgroup = $classgroup;
        $subjects = $this->model->getSubjects();
        $this->subjects = $subjects;

        $this->classnumbers = $this->model->getClassNumber();

        $this->classletters = $this->model->getClassLetter();



        if ($this->isPost){
            if (isset($_POST['term']) && isset($_POST['termyear'])){
                $term = $_POST['term'];
                if ($term == 'първи' || $term == 'втори' || $term == 'трети'){
                }
                else{
                    $this->addErrorMessage("Грешен учебен срок");
                    $this->setValidationError("term", "Грешен учебен срок");
                }
                $termYear = $_POST['termyear'];
                $fromYear = strtotime("01-01-1999 0:0:01");
                $toYear = strtotime("01-01-2020 0:0:01");
                $orgterm = strtotime("01-01-{$termYear} 0:0:01");

                if ($orgterm <= $fromYear && $orgterm >= $toYear){
                    $this->addErrorMessage("Грешна учебна година. Между 1999 и 2020-та.");
                    $this->setValidationError("termYear", "Грешна учебна година.");
                }

                if($this->model->createStudyPeriod($term, $termYear)){
                    if ($this->formValid()){
                        $this->addInfoMessage("Учебният период беше добавен");
                        $this->redirectToUrl("/school/class/create");
                    }
                    else {
                        $this->addErrorMessage("Грешка, неуспешно създаден учебен период.");
                    }
                }
            }
            if (isset($_POST['number']) && isset($_POST['letter'])){
                $number = $_POST['number'];
                $letter = $_POST['letter'];

                if ($this->formValid()){
                    if($this->model->createClassGroup($number, $letter)){
                        $this->addInfoMessage("Класът беше добавен");
                        $this->redirectToUrl("create/");
                    }   else {
                        $this->addErrorMessage("Грешка, неуспешно създаване клас и подгрупа.");
                    }
                }
            }
            if (isset($_POST['subject']) && isset($_POST['abb'])){
                $subject = $_POST['subject'];
                $abb = $_POST['abb'];

                if ($this->formValid()){
                    if($this->model->createSubject($subject, $abb)){
                        $this->addInfoMessage("Предметът беше добавен");
                        $this->redirectToUrl("create/");
                    }   else {
                        $this->addErrorMessage("Грешка, неуспешно добавяне на предмет");
                    }
                }
            }
        }
    }

}

?>