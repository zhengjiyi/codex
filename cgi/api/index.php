<?php
/**
 * polygon
 * @author paperen<paperen@gmail.com>
 */

// 环境
define('ENV', 'test');

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
if ( !@include( ROOT.'core/polygon.php' ) ) exit('polygon missing');

Polygon::instance()->run();
