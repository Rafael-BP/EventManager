<?php

namespace App;

use App\Interfaces\EventManager as EventManagerInterface;
use App\Interfaces\Listener;

class EventManager implements EventManagerInterface
{    
    /*
     * This is the events array
     * @var array
     * @example
     * array(
     *     0 => array(
     *         "name" => "eventName",
     *         "actions" => array(
     *             0 => callable,
     *             1 => concreteListener
     *             ...
     *         )
     *     )
     *     ...
     * )
     */
    private $events;
    
    /**
     * Construct
     */
    public function __construct()
    {
        $this->events = array();
    }
    
    /**
     * Add a callable or listener to a new or existent event name
     * @param string $eventName
     * @param \App\Interfaces\Listener|callable $action
     */
    public function on($eventName, $action)
    {
        $event = $this->getEvent($eventName);
        switch(true) {
            case ( ($action instanceof callable) || ($action instanceof Listener) ):
                if (!empty($event)) {
                    $key = array_search($event, $this->events);
                    $this->events[$key]["actions"][] = $action;
                } else {
                    $this->events[]["name"] = $eventName;
                    $this->events[]["actions"][] = $action;
                }
                break;
            default:
                throw new \InvalidArgumentException("Invalid type of action provided for event manager", 400);
        }
    }
    
    /**
     * Dispatch event
     * @param string $eventName
     * @param array $args Optional args for event actions
     */
    public function dispatch($eventName, $args = array())
    {
       $event = $this->getEvent($eventName);
       if (!empty($event)) {
           $key = array_search($event, $this->events);
           foreach ($this->events[$key]["actions"] as $action) {
               switch (true) {
                    case $action instanceof callable:
                        call_user_func_array($action, $args);
                        break;
                    case $action instanceof Listener:
                        $action->update($args);
                        break;
                    default:
                        throw new \InvalidArgumentException("Invalid type of action provided on event manager", 400); 
               }               
           }
       }
        
    }
    
    /**
     * Return events array
     * @return array
     */
    public function getEvents()
    {    
       return $this->events;
    }
    
    /**
     * Search and return event from the events array
     * @param string $eventName
     * @return array
     */
    public function getEvent($eventName)
    {
        $result = array();
        foreach ($this->getEvents() as $event) {
            if ($event['name'] == $eventName) {
                $result = $event;
            }
        }
        return $result;
    }
    
    /**
     * Remove event from events array
     * @param string $eventName
     */
    public function removeEvent($eventName)
    {  
       $events =  $this->events;
       $event = $this->getEvent($eventName); 
       $key = array_search($event, $events);
       $this->events = array_splice($events, $key, 1);
    }
    
}

