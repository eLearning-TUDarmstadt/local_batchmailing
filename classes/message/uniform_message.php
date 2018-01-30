<?php

namespace local_batchmailing\message;

require_once __DIR__.'/message_creator.php';
require_once __DIR__.'/message.php';

class UniformMessage implements MessageCreator {
    
    public function __construct($subject, $content, $replyTo) {
        $this->subject = $subject;
        $this->content = $content;
        $this->replyTo = $replyTo;
    }
    
    public function createMessage($user) {
        
        return new Message($user, $this->subject, $this->content, $this->replyTo);                           
    }

    
}