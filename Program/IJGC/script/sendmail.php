<?
mailTo('ni_ali@yahoo.com','ni_ali@yahoo.com','ini adalah pesan <h1>test</h1>');

function mailTo ($from, $to, $oggetto, $pesan, $type = "both", $reply = true) {

    // Standar Header
    $crlf = chr(10) . chr(13);
    $intestazione  = "To: {$to}" . $crlf;
    $intestazione .= "From: {$from}" . $crlf;
    $intestazione .= "Return-Path: " . (($reply)? $from : substr_replace($from, "noreply", 0, strpos($from, '@'))) . $crlf;
    $intestazione .= 'Reply-To: ' .(($reply)? $from : substr_replace($from, "noreply", 0, strpos($from, '@'))) . $crlf;
    $intestazione .= 'X-Mailer: PHP/' . phpversion() . $crlf;

    // MIME boundary
    $separatore = 'PHP' . md5(uniqid(time()));
    // MIME Header
    $intestazione .= 'MIME-Version: 1.0' . $crlf;

    switch ($type){
        case 'html' :
                        // Header for client non MIME compatible
            $intestazione .= 'Content-Type: text/html; charset=ISO-8859-15' . $crlf;
            $intestazione .= 'Content-Transfer-Encoding: 7bit' . $crlf;
            $messaggio .= "\n{$pesan}\n";
            break;

        case 'both' :
            $intestazione .= "Content-Type: multipart/alternative;\n\tboundary=\"" . $separatore . '"' . $crlf;
            // Create message for no mime client
            $messaggio .= "For English People: This is a multi-part message in MIME format.\nIf you are reading this, consider upgrading your e-mail client to a MIME-compatible client.\n";
            $messaggio .= "For Italian People: Questo è un messaggio MIME.\nSe si stà leggendo questa nota, consigliamo l\'aggiornamento del programma di posta elettronica con uno compatibile MIME";
            $messaggio .= "\n--{$separatore}\n";
            $messaggio .= "Content-Type: text/plain; charset=ISO-8859-15\n";
            $messaggio .= "Content-Transfer-Encoding: 7bit\n\n";

        case 'text' :
            $messaggio .= strip_tags($contenuto);
            if ($type == 'both') {
                $messaggio .= "\n--{$separatore}\n";;
                $messaggio .= "Content-Type: text/html; charset=ISO-8859-15\n";
                $messaggio .= "Content-Transfer-Encoding: 7bit\n";
                $messaggio .= "\n{$pesan}";
                $messaggio .= "\n--{$separatore}\n";
            }
    }

    // Send MAIL
    return  mail($to, $oggetto, $messaggio, $intestazione);

}
?>