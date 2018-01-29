<?php

namespace batchmailing\batch;

require_once __DIR__.'/batchsize.php';

class ConstantBatchsize implements Batchsize {
    
    protected $size = 200;
    
    function __construct($size) {
        $this->size = $size;
    }
    
    public function next() {
        return $this->size;
    }


}