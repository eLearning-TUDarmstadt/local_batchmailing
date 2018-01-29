<?php

namespace local_batchmailing\task;

require_once __DIR__.'/../classes/batch/constant_batchsize.php';
require_once __DIR__.'/../classes/batchmailing.php';

use local_batchmailing\Batchmailing;
use local_batchmailing\batch\ConstantBatchsize;

class send_batchmails extends \core\task\scheduled_task {

    private $mailer;
    
    function __construct() {
        
        $numOfMessages = get_config('local_batchmailing', 'numofmessages');
        $batchSize = new ConstantBatchsize($numOfMessages);
        $this->mailer = new Batchmailing($batchSize);
    }
    
    public function get_name() {
        return get_string('crontask','batchmailing');
    }

    public function execute() {
        $this->mailer->sendNextBatch();
    }

}