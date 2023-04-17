$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#cep').blur(function(){
       document.getElementById('load').hidden = false;
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_cep.php', /* URL que será chamada */
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + $('#cep').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#rua').val(data.rua);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.cidade);
                        $('#estado').val(data.estado);
						//document.getElementById('bairro').disabled = true;
						//document.getElementById('cidade').disabled = true;
 						//document.getElementById('estado').disabled = true;
                        document.getElementById('load').hidden = true;
                        $('#numero').focus();
                    }
                }
           });   
   return false;    
   })
});