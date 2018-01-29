<?php

namespace local_batchmailing\recipients;

require_once __DIR__.'/recipient_list.php';

class LdapSync implements RecipientList {
    
    private $ldap;
    
    function __construct($ldap) {
        $this->ldap = $ldap;
    }
    
    public function get() {
        return $this->getMoodleStudents();
    }
    
    private function getMoodleStudents() {
        
        $ldapUsers = self::getLdapUsers();
        $dbUsers = self::getDbUsers();
        $intersection = array_intersect($ldapUsers, array_keys($dbUsers));
        $students = array_map(function($tuid) use ($dbUsers) { return $dbUsers[$tuid]; }, $intersection);
        
        return $students;
    }

    private function getLdapUsers($server, $basedn, $filter, $attributes) {
        
        $result = $this->ldapSearch($server, $basedn, $filter, $attributes);
        $ldapUsers = array_map(function($r) { return $r['cn'][0]; }, $result);
        
        return $ldapUsers;
    }
    
    private function ldapSearch($server, $basedn, $filter, $attributes) {
        
        $ldap = ldap_connect($server);
        ldap_bind($ldap);
        $search = ldap_search($ldap, $basedn, $filter, $attributes) or die("Error in search Query: " . ldap_error($ldap));
        $result = ldap_get_entries($ldap, $search);
        
        return $result;
    }
    
    private function getDbUsers() {
        
        global $DB;
        $dbUsers = $DB->get_records('user', array('deleted' => '0', 'suspended' => '0'), 'lastaccess desc', 'username, id');
        return $dbUsers;
    }
    
}