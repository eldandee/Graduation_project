<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Please login with your email/username and password below.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Remember Me:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Forgot your password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deaktivovat uživatele!';
$lang['deactivate_subheading']               = 'Jste si jisti, že chcete deaktivovat uživatele \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Ano:';
$lang['deactivate_confirm_n_label']          = 'Ne:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading']                           = 'Vytvoření uživatele';
$lang['create_user_subheading']                        = 'Please enter the users information below.';
$lang['create_user_fname_label']                       = 'Křestní jméno:';
$lang['create_user_lname_label']                       = 'Příjmení:';
$lang['create_user_identity_label']                    = 'Uživatelské jméno:';
$lang['create_user_company_label']                     = 'Organizace:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Telefon:';
$lang['create_user_password_label']                    = 'Heslo:';
$lang['create_user_password_confirm_label']            = 'Znovu heslo:';
$lang['create_user_submit_btn']                        = 'Vytvořit uživatele';
$lang['create_user_validation_fname_label']            = 'Křestní jméno';
$lang['create_user_validation_lname_label']            = 'Příjmení';
$lang['create_user_validation_identity_label']         = 'Uživatelské jméno';
$lang['create_user_validation_email_label']            = 'Email';
$lang['create_user_validation_phone_label']            = 'Phone';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Heslo';
$lang['create_user_validation_password_confirm_label'] = 'Znovu heslo';

// Edit User
$lang['edit_user_heading']                           = 'Editace uživatele';
$lang['edit_user_subheading']                        = 'Prosím, zadejte informace o uživateli.';
$lang['edit_user_fname_label']                       = 'Křestní jméno:';
$lang['edit_user_lname_label']                       = 'Příjmení:';
$lang['edit_user_company_label']                     = 'Organizace:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Telefon:';
$lang['edit_user_password_label']                    = 'Heslo: (pokud je změněno)';
$lang['edit_user_password_confirm_label']            = 'Znovu heslo: (pokud je změněno)';
$lang['edit_user_groups_heading']                    = 'Skupiny uživatele';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'Křestní jméno';
$lang['edit_user_validation_lname_label']            = 'Příjmení';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone_label']            = 'Phone';
$lang['edit_user_validation_company_label']          = 'Organizace';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Heslo';
$lang['edit_user_validation_password_confirm_label'] = 'Znovu heslo';

// Create Group
$lang['create_group_title']                  = 'Vytvořit skupinu';
$lang['create_group_heading']                = 'Vytvořit skupinu';
$lang['create_group_subheading']             = 'Prosím, zadejte informace o skupině.';
$lang['create_group_name_label']             = 'Název skupiny:';
$lang['create_group_desc_label']             = 'Popis:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Název skupiny';
$lang['create_group_validation_desc_label']  = 'Popis';

// Edit Group
$lang['edit_group_title']                  = 'Upravit skupinu';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Upravit skupinu';
$lang['edit_group_subheading']             = 'Prosím, zadejte informace o skupině.';
$lang['edit_group_name_label']             = 'Název skupiny:';
$lang['edit_group_desc_label']             = 'Popis:';;
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Název skupiny';
$lang['edit_group_validation_desc_label']  = 'Popis';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Staré heslo';
$lang['change_password_validation_new_password_label']         = 'Nové heslo';
$lang['change_password_validation_new_password_confirm_label'] = 'Znovu heslo';

// Forgot Password
$lang['forgot_password_heading']                 = 'Zapomenuté heslo';
$lang['forgot_password_subheading']              = 'Prosím zadejte email abychom vám mohli poslat e-mail pro resetování hesla.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_username_identity_label'] = 'Username';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Activation Email
$lang['email_activate_heading']    = 'Activate account for %s';
$lang['email_activate_subheading'] = 'Please click this link to %s.';
$lang['email_activate_link']       = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Reset Password for %s';
$lang['email_forgot_password_subheading'] = 'Please click this link to %s.';
$lang['email_forgot_password_link']       = 'Reset Your Password';

// New Password Email
$lang['email_new_password_heading']    = 'New Password for %s';
$lang['email_new_password_subheading'] = 'Your password has been reset to: %s';

