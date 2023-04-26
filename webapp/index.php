<?php
session_start();

$request = $_SERVER['REQUEST_URI'];
$request = explode('?', $request);
if (isset($_SESSION['role']) && $_SESSION['role'] = 'manager') {
    switch ($request[0]) {
        case '/':
        case '':
        case '/events':
            require __DIR__ . '/views/admin_events.php';
            break;
        case '/parents':
            require __DIR__ . '/views/parent.php';
            break;
        case '/children':
            require __DIR__ . '/views/children.php';
            break;
        case '/logout':
            require __DIR__ . '/controllers/logout.php';
            break;
        case '/record_new':
            require __DIR__ . '/forms/record_new.php';
            break;
        case '/record_edit':
            require __DIR__ . '/forms/record_edit.php';
            break;
        case '/record_delete':
            require __DIR__ . '/controllers/record_delete.php';
            break;
        default:
            $_SERVER['REQUEST_URI'] = '';
            header('Refresh:0; url=/');
    }
} else {
    switch ($request[0]) {
        case '/':
        case '':
            require __DIR__ . '/views/events.php';
            break;
        case '/login':
            require __DIR__ . '/forms/login.php';
            break;
        case '/record':
            require __DIR__ . '/forms/record.php';
            break;
        default:
            $_SERVER['REQUEST_URI'] = '';
            header('Refresh:0; url=/');
    }
}