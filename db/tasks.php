<?php

defined('MOODLE_INTERNAL') || die();

$tasks = array(
        array(
                'classname' => 'local_batchmailing\task\send_batchmails',
                'blocking' => 0,
                'minute' => '*/5',
                'hour' => '*',
                'day' => '*',
                'dayofweek' => '*',
                'month' => '*'
        )
);