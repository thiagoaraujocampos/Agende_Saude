// JAVASCRIPT

//MENU FIXO
$(function(){   
	var nav = $('#nav'); 
		if ($(this).scrollTop() > 200) { 
				nav.addClass("menuFixo"); 
			}  
			$(window).scroll(function () { 
				if ($(this).scrollTop() > 200) { 
					nav.slideDown(150);
				} else { 
					nav.slideUp(150);
				} 
			});  
		});

//SCROLL SUAVE
jQuery(document).ready(function($) { 
	$(".scroll").click(function(event){        
 		event.preventDefault();
  			$('html,body').animate({scrollTop:$(this.hash).offset().top}, 600);
 	});
});

//TOOLTIP
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

//DATAPICKER  


//HABILITAR/DESABILITA CAMPO MEDICO
function habilitaMedico() {
    if(document.getElementById('checkMedico').checked){
        document.getElementById('nomeMedico').disabled = false;
    } else {
        document.getElementById('nomeMedico').disabled = true;
    }
};

//HABILITAR/DESABILITA CAMPO ENFERMEIRO
function habilitaEnfermeiro() {
    if(document.getElementById('checkEnfermeiro').checked){
        document.getElementById('nomeEnfermeiro').disabled = false;
    } else {
        document.getElementById('nomeEnfermeiro').disabled = true;
    }
};

//MEMBRO
function sMembro() {
    if(document.getElementById('checkMembro').checked){
        document.getElementById('membroRow').style.backgroundColor = '#CCE4FE';
        document.getElementById('removerMembro').disabled = false;
    } else {
        document.getElementById('membroRow').style.backgroundColor = 'transparent';
        document.getElementById('removerMembro').disabled = true;
    }
};

//DESATIVA/ATIVA PRONT
function desativarPront() {
    document.getElementById('prontuario').style.backgroundColor = '#D6D6D6';
    document.getElementById('prontuarioTitle').innerHTML = "Prontuário nº 'númeroPront' <span style='color: red;'>DESATIVADO</span> <button class='btn btn-success pull-right' id='BtnDesativaPront' onClick='ativarPront();''>Ativar</button>";
    document.getElementById('btnAlterar').disabled = true;
};
function ativarPront() {
    document.getElementById('prontuario').style.backgroundColor = '#FFF';
    document.getElementById('prontuarioTitle').innerHTML = "Prontuário nº 'númeroPront' <button class='btn btn-danger pull-right' id='BtnDesativaPront' onClick='desativarPront();'>Desativar</button>";
};

$(document).ready(function(){
    $("btnDesativaPront").click(function(){
        $('.btnAlterar').hide();
    });
});



