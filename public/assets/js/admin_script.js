document.addEventListener('DOMContentLoaded', function () {
        function handleFileUpload(inputId, framesId) {
            const fileInput = document.getElementById(inputId);
            const framesDiv = document.getElementById(framesId);

            fileInput.addEventListener('change', function () {
                framesDiv.innerHTML = '';

                const files = this.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    if (file.type.startsWith('image/')) {
                        const thumbnail = document.createElement('img');
                        thumbnail.classList.add('thumbnail');
                        thumbnail.src = URL.createObjectURL(file);
                        thumbnail.style.height = '150px';
                        thumbnail.style.width = '100px';
                        thumbnail.style.margin = '10px';

                        framesDiv.appendChild(thumbnail);
                    } else {
                        const unsupportedFile = document.createElement('p');
                        unsupportedFile.textContent = 'Unsupported File: ' + file.name;
                        framesDiv.appendChild(unsupportedFile);
                    }
                }
            });
        }
        handleFileUpload('fileAttached', 'framesDoc');
    });
$(function() {
	var base_url = $("#base_url").val();
	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.caStatus').click(function() {
		var status = $(this).data('stat');
		var id = $(this).data('id');
		$.ajax({
			type: "GET",
			dataType: "json",
			url: base_url + '/caStatus',
			data: {'status': status, 'id': id},
			success: function(data){
			  //console.log(data.success)
			  window.location.href=data.redirect;

			}
		});
	});
	
	//Un-assign CA
	$('.caunassign').click(function() {
		var uid = $(this).data('id');
		var iscaactive = $(this).data('iscaactive');
		$('#caUnAssinged').click(function() {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: base_url + '/assign_unassign_ca',
				data: {'id': uid,'iscaactive': iscaactive},
				success: function(data){
				  window.location.href=data.redirect;

				}
			});
		});
	});
	
	//start messages
	var adminMessageFrm = $('#adminMessageFrm').validate({
			rules: {
				
			},
			messages: {
					
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
		});

		$('form#adminMessageFrm').bind('submit',function(){
			if (adminMessageFrm.form()) {
				$('#addMsgLoader').show();
				var formData = $('form#adminMessageFrm').serialize();
				var suburl = base_url + '/send_message';
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					success: function(response) {
						$('#addMsgLoader').hide();
						if (response.class=="succ") {
							$("#adminMessageFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							$("#messageText").val();
						} else {
							$.each(response, function(idx, obj) {
								$("#adminMessageFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//end Messages
		
		//Start add employee
		var addAdminEmployeeFrm = $('#addAdminEmployeeFrm').validate({
		rules: {
			name: {
				required: true
			},
			phone: {
				required: true,
				minlength: 10,
				maxlength: 10,
				number: true
			},
			email: {
				required: true,
				email:true
			},
			password: {
				required: true,
				minlength: 6
			},
			conf_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
			dept_id: {
				required: true,
			},
			desig_id: {
				required: true,
			},
			dob: {
				required: true,
			},
			gender: {
				required: true,
			},
			qualification: {
				required: true,
			},
			c_addr_lineone: {
				required: true
			},
			c_emp_country: {
				required: true
			},
			c_emp_state: {
				required: true
			},
			c_emp_city: {
				required: true
			},
			c_emp_pincode: {
				required: true,
				number: true
			},
			p_addr_lineone: {
				required: true
			},
			p_emp_country: {
				required: true
			},
			p_emp_state: {
				required: true
			},
			p_emp_city: {
				required: true
			},
			p_emp_pincode: {
				required: true,
				number: true
			},
			
			basic_sal: {
				required: true,
				number: true
			},
			hra: {
				required: true,
				number: true
			},
			convayance: {
				required: true,
				number: true
			},
			special_bonus: {
				required: true,
				number: true
			},
			provident_fund: {
				required: true,
				number: true
			},
			esi: {
				required: true,
				number: true
			},
			loan: {
				required: true,
				number: true
			},
			ptax: {
				required: true,
				number: true
			},
			tds: {
				required: true,
				number: true
			},
			total_deduction: {
				required: true,
				number: true
			},
			total_addition: {
				required: true,
				number: true
			},
			net_sal: {
				required: true,
				number: true
			},
			net_sal_word: {
				required: true,
			},
			emp_permission: {
				required: true
			},

		},
		messages: {
				name: {
					required: "Name is required"
				},
				phone: {
					required: "Phone is required"
				},
				email: {
					required: "Email is required"
				},
				password: {
					required: "Password is required"
				},
				conf_password: {
					required: "Confirm password is required"
				},
				dept_id: {
					required: "Dept. is required"
				},
				desig_id: {
					required: "Designation is required"
				},
				dob: {
					required: "DOB is required"
				},
				gender: {
					required: "Gender is required"
				},
				qualification: {
					required: "Qualification is required"
				},
				c_addr_lineone: {
					required: "Address is required"
				},
				c_emp_country: {
					required: "Country is required"
				},
				c_emp_state: {
					required: "State is required"
				},
				c_emp_city: {
					required: "City is required"
				},
				c_emp_pincode: {
					required: "Pincode is required"
				},
				p_addr_lineone: {
					required: "Address is required"
				},
				p_emp_country: {
					required: "Country is required"
				},
				p_emp_state: {
					required: "State is required"
				},
				p_emp_city: {
					required: "City is required"
				},
				p_emp_pincode: {
					required: "Pincode is required"
				},
				
				basic_sal: {
					required: "Salary basic is required"
				},
				hra: {
					required: "HRA is required"
				},
				convayance: {
					required: "Convayance is required"
				},
				special_bonus: {
					required: "Bonus is required"
				},
				provident_fund: {
					required: "PF is required"
				},
				esi: {
					required: "ESI is required"
				},
				loan: {
					required: "Loan is required"
				},
				ptax: {
					required: "PTAX is required"
				},
				tds: {
					required: "TDS is required"
				},
				total_deduction: {
					required: "Total deduction is required"
				},
				total_addition: {
					required: "Total addition is required"
				},
				net_sal: {
					required: "Net salary is required"
				},
				net_sal_word: {
					required: "Salary in word is required"
				},
				

			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addAdminEmployeeFrm').bind('submit',function(){
			if (addAdminEmployeeFrm.form()) {
				$('#addEmployeeLoader').show();
				var formEmployeeData = $('form#addAdminEmployeeFrm').serialize();
				var empId = $("#empId").val();
				if(empId =="") {
					var suburl = base_url + '/save_admin_employee';
				}else{
					var suburl = base_url + '/update_admin_employee';
				}
				$.ajax({
					url: suburl,
					type:'POST',
					data:formEmployeeData,
					success: function(response) {
						$('#addEmployeeLoader').hide();
						if (response.class=="succ") {
							$("#addAdminEmployeeFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addAdminEmployeeFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		
		$('.admin_emp_active').click(function() {
			var status = $(this).data('stat');
			var emp_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/changeAdminEmployeeStatus',
				data: {'status': status, 'id': emp_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});
		
		$('.adminempdelete').click(function() {
			var emp_id = $(this).data('id');
			$('#admin_del_emp').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delAdminEmployee',
					data: {'id': emp_id},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		var addAdminDepertmentFrm = $('#addAdminDepertmentFrm').validate({
		rules: {
			dept_name: {
				required: true
			},
		},
		messages: {
				dept_name: {
					required: "Deptertment is required"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addAdminDepertmentFrm').bind('submit',function(){
			if (addAdminDepertmentFrm.form()) {
				$('#addEmployeeLoader').show();
				var formData = $('form#addAdminDepertmentFrm').serialize();
				var suburl = base_url + '/add_admin_depertment';
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					success: function(response) {
						$('#addEmployeeLoader').hide();
						if (response.class=="succ") {
							$("#addAdminDepertmentFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.reload();
						} else {
							$.each(response, function(idx, obj) {
								$("#addAdminDepertmentFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		
		var addAdminDesignationFrm = $('#addAdminDesignationFrm').validate({
		rules: {
			deptName: {
				required: true
			},
			designation_name: {
				required: true
			},
		},
		messages: {
				deptName: {
					required: "Deptertment is required"
				},
				designation_name: {
					required: "Designation is required"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addAdminDesignationFrm').bind('submit',function(){
			if (addAdminDesignationFrm.form()) {
				$('#addEmployeeLoader').show();
				var formData = {
						 designation_name : $("#addAdminDesignationFrm #designation_name").val(),
						 dept_id : $("#deptName option:selected").val(),
					}
				var suburl = base_url + '/add_admin_designation';
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					success: function(response) {
						$('#addEmployeeLoader').hide();
						if (response.class=="succ") {
							$("#addAdminDesignationFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.reload();
						} else {
							$.each(response, function(idx, obj) {
								$("#addAdminDesignationFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//End add employee
		
		//start Plans
		var addPlanFrm = $('#addPlanFrm').validate({
			rules: {
				
			},
			messages: {
					
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
		});

		$('form#addPlanFrm').bind('submit',function(){
			if (addPlanFrm.form()) {
				$('#addPlanLoader').show();
				var formData = $('form#addPlanFrm').serialize();
				var planId = $("#planId").val();
				if(planId =="") {
					var suburl = base_url + '/save_plan';
				}else{
					var suburl = base_url + '/update_plan';
				}
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					success: function(response) {
						$('#addPlanLoader').hide();
						if (response.class=="succ") {
							$("#addPlanFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							$("#messageText").val();
						} else {
							$.each(response, function(idx, obj) {
								$("#addPlanFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//end Plans
		
		//start create reminder
		var u_id = $("#user_type").val();
		var customer_type = $("#customer_type").val();
		$.ajax({
			url: base_url + "/userLists",
			dataType: "json",
			type: "post",
			data: {id: u_id,customer_type:customer_type},
			success: function( data ) {
			  $("#userId").empty();
			  var str ='';
			  $.each(data, function (idx, item) {
					str +='<option value="' + item.id + '">' + item.name + '</option>';
				});
			  $("#userId").html(str);

			}
		});
	  
		var setReminderFrm = $('#setReminderFrm').validate({
		rules: {
			reminder_type: {
				required: true
			},
			user_type: {
				required: true
			},
			customer_type: {
				required: true
			},
			reminder_through: {
				required: true
			},
			sub_text: {
				required: true
			},
			msg_text: {
				required: true
			},
			
		},
		messages: {
				reminder_type: {
					required: "Remider type is required"
				},
				user_type: {
					required: "User type is required"
				},
				customer_type: {
					required: "Customer type is required"
				},
				reminder_through: {
					required: "Remider through is required"
				},
				sub_text: {
					required: "Subject is required"
				},
				msg_text: {
					required: "Message is required"
				},
				
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#setReminderFrm').bind('submit',function(){
			if (setReminderFrm.form()) {
				$('#setReminderLoader').show();
				//var formData = $('form#setReminderFrm').serialize();
				let reminder_type = $('#setReminderFrm #reminder_type').val();
				let user_type = $('#setReminderFrm #user_type').val();
				let customer_type = $('#setReminderFrm #customer_type').val();
				let reminder_through = $('#setReminderFrm #reminder_through').val();
				let userId = $('#setReminderFrm #userId').val();
				let fileAttached = $('#setReminderFrm #fileAttached').prop('files')[0];
				let sub_text = $('#setReminderFrm #sub_text').val();
				let msg_text = $('#setReminderFrm #msg_text').val();

							

				let reminderData = new FormData();
				reminderData.append('reminder_type', reminder_type);
				reminderData.append('user_type', user_type);
				reminderData.append('customer_type', customer_type);
				reminderData.append('reminder_through', reminder_through);
				reminderData.append('userId', userId);
				reminderData.append('fileAttached', fileAttached);
				reminderData.append('sub_text', sub_text);
				reminderData.append('msg_text', msg_text);		
						
				var suburl = base_url + '/sendReminder';
				$.ajax({
					url: suburl,
					type:'POST',
					data:reminderData,
					contentType: false,
					processData: false,
					success: function(response) {
						
						
						$('#setReminderLoader').hide();
						if (response.class=="succ") {
							$("#setReminderFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							$("#sub_text").val('');
							$("#msg_text").val('');
						} else {
							$.each(response, function(idx, obj) {
								$("#setReminderFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//end create reminder
		
		//Start report
		var profitLossFrm = $('#profitLossFrm').validate({
		rules: {
			fromDate: {
				required: true
			},
			toDate:{
				required:true
			}
		},
		messages: {
				fromDate: {
					required: "From date is required"
				},
				toDate: {
					required: "To date is required"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#profitLossFrm').bind('submit',function(){
			if (profitLossFrm.form()) {
				//$('#reportLoader').show();
				var formData = $('form#profitLossFrm').serialize();				
				var suburl = base_url + '/gen_profit_loss';
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					cache: false,
					xhrFields:{
						responseType: 'blob'
					},
					success: function(res, status, xhr) {						
						var header = xhr.getResponseHeader('Content-Disposition');
						var fileName = header.split("=")[1];
						var blob = new Blob([res]);
						var link = document.createElement('a');
						link.href = window.URL.createObjectURL(blob);
						link.download = fileName;
						link.click();
	
					}
				});
			}
		});
		//End report
		
		
	

});


function getAdminDesignationOptions(el)
	{
		var base_url = $("#base_url").val();
		var id = el.value;
		$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		});
	  $.ajax({
		url: base_url + "/getAdminDesignationOptions?"+id,
		dataType: "json",
		//type: "post",
		data: {id: id},
		success: function( data ) {
		  $("#desig_id").empty();
		  var str ='<option value="">Select</option>';
		  $.each(data, function (idx, item) {
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#desig_id").html(str);

		}

	  });
	}
	
	
	function getUserOptions(el)
	{
		var base_url = $("#base_url").val();
		var id = el.value;
		var customer_type = $("#customer_type").val();
		$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		});
	  $.ajax({
		url: base_url + "/userLists",
		dataType: "json",
		type: "post",
		data: {id: id,customer_type:customer_type},
		success: function( data ) {
		  $("#userId").empty();
		  //var str ='<option value="">Select</option>';
		  var str ='';
		  $.each(data, function (idx, item) {
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#userId").html(str);

		}

	  });
	}
	
	function getUserOptionsByStatus(el)
	{
		var base_url = $("#base_url").val();
		var customer_type = el.value;
		var id = $("#user_type").val();
		$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		});
	  $.ajax({
		url: base_url + "/userLists",
		dataType: "json",
		type: "post",
		data: {id: id,customer_type:customer_type},
		success: function( data ) {
		  $("#userId").empty();
		  //var str ='<option value="">Select</option>';
		  var str ='';
		  $.each(data, function (idx, item) {
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#userId").html(str);

		}

	  });
	}

 	

	
