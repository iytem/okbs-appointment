<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This file is part of Auth_Ldap.

    Auth_Ldap is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Auth_Ldap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Auth_Ldap.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
/**
 * Auth_ldap Class
 *
 * Simple LDAP Authentication library for CodeIgniter.
 *
 * @package         Auth_Ldap
 * @author          Greg Wojtak <gwojtak@techrockdo.com> and Ahmet AKÞÝT <ahmetaksit@gmail.com>
 * @version         0.6
 * @link            http://www.techrockdo.com/projects/auth_ldap
 * @license         GNU Lesser General Public License (LGPL)
 * @copyright       Copyright Â© 2010,2011 by Greg Wojtak <gwojtak@techrockdo.com>
 * @todo            Allow for privileges in groups of groups in AD
 * @todo            Rework roles system a little bit to a "auth level" paradigm
 */
class Auth_ldap {
    function __construct() {
        $this->ci =& get_instance();

        log_message('debug', 'Auth_Ldap initialization commencing...');

        // Load the session library
        //aa $this->ci->load->library('session');

        // Load the configuration
        $this->ci->load->config('auth_ldap');

        // Load the language file
        // $this->ci->lang->load('auth_ldap');

        $this->_init();
    }

    
    /**
     * @access private
     * @return void
     */
    private function _init() {

        // Verify that the LDAP extension has been loaded/built-in
        // No sense continuing if we can't
        if (! function_exists('ldap_connect')) {
            show_error('LDAP functionality not present.  Either load the module ldap php module or use a php with ldap support compiled in.');
            log_message('error', 'LDAP functionality not present in php.');
        }

        $this->hosts = $this->ci->config->item('hosts');
        $this->ports = $this->ci->config->item('ports');
        $this->basedn = $this->ci->config->item('basedn');
        $this->account_ou = $this->ci->config->item('account_ou');
        $this->login_attribute  = $this->ci->config->item('login_attribute');
        $this->use_ad = $this->ci->config->item('use_ad');
        $this->ad_domain = $this->ci->config->item('ad_domain');
        $this->proxy_user = $this->ci->config->item('proxy_user');
        $this->proxy_pass = $this->ci->config->item('proxy_pass');
        $this->items = $this->ci->config->item('items');
        $this->auditlog = $this->ci->config->item('auditlog');
        $this->member_attribute = $this->ci->config->item('member_attribute');
        //$this->userlists = $this->ci->config->item('userlists');
    }

    /**
     * @access public
     * @param string $username
     * @param string $password
     * @return bool 
     */
    function login($username, $password) {
        // error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        /*
         * For now just pass this along to _authenticate.  We could do
         * something else here before hand in the future.
         */
        $user_info = $this->_authenticate($username,$password);
        log_message('info', 'user_info '.$user_info);
        
        //aa
        $items = $this->_get_items($username);
        //log_message('info', 'user_info '.$bilgi);
        //aa

        // Set the session data
        if ($items['acct-aktif'] == 1) {
            $items['aktif'] = TRUE;
        }
        else
        {
             $items['aktif'] = FALSE;    
        }
    
        //aa $this->ci->session->set_userdata($customdata);
        return $items;
    }

    /**
     * @access public
     * @return bool
     */
    /*
    function is_authenticated() {
        if($this->ci->session->userdata('logged_in')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }*/
    
    /*
     * yetkili kullanÄ±cÄ± listesi kontrolÃ¼
     */
    /*
    function is_username($username){
        $is_yetkili = in_array($username,$this->userlists);
        if (! $is_yetkili) {
            $this->_audit("Successful login but not an entry : (".$username.") from ".$this->ci->input->ip_address());
        }
        return $is_yetkili;
    }*/
    
    /**
     * @access public
     */
    /*
    function logout() {
        // Just set logged_in to FALSE and then destroy everything for good measure
        $this->ci->session->set_userdata(array('logged_in' => FALSE));
        $this->ci->session->sess_destroy();
    }*/

