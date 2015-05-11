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
     *     "EventName1" => array(
     *         0 => callable,
     *         1 => concreteListener
     *         ...
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
     * Add a callable or listener to a new or existent event
     * @param string $eventName
     * @param \App\Interfaces\Listener|callable $action
     */
    public function on($eventName, $action)
    {
        switch(true) {
	    case ( ($action instanceof callable) || ($action instanceof Listener) ):
		
		// The block below you can use for control or remove it
		$events = $this->getEvents();
		if (array_key_exists("attach", $events)) {
		    $this->dispatch("attach", array($eventName, $action));
		}
		
              	$this->events[$eventName][] = $action;
               	break;
            default:
               	throw new \InvalidArgumentException("Invalid type of action provided for event manager", 400);
        }
    }
    
    /**
     * Dispatch event
     * @param string $eventName
     * @param array $args Optional args for event actions
     * If you event have more than one action, unless all the actions dont have
     * any args, the args array need to be a array of arrays, each index of the
     * args array need to corresponds to the index of the action in the event 
     * array to work properly. 
     */
    public function dispatch($eventName, $args = array())
    {
        $events = $this->getEvents();
        if (array_key_exists($eventName, $events)) {
            $argsIndex = 0;
            foreach ($events[$eventName] as $action) {
                switch (true) {
                    case $action instanceof callable:
                        if ( (count($events[$eventName]) > 1) && !empty($args) ) {
                            call_user_func_array($action, $args[$argsIndex]);
                        } else {
                            call_user_func_array($action, $args);
                        }
                        break;
                    case $action instanceof Listener:
                        if ( (count($events[$eventName]) > 1) && !empty($args) ) {
                            $action->update($args[$argsIndex]);
                        } else {
                            $action->update($args);
                        }
                        break;
                    default:
                        throw new \InvalidArgumentException("Invalid type of action provided on event manager", 400); 
                }
                $argsIndex++;
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
        $events = $this->getEvents();
        if (array_key_exists($eventName, $events)) {
            return $events[$eventName];
        }
        return null;
    }
    
    /**
     * Remove event from events array
     * @param string $eventName
     */
    public function removeEvent($eventName)
    {  
        $events = $this->getEvents();
        if (array_key_exists($eventName, $events)) {
           $this->events = array_splice($events, $eventName, 1);
        }
    }
    
}

