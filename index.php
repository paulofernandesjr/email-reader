<?php

DEFINE('SERVIDOR', 'pop.phpaulo.com.br'); 
DEFINE('PORTA', '110');
DEFINE('USUARIO', 'user@phpaulo.com.br');
DEFINE('SENHA', 'minha-senha-secreta');

$mail_box = imap_open("{" . SERVIDOR . ":" . PORTA . "/pop3/novalidate-cert}INBOX", USUARIO, SENHA);

echo '<pre>';
print_r(imap_errors());
echo '</pre>';

if ($mail_box) {
    $total_de_mensagens = imap_num_msg($mail_box);
    if ($total_de_mensagens > 0) {
        for ($mensagem = 1; $mensagem <= $total_de_mensagens; $mensagem++) {

            echo '<pre>';
                print_r(imap_headerinfo($mail_box, $mensagem));
            echo '</pre>';

            /*
             *  o terceiro parametro pode ser
             *  0=> retorna o body da mensagem com o texto que o servidor recebe
             *  1=> retorna somente o conteudo da mensagem em plain-text
             *  2=> retorna o conteudo da mensagem em html
             */
            
            echo "<hr />";
            $body_1 = ( imap_fetchbody($mail_box, $mensagem, 1) );
            echo $body_1;

            echo "<hr />";
            $body_0 = ( imap_fetchbody($mail_box, $mensagem, 0) );
            echo $body_0;

            echo "<hr />";
            $body_2 = ( imap_fetchbody($mail_box, $mensagem, 2) );
            echo $body_2;

            echo "<hr />";
            // deixei comentando pra não dar problema e excluir todos seus e-mails
            
            //imap_delete($mail_box, $mensagem);
            //imap_expunge($mail_box);
        }
    }
    imap_close($mail_box);
}