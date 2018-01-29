<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


defined('MOODLE_INTERNAL') || die;



if ($hassiteconfig) {
    
    $component = 'local_batchmailing';
    $plugintitle = get_string('plugintitle', $component);
    $numberOfMessages = get_string('numberofmessages', $component);
    $numberOfMessagesDesc = get_string('numberofmessages_description', $component);
    
    $settings = new admin_settingpage('local_batchmailing', $plugintitle);
    $ADMIN->add('localplugins', $settings);
    
    $settings->add(new admin_setting_configtext('local_batchmailing/numofmessages', $numberOfMessages, $numberOfMessagesDesc, 200, PARAM_INT));
    
    
}