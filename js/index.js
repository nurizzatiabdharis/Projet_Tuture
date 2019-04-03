jQuery(function($){
	$('#formCo').hide();
	$('#formIns').hide();
	$('#formUns').hide();
	$('#co').click(function(){
		$('#formIns').hide();
		$('#formUns').hide();
		$('#formCo').slideDown();
	});
	$('#ins').click(function(){
		$('#formCo').hide();
		$('#formUns').hide();
		$('#formIns').slideDown();
	});
	$('#uns_co').click(function(){
		$('#formCo').hide();
		$('#formIns').hide();
		$('#formUns').slideDown();
	});
});
function closeDiv(clicked_id){
	var string_size = clicked_id.length;
	var get_number = clicked_id.substring(string_size-1,string_size);
	$('#warning'+get_number).slideUp();	
}