<?php
include 'include/config.inc.php';

function verificarNomeExistente($nomeJogador, $ligacao)
{
    $verificarNome = "SELECT nome FROM jogador WHERE nome = '" . mysqli_real_escape_string($ligacao, $nomeJogador) . "';";
    $qVerificaNome = mysqli_query($ligacao, $verificarNome) or die("#2: a query verifica nome falhou"); //Erro #2 = Não foi possivel verificar o nome do utilizador 
    return mysqli_num_rows($qVerificaNome) > 0;
}

function adicionarUtilizador($nomeJogador, $passwordJogador, $ligacao)
{
    $dataregisto = date("Y-m-d H:i:s");
    $pontuacao = 0;

    //Verificar se nome de utilizador já existe na BD
    if (verificarNomeExistente($nomeJogador, $ligacao)) {
        echo "#3: O nome do jogador já existe";
        exit();
    }

    //adicionar utilizador
    //Salt funciona como uma chave de encriptação que é adicionada à encriptação de palavra pass
    $salt = "\$5\$rounds=5000\$" . bin2hex(random_bytes(16)) . "\$"; // Utiliza uma salt aleatória mais segura
    //adicionar salt à chave de encriptação 		
    $password = crypt($passwordJogador, $salt);
    $qCriarUtilizador = "INSERT INTO jogador (nome, password, criado_em, salt, pontuacao) VALUES ( '" . mysqli_real_escape_string($ligacao, $nomeJogador) . "', '" . mysqli_real_escape_string($ligacao, $password) . "', '" . $dataregisto . "', '" . $salt . "', '" . $pontuacao . "' );";
    //Registar utilizador
    mysqli_query($ligacao, $qCriarUtilizador) or die("#4: Falha ao criar utilizador");//Erro #4 = Não foi possivel registar o utilizador na BD

    //Se o script terminar com sucesso enviar string 0 SUCESSO
    echo("0");
}
?>