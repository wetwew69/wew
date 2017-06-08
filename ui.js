////********************************
//// USER INTERFACE FUNCTIONS
////********************************	
//$(document).ready( function(){ resizeDiv(); } );
//
//window.onresize = function(event){ resizeDiv(); }
//
//// change map height according to viewport
//function resizeDiv() {
//	nbh = $('.navbar').height();
//	vpw = $(window).width();
//	vph = $(window).height() - nbh;
//
//	console.log('nbh:'+nbh+' / vpw:'+vpw+' / vph:'+vph);
//	$('#mapid').css({'width': vpw + 'px'});
//	$('#mapid').css({'height': vph + 'px'});
//}	
//
//$("#crop option").filter(function(){
//	return $.trim($(this).text()) ==  'Application 2'
//}).prop('selected', true);
//$('#crop').selectpicker('refresh');


 //********************************
 // USER INTERFACE FUNCTIONS
 //********************************	
 $(document).ready( function(){ resizeDiv(); } );
 
 window.onresize = function(event){ resizeDiv(); }
 
 // change map height according to viewport
 function resizeDiv() {
 	nbh = $('.navbar').height();
 	vpw = $(window).width();
 	vph = $(window).height() - nbh;
 
 	console.log('nbh:'+nbh+' / vpw:'+vpw+' / vph:'+vph);
 	$('#mapid').css({'width': vpw + 'px'});
 	$('#mapid').css({'height': vph + 'px'});
 }	
 
 $("#crop option").filter(function(){
 	return $.trim($(this).text()) ==  'Application 2'
 }).prop('selected', true);
 $('#crop').selectpicker('refresh'); 