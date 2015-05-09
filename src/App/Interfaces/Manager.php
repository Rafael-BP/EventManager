<?php

namespace App\Interfaces;

interface Manager
{
    /**
     * Do the dispatch of a specific event
     * @param string $eventName
     */
    public function dispatch($eventName);
    
    /**
     * Add action (Listener or callable) on a event name
     * @param string $eventName
     * @param Listener|function $action
     */
    public function on($eventName, $action);
    
}

