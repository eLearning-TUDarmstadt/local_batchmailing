<?php

namespace local_batchmailing\recipients;

require_once __DIR__.'/recipient_list.php';

class ConditionalRecipients implements RecipientList{
    
    private $conditions = null;
    
    function __construct($conditions) {
        $this->conditions = $conditions;
    }
    
    public function get() {
        global $DB;
        return $DB->get_records('user', $this->conditions, '', 'id');
    }
    
}