    /**
     * @access private
     * @param string $msg
     * @return bool
     */
    private function _audit($msg){
        $date = date('Y/m/d H:i:s');
        if( ! file_put_contents($this->auditlog, $date.": ".$msg."\n",FILE_APPEND)) {
            log_message('info', 'Error opening audit log '.$this->auditlog);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * @access private
     * @param string $username
     * @param string $password
     * @return array 
     */
    private function _authenticate($username, $password) {
        
        //bu satýrda birden fazla ldap sunucuya baðlanmaktatýr. port bilgisi alýnmamaktadýr. (389) default kullanýlýyor.
        foreach($this->hosts as $host) {
            $this->ldapconn = ldap_connect($host);
            if($this->ldapconn) {
               break;
            }else {
                log_message('info', 'Error connecting to '.$uri);
            }
        }
        // At this point, $this->ldapconn should be set.  If not... DOOM!
        if(! $this->ldapconn) {
            log_message('error', "Couldn't connect to any LDAP servers.  Bailing...");
            show_error('Error connecting to your LDAP server(s).  Please check the connection and try again.');
        }

        // We've connected, now we can attempt the login...
        
        // These to ldap_set_options are needed for binding to AD properly
        // They should also work with any modern LDAP service.
        ldap_set_option($this->ldapconn, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($this->ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        
        $binddn = $this->login_attribute.'='.$username.','.$this->basedn;

        log_message('debug', 'AA $binddn = '.$binddn);

        // Now actually try to bind as the user
       // $bind = ldap_bind($this->ldapconn, $binddn, $password);
        $bind = @ldap_bind($this->ldapconn, $binddn, $password);
        
        if ($bind) 
        {
            // Record the login
            $this->_audit("Successful login: (".$username.") from ".$this->ci->input->ip_address());
            return TRUE;
        }
        else
        {
            // Record the not Login
            $this->_audit("Failed login attempt: ".$username." from ".$_SERVER['REMOTE_ADDR']);
            return FALSE;
        }
    }

    /**
     * @access private
     * @param string $str
     * @param bool $for_dn
     * @return string 
     */
    /*
    private function ldap_escape($str, $for_dn = false) {
        /**
         * This function courtesy of douglass_davis at earthlink dot net
         * Posted in comments at
         * http://php.net/manual/en/function.ldap-search.php on 2009/04/08
         */
        // see:
        // RFC2254
        // http://msdn.microsoft.com/en-us/library/ms675768(VS.85).aspx
        // http://www-03.ibm.com/systems/i/software/ldap/underdn.html  
        /*
        if  ($for_dn)
            $metaChars = array(',','=', '+', '<','>',';', '\\', '"', '#');
        else
            $metaChars = array('*', '(', ')', '\\', chr(0));

        $quotedMetaChars = array();
        foreach ($metaChars as $key => $value) $quotedMetaChars[$key] = '\\'.str_pad(dechex(ord($value)), 2, '0');
        $str=str_replace($metaChars,$quotedMetaChars,$str); //replace them
        return ($str);  
    }*/
    
     /**
     * @access private
     * @param string $username
     * @return array
     */
    private function _get_items($username) {
    
        log_message('debug', "get_role: username =>".$username);
        $filter = '('.$this->member_attribute.'='.$username.')';
        log_message('debug', "get_role: filter =>".$filter);
        $search = ldap_search($this->ldapconn, $this->basedn, $filter, $this->items);
        log_message('debug', "get_role: search =>".$filter);
        if(! $search ) {
            log_message('error', "Error searching for group:".ldap_error($this->ldapconn));
            show_error('Couldn\'t find groups: '.ldap_error($this->ldapconn));
        }
        $results = ldap_get_entries($this->ldapconn, $search);
        log_message('debug', "get_role: results =>".print_r($results,true));
      
        if($results['count'] != 0) {
            $get_items = array();
            for($i = 0; $i < count($this->items); $i++) {
                $get_items[$this->items[$i]] = $results[0][$this->items[$i]][0];
                log_message('debug', "get_items: items =>".$this->items[$i]."; value =>".$get_items[$this->items[$i]]);
            }
            log_message('debug', "get_items: get_items =>". print_r($get_items,true));
            return $get_items;
        }
        return false;
    }
    
     /**
     * @access private
     * @param string $username
     * @return int
     */
    /*
    private function _get_role($username) {
    
        $filter = '('.$this->member_attribute.'='.$username.')';
        $search = ldap_search($this->ldapconn, $this->basedn, $filter, array('cn'));
        if(! $search ) {
            log_message('error', "Error searching for group:".ldap_error($this->ldapconn));
            show_error('Couldn\'t find groups: '.ldap_error($this->ldapconn));
        }
        $results = ldap_get_entries($this->ldapconn, $search);
        if($results['count'] != 0) {
            for($i = 0; $i < $results['count']; $i++) {
                $role = array_search($results[$i]['cn'][0], $this->roles);
                if($role !== FALSE) {
                    return $role;
                }
            }
        }
        return false;
    }*/
}

