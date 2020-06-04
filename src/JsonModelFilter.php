<?php

namespace EloquentFilter;

use EloquentFilter\ModelFilter;

class JsonModelFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];


    /**
     * @var string[]
     * 
     * [
     *  'type' => 'filterType',
     *  'status' => 'filterStatus',
     * ]
     */
    public $filterKeyMapping = [];


    /**
     * Wendet Filter aus einen JSON Objekt an.
     *
     * @param $json
     */
    public function filters($json)
    {
        $filters = json_decode($json);

           if($filters) {
            foreach ($filters as $key => $value) {
                if(!empty($value)){
                    $methodName = $this->filterMapping[$key];

                    if(method_exists($this, $methodName)) {
                        $this->{$methodName}($value);
                    }
                }

            }

        }
    }
}
