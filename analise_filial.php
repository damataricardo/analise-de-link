
<html>
 <head>
  <title>Análise de Link </title>



 </head>


 <body>

<pre>

<?php


echo "<font face=\"Verdana\" color=\"#000000\">Data da Análise Efetuada : </font>";
echo exec('date +"%A, %H de %B de %Y, %X"');

echo "<br />";
echo "<br />";
$name_server = shell_exec('cat /etc/hostname');
echo "<font face=\"Verdana\" color=\"#000000\">Número da Filial :  </font>";
echo "$name_server";

echo "<br />";
echo "<br />";
$version_server = shell_exec('cat /etc/issue.net');
echo "<font face=\"Verdana\" color=\"#000000\">Versão do Servidor :  </font>";
echo "$version_server";

echo "<br />";
echo "<br />";
$maq_conect = shell_exec('arp | grep eth0 |wc -l');
echo "<font face=\"Verdana\" color=\"#000000\">Quantidade de Maquinas Conectadas :  </font>";
echo "$maq_conect";


$zabbix = ('sh /var/www/html/analise/zabbixgraf.sh');
shell_exec($zabbix);




echo "<br />";
echo "<br /> ";
$output = "speedtest-cli --simple --share | grep http | awk '{print $3}'";
$speed_test = shell_exec("$output");
echo "<font face=\"Verdana\" color=\"#000000\">Velocidade da Internet : </font>";
echo "<br/>";
echo "<br/>";

if($a == ""){
echo "<img src='$speed_test' width='350' height='200' alt='descrição da imagem' />";
}

?>



<h3>O Grafico Abaixo Representa sua Conexão</h3>
<span>A linha verde do seu gráfico representa a Latencia de seu link.
A linha vermelha do seu gráfico representa a porcentagem de perda de pacotes de seu link.
Caso a linha verde do gráfico ultrapassar os <b>180 ms</b>(Disponível do lado esquerdo ) ou a linha vermelha
ultrapassar os <b>50%</b>(Disponivel ao lado direito)<b>favor abrir Chamado com Sua Operadora.</b> </span>


<img src="grafico.png" alt="some text" width=1071 height=368>

</pre>



 </body>
</html>



