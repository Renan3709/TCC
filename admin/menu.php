<!DOCTYPE html>
<html lang="en">
<head>
  <title>Administração - Central La Salle Abel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	include('../functions/conexao.php');
	include('session.php');	
?>

<div class="container">
<!-- INICIO MENU -->
  <h2>Administração - Central La Salle Abel</h2> 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><span class="glyphicon glyphicon-home"></span> Início</a></li>
    
    <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-pencil"></span> Candidato<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a data-toggle="tab" href="#CandidatoNovo">Novo</a></li>
      <li><a data-toggle="tab" href="#CandidatoListar">Listar</a></li>
    </ul>
  	</li> 
     
    <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Usuários<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a data-toggle="tab" href="#NovoUsuario">Novo</a></li>
      <li><a data-toggle="tab" href="#EditarUsuario">Listar</a></li>
    </ul>
  	</li> 
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-out"></span> Sair</button>          
  </ul>
<!-- FIM MENU -->
  <div class="tab-content">
  <!-- HOME --> 
    <div id="home" class="tab-pane fade in active">
      <h3>Ultimos candidatos cadastrados</h3>
      
      <?php
		$conn = conectar();
		$sql = "SELECT C.NINSC,C.NOME CNOME, f.FNOME FNOME, f.CPF, f.FTEL FTEL,f.FEMAIL FEMAIL, a.ANOME ANOME,a.ATEL ATEL,a.AEMAIL AEMAIL FROM CANDIDATO C, RESPFIN f, RESPACAD a WHERE C.NINSC=f.CANDIDATO_NINSC AND C.NINSC=a.CANDIDATO_NINSC ORDER BY C.NINSC DESC LIMIT 5 ;";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {    
			echo '<table border="0" class="table">
			<tr>
			<th></th>
			<th></th>
			<th>Nº de Insc.</th>
			<th>Candidato</th>			
			<th>Fin. Tel.</th>
			<th>Acad. Tel.</th>
			</tr>';
			while($row = $result->fetch_assoc()) {
				$id=$row["NINSC"];
				echo '<tr>';
        		echo '<td><a href="PDF/pdf.php?id='.$id.'"><img src="../img/7_PDF_Marquee_1.png" width="12px"></td>';
				echo '<td><a href="update.php?id='.$id.'"><img src="../img/icon-pencil32.png" width="14px"></td>';
				echo '<td>'.$row["NINSC"].'</td> 
				<td>' . $row["CNOME"]. '</td>
				<td>' . $row["FTEL"]. '</td>
				<td>' . $row["ATEL"]. '</td>
				</tr><br>';
    		}
			echo '</table>';
		}
		else 
			echo "Nenhum resultado encontrado...";
			
$sql = "SELECT COUNT(*) COUNT FROM `CANDIDATO` WHERE SOCIAL = 'SIM'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
		$row = $result->fetch_assoc();
				echo  '<h4>Total de Bolsa Social: '.$row["COUNT"].'</h4>';				
    		}
$sql = "SELECT COUNT(*) COUNT2 FROM `CANDIDATO` WHERE DC = 'SIM'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
		$row = $result->fetch_assoc();
				echo  '<h4>Total de Desconto Comercial: '.$row["COUNT2"].'</h4>';				
    		}

		desc();
