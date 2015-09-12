<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - sendMessage()
* Classes list:
* - Mail
*/
namespace Multiple\Library;

use Swift_Message AS Message;
use Swift_SmtpTransport AS Smtp;
use Swift_Mailer AS Mailer;

use Multiple\Backend\Models\Blogs;

/**
 * Classe para envios e confirmação de emails utilizando Swift Mailer
 * Verificar utilização em http://www.sitepoint.com/sending-confirmation-emails-phalcon-swift/
 */
class Mail {

    private $transport;
    private $mailer;
    private $mail;
    private $mail_password;

    /**
     * Efetua a configuração do swift para envio de emails
     */
    public function __construct() {
        $blog = Blogs::findFirst();
        $this->mail = $blog->blog_mail;
        $this->mail_password = $blog->blog_mail_password;
        $this->transport = Smtp::newInstance('smtp.gmail.com', 465, 'ssl')->setUsername($this->mail)->setPassword($this->mail_password);

        $this->mailer = Mailer::newInstance($this->transport);
    }

    /**
     * Envia um email
     * @param  string 	$subject  	Assunto do email
     * @param  array 	$addresse  	Array com todos os destinatários do email
     * @param  string 	$body     	Conteúdo da menssagem
     * @return bool		            true caso o email tenha sido enviado ou false caso ocorra algum erro
     */
    public function sendMessage($subject, $addresse, $body) {

        $message = Message::newInstance($subject)->setFrom(array(
            $this->transport->getUsername() => $this->mail
        ))->setTo($addresse)->setBody($body);

        return $this->mailer->send($message);
    }
}