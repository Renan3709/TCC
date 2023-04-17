<?php
//Valida o CPF
function validaCPF($cpf) {

    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }

   

    // Verifica se o numero de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
    } else {

        for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return false;
            }
        }

        return true;
    }
}
function enviarEmail($conteudoHtml,$nCad,$email_destinatario){
 
	//REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
 	//====================================================
	$email_remetente = "atendimento.abel@lasalle.org.br"; // deve ser um email do dominio
	//====================================================
 
 
	//Configurações do email, ajustar conforme necessidade
	//====================================================
	//$email_destinatario = "atendimento.abel@lasalle.org.br"; // qualquer email pode receber os dados
	$email_reply = "atendimento.abel@lasalle.org.br";
	$email_assunto = 'Ficha de Inscrição para Ingresso '.date('Y').' | Nº:'.$nCad;
	//====================================================
 
 
	//Variaveis de POST, Alterar somente se necessário
	//====================================================

 	//$mensagem = $_POST['mensagem'];
	//====================================================
 
	//Monta o Corpo da Mensagem
	//====================================================

	$email_conteudo =  $conteudoHtml;
	//$email_conteudo .=  "Mensagem: $mensagem \n";
 	//====================================================
 
	//Seta os Headers (Alerar somente caso necessario)
	//====================================================
	$email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Subject: $email_assunto","Return-Path:  $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
	//====================================================
 
 
	//Enviando o email
	//====================================================
	if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
		return true; 
	}
  	else{
		return false; 

	}
	//====================================================
}	
function acertaData ($data){
	$temp = substr($data,8,9);//dia
	$temp .= '/';
	$temp .= substr($data,5,2);//mes
	$temp .= '/';
	$temp .= substr($data,0,4);//ano
	return $temp;
}
function exluno($a){
	if(strcmp($a,'SIM')==0)
		return '<img src="img/checked.png" width="10px">	<label>SIM</label><input type="checkbox" disabled ><label>NÃO</label>';	
	else
		return '<input type="checkbox" disabled ><label>SIM</label><img src="img/checked.png" width="10px"><label>NÃO</label>';
	}
function reside($b,$otr,$pr){
	if(strcmp($b,'Pai e Mãe')==0){
		return '<input type="checkbox" checked disabled>Pai e mãe</label>
          <label class="radio-inline">
            <input type="checkbox" disabled>Pai</label>
          <label class="radio-inline">
            <input type="checkbox" disabled> Mãe</label>
          <label class="radio-inline">
            <input type="checkbox" disabled>Outros</label>';
		}
	if(strcmp($b,'Pai')==0){
		return '<input type="checkbox"  disabled>Pai e mãe</label>
          <label class="radio-inline">
            <input type="checkbox" disabled checked>Pai</label>
          <label class="radio-inline">
            <input type="checkbox" disabled> Mãe</label>
          <label class="radio-inline">
            <input type="checkbox" disabled>Outros</label>';
		}
			if(strcmp($b,'Mãe')==0){
		return '<input type="checkbox" disabled>Pai e mãe</label>
          <label class="radio-inline">
            <input type="checkbox" disabled >Pai</label>
          <label class="radio-inline">
            <input type="checkbox" disabled checked> Mãe</label>
          <label class="radio-inline">
            <input type="checkbox" disabled>Outros</label>';
		}
			if(strcmp($b,'Outros')==0){
		return '<input type="checkbox"  disabled>Pai e mãe</label>
          <label class="radio-inline">
            <input type="checkbox" disabled >Pai</label>
          <label class="radio-inline">
            <input type="checkbox" disabled > Mãe</label>
          <label class="radio-inline">
            <input type="checkbox" checked disabled>Outros</label>
			<br><label>Nome: </label>'.$otr.'   <label>Parentesco: </label> '.$pr.'			';
			
		}
	}
function aEsp($a, $b){
	if(strcmp($a,'SIM')==0)
		return '<input type="checkbox" disabled checked><label>SIM</label><input type="checkbox" disabled><label>NÃO</label><label> &nbsp;&nbsp;Quais:</label> '.$b.'';	
	else
		return '<input type="checkbox" disabled ><label>SIM</label><input type="checkbox" disabled checked><label>NÃO</label><label> &nbsp;&nbsp;Quais:</label> N/A';	
}
function aEspc($a){
		if(strlen($a)>3){
			return '<img src="../img/checked.png" width="5px"><label>SIM</label><input type="checkbox" disabled ><label>NÃO</label> <strong>Qual:</strong>'.$a;
		}
		else
		return '<input type="checkbox" disabled ><label>SIM</label><img src="../img/checked.png" width="10px"><label>NÃO</label>';
	}
function check($a){
	if(strcmp($a,0)!=0)
		return '<img src="../img/checked.png" width="5px">	<label>SIM</label><input type="checkbox" disabled ><label>NÃO</label>';	
	else
		return '<input type="checkbox" disabled ><label>SIM</label><img src="../img/checked.png" width="10px"><label>NÃO</label>';
	}