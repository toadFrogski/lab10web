<?php

require_once(BASEDIR . '/core/HttpFoundation/Request.php');
require_once(BASEDIR . '/core/Template/Template.php');
require_once(BASEDIR . '/src/Repository/EventRepository.php');
require_once(BASEDIR . '/src/Repository/RecordRepository.php');

use Core\HttpFoundation\Request;
use Core\Template\Template;

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