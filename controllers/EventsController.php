<?php
class EventsController extends BaseController
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
        $this->events = $this->model->getAll();
    }

    public function create()
    {
        if ($this->isPost){
            $title =$_POST['event_title'];
            if(strlen($title)<1){
                $this->setValidationError("event_title", "Title cannot be ");
            }
            $content = $_POST['event_content'];
            if(strlen($content) < 1){
                $this->setValidationError("event_content", "content cannot be emprty");
            }
            if ($this->formValid()){
                $teacherId = $_SESSION['teacherID'];
                if($this->model->create($title, $content, $teacherId)){
                    $this->addInfoMessage("Event created.");
                    $this->redirect("events");
                }   else {
                    $this->addErrorMessage("Error:cannot create event.");
                }
            }
        }
    }
    
    public function edit(int $id)
    {
        if($this->isPost){
            $title = $_POST['event_title'];
            if(strlen($title) < 1){
                $this->setValidationError("event_title", "Title cannot be empty!");
            }
            $content = $_POST['event_content'];
            if(strlen($content) < 1){
                $this->setValidationError("event_content", "Conent cannot be emptry!");
            }
            $date = $_POST['event_date'];
            $dateRegex = '/^\d{2,4}-\d{1,2}-\d{1,2}( \d{1,2}:\d{1,2}(:\d{1,2})?)?$/';
            if (!preg_match($dateRegex, $date)){
                $this->setValidationError("event_date", "Invalid date!");
            }
            $userid = $_POST['user_id'];
            if ($userid <= 0 || $userid > 10000){
                $this->setValidationError("user_id", "Invalud autohr user ID!");
            }
            if ($this->formValid()) {
                if ($this->model->edit($id, $title, $content, $date, $userid)) {
                    $this->addInfoMessage("Post edited.");
                }else {
                    $this->addErrorMessage("Error: cannot edit post.");
                }
                $this->redirect('events');
            }
         }
        $event = $this->model->getById($id);
        if (!$event) {
            $this->addErrorMessage("Error: post does not exits.");
            $this->redirect("events");
        }
        $this->event = $event;
    }

    public function delete(int $id)
    {
        if($this->isPost){
            if($this->model->delete($id)){
                $this->addInfoMessage("Event deleted.");
            } else{
                $this->addErrorMessage("Errot: canot delete event.");
              }
            $this->redirect('events');
        }   else {
            $event = $this->model->getById($id);
            if(!$event){
                $this->addInfoMessage("Error: event does not exist.");
                $this->redirect("events");
            }
            $this->event = $event;
        }
    }
}

?>