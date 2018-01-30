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
    
    static function coreMessage($object) {
        
        global $USER;
        
        $message = new \core\message\message();
        $message->component = $object->component;
        $message->name = $object->eventtype;
        
        $message->userfrom = $USER;
        $message->userto = \core_user::get_user($object->useridto);
        $message->userto->emailstop = 0;
        
        $message->subject = $object->subject;
        $message->fullmessage = $object->fullmessage;
        $message->fullmessageformat = FORMAT_HTML;
        $message->fullmessagehtml = $object->fullmessagehtml;
        $message->smallmessage = $object->smallmessage;
        $message->notification = $object->notification;
        
        $message->contexturl = $object->contexturl;
        $message->contexturlname = $object->contexturlname;
        $message->replyto = $object->replyTo;
        
        return $message;
        
    }
    
    
    
    
}