<?php
namespace App\Support\Filter;

use Illuminate\Http\Request;

abstract class QueryFilter{

    public $request;
    public $query;

    public function __construct(Request $request ) {
        $this->request = $request;
    }

    public function methods()
    {
        return $this->request->all();
    }

    public function apply($query)
    {
        $this->query=$query;
        foreach ($this->methods() as $key => $value) {

            if(method_exists($this,$key)){
                call_user_func_array([$this,$key],array_filter([$value]));
            }
            
        }       
        return $this->query;
    }

}