<?php
if (isset($_SESSION['role']) && $_SESSION['role'] = 'manager') {
    echo "<header class=\"w-100\">
        <ul class=\"w-75 mx-auto d-flex\">
            <li><a href=\"/parents\">Родители</a></li>
            <li><a href=\"/children\">Дети</a></li>
            <li><a href=\"/events\">События</a></li>
            <li><a href=\"/logout\">Выйти</a></li>
        </ul>
    </header>";
} else {
    echo "<header class=\"w-100\">
        <ul class=\"w-75 mx-auto d-flex\">
            <li><a href=\"/login\">Войти</a></li>
        </ul>
    </header>";
}