?>
    </div>
    
    <div id="CandidatoNovo" class="tab-pane fade" >
     <iframe src="../index.php" frameborder="0" width="100%" height="1000px"></iframe>
    </div>
    
	<div id="CandidatoListar" class="tab-pane fade">
	
	<script type="text/javascript">
	$(document).ready(function(){

    //Aqui a ativa a imagem de load
    function loading_show(){
		$('#loading').html("<img src='../img/loading.gif'/>").fadeIn('fast');
    }
    
    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }       
    
    
    // aqui a função ajax que busca os dados em outra pagina do tipo html, não é json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
		              loading_show();
				},
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
			        $(div).html(data).fadeIn();				
                }
            });
    }
    
    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'pesquisa.php', '#MostraPesq');
    
    
    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#busca').keyup(function(){
        
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $(this).val();
        
        if($parametro.length >= 1)
        {
            load_dados(valores, 'busca.php', '#MostraPesq');
        }else
        {
            load_dados(null, 'busca.php', '#MostraPesq');
        }
    });

	});
	</script>	    
    
      <h3>Listagem de candidatos</h3>
      
    <form method="post" action="" name="form_pesquisa" id="form_pesquisa">
    <div class="col-lg-4" >    
    <div class="input-group"> 
    	<span class="input-group-addon glyphicon glyphicon-search" id="basic-addon1"></span>    
		<input type="text" class="form-control" placeholder="Busque por: N. de Inscrição, Nome ou Cpf" name="busca" id="busca" aria-describedby="basic-addon1">         
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  </form>
  <br> <br>
	<div id="contentLoading">
		<div id="loading"></div>
	</div>
    
    <div id="MostraPesq"></div>
 
    </div>
    
    <!-- CRIAÇÃO DE USUÁRIO -->    
    <div id="NovoUsuario" class="tab-pane fade">
      <h3>Criação de usuário</h3>
      <form action="<?php SELF ?>" method="post">
      <div class="input-group col-sm-4">
		<span class="input-group-addon" id="basic-addon1">Nome Completo:</span>
		<input type="text" class="form-control" placeholder="Fulado de Tal" aria-describedby="basic-addon1" name="nome">
      </div>
      <div class="input-group col-sm-4">
		<span class="input-group-addon" id="basic-addon1">Nome de Usuário:</span>
		<input type="text" class="form-control" placeholder="fulano.tal" aria-describedby="basic-addon1" name="usuario">
      </div>
      <div class="input-group col-sm-4">
		<span class="input-group-addon" id="basic-addon1">Senha:</span>
		<input type="password" class="form-control" placeholder="" aria-describedby="basic-addon1" name="senha">
      </div>
      <div class="input-group col-sm-4">
		<span class="input-group-addon" id="basic-addon1">Repita a Senha:</span>
		<input type="password" class="form-control" placeholder="" aria-describedby="basic-addon1" name="senhaR">
      </div>			
			<input type="submit" value="Cadastrar" name="cadastrar" class="btn btn-info btn-lg">
		</form>
     <?php
     // inserção de novo usuário
	if (isset($_POST['cadastrar'])) {
	
		if(strcmp($_POST['senha'],$_POST['senhaR'])!=0)
			echo '<script type="text/javascript"> alert("As senhas não conferem.");</script>';				
		else{	
			$con = conectar();
			$sql = "INSERT INTO USUARIO (ID, USUARIO, SENHA, NOME) VALUES (DEFAULT, ?, ?, ?)";
			$stmt = $con->prepare($sql);
    		$ok = $stmt->bind_param("sss", $_POST['usuario'],md5($_POST['senha']), $_POST['nome']);
			if ($ok && $stmt->execute())
				echo '<script type="text/javascript"> alert("Usuário '.$_POST['usuario'].' cadastrado com sucesso!");</script>';			
    		else
        		echo '<script type="text/javascript"> alert("Erro ao inserir dados do candidato.'.$con->error.'");</script>';
		}
	}
	 ?>   
        
    </div>
	<!-- FIM CRIAÇÃO DE USUÁRIO -->
  
	<!-- UPDATE DE USUÁRIO -->
    <div id="EditarUsuario" class="tab-pane fade">
      <h3>Listagem de usuário</h3>
      <?php
		$conn = conectar();
		$sql = "SELECT ID, USUARIO, NOME FROM USUARIO";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {    
			echo '<table border="0" class="table"><thead><tr><th></th><th></th><th>Usuario</th><th>Nome</th></tr>';
			while($row = $result->fetch_assoc()) {
				$id=$row["ID"];
				echo '<tr>';
        		echo '<td><a href="delete.php?id='.$id.'"><img src="../img/wrong-th.png" width="12px"></td>';
				echo '<td><a href="#mymodal'.$id.'" data-toggle="modal" data-target="#myModal'.$id.'"><img src="../img/icon-pencil32.png" width="14px"></td>';				
				
				//MODAL
echo '<div class="modal fade" id="myModal'.$id.'" role="dialog"><div class="modal-dialog"><!-- Modal content--><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Alteração de usuário</h4></div>     

<div class="modal-body" style="color:#000000">  
		       
<form action="';?><?php SELF ?><?php echo'" method="post">
		<input type="text" hidden="" value="'.$id.'" name="Upid">
      <div class="input-group col-sm-8">
		<span class="input-group-addon" id="basic-addon1">Nome Completo:</span>
		<input type="text" class="form-control" aria-describedby="basic-addon2" name="Upnome" value="'.$row['NOME'].'">
      </div>
      <div class="input-group col-sm-8">
		<span class="input-group-addon" id="basic-addon1">Nome de Usuário:</span>
		<input type="text" class="form-control" placeholder="fulano.tal" aria-describedby="basic-addon1" name="Upusuario" value="'.strtolower($row['USUARIO']).'">
      </div>
      <div class="input-group col-sm-8">
		<span class="input-group-addon" id="basic-addon1">Nova Senha:</span>
		<input type="password" class="form-control" placeholder="" aria-describedby="basic-addon1" name="Upsenha">
      </div>
      <div class="input-group col-sm-8">
		<span class="input-group-addon" id="basic-addon1">Repita a nova Senha:</span>
		<input type="password" class="form-control" placeholder="" aria-describedby="basic-addon1" name="UpsenhaR">
      </div>			
			<input type="submit" value="Atualizar" name="updateUser" class="btn btn-info btn-lg">
		</form> 
		
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>';				
			echo '<td>'.$row["USUARIO"].'</td> <td>' . $row["NOME"]. '</td></tr><br>';
    		}
			echo '</table>';
		}
		else 
		echo "0 results";
		
if(isset($_POST['updateUser'])){
	if(strcmp($_POST['Upsenha'],$_POST['UpsenhaR'])!=0)
			echo '<script type="text/javascript"> alert("As senhas não conferem.");</script>';				
		else{	
			$con = conectar();
			$sql = "UPDATE USUARIO SET USUARIO=(?), SENHA =(?), NOME = (?) WHERE ID = (?)";
			$stmt = $con->prepare($sql);
    		$ok = $stmt->bind_param("sssi", $_POST['Upusuario'],md5($_POST['Upsenha']), $_POST['Upnome'], $_POST['Upid']);
			if ($ok && $stmt->execute()){
				echo '<script type="text/javascript"> alert("Usuário '.$_POST['Upusuario'].' alterado com sucesso!");</script>';
				header('');
			}
    		else
        		echo '<script type="text/javascript"> alert("Erro ao alterar dados.'.$con->error.'");</script>';
		}
}
		$conn->close();
	  ?>
     
    </div>
    <!-- FIM UPDATE DE USUÁRIO -->
  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deseja realmente sair do sistema?</h4>
      </div>
      <div class="modal-body">
        <a href="sair.php" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-thumbs-up"></span> Sim</a>
        <button type="button" class="btn btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-down"></span> Não</button>
      </div>
      
    </div>

  </div>
</div>

</body>
</html>