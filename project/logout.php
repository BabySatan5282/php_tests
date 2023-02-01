<?php
include "core/autoload.php";
session_destroy();
Helper::redirect("login.php");
