<?php
$ligacao = mysqli_connect('localhost', 'root', '', 'gamedb');
	
if(mysqli_connect_errno()){
    //Forma simplificada de detetar erros 
    echo "1"; //Erro code #1 = a Ligação Falhou
    exit();
}
?>