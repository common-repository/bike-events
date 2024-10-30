//Javascript for the Dialog box
//$(function(){
jQuery(document).ready(function($) {
	
	$('#bike-events-go').click( function() {
	
		$('#bike-events').empty();
	
		zip = $('#bike-events-zip').val();
		max_display = $('#bike-events-max_display').val();
		distance = $('#bike-events-distance').val();
		blog_url = $('#bike-events-blog_url').val();
		blog_name = $('#bike-events-blog_name').val();
		links = $('#bike-events-links').val();
		use_ip = $('#bike-events-use_ip').val();
		
		$.ajax({
     	 	url: 'http://www.freehub.net/bike_events_widget.php',
     	 	crossDomain: true,
     	 	data: {	
     	 		zip: zip,
     	 		max_display: max_display,
     	 		distance: distance,   
     	 		blog_url: blog_url, 
     	 		links: links,
     	 		blog_name: blog_name, 	
     	 		use_ip: use_ip, 	
     			 },
     	 	type: 'post',
     	 	dataType: 'html',
   		   	success: function(data) { 
   		   		$('#bike-events-spinner').hide();
   		   		$('#freehub-link').hide();
   		   		$('#bike-events').append(data);
   			},
		});
		
	});
	
	$('#bike-events-go').trigger('click');
	
});
