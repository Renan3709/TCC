<?php	
	include('../functions/conexao.php');
	$busca = mysql_escape_string($_REQUEST['busca']);
	if(is_numeric($busca)){
		$sql = 'SELECT C.NINSC, C.NOME, F.CPF FROM CANDIDATO C, RESPFIN F WHERE C.NINSC=F.CANDIDATO_NINSC AND F.CPF LIKE "%'.$busca.'%" OR C.NINSC LIKE "%'.$busca.'%" group by C.NINSC LIMIT 200';
		}
		else
			$sql = 'SELECT C.NINSC, C.NOME, F.CPF FROM CANDIDATO C, RESPFIN F WHERE C.NINSC=F.CANDIDATO_NINSC AND C.NOME LIKE "%'.$busca.'%" LIMIT 200';
//echo $sql;
	$conn = conectar();
	$result = $conn->query($sql);
		if ($result->num_rows > 0) {    
			echo '<table border="0" class="table"><tr><th></th><th></th>
			<th>Nº de Insc.</th>
			<th>Candidato</th>			
			<th>Fin. CPF</th>
			</tr>';
			while($row = $result->fetch_assoc()) {
				$id=$row["NINSC"];
				echo '<tr>';
        		echo '<td><a href="PDF/pdf.php?id='.$id.'"><img src="../img/7_PDF_Marquee_1.png" width="12px"></td>';
				echo '<td><a href="update.php?id='.$id.'"><img src="../img/icon-pencil32.png" width="14px"></td>';
				echo '<td>'.$row["NINSC"].'</td> 
				<td>' . $row["NOME"]. '</td>				
				<td>' . $row["CPF"]. '</td>
				</tr><br>';
    		}
			echo '</table>';
		}
		else 
		echo "Nenhum resultado encontrado.";
	//$recordset = mysqli_query($query,$conn);
	//header("Location:usuario.php");
?>	

