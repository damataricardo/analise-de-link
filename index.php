<html>
 <head>
 <title>Análise de Link</title>


 </head>
 <body>


<img src="logo.jpg"  width="200" height="100" align="right" >


<center><h2>Sistema de Análise de Link  </h2></center>
<?php  echo('<iframe src="load2.html"  frameborder="0" marginheight="0" marginwidth="0" scrolling="no"  height="129"  width="1000"></iframe>'); ?>
<h3>Para Realizar uma Análise de Link clique no botão abaixo :</h3>
<form method="POST" action=''>
<input type="submit" name="button1"  value="Iniciar Analise de Link">
</form>
<?php
if (isset($_POST['button1']))
{

	echo('<iframe src="load.html"  scrolling="no" height="1100" width="1200"></iframe>');

}
?>



 </body>
</html>
