<?php

namespace Src\Controllers;

use Core\HttpFoundation\Request;
use Core\Template\Template;

use Src\Repository\EventRepository;
use Src\Repository\UserRepository;

class ManagerController
{
    public function getAction(Request $request)
    {
        $events = EventRepository::getAllEvents();
        return Template::view('manager/home.html', ['events' => $events]);
    }

    public function eventEditGetAction(Request $request)
    {
        $event = EventRepository::getEventById((int) $request->getParameters()['eid']);
        $managers = UserRepository::getAllManagers();
        return Template::view('manager/event_edit.html', ['event' => $event, 'managers' => $managers]);
    }
    public function eventEditPostAction(Request $request)
    {
        EventRepository::changeEvent($request->getParameters());
        global $router;
        $router->redirect('manager');
    }
    public function eventDeleteAction(Request $request)
    {
        EventRepository::deleteEvent((int) $request->getParameters()['eid']);
        global $router;
        $router->redirect('manager');
    }
    public function eventNewGetAction(Request $request)
    {
        $managers = UserRepository::getAllManagers();
        return Template::view('manager/event_new.html', ['managers' => $managers]);
    }
    public function eventNewPostAction(Request $request)
    {
        global $router;
        EventRepository::newEvent($request->getParameters());
        $router->redirect('manager');
    }
}