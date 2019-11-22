
<html>
 <head>
  <title>Análise de Rede Interna </title>
 </head>
 <body>
<pre>
<?php
$cut_ip = "netstat -r | grep default | cut -d' ' -f10";
$ip = shell_exec("$cut_ip");

//Ping Roteador
$result_roteador = shell_exec("ping -c 3 $ip > /dev/null && echo 'True'");
if ($result_roteador == True) {
  echo "<b> <font size=\"+1\" face=\"Verdana\">Seu Modem/Roteador está:</font> </b> <font face=\"Verdana\" color=\"#008000\">ONLINE</font>\n";
} else {
  echo "<b> <font size=\"+1\" face=\"Verdana\">Seu Modem/Roteador está :</font></b><font font size=\"+1\" face=\"Verdana\" color=\"#FF0000\">OFFLINE</font>\n\n</b> <font face=\"Verdana\">Quando isso ocorre existe a possibilidade de problema fisico de conexão: \n-Verifique se os cabos de conexão entre o Modem/Roteador de sua operadora e o servidor estão conectados.\n-Verififique se o Modem/Roteador da sua operadora  esta ligado.\n-Caso ele esteja ligado reiniciar o mesmo e refazer o teste, Ele se mantendo offiline  acionar o tecnico local para verificação.</font>\n\n";

}


//Ping Internet
$result_internet = shell_exec("ping -c 3 8.8.8.8 > /dev/null && echo 'True'");
if ($result_internet == True) {
  echo "<b> <font size=\"+1\" face=\"Verdana\">Sua Internet está :</font> </b><font face=\"Verdana\" color=\"#008000\">ONLINE</font>\n";
} else {
  echo " <b> <font size=\"+1\" face=\"Verdana\">Sua Internet está :</font></b> <font face=\"Verdana\" color=\"#FF0000\">OFFLINE</font> \n<font face=\"Verdana\"> Quando isso ocorre geralmente é um problema na operadora ,Efetuar os seguintes testes:\n-Reiniciar o modem/roteador de internet.\n-Apos reiniciar o modem efetuar o teste novamente, caso ele se mantenha offiline entre em contato com a operadora.</font>\n\n";
}

//Ping Intranet
$result_intranet = shell_exec("ping -c 6 rede.cvc.com.br > /dev/null && echo 'True'");
if ($result_intranet == True) {
  echo "<b> <font size=\"+1\" face=\"Verdana\">O Acesso aos Serviços CVC está :</font> </b><font face=\"Verdana\" color=\"#008000\">ONLINE</font>\n";
} else {
  echo "<b> <font size=\"+1\" face=\"Verdana\">O Acesso aos serviços CVC está :</font></b> <font face=\"Verdana\" color=\"#FF0000\">OFFLINE</font>\n<font face=\"Verdana\">Abrir chamado para verificação ou ligar no 0800-940-1611(Anexe um print dessa tela no chamado!)</font>";
}

?>
 </body>
</html>



