var x = new Array("","---");
var fundamental = new Array("","Manhã", "Tarde", "Integral");
var medio = new Array("","Manhã");


var fundManha = new Array("","1º","2º","3º","4º","5º","6º","7º","8º","9º");
var fundTarde = new Array("","1º","2º","3º","4º","5º","6º","7º");
var integral = new Array("","1º","2º","3º","4º");
var medioManha = new Array("","1º","2º","3º");

function loadTurno(v){
	//pega o valor do select turno
	var objSpan1=document.getElementsByName("turno");
	//eval(v)Ex:listaEscolhida = manhã;
	var listaEscolhida = eval(v);
	document.insc.turno.options.length = listaEscolhida.length;
	for(i=0; i<listaEscolhida.length;i++)
		document.insc.turno.options[i] = new Option(listaEscolhida[i],listaEscolhida[i]);	
	
}

function loadAno(v,x){
	if(v =="fundamental" & x =="Manhã"){
		document.insc.ano.options.length = fundManha.length;
		for(i=0; i<fundManha.length;i++)
			document.insc.ano.options[i] = new Option(fundManha[i],fundManha[i]);
		//window.alert("IF");
	}
	if(v =="fundamental" & x =="Tarde"){
		document.insc.ano.options.length = fundTarde.length;
		for(i=0; i<fundTarde.length;i++)
			document.insc.ano.options[i] = new Option(fundTarde[i],fundTarde[i]);
		//window.alert("IF");
	}
	if(v =="fundamental" & x =="Integral"){
		document.insc.ano.options.length = integral.length;
		for(i=0; i<integral.length;i++)
			document.insc.ano.options[i] = new Option(integral[i],integral[i]);
		//window.alert("IF");
	}
	if(v =="medio" & x =="Manhã"){
		document.insc.ano.options.length = medioManha.length;
		for(i=0; i<medioManha.length;i++)
			document.insc.ano.options[i] = new Option(medioManha[i],medioManha[i]);
		//window.alert("IF");
	}
	//var esco = document.getElementsByName("esc");
	//var tur = document.getElementById("cboTurno");
	//window.alert(esco.item(0).contextMenu, x);

}

function habilitaMat(v){	
		var display = document.getElementById(v).style.display;
		if(display == "block")
			document.getElementById(v).style.display = "none";
		else
			document.getElementById(v).style.display = "block";
		}

function habilitaQuem(v){	
		var display = document.getElementById(v).style.display;
		if(display == "none"){
			document.getElementById(v).style.display = "block";
		}
		else{
			document.getElementById(v).style.display = "block";
			}
		}
		
function desabQuem(v){	
		var display = document.getElementById(v).style.display;
		if(display == "block"){
			document.getElementById(v).style.display = "none";
		}
		else{
			document.getElementById(v).style.display = "none";
			}
		}

function habilitaQuais(v){	
		var display = document.getElementById(v).style.display;
		if(display == "block")
			document.getElementById(v).style.display = "none";
		else
			document.getElementById(v).style.display = "block";
		}

function resetList(){
	loadTurno(x);
	document.insc.turno.options[0].selected = true;
	}

function validaCPF() {

    strCPF = $("#cpf").val();
    strCPF = strCPF.replace(/[^\d]+/g, '');
    var Soma;
    var Resto;
    var cboll = true;
    Soma = 0;

    if (strCPF.length != 11 ||
        strCPF == "00000000000" ||
        strCPF == "11111111111" ||
        strCPF == "22222222222" ||
        strCPF == "33333333333" ||
        strCPF == "44444444444" ||
        strCPF == "55555555555" ||
        strCPF == "66666666666" ||
        strCPF == "77777777777" ||
        strCPF == "88888888888" ||
        strCPF == "99999999999")
        cboll = false;


    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) cboll = false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) cboll = false;

    if (!cboll) {
        $('#cpf').css('background-color', '#FF7171');
		window.alert("Cpf Inválido!");		
        $('#cpf').focus();
    } else {
        $('#cpf').css('background-color', '#FFF');
        return cboll;
    }


}

$(document).ready(function(){
    $("#paifin").click(function(){
		var pDtNasc = $("#pDtNasc").val();
		var pNat = $("#pNat").val();
		var pUf = $("#pUF").val();
		$("#finDtNasc").val(pDtNasc);  
		$("#finNat").val(pNat);       
		$("#finUF").val(pUf); 
    }); 	
	$("#paiaca").click(function(){
		var pDtNasc = $("#pDtNasc").val();
		var pNat = $("#pNat").val();
		var pUf = $("#pUF").val();
		$("#acaDtNasc").val(pDtNasc);  
		$("#acaNat").val(pNat);       
		$("#acaUF").val(pUf); 
    }); 
	
	$("#maeaca").click(function(){
		var pDtNasc = $("#mDtNasc").val();
		var pNat = $("#mNat").val();
		var pUf = $("#mUF").val();
		$("#acaDtNasc").val(pDtNasc);  
		$("#acaNat").val(pNat);       
		$("#acaUF").val(pUf); 
    });  
	
	$("#maefin").click(function(){
		var pDtNasc = $("#mDtNasc").val();
		var pNat = $("#mNat").val();
		var pUf = $("#mUF").val();
		$("#finDtNasc").val(pDtNasc);  
		$("#finNat").val(pNat);       
		$("#finUF").val(pUf); 
    });     
});

