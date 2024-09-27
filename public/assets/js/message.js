var currentURL = window.location.href;


//Start for scroll down
let updateScroll=()=>{
let element = document.querySelector(".allMassage");
element.scrollTop = element.scrollHeight;
}
//End for scroll down

function fetch_file(){
	$("#attachment_file").trigger("click");
}

function preview_file(el){
	var base_url = $("#base_url").val();
	var attachment_file = $('#attachment_file').prop('files')[0];
	var c_qid = $('#c_qid').val();
	//alert(attachment_file);
	
		var form_data = new FormData();
        form_data.append('attachment_file', attachment_file);
        form_data.append('c_qid', c_qid);
		$('#loader').show();
        $.ajax({
                url: base_url + "/upload_file",
				method: "POST",
				data: form_data,
				contentType: false,
				processData: false,
                success     : function(response){
                    //alert(output);   
					//console.log(response);
					$('#loader').hide();
					if (response.class=="succ") { 
					$("#chat-widget-message-file").val(response.filename);
					$("#file_prev_attachment_section").css('display','block');
					$("#file_prev_attachment_section").html(response.message);
					}else{
						$.each(response, function(idx, obj) {
								$("#chat-form .message-container").html('<div class="err">'+obj+'</div>');
						});
						setTimeout(function() {                             	
							$("#chat-form .message-container div").fadeOut(300, function() {
								$("#chat-form .message-container").html('');
							}); 
						}, 3000);
					}
                }
         });
}

function remove_image(e){
	 e.preventDefault();
        e.stopPropagation();
	$("#file_prev_attachment_section").html('');
	$("#chat-widget-message-file").val('');
	//event.stopPropagation();
}

$(document).ready(function() {
	var base_url = $("#base_url").val();
   updateScroll();
	//Start file upload
	
	 $('#chat-btn').on('click', function() {
        var to_user_id = $('#to_user_id').val();
        var from_user_id = $('#from_user_id').val();
        var chat_message = $('#chat-widget-message-text').val();
        var message_file = $('#chat-widget-message-file').val();
		var c_qid = $('#c_qid').val();
		
        var form_data = new FormData();
        form_data.append('to_user_id', to_user_id);
        form_data.append('from_user_id', from_user_id);
        form_data.append('chat_message', chat_message);
        form_data.append('message_file', message_file);
        form_data.append('c_qid', c_qid);
		
		if(chat_message !="" || message_file!="")
		{
			$('#loader').show();
				$.ajax({
						url         : base_url + "/insert_chat",
						method: "POST",
						data: form_data,
						contentType: false,
						processData: false,
						success     : function(response){
							$('#loader').hide();
							if (response.class=="succ") { 
								$(".chatConversationSection").append(response.message);
								$("#chat-widget-message-text").val('');
								
								$("#chat-widget-message-file").val('');
								$("#file_prev_attachment_section").css('display','none');
								$("#file_prev_attachment_section").html('');
								updateScroll();
							
							}else{
								
							}
						}
				 });
		}
		
    }); 

   



});

//End chat