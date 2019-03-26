
/// pega rota atual para comparar e poder executar o script na página correta
var url_atual = window.location.href;

if(url_atual === "https://sisalalerta.com/api5533/"){

	home();
	setInterval(home,1000);


}



function ajustar_data(data){


	var data_nova = '';

	var del = data.split("-");

	data_nova = del[2]+"-"+del[1]+"-"+del[0];


	return data_nova;
}


function abrirModal(id){

	$('#modal').find('.modal-body').html('Tem certeza que deseja excluir essa notícia '+id+'? <br><br> <button class="btn btn-info" onclick="deletenews('+id+')">Sim</button> - <button class="btn btn-warning" onclick="fechar()">Não</button>');


	$('#modal').modal('show');





}



function fechar(){

	$('#modal').modal('hide');


}




