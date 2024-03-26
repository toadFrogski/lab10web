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
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "manager" || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        $events = EventRepository::getAllEvents();
        return Template::view('manager/home.html', ['events' => $events]);
    }

    public function eventEditGetAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "manager" || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        $event = EventRepository::getEventById((int) $request->getParameters()['eid']);
        $managers = UserRepository::getAllManagers();
        return Template::view('manager/event_edit.html', ['event' => $event, 'managers' => $managers]);
    }
    public function eventEditPostAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "manager" || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        EventRepository::changeEvent($request->getParameters());
        global $router;
        $router->redirect('manager');
    }
    public function eventDeleteAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "manager" || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        EventRepository::deleteEvent((int) $request->getParameters()['eid']);
        global $router;
        $router->redirect('manager');
    }
    public function eventNewGetAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "manager" || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        $managers = UserRepository::getAllManagers();
        return Template::view('manager/event_new.html', ['managers' => $managers]);
    }
    public function eventNewPostAction(Request $request)
    {
        global $router;
        if (empty($_SESSION) || $_SESSION['role'] != "manager" || $_SESSION['role'] != "admin") {
            $router->redirect("loginGet");
        }
        global $router;
        EventRepository::newEvent($request->getParameters());
        $router->redirect('manager');
    }
}