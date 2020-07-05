<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 12/6/2018
 * Time: 7:47 PM
 */

/*  Some HTTP security headers */

header('X-XSS-Protection: 1; mode=block');
header('X-Frame-Options: sameorigin');
header('X-Content-Type-Options: nosniff');
header('strict-transport-security: max-age=15552000');