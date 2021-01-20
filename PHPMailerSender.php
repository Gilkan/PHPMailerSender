<?
// sendMail(
//     $subject,
//     $body,
//     $destinys = 'email@domain.test',
//     $destinysName = 'Name',
//     $from = 'sender@domain.text',
//     $fromName = 'Sender',
//     $ishtml = true,
//     $secureType = 'ssl',
//     $port = '465',
//     $debug = 0,
//     $auth = true,
//     $ccArray=null,
//     $username = 'sender@domain.text',
//     $password = 'senderpassword',
//     $host = 'smtp.provider.com'
// )

/**
 * 
 * @param string $subject
 * @param string $body
 * @param string $destinys
 * @param string $destinysName
 * @param string $from
 * @param string $fromName
 * @param boolean $ishtml
 * @param string $secureType
 * @param string $port
 * @param integer $debug
 * @param boolean $auth
 * @param array[string] $ccArray
 * @param string $username
 * @param string $password
 * @param string $host
 * 
 * @return boolean|exception
 */
public function sendMail($subject, $body, $destinys = 'email@domain.test', $destinysName = 'Name', $from = 'sender@domain.text', $fromName = 'Sender', $ishtml = true, $secureType = 'ssl', $port = '465', $debug = 0, $auth = true, $ccArray=null, $username = 'sender@domain.text', $password = 'senderpassword', $host = 'smtp.provider.com'){

    $regexEmail = "/^(?:(?:[\"]\2[\".])?((?:[a-zA-Z0-9](?:\.[a-zA-Z0-9-_])?[a-zA-Z0-9-_]*)+)(?:[.\"](.+)[\".])?\1?(?:[.\"]\2[\"])?)@[a-zA-Z0-9][a-zA-Z0-9-]*(\.(?:[a-zA-Z0-9]{2,}))*$/";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->SMTPDebug = $debug;

    $mail->SMTPAuth = $auth;

    $mail->Host = $host;

    $mail->SMTPSecure = $secureType;
    
    $mail->Port = $port;

    $mail->FromName = $fromName;

    $mail->Username = $username;
    $mail->Password = $password;
    $mail->From = $from;

    $mail->IsHTML($ishtml);
    
    if(is_array($destinys)){
        foreach ($destinys as $destiny) {
            if(preg_match($regexEmail, $destiny)){
                $mail->AddAddress($destiny);
            }
        }
    } else {
        if(preg_match($regexEmail, $destinys)){
            $mail->AddAddress($destinys);
        }
    }

    $mail->Subject = $subject;

    $mail->Body = $body;

    return $mail->Send();
}
