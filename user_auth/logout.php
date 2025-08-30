<?php
session_start();
session_unset();
session_destroy();
header("Location: /new_homee/home");
exit();
