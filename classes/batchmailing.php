<?php

namespace batchmailing;

require_once __DIR__.'/util/constants.php';
require_once __DIR__.'/batch/constant_batchsize.php';

use batchmailing\util\Constants;
use batchmailing\batch\ConstantBatchsize;

class Batchmailing {
    
    private $batchSize = null;
    
    function __construct() {
        $numOfMessages = get_config('local_batchmailing', 'numofmessages');
        $batchSize = new ConstantBatchsize($numOfMessages);
        $this->setBatchSize($batchSize);
    }
    
    public function setBatchSize($batchSize) {
        $this->batchSize = $batchSize;
    }
    
    public function sendNextBatch() {
        
        $messages = $this->getNextBatch();
        foreach($messages as $message) {
            message_send($message);
        }
    }
    
    
    public function saveMessages($messages) {
        global $DB;
        
        foreach($messages as $message) {
            $DB->insert_record('message', $message);
        }
    }
    
    public function createMessages($messageCreator, $recipientList) {
        
        $creator = function ($u) use ($messageCreator) { 
            return $messageCreator->createMessage($u); 
        };
        
        return array_map($creator, $recipientList->get());
    }
    
    public function getNextBatch() {
        $size = $this->batchSize->next();
        return $this->getPendingMessages('timecreated', '*', 0, $size);
    }
    
    private function getPendingMessages($sort = '', $fields='*', $limitfrom = 0, $limitnum = 0) {
        
        global $DB;
        
        $conditions = array('eventtype' => Constants::eventType, 'component' => Constants::component);
        $messages = array();
        
        if(isset($conditions['eventtype']) && isset($conditions['component'])) {
            $messages = $DB->get_records('message', $conditions, $sort, $fields, $limitfrom, $limitnum = 0);
        }
        return $messages;
    }
    
    
}