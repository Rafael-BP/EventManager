<?php

namespace App;

use App\Interfaces\Listener as ListenerInterface;

class Listener implements ListenerInterface
{
    
    abstract function update();
    
}

