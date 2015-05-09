<?php

namespace App\Interfaces;

interface Event 
{    
    /**
     * Add Listener to Event
     * @param \App\Interfaces\Listener $listener
     */
    public function addListener(Listener $listener);
    
    /**
     * Remove Listener from Event
     * @param \App\Interfaces\Listener $listener
     */
    public function removeListener(Listener $listener);
    
}
