<?php

namespace Src\Controllers;

use Core\HttpFoundation\Request;
use Core\Template\Template;

use Src\Repository\EventRepository;
use Src\Repository\UserRepository;

class AdminController
{
    public function getAction(Request $request)
    {
        $events = EventRepository::getAllEvents();
        return Template::view('admin/home.html', ['events' => $events]);
    }

    public function eventEditGetAction(Request $request)
    {
        $event = EventRepository::getEventById((int) $request->getParameters()['eid']);
        $managers = UserRepository::getAllManagers();
        return Template::view('admin/event_edit.html', ['event' => $event, 'managers' => $managers]);
    }
    public function eventEditPostAction(Request $request)
    {
        EventRepository::changeEvent($request->getParameters());
        global $router;
        $router->redirect('admin');
    }
    public function eventDeleteAction(Request $request)
    {
        EventRepository::deleteEvent((int) $request->getParameters()['eid']);
        global $router;
        $router->redirect('admin');
    }
    public function eventNewGetAction(Request $request)
    {
        $managers = UserRepository::getAllManagers();
        return Template::view('admin/event_new.html', ['managers' => $managers]);
    }
    public function eventNewPostAction(Request $request)
    {
        global $router;
        EventRepository::newEvent($request->getParameters());
        $router->redirect('admin');
    }

    public function logoutAction(Request $request)
    {
        global $router;
        session_destroy();
        $router->redirect('home');
    }
}