<?php

namespace App;

use App\Interfaces\Event;
use App\Interfaces\Manager;
use App\Interfaces\Listener;

class EventManager implements Event, Manager
{    
    /*
     * This is the events array
     * @var array
     */
    private $events;
    
    /**
     * Construct
     */
    public function __construct()
    {
        $events = array();
    }
    
    /**
     * Add Listener to Event Name
     * @param string $eventName
     * @param \App\Interfaces\Listener $listener
     */
    private function addListener($eventName, Listener $listener)
    {    
       
    }
    
    /**
     * Remove Listener from Event Name
     * @param string $eventName
     * @param \App\Interfaces\Listener $listener
     */
    private function removeListener($eventName, Listener $listener)
    {    
       
    }
    
    /**
     * Add a callable or listener to a new or existent event name
     * @param string $eventName
     * @param Listener|function $action
     */
    public function on($eventName, $action)
    {
        
    }
    
    /**
     * Dispatch event
     * @param string $eventName
     */
    public function dispatch($eventName)
    {
        
    }
    
}

