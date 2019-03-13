<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* E-mail Messages */

// Account verification
$lang['aauth_email_verification_subject'] = 'Hesap doğrulama';
$lang['aauth_email_verification_code'] = 'Doğrulama kodunuz: ';
$lang['aauth_email_verification_link'] = " You can also click on (or copy and paste) the following link\n\nhttp://yourdomain/account/verification/";

// Password reset
$lang['aauth_email_reset_subject'] = 'Reset Password';
$lang['aauth_email_reset_link'] = "To reset your password click on (or copy and paste in your browser address bar) the link below:\n\nhttp://yourdomain/account/reset_password/";

// Password reset success
$lang['aauth_email_reset_success_subject'] = 'Successful Pasword Reset';
$lang['aauth_email_reset_success_new_password'] = 'Your password has successfully been reset. Your new password is : ';


/* Error Messages */

// Account creation errors
$lang['aauth_error_email_exists'] = 'Sistemde zaten e-posta adresi var. Şifrenizi unuttuysanız, aşağıdaki bağlantıyı tıklayabilirsiniz..';
$lang['aauth_error_username_exists'] = "Bu kullanıcı adı olan sistemde hesap zaten var. Lütfen farklı bir kullanıcı adı girin veya şifrenizi unuttuysanız, lütfen aşağıdaki bağlantıyı tıklayın.";
$lang['aauth_error_email_invalid'] = 'Geçersiz e-posta adresi';
$lang['aauth_error_password_invalid'] = 'Geçersiz şifre';
$lang['aauth_error_username_invalid'] = 'Geçersiz kullanıcı adı';
$lang['aauth_error_username_required'] = 'Kullanıcı Adı zorunludur';

// Groupaccess errors
$lang['aauth_error_no_access'] = 'Maalesef, talep ettiğiniz kaynağa erişiminiz yok.';
$lang['aauth_error_login_failed'] = 'E-Posta Adresi ve Parolası eşleşmiyor.';
$lang['aauth_error_login_attempts_exceeded'] = 'Giriş denemelerini aştınız, hesaplarınız şimdi kilitlendi.';
$lang['aauth_error_recaptcha_not_correct'] = 'Maalesef girilen ReCAPTCHA metni yanlış.';


// Misc. errors
$lang['aauth_error_no_user'] = 'User does not exist';
$lang['aauth_error_account_not_verified'] = 'Your account has not been verified. Please check your e-mail and verify your account.';
$lang['aauth_error_no_group'] = 'Group does not exist';
$lang['aauth_error_self_pm'] = 'It is not possible to send a Message to yourself.';
$lang['aauth_error_no_pm'] = 'Private Message not found';


/* Info messages */
$lang['aauth_info_already_member'] = 'User is already member of group';
$lang['aauth_info_group_exists'] = 'Group name already exists';
$lang['aauth_info_perm_exists'] = 'Permission name already exists';
