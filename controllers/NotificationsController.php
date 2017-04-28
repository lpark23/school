<?php
class NotificationsController extends BaseController
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
        if ($_SESSION['positionID'] == 1){

        }
        else{
            $this->addInfoMessage("Тази страница е недостъпна за вас");
            $this->redirect("");
        }
    }

    public function index()
    {
        $school = $this->model->getSchool();
        $this->school = $school;

        $userST = $this->model->getAllUsers();
        $this->userST = $userST;

        $records = 0;
        $N = 6;

        $pro = $this->model->chekPro();
        $this->pro = $pro; //Общ брой записа след заявката

        $_SESSION['asd'] = $records + $N;
        $_SESSION['ass'] = $pro;

        if (isset($_GET['page'])) {
            if (!isset($_GET['page'])) {
                $page = 0;
            } else
                $page = $_GET['page'];


            $records = $page * $N;
            $profiles = $this->model->getAllProfile($records, $N);
            $this->profiles = $profiles;
        }

        $profiles = $this->model->getAllProfile($records, $N);
        $this->profiles = $profiles;

        if (isset($_GET['search'])){
            $search = $_GET['search'];
            $search = $this->model->searchEGN($search);
            $this->search = $search;
        }

        if ($this->isPost) {
            $ustatus = $_POST['ustatus'];
            $userid = $_POST['useridActive'];
            $pstatus = $_POST['pstatus'];
            $posid = $_POST['posID'];
            $profileID = $_POST['profileID'];

            if ($this->formValid()) {
                if (isset($ustatus))
                    $this->model->addUstatus($ustatus, $userid);
                if (isset($pstatus))
                    $this->model->addPstatus($pstatus, $userid);
                if (isset($posid))
                    $this->model->setPosition($posid, $userid);
                if (isset($profileID)) {
                    if ($posid == 1) {
                        $this->redirect("notifications");
                    }
                    if ($posid == 2) {
                        if ($this->model->insertStudent($posid, $profileID)){
                            $this->redirect("notifications");
                            $this->addInfoMessage("Записът беше променен.");
                        }
                    }
                    if ($posid == 3) {
                        if ($this->model->insertTeacher($posid, $profileID)){
                            $this->redirect("notifications");
                            $this->addInfoMessage("Записът беше променен.");
                        }
                    }
                    if ($posid == 4) {
                        if ($this->model->insertParent($posid, $profileID)){
                            $this->redirect("notifications");
                            $this->addInfoMessage("Записът беше променен.");
                        }
                    }
                }
                $this->redirect("notifications");
                $this->addInfoMessage("Записът беше променен.");
            }
        }

    }
}