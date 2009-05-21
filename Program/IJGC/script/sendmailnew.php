<?
email('ali.r@edi-indonesia.co.id','test','test aja', '');
mail('ali.r@edi-indonesia.co.id','test','testaja','');
function imap8bit(&$item, $key) {
 $item = imap_8bit($item);
}

function email($e_mail, $subject, $message, $headers)
 {
  // add headers for utf-8 message
  $headers .= "\r\n";
  $headers .= 'From: ijgc-online.com <ijgc@ijgc-online.com>' . "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/plain; charset=utf-8\r\n";
  $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";

  // encode subject
  //=?UTF-8?Q?encoded_text?=

  // work a round: for subject with wordwrap
  // not fixed, no possibility to have one in a single char
  $subject = wordwrap($subject, 25, "\n", FALSE);
  $subject = explode("\n", $subject);
  array_walk($subject, imap8bit);
  $subject = implode("\r\n ", $subject);
  $subject = "=?UTF-8?Q?".$subject."?=";

  // encode e-mail message
  $message = imap_8bit($message);

  return(mail("$e_mail", "$subject", "$message", "$headers"));
 }
?>