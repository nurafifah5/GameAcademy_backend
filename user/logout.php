<?php

SESSION_START();

SESSION_UNSET($_SESSION);

unset($_SESSION['user_id']);
unset($_SESSION['token']);
unset($_SESSION['level']);

SESSION_DESTROY();

header("Location: http://localhost/gameacademy_backend/");

?>