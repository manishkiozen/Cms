<?php namespace App\Commands;

abstract class Command {

    /**
     * Returns an array with command properties.
     *
     * @return array
     */
	public function getProperties()
    {
        return get_object_vars($this);
    }

}
