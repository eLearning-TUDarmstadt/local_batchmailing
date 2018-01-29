<?php

namespace batchmailing\message;

interface MessageCreator {
    public function createMessage($user);    
}