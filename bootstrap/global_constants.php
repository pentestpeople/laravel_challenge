<?php 

/**
 * Define global constants for our application here..
 */
if (!function_exists('define_const')) {
    function define_const($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }     
    }
}

define_const('PAGE_LIMIT', 2);
define_const('SOMETHING_ERROR', 'Some error has been occurred..');
define_const('USER_NOT_FOUND', 'User not found with the provided email');
define_const('VALID_DATA_REGISTER', 'The given data was invalid.');
define_const('REGISTER_SUCCESS', 'User has registered successfully');
define_const('APP_TOKEN', 'pentest');
define_const('LOGIN_SUCCESS', 'User login successfully.');
define_const('UNAUTHORISED', 'Unauthorised User');
define_const('LISING_DATA', 'Listing data successful.');
define_const('LOGOUT_SUCCESS', 'User has successfully logged out');