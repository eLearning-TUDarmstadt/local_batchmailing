<?php

namespace local_batchmailing\message;

require_once __DIR__.'/../util/constants.php';

use local_batchmailing\util\Constants;

class Message {
    
    public $component         = Constants::component;
    public $eventtype         = Constants::eventType;
    public $contexturl 	      = Constants::contextUrl;
    public $contexturlname    = Constants::contexturlname;
    public $smallmessage      = "";
    public $notification      = '0';
    
    public $useridfrom;
    public $useridto;
    public $subject;
    public $fullmessage;
    public $fullmessagehtml;
    public $replyTo;
    public $fullmessageformat;
    public $timecreated;
    
    function __construct($user, $subject, $content, $replyTo, $format = FORMAT_MARKDOWN) {
        
        global $USER;
        
        $this->useridfrom        = $USER->id;
        $this->useridto          = $user->id;
        $this->subject           = $subject;
        $this->fullmessage       = $content;
        $this->fullmessagehtml   = $content;
        $this->replyTo 	         = $replyTo;
        $this->fullmessageformat = $format;
        $this->timecreated       = time();
    }
    
}