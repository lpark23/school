<?php

class HomeController extends BaseController
{
    function index() {
        $events = $this->model->getLatestEvents(6);
        $this->events = array_slice($events,0,4 );
        $this->eventsSidebar = $events;
        $school = $this->model->getSchool();
        $this->school = $school;
    }

    function view(int $id) {
        $this->school = $this->model->getSchool();
        $event = $this->model->getEventById($id);
        if(!$event){
            $this->addErrorMessage("Error: invalid event id.");
            $this->redirect("");
        }
        $this->event = $event;
    }
}
