<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------
  |  Aauth Config
  | -------------------------------------------------------------------
 */


// Config variables

$config['aauth'] = array(
    'login_page' => '/login',

    'no_permission' => '/403.php',
    'admin_group' => 'admin',
    'public_group' => 'public',
    'users' => 'cms_aauth_users',
    'groups' => 'cms_aauth_groups',
    'user_to_group' => 'cms_aauth_user_to_group',
    'perms' => 'cms_aauth_perms',
    'perm_to_group' => 'cms_aauth_perm_to_group',

    'remember' => ' +3 days',

    'max' => 13,

    'valid_chars' => array(' ', '\''),

    'ddos_protection' => true,

    'recaptcha_active' => false,
    'recaptcha_login_attempts' => 4,
    'recaptcha_siteKey' => '',
    'recaptcha_secret' => '',

    'max_login_attempt' => 10,

    'verification' => false,

    'email' => '',
    'name' => ''

);


/* End of file aauth.php */
/* Location: ./application/config/aauth.php */
