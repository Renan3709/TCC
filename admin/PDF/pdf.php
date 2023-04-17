<?php
  define('MPDF_PATH', 'class/mpdf/');
  include(MPDF_PATH.'mpdf.php');
  include('../../functions/conexao.php');
  include('../../functions/functions.php');
  include('../session.php');
  $mpdf=new mPDF();
  $NINSC = $_REQUEST['id'];
  
  if(is_numeric($NINSC)==true){
	$sql = "SELECT * FROM CANDIDATO C, PAIS P, RESPACAD A, RESPFIN F, TURMA T, ENDERECO E WHERE C.NINSC = $NINSC AND C.NINSC = P.CANDIDATO_NINSC AND C.NINSC=A.CANDIDATO_NINSC AND C.NINSC = F.CANDIDATO_NINSC AND C.NINSC=T.CANDIDATO_NINSC";  
	$conn = conectar();
	$result = $conn->query($sql);
	//if ($result->num_rows > 0) {    			
		//while(
	$row = $result->fetch_assoc();


$ano = $row['ANO'];
$gEnsino = $row['ESCOLARIDADE'];
$turno = $row['TURNO'];
$exAluno= $row['ANO'];
$Numinsc= $row['NINSC'];
$matricula= $row['MATRICULA'];
$nome = $row['NOME'];
$pDtNasc = $row['PDTNASC'];
$pNat = $row['PNAT'];
$pUF = $row['PUF'];
$mDtNasc = $row['MDTNASC'];
$mNat = $row['MNAT'];
$mUF = $row['MUF'];
$reside = $row['RESIDE'];

$outros = $row['RESIDENOME'];
$parentesco = $row['RESIDEPARENTE'];
$rua = $row['RUA'];
$nCasa = $row['NUM'];
$comp = $row['COMP'];
$bairro = $row['BAIRRO'];
$cidade = $row['CIDADE'];
$estado = $row['ESTADO'];
$cep = $row['CEP'];
$escAtual = $row['ESCATUAL'];
$atendEsp = $row['AESPECIAIS'];
$atendEspQual = 'VER';
$acaNome = $row['ANOME'];
$acaNat = $row['ANAT'];
$acaUf = $row['AUF'];
$acaDtNasc = $row['ADTNASC'];
$acaTel = $row['ATEL'];
$acaEmail = $row['AEMAIL'];
$FinNome = $row['FNOME'];
$FinNat = $row['FNAT'];
$FinUF = $row['FUF'];
$FinCPF = $row['CPF'];
$FinRG = $row['FRG'];
$bolsa = $row['SOCIAL'];
$DC = $row['FRG'];
$FinNasc = $row['FDTNASC'];
$FinTel = $row['FTEL'];
$FinEmail = $row['FEMAIL'];


$html = '
<h1 align="center">Ficha de Inscrição para Ingresso '. date('Y').'</h1> <br>
<table style="width:100%">  
  <tr>
    <td><label><strong>Nº de Inscrição:</strong> '.$Numinsc.' </label> <br>
	<strong>Ex-Aluno?</strong>'.
	check($matricula)
	.'<br>
	<strong>Matrícula:</strong> '.$matricula.' 
	
	</td>
    <td align="right">
	<div id="grau">
	<label>'.$ano.' Ano<br>Ensino '.ucwords($gEnsino).'<br>Turno: '.ucwords($turno).' </label><br>
	</div>
	</td>    
  </tr>  
</table>
<h3><strong>Candidato:</strong> '.$nome.'</h3>

<strong>Pai:</strong>
<table style="width:100%">  
  <tr>
	<td>
	 <strong>Data de Nascimento:</strong> '.acertaData($pDtNasc).'
	</td>
    <td>
	<strong>Naturalidade:</strong> '.$pNat.'
	</td>
	<td>
	<strong>UF:</strong> '.$pUF.'
	</td>      
  </tr>  
</table>

<strong>Mãe:</strong>
<table style="width:100%">  
  <tr>
	<td>
	 <strong>Data de Nascimento:</strong> '.acertaData($mDtNasc).'
	</td>
    <td>
	<strong>Naturalidade:</strong> '.$mNat.'
	</td>
	<td>
	<strong>UF:</strong> '.$mUF.'
	</td>      
  </tr>  
</table>
<br>


<label><strong>O Candidato reside com:</strong></label> '.$reside.' '.$outros.' '.$parentesco.'<br>
<br><br>
<table style="width:100%">  
  <tr>
	<td>
	<strong>Endereço:</strong> '.$rua.'
	</td>
    <td>
	<strong>Nº</strong>: '.$nCasa.'
	</td>
	<td>
	<strong>Complemento:</strong> '.$comp.'
	</td>      
  </tr>  
</table>

<table style="width:100%">  
  <tr>
	<td>
	<strong>Bairro:</strong> </label> '.$bairro.'
	</td>
    <td>
	<strong>Cidade:</strong> '.$cidade.'
	</td>
	<td>
	<strong>Estado:</strong> '.$estado.'
	</td> 
	<td>
	<strong>CEP:</strong> </label> '.$cep.'
	</td>     
  </tr>  
</table>

<br><br>
<strong>Escola Atual:</strong> '.$escAtual.'<br>
<label><strong>O Candidato necessita de atendimento especial?</strong></label> '.aEspc($atendEsp).'
<br><br>
<strong>Responsável Acadêmico:</strong> '.$acaNome.'
<table style="width:100%">  
  <tr>
	<td>
	<strong>Naturalidade:</strong>  '.$acaNat.'<br>
	<strong>UF:</strong> '.$acaUf.'<br>
	<strong>Data de Nasc.:</strong>  '.acertaData($acaDtNasc).'
	</td>
    <td align="right">
	<strong>Telefone:</strong>  '.$acaTel.'<br>
	<strong>E-Mail:</strong>  '.$acaEmail.'
	</td>	     
  </tr>  
</table>

<br>
<strong>Responsável Financeiro:</strong> '.$FinNome.'
<table style="width:100%">  
  <tr>
	<td>
	<strong>Naturalidade:</strong>  '.$FinNat.'<br>
	<strong>UF:</strong> '.$FinUF.'<br>
	<strong>Data de Nasc.:</strong>  '.acertaData($FinNasc).'<br>
	<strong>Telefone:</strong>  '.$FinTel.'
	</td>
    <td align="right">
	<strong>Telefone:</strong>  '.$FinCPF.'<br>
	<strong>RG:</strong>  '.$FinRG.'<br>
	<strong>E-Mail:</strong>  '.$FinEmail.'
	</td>	     
  </tr>  
</table>
';

if(strcmp($row['SOCIAL'],'SIM') == 0) 
	$html.='<br><strong>Bolsa Social: </strong>Sim<br>';
if(strcmp($row['DC'],'SIM') == 0) 
	$html.='<strong>Desconto Comercial: </strong>Sim';


	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("css/style.css");
	$mpdf->WriteHTML($css,1);
  $mpdf->WriteHTML($html);
  $mpdf->Output();
  exit();
echo $html;
	}
	else 
		echo "Nenhum resultado encontrado...";
	desc();
