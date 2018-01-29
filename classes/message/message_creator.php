<?php

namespace local_batchmailing\message;

interface MessageCreator {
    public function createMessage($user);    
}