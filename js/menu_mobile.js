jQuery(function($){
	$('#access_site').show();
});
var cpt=0;
function addCPT(){
	return cpt+1;
}
function menu(clicked_id){
	cpt=addCPT();
	if(cpt%2 == 1){
		$('#access_site').hide();
	}
	else{
		$('#access_site').show();
	}
}