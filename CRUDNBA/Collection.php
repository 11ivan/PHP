<?php
/**
 * Created by PhpStorm.
 * User: icastillo
 * Date: 17/11/2017
 * Time: 0:07
 */

class Collection implements ArrayAccess,IteratorAggregate
{
    public $objectArray = Array();
    //**these are the required iterator functions
    function offsetExists($offset)
    {
        if(isset($this->objectArray[$offset]))  return TRUE;
        else return FALSE;
    }

    function & offsetGet($offset)
    {
        if ($this->offsetExists($offset))  return $this->objectArray[$offset];
        else return (false);
    }

    function offsetSet($offset, $value)
    {
        if ($offset)  $this->objectArray[$offset] = $value;
        else  $this->objectArray[] = $value;
    }

    function offsetUnset($offset)
    {
        unset ($this->objectArray[$offset]);
    }

    function & getIterator()
    {
        return new ArrayIterator($this->objectArray);
    }
    //**end required iterator functions

    public function doSomething()
    {
        echo "I'm doing something";
    }
}

/*
$bob = new Collection();
$bob->doSomething();
$bob[] = new Contact();
$bob[5] = new Contact();
$bob[0]->set_name("Superman");
$bob[5]->set_name("a name of a guy");

foreach ($bob as $aContact)
{
     echo $aContact->get_name() . "\r\n";
}

 */