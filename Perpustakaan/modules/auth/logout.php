<?php
session_start();
session_destroy();
header("Location: http://localhost/List_agenda/login");
exit;
