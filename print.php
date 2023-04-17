<?php
include('functions/functions.php');
include('functions/conexao.php');

//Dados do Candidato
$Numinsc = date('dmyGis').rand(0,9);
$matricula = $_POST['matricula'];
if($matricula==0)
	$matricula = '';
else
	$matricula = $_POST['matricula'];
	
$ano = $_POST['ano'];
$gEnsino = ucwords($_POST['esc']);
$turno = $_POST['turno'];
$exAluno = $_POST['exAluno'];
$nome = $_POST['nome'];
$dtNasc = $_POST['dtNasc'];
$escAtual = $_POST['escAtual'];
$candTel = $_POST['candTel'];


//Endereço
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$nCasa = $_POST['nCasa'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$comp = $_POST['comp'];
$atendEsp = $_POST['chkesp'];
$atendEspQual = $_POST['atenEspc'];
$reside = $_POST['optradio'];
$outros = $_POST['outros'];
$parentesco = $_POST['parentesco'];

//Dados dos Pais
//Dados do Pai
$pDtNasc = $_POST['pDtNasc'];
$pNat = $_POST['pNat'];
$pUF = $_POST['pUF'];

//Dados da Mãe
$mDtNasc = $_POST['mDtNasc'];
$mNat = $_POST['mNat'];
$mUF = $_POST['mUF'];

//Dados do Resposável Academico
$acaNome = $_POST['acaNome'];
$acaDtNasc = $_POST['acaDtNasc'];
$acaNat = $_POST['acaNat'];
$acaUf = $_POST['acaUF'];
$acaTel = $_POST['acaTel'];
$acaEmail = $_POST['acaEmail'];

//Dados do Resposável Financeiro

$FinNome = $_POST['finNome'];
$bolsa = $_POST['bolsa'];
$dc = $_POST['desconto'];
$FinNasc = $_POST['finDtNasc'];
$FinNat = $_POST['finNat'];
$FinUF = $_POST['finUF'];
$FinTel = $_POST['finTel'];
$FinEmail = $_POST['finEmail'];
$FinCPF = $_POST['finCPF'];
$FinRG = $_POST['finRG'];


//HTML PARA EXIBIÇÃO NA TELA
$HTML = '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Print</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body><script type="text/javascript">';
$HTML .="

function cont(){
   var conteudo = document.getElementById('container').innerHTML;
   tela_impressao = window.open('about:blank');
   tela_impressao.document.write(conteudo);
   tela_impressao.window.print();
   tela_impressao.window.close();
}
</script>";
$HTML.='

<div class="container" id="container">
<h1 align="center">Ficha de Inscrição para Ingresso '. (date('Y')+1).'</h1>
<div style="float:right">
<label>'.$ano.' Ano<br>Ensino '.strtoupper($gEnsino).'<br>Turno: '.strtoupper($turno).' </label>
</div>
<div class="page-header"> 
<label>Nº de Inscrição:'.$Numinsc.' </label> <br><br> 
<label>Matricula:'.$matricula.' </label>
</div>
<div style="float:right">
<label>Ex-Aluno?<br>'.exluno($exAluno).'</label>
</div>
<h3>Candidato: '.$nome.' </h3>
<strong>Data de Nascimento:</strong> '.acertaData($dtNasc).'
<br><br><label>Endereço:</label>'.$rua.' <strong>Nº</strong>: '.$nCasa.' - '.$comp.'
<br><label>Bairro: </label> '.$bairro.'<label> &emsp;&emsp;Cidade:</label> '.$cidade.'
<br><label>Estado: </label> '.$estado.' <label> &emsp;&emsp;&emsp;CEP: </label> '.$cep.'&emsp;&emsp;<strong>Tel:</strong>'.$candTel.'
 <br><br>

<strong>Pai:</strong> Data de Nascimento: '.acertaData($pDtNasc).'  &emsp;&emsp;Naturalidade: '.$pNat.' &emsp;&emsp;UF: '.$pUF.'<br>
<strong>Mãe:</strong> Data de Nascimento: '.acertaData($mDtNasc).'  &emsp;&emsp;Naturalidade: '.$mNat.' &emsp;&emsp;UF: '.$mUF.'<br>
<br><label>O Candidato reside com:</label>'.reside($reside,$outros,$parentesco).'

<br><label>Escola Atual: </label> '.$escAtual.'
<br><label>O Candidato necessita de atendimento especial?</label> '.aEsp($atendEsp,$atendEspQual).'<br><label>Em caso afirmativo, apresente o laudo médico</label>

<div>
<div>
<br><label>Responsável Acadêmico:</label>  '.$acaNome.'
<div style="float:right">
Naturalidade:  '.$acaNat.' UF: '.$acaUf.'
</div>
<br>Data de Nasc.:  '.acertaData($acaDtNasc).'
<br>Telefone:  '.$acaTel.'
<br>E-Mail:  '.$acaEmail.'
</div>

</div>

<div>
<div>
<br><label>Responsável Financeiro:</label>  '.$FinNome.'
<div style="float:right">
Naturalidade:  '.$FinNat.' UF: '.$FinUF.'
<br>CPF:  '.$FinCPF.'
<br>RG: '.$FinRG.'
<br>'.$bolsa.'<br>'.$FinDesc.'
</div>
<br>Data de Nasc.:  '.acertaData($FinNasc).'
<br>Telefone:  '.$FinTel.'
<br>Email:  '.$FinEmail.'
</div>

</div>
<div>
<br><br>
<div>
<div style="float:right" align="right">
Atendimento:___/___/____&nbsp;&nbsp;
_____________<br>
visto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
Niterói, ______ de _________________ de '.date('Y').'<br><br><br>
__________________________________________<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Assinatura do responsável
</div>
</div>
<hr size="4">
<h3 align="center">Confirmação de Inscrição</h3> <br>
Confirmo a inscrição de '.$nome.' candidato ao '.$ano.' do Ensino '.$gEnsino.'.<br>
Data da Avaliação/Teste de Seleção: ___/___/___ às __________. &emsp;Niterói, ___/___/___.<br>
Local: (&nbsp;&nbsp;&nbsp;)Abel EF &emsp;(&nbsp;&nbsp;&nbsp;)Abel EM

</div>
<br><br>
<div align="center">
<input type="button" onclick="cont();" value="Imprimir" style="font-size:18px;">
</div>
<br><br>';
echo $HTML;

//HTML PARA ENVIO DE E-MAIL
$HTMLMail = '
<div>
<h1 align="center">Ficha de Inscrição para Ingresso '. (date('Y')+1).'</h1>
<div style="float:right">
<label>'.$ano.' Ano<br>Ensino '.strtoupper($gEnsino).'<br>Turno: '.strtoupper($turno).' </label>
<br><label><strong>Ex-Aluno?</strong>'.exluno($exAluno).'</label>
</div>
<div class="page-header"> 
<label><strong>Nº de Inscrição:</strong>'.$Numinsc.' </label>
<label><strong>Matricula:</strong>'.$matricula.' </label>
</div>
<div style="float:right">
</div>
<h3><strong>Candidato:</strong> '.$nome.'</h3>
<strong>Pai:</strong> Data de Nascimento: '.acertaData($pDtNasc).'  &emsp;&emsp;Naturalidade: '.$pNat.' &emsp;&emsp;UF: '.$pUF.'
<strong>Mãe:</strong> Data de Nascimento: '.acertaData($mDtNasc).'  &emsp;&emsp;Naturalidade: '.$mNat.' &emsp;&emsp;UF: '.$mUF.'

<label><strong>O Candidato reside com:</strong></label>'.reside($reside,$outros,$parentesco).'
<label><strong>Endereço:</strong></label>'.$rua.' <strong>Nº</strong>: '.$nCasa.' - '.$comp.'<label>
<strong>Bairro:</strong> </label> '.$bairro.'<label> &emsp;&emsp;<strong>Cidade:</strong></label> '.$cidade.'<label><strong>Estado:</strong> </label> '.$estado.' <label> &emsp;&emsp;&emsp;<strong>CEP:</strong> </label> '.$cep.'
<label><strong>Escola Atual:</strong> </label> '.$escAtual.'
<label><strong>O Candidato necessita de atendimento especial?</strong></label> '.aEsp($atendEsp,$atendEspQual).'

<div>
<div>
<label><strong>Responsável Acadêmico:</strong></label>  '.$acaNome.'
<div style="float:right">
<strong>Naturalidade:</strong>  '.$acaNat.' &emsp;&emsp;<strong>UF:</strong> '.$acaUf.'
</div>
<strong>Data de Nasc.:</strong>  '.acertaData($acaDtNasc).'
<strong>Telefone:</strong>  '.$acaTel.'
<strong>E-Mail:</strong>  '.$acaEmail.'</div></div><div><div>
<label><strong>Responsável Financeiro:</strong></label>  '.$FinNome.'
<div style="float:right">
<strong>Naturalidade:</strong>  '.$FinNat.' &emsp;&emsp;UF: '.$FinUF.'
<strong>CPF:</strong>  '.$FinCPF.'
<strong>RG:</strong> '.$FinRG.'
'.$bolsa.'<br>'.$FinDesc.'
</div>
<strong>Data de Nasc.:</strong>  '.acertaData($FinNasc).'
<strong>Telefone:</strong>  '.$FinTel.'
<strong>E-Mail:</strong>  '.$FinEmail.'
</div></div></div>';


			
//echo $HTMLMail;

//Inserção dos DADOS
if(validaCPF($FinCPF)==true){
	//Salva os dados do aluno
	if (isset($_POST['saveCandidato'])) {
		
		//Inserção de CANDIDATO
    	$con  = conectar(); 
		if (strcmp($reside,'Outros')!=0){
			$outros = '';
			$parentesco = '';
		}
		$sql  = "INSERT INTO CANDIDATO (NINSC, NOME, MATRICULA, DTNASC, AESPECIAIS, ESCATUAL, SOCIAL, DC) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    	$stmt = $con->prepare($sql);
    	$ok   = $stmt->bind_param("isisssss", $Numinsc, $nome, $matricula, $dtNasc,$atendEspQual, $escAtual, $bolsa, $dc);
			if ($ok && $stmt->execute()){			
				//Inserção de TURMA		
				$sql  = "INSERT INTO TURMA (CANDIDATO_NINSC, ESCOLARIDADE, TURNO, ANO) VALUES (?, ?, ?, ?)";
				$stmt = $con->prepare($sql);
				$ok   = $stmt->bind_param("isss", $Numinsc, $gEnsino, $turno, $ano);
				if ($ok && $stmt->execute()){
					//INSERÇÃO DOS DADOS DOS PAIS
					$sql  = "INSERT INTO PAIS (CANDIDATO_NINSC, PDTNASC, PNAT, PUF, MDTNASC, MNAT, MUF) VALUES (?, ?, ?, ?, ?, ?, ?)";
					$stmt = $con->prepare($sql);
					$ok   = $stmt->bind_param("issssss", $Numinsc, $pDtNasc, $pNat, $pUF, $mDtNasc, $mNat, $mUF);
					if ($ok && $stmt->execute()){
						//INSERÇÃO DOS DADOS DO RESP.FIN					
						$sql  = "INSERT INTO RESPFIN (CPF, CANDIDATO_NINSC, FNOME, FDTNASC, FNAT, FUF, FTEL, FEMAIL, FRG) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
						$stmt = $con->prepare($sql);
						$ok   = $stmt->bind_param("iissssiss",$FinCPF, $Numinsc, $FinNome, $FinNasc, $FinNat, $FinUF, $FinTel, $FinEmail, $FinRG);
						if ($ok && $stmt->execute()){
							//INSERÇÃO DOS DADOS DO RESP. ACADEMICO						
							$sql  = "INSERT INTO RESPACAD (CANDIDATO_NINSC, ANOME, ADTNASC, ANAT, AUF, ATEL, AEMAIL) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
							$stmt = $con->prepare($sql);
							$ok   = $stmt->bind_param("issssis",$Numinsc, $acaNome, $acaDtNasc, $acaNat, $acaUf, $acaTel, $acaEmail);
							if ($ok && $stmt->execute()){							 						
								
												
							//INSERÇÃO DOS DADOS DO RESP. ACADEMICO						
							$sql  = "INSERT INTO ENDERECO (CANDIDATO_NINSC, RUA, NUM, COMP, BAIRRO, CIDADE, ESTADO, CEP, RESIDE ,RESIDENOME, RESIDEPARENTE) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
							$stmt = $con->prepare($sql);
							$ok   = $stmt->bind_param("isissssisss",$Numinsc, $rua, $nCasa, $comp, $bairro, $cidade, strtoupper($estado), $cep, $reside, $outros, $parentesco);							
							if ($ok && $stmt->execute()){														
        						echo '<script type="text/javascript"> alert("Inserido com Sucesso!\nImprima essa ficha de inscrição e entregue na central de atendimento\njunto com os seguintes documentos:\n\nEnsino Fundamental\n\nFotocópia da certidão de nascimento\nComprovante de tipo sanguineo(Exame ou atestado médico)\nBoletim ou declaração de escolaridade\n1º ano - Comprovante da ultima etapa da educação infantil\nComprovante de residência do responsável financeiro\n\nEnsino Médio\n\n1 (uma) foto 3x4\nFotocópia da certidão de nascimento\nComprovante de tipo sanguineo(Exame ou atestado médico)\nBoletim ou declaração de escolaridade\nComprovante de residência do responsável financeiro"); </script>';//window.location="index.php"
							}
							else
								die ('<script type="text/javascript"> alert("Erro ao inserir endereço.\n'.$con->error.'"); </script>');
							}
							else
								die ('<script type="text/javascript"> alert("Erro ao inserir Resp. Academico.\n'.$con->error.'"); </script>');			
							$stmt->close;
							desc();
							if(enviarEmail($HTMLMail,$Numinsc,$acaEmail)!=true)
								echo '<script type="text/javascript"> alert("Erro ao enviar e-mail."); </script>';
							if(enviarEmail($HTMLMail,$Numinsc,$FinEmail)!=true)
								echo '<script type="text/javascript"> alert("Erro ao enviar e-mail."); </script>';
							if(enviarEmail($HTMLMail,$Numinsc,'atendimento.abel@lasalle.org.br')!=true)
								echo '<script type="text/javascript"> alert("Erro ao enviar e-mail."); </script>';
							if(enviarEmail($HTMLMail,$Numinsc,'raphael.oliveira@lasalle.org.br')!=true)
								echo '<script type="text/javascript"> alert("Erro ao enviar e-mail."); </script>';
							}
						else
							die ('<script type="text/javascript"> alert("Erro ao inserir Resp. Financeiro.\n'.$con->error.'");</script>');
							}
					else
						die ('<script type="text/javascript"> alert("Erro ao inserir dados dos pais.\n.'.$con->error.'");</script>');
						}
				else
					die ('<script type="text/javascript"> alert("Erro ao inserir dados da escolaridade.\n'.$con->error.'");</script>');
					}
			else
				echo '<script type="text/javascript"> alert("Erro ao inserir dados do candidato.\n'.$con->error.'");</script>';		
		
	}
}
else
	echo '<script type="text/javascript"> alert("Erro no CPF, volte e tente novamente."); </script>';

?>
</body>
</html>