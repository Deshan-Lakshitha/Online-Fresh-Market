<?php

abstract class Model
{
    /** Abstract method to load records from the database. Use in some concrete models for loading different database records.
     * @param $param
     * @return mixed
     */
    public abstract function load($param);
}