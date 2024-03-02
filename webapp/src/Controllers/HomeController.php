<?php

namespace Src\Controllers;

use Core\HttpFoundation\Request;
use Core\Template\Template;

use Src\Repository\EventRepository;
use Src\Repository\RecordRepository;

class HomeController
{
    public function getAction(Request $request)
    {
        $events = EventRepository::getAllEvents();
        return Template::view('crafti/home.html', ['events' => $events]);
    }

    public function recordGetAction(Request $request)
    {
        return Template::view('crafti/record.html');
    }

    public function recordPostAction(Request $request)
    {
        RecordRepository::setRecord($request->getParameters());
        global $router;
        $router->dispatch('/', 'GET');
    }

}