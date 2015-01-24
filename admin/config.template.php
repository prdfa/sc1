<?php return array (
  'base_url' => 'http://localhost/socialauth/',
  'networks' => 
  array (
    'facebook' => 
    array (
      'name' => 'Facebook',
      'enabled' => true,
      'keys' => 
      array (
        'key' => '',
        'secret' => '',
      ),
    ),
    'twitter' => 
    array (
      'name' => 'Twitter',
      'enabled' => false,
      'keys' => 
      array (
        'key' => '',
        'secret' => '',
      ),
    ),
    'linkedin' => 
    array (
      'name' => 'Linkedin',
      'enabled' => true,
      'keys' => 
      array (
        'key' => '',
        'secret' => '',
      ),
    ),
    'yahoo' => 
    array (
      'name' => 'Yahoo',
      'enabled' => true,
      'keys' => 
      array (
        'key' => '',
        'secret' => '',
      ),
    ),
    'google' => 
    array (
      'name' => 'Google',
      'enabled' => true,
      'keys' => 
      array (
        'key' => '',
        'secret' => '',
      ),
    ),
  ),
  'debug_enabled' => false,
  'log_file' => '',
  'db' => 
  array (
    'enabled' => true,
    'host' => 'localhost',
    'username' => '',
    'password' => '',
    'dbname' => 'socialauth',
    'tbl_users' => 'sa_users',
    'clmn_user_username' => 'username',
    'clmn_user_email' => 'email',
    'clmn_user_password' => 'password',
  ),
);