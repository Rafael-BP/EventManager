# Event Manager
![A simple event manager structure]
(http://i58.tinypic.com/2lke9w8.png)

### Description ###
This project have a PHP implementation of Event Manager structure as showed in the picture above. The objective of this structure is to be easy to use and have low burocracy.
<br/><br/>
You can create Events with the EventManager class, and assign actions to these events, these actions can be a callable or a class that implements the Listener interface (a concrete listener).
<br/><br/>
When you dispatch the event all the actions (the callable or the update method of the Listener implementation) will be executed. Optional args can be passed to then.

###The events array have the below structure:###
```
array(
  "EventName1" => array(
    0 => callable,
    1 => concreteListener,
    ...
  ),
  ...
)
```

###Use###
This structure can be easily used or adapted for a lot of things, it's not perfect so use it with wisdow.
