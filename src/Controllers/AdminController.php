<?php

require_once(BASEDIR . '/core/HttpFoundation/Request.php');
require_once(BASEDIR . '/core/Template/Template.php');
require_once(BASEDIR . '/core/DBManager/MysqlConnectManager.php');

require_once(BASEDIR . '/src/Repository/EventRepository.php');
require_once(BASEDIR . '/src/Repository/ManagerRepository.php');
require_once(BASEDIR . '/src/Repository/ParentRepository.php');
require_once(BASEDIR . '/src/Repository/ChildRepository.php');

use Core\HttpFoundation\Request;
use Core\Template\Template;


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
        $managers = ManagerRepository::getAllManagers();
        return Template::view('admin/event_edit.html', ['event' => $event, 'managers' => $managers]);
    }
    public function eventEditPostAction(Request $request)
    {
        EventRepository::changeEvent($request->getParameters());
        global $router;
        $router->dispatch('/', 'GET');
    }
    public function eventDeleteAction(Request $request)
    {
        EventRepository::deleteEvent((int) $request->getParameters()['eid']);
        global $router;
        $router->dispatch('/', 'GET');
    }
    public function eventNewGetAction(Request $request)
    {
        $managers = ManagerRepository::getAllManagers();
        return Template::view('admin/event_new.html', ['managers' => $managers]);
    }
    public function eventNewPostAction(Request $request)
    {
        EventRepository::newEvent($request->getParameters());
        global $router;
        $router->dispatch('/', 'GET');
    }

    public function logoutAction(Request $request)
    {
        session_destroy();
        header("Location: /");
    }
    public function childrenAction(Request $request)
    {
        $children = ChildRepository::getAllChildren();
        return Template::view('admin/children.html', ['children' => $children]);
    }
    public function parentsAction(Request $request)
    {
        $parents = ParentRepository::getAllParents();
        return Template::view('admin/parents.html', ['parents' => $parents]);
    }
}