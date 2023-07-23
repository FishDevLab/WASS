<?php

namespace Indorker;

use Indorker\Core as Core;

function __init__()
{
    require_once('core/core.php');
    $init = new Core\Core();
    $init -> start();
}
__init__();
?>
