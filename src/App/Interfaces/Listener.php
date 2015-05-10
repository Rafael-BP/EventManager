<?php

namespace App\Interfaces;

interface Listener
{
    
    /**
     * Update listener, can recevei optional args array
     * @param array $args
     */
    function update($args = array());
    
}

