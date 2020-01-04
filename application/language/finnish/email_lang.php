<?php

$lang['email_must_be_array'] = 'Sähköpostin tarkastusmetodi täytyy olla annettuna "array":na.' ; //"The email validation method must be passed an array.";
$lang['email_invalid_address'] = "Sähköpostia ei hyväksytä: %s" ; //"Invalid email address: %s";
$lang['email_attachment_missing'] = "Seuraavia sähköpostiliitteitä ei voida paikantaa: %s" ; //"Unable to locate the following email attachment: %s";
$lang['email_attachment_unreadable'] = "Liitettä ei voida avata: %s" ; //"Unable to open this attachment: %s";
$lang['email_no_recipients'] = "Sinun täytyy lisätä vastaanottajat: To, Cc tai Bcc" ; // "You must include recipients: To, Cc, or Bcc";
$lang['email_send_failure_phpmail'] = "Sähköpostia ei voida lähettää käyttäen PHP mail()-funktiota. Palvelimesi ei välttämättä ole konfiguroitu käyttämään tätä metodia." ; // "Unable to send email using PHP mail().  Your server might not be configured to send mail using this method.";
$lang['email_send_failure_sendmail'] = "Sähköpostia ei voida lähettää käyttäen PHP sendmail:ia. Palvelimesi ei välttämättä ole konfiguroitu käyttämään tätä metodia. " ; // "Unable to send email using PHP Sendmail.  Your server might not be configured to send mail using this method.";
$lang['email_send_failure_smtp'] =  "Sähköpostia ei voida lähettää käyttäen PHP SMTP:tä.  Palvelimesi ei välttämättä ole konfiguroitu käyttämään tätä metodia." ; //"Unable to send email using PHP SMTP.  Your server might not be configured to send mail using this method.";
$lang['email_sent'] = "Viestisi on onnistuneesti lähetetty käyttäen protokollaa: %s" ; // "Your message has been successfully sent using the following protocol: %s";
$lang['email_no_socket'] = '"socket":ia ei voida avata sähköpostin lähettämiseksi, ole hyvä ja tarkasta Sendmail asetukset.' ; // "Unable to open a socket to Sendmail. Please check settings.";
$lang['email_no_hostname'] = "Et määrittänyt SMTP isäntänimeä." ; // "You did not specify a SMTP hostname.";
$lang['email_smtp_error'] = "SMTP virhe: %s" ; // "The following SMTP error was encountered: %s";
$lang['email_no_smtp_unpw'] = "Virhe: Sinun täytyy asettaa SMTP käyttäjänimi ja salasana." ; // "Error: You must assign a SMTP username and password.";
$lang['email_failed_smtp_login'] = "AUTH LOGIN komennon lähettämisessä epäonnistuttiin. Virhe: %s" ; // "Failed to send AUTH LOGIN command. Error: %s";
$lang['email_smtp_auth_un'] = " Käyttäjänimeä ei voitu autentikoida. Virhe: %s" ; // "Failed to authenticate username. Error: %s";
$lang['email_smtp_auth_pw'] = "Salasanaa ei voitu autentikoida. Virhe: %s" ; // "Failed to authenticate password. Error: %s";
$lang['email_smtp_data_failure'] =  "Tietoa ei voida lähettää: %s" ; //"Unable to send data: %s";
$lang['email_exit_status'] = "Poistumisen tilakoodi (Exit status code): %s" ; // "Exit status code: %s";


/* End of file email_lang.php */
/* Location: ./system/language/english/email_lang.php */
