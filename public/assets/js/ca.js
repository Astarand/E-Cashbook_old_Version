

$(function() {
	var base_url = $("#base_url").val();
	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	//Start Remainder message
	var setReminderFrmCA = $('#setReminderFrmCA').validate({
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

		$('form#setReminderFrmCA').bind('submit',function(){
			if (setReminderFrmCA.form()) {
				$('#setReminderLoader').show();
				//var formData = $('form#setReminderFrmCA').serialize();
				let reminder_type = $('#setReminderFrmCA #reminder_type').val();
				let user_type = $('#setReminderFrmCA #user_type').val();
				let customer_type = $('#setReminderFrmCA #customer_type').val();
				let reminder_through = $('#setReminderFrmCA #reminder_through').val();
				let userId = $('#setReminderFrmCA #userId').val();
				let fileAttached = $('#setReminderFrmCA #fileAttached').prop('files')[0];
				let sub_text = $('#setReminderFrmCA #sub_text').val();
				let msg_text = $('#setReminderFrmCA #msg_text').val();

							

				let reminderData = new FormData();
				reminderData.append('reminder_type', reminder_type);
				reminderData.append('user_type', user_type);
				reminderData.append('customer_type', customer_type);
				reminderData.append('reminder_through', reminder_through);
				reminderData.append('userId', userId);
				reminderData.append('fileAttached', fileAttached);
				reminderData.append('sub_text', sub_text);
				reminderData.append('msg_text', msg_text);		
						
				var suburl = base_url + '/sendReminderCA';
				$.ajax({
					url: suburl,
					type:'POST',
					data:reminderData,
					contentType: false,
					processData: false,
					success: function(response) {
						//console.log(response);
						
						
						$('#setReminderLoader').hide();
						if (response.class=="succ") {
							$("#setReminderFrmCA .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							$("#sub_text").val('');
							$("#msg_text").val('');
							$("#setReminderFrmCA")[0].reset();
							
						} else {
							$.each(response, function(idx, obj) {
								$("#setReminderFrmCA .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});

	//Start CA update profile
		var frmprofileimageCA = $('#frmprofileimageCA').validate({
			rules: {
				comp_logo: {
					required: true
				},
			},
			messages: {
				comp_logo: {
					required: "Image is required"
				}
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

		$("#comp_logo_ca").change(function() {
			if (frmprofileimageCA.form()) {
				$('#loader').show();
				let comp_logo = $('#frmprofileimageCA #comp_logo_ca').prop('files')[0];
				let comp_profile_data = new FormData();
				comp_profile_data.append('comp_logo', comp_logo);

				$.ajax({
					url: base_url + '/update_comp_logo_ca',
					type:'POST',
					data:comp_profile_data,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response.class=="succ") {
							$("#frmprofileimageCA .message-container").html('<div class="'+response.class+'">'+response.message+'</div>').delay(3000).hide("slow");
							$('#image-preview').attr('src', base_url+'/public/uploads/profile/'+response.image_name);
							$('#image-preview-ca').attr('src', base_url+'/public/uploads/profile/'+response.image_name);
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								console.log(obj);
								$("#frmprofileimageCA .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});

		//Delete CA logo delete
		$(".compimagedelCA").click(function() {
				$('#loader').show();
				let comp_logo_data = new FormData();

				$.ajax({
					url: base_url + '/delete_comp_logo_ca',
					type:'POST',
					data:comp_logo_data,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response.class=="succ") {
							$("#frmprofileimage .message-container").html('<div class="'+response.class+'">'+response.message+'</div>').delay(3000).hide("slow");
							$('#image-preview').attr('src', base_url+'/public/assets/img/profiles/avatar-10.jpg');
							$('#image-preview-ca').attr('src', base_url+'/public/assets/img/profiles/avatar-10.jpg');
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								console.log(obj);
								$("#frmprofileimage .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
		});
		
		//Start update company details
		var CAfrmcompdet = $('#CAfrmcompdet').validate({
			rules: {
				
				comp_name: {
					required: true,
					minlength: 3,
				},
				comp_phone: {
					required: true,
					minlength: 10,
					maxlength: 10,
					number: true
				},
				comp_email: {
					required: true,
					email:true
				},

				no_ca_firm: {
					required: true,
				},
				no_employee: {
					required: true,
				},
				total_no_client: {
					required: true,
				},
				
				
				comp_bill_addone: {
					required: true
				},
				comp_bill_country: {
					required: true
				},
				comp_bill_state: {
					required: true
				},
				comp_bill_city: {
					required: true
				},
				comp_bill_pin: {
					required: true
				},
			},

			messages: {
					
					comp_name: {
						required: "Name is required",
					},
					comp_phone: {
						required: "Mobile is required",
						minlength: "10 digits at least"
					},
					comp_email: {
						required: "Email is required",
					},
					no_ca_firm: {
						required: "No of CA in the Firm is required",
					},
					no_employee: {
						required: "No of Employee is required",
					},
					total_no_client: {
						required: "Total No of client is required",
					},
					
					
					comp_bill_addone: {
						required: "Address line1 is required",
					},
					comp_bill_country: {
						required: "Country is required",
					},
					comp_bill_state: {
						required: "State is required",
					},
					comp_bill_city: {
						required: "City is required",
					},
					comp_bill_pin: {
						required: "Pincode is required",
					},

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
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

			$('form#CAfrmcompdet').bind('submit', function(e) {
				
				e.preventDefault(); // Prevent the default form submission
			
				if ($(this).valid()) { // Assuming you're using a validation plugin like jQuery Validate
					$('#loader').show(); // Show the loader
					var formCompData = {
						comp_name: $("#CAfrmcompdet #comp_name").val(),
						comp_phone: $("#CAfrmcompdet #comp_phone").val(),
						comp_email: $("#CAfrmcompdet #comp_email").val(),

						no_ca_firm: $("#CAfrmcompdet #no_ca_firm").val(),
						no_employee: $("#CAfrmcompdet #no_employee").val(),
						total_no_client: $("#CAfrmcompdet #total_no_client").val(),
						about_firm: $("#CAfrmcompdet #about_firm").val(),

						comp_bill_addone: $("#CAfrmcompdet #comp_bill_addone").val(),
						comp_bill_addtwo: $("#CAfrmcompdet #comp_bill_addtwo").val(),
						comp_bill_country: $("#CAfrmcompdet #country option:selected").val(),
						comp_bill_state: $("#CAfrmcompdet #state option:selected").val(),
						comp_bill_city: $("#CAfrmcompdet #city option:selected").val(),
						comp_bill_pin: $("#CAfrmcompdet #comp_bill_pin").val(),
					};
			
					$.ajax({
						url: base_url + '/update_compdet_ca',
						type: 'POST',
						data: formCompData,
						success: function(response) {
							$('#loader').hide(); // Hide the loader
							console.log(response);
							var messageContainer = $("#CAfrmcompdet .message-container");
			
							messageContainer.html(''); // Clear the message container
			
							if (response.class === "succ") {
								messageContainer.html('<div class="' + response.class + '">' + response.message + '</div>');
							} else {
								$.each(response, function(idx, obj) {
									messageContainer.append('<div class="err">' + obj + '</div>');
								});
							}
			
							messageContainer.show(); // Show the message container
			
							// Ensure the message container is visible
							messageContainer.stop(true, true).show();
			
							
							setTimeout(function() {
								messageContainer.fadeOut("slow");
							}, 3000);
						},
						error: function(xhr, status, error) {
							$('#loader').hide(); // Hide the loader
							var messageContainer = $("#CAfrmcompdet .message-container");
			
							messageContainer.html('<div class="err">An error occurred: ' + error + '</div>');
							messageContainer.show();
			
							
							messageContainer.stop(true, true).show();
			
							
							setTimeout(function() {
								messageContainer.fadeOut("slow");
							}, 3000);
						}
					});
				}
			});
			
			
			
		//Start CA Speclization details
		var frmCa_spec = $('#frmCa_spec').validate({
		rules: {
			ca_spec: {
				required: true
			},
		},
		messages: {
				ca_spec: {
					required: "Speclization is required",
				}
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

		$('form#frmCa_spec').on('submit', function(e) {
			e.preventDefault(); // Prevent the default form submission
		
			if ($(this).valid()) { 
				$('#loader').show(); // Show the loader
				var formCASpec = $(this).serialize();
		
				$.ajax({
					url: base_url + '/update_ca_speclization',
					type: 'POST',
					data: formCASpec,
					success: function(response) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#frmCa_spec .message-container");
		
						messageContainer.html(''); // Clear the message container
		
						if (response.class == "succ") {
							messageContainer.html('<div class="' + response.class + '">' + response.message + '</div>');
						} else {
							$.each(response, function(idx, obj) {
								messageContainer.append('<div class="err">' + obj + '</div>');
							});
						}
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					},
					error: function(xhr, status, error) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#frmCa_spec .message-container");
		
						messageContainer.html('<div class="err">An error occurred: ' + error + '</div>');
						messageContainer.show();
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					}
				});
			}
		});
		
			
		//Start CA bank details
		var CAfrmbankdet = $('#CAfrmbankdet').validate({
		rules: {
			bank_name: {
				required: true
			},
			ac_no: {
				required: true,
				number: true
			},
			ifsc_code: {
				required: true
			},
			bank_branch: {
				required: true
			}

		},
		messages: {
				bank_name: {
					required: "Bank name is required",
				},
				ac_no: {
					required: "A/C is required",
				},
				ifsc_code: {
					required: "IFSC is required",
				},
				bank_branch: {
					required: "Brannch name is required",
				}
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

		$('form#CAfrmbankdet').on('submit', function(e) {
			e.preventDefault(); // Prevent the default form submission
		
			if ($(this).valid()) { // Assuming you're using a validation plugin like jQuery Validate
				$('#loader').show(); // Show the loader
				var formCompBank = $(this).serialize();
		
				$.ajax({
					url: base_url + '/update_bankdet_ca',
					type: 'POST',
					data: formCompBank,
					success: function(response) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#CAfrmbankdet .message-container");
		
						messageContainer.html(''); // Clear the message container
		
						if (response.class == "succ") {
							messageContainer.html('<div class="' + response.class + '">' + response.message + '</div>');
						} else {
							$.each(response, function(idx, obj) {
								messageContainer.append('<div class="err">' + obj + '</div>');
							});
						}
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					},
					error: function(xhr, status, error) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#CAfrmbankdet .message-container");
		
						messageContainer.html('<div class="err">An error occurred: ' + error + '</div>');
						messageContainer.show();
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					}
				});
			}
		});
		
		
		//Start CA Partners details
		var frmPartnerdet = $('#frmPartnerdet').validate({
		rules: {
			partner_name: {
				required: true
			},
			partner_no: {
				required: true,
				number: true
			},
			partner_email: {
				required: true
			},
			practicing: {
				required: true
			},
			partner_role: {
				required: true
			},

		},
		messages: {
				partner_name: {
					required: "Partner name is required",
				},
				partner_no: {
					required: "Contact is required",
				},
				partner_email: {
					required: "Email is required",
				},
				practicing: {
					required: "Tenure of Practicing is required",
				},
				partner_role: {
					required: "Role is required",
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

		$('form#frmPartnerdet').on('submit', function(e) {
			e.preventDefault(); // Prevent the default form submission
		
			if ($(this).valid()) { // Assuming you're using a validation plugin like jQuery Validate
				$('#loader').show(); // Show the loader
				var formCApartner = $(this).serialize();
		
				$.ajax({
					url: base_url + '/update_partner_ca',
					type: 'POST',
					data: formCApartner,
					success: function(response) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#frmPartnerdet .message-container");
		
						messageContainer.html(''); // Clear the message container
		
						if (response.class == "succ") {
							messageContainer.html('<div class="' + response.class + '">' + response.message + '</div>');
						} else {
							$.each(response, function(idx, obj) {
								messageContainer.append('<div class="err">' + obj + '</div>');
							});
						}
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					},
					error: function(xhr, status, error) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#frmPartnerdet .message-container");
		
						messageContainer.html('<div class="err">An error occurred: ' + error + '</div>');
						messageContainer.show();
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					}
				});
			}
		});
		
		
		//Start CA attachments update
		var gstdocstate = $("#gstdocstate").val();
		if(gstdocstate =="")
		{
			var CAfrmattadet = $('#CAfrmattadet').validate({
				rules: {
					/**gst_doc: {
						required: true
					},
					pan_doc: {
						required: true
					},
					tan_doc: {
						required: true
					},
					cin_doc: {
						required: true
					},
					other_logo_doc: {
						required: true
					},
					signature_doc: {
						required: true
					},
					stamp_doc: {
						required: true
					},*/
				},
				messages: {
					/**gst_doc: {
						required: "GST doc is required"
					},
					pan_doc: {
						required: "PAN doc is required"
					},
					tan_doc: {
						required: "TAN doc is required"
					},
					cin_doc: {
						required: "CIN doc is required"
					},
					other_logo_doc: {
						required: "Logo is required"
					},
					signature_doc: {
						required: "Signature doc is required"
					},
					stamp_doc: {
						required: "Stamp doc is required"
					},*/
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
		}else{
				var CAfrmattadet = $('#CAfrmattadet').validate({
				rules: {
				},
				messages: {
				},
			});

		}

		$('form#CAfrmattadet').on('submit', function(e) {
			e.preventDefault(); // Prevent the default form submission
		
			if ($(this).valid()) { 
				$('#loader').show(); // Show the loader
		
				let gst_doc = $('#CAfrmattadet #gst_doc').prop('files')[0];
				let pan_doc = $('#CAfrmattadet #pan_doc').prop('files')[0];
				let tan_doc = $('#CAfrmattadet #tan_doc').prop('files')[0];
				let cin_doc = $('#CAfrmattadet #cin_doc').prop('files')[0];
				let other_logo_doc = $('#CAfrmattadet #other_logo_doc').prop('files')[0];
				let signature_doc = $('#CAfrmattadet #signature_doc').prop('files')[0];
				let stamp_doc = $('#CAfrmattadet #stamp_doc').prop('files')[0];
				let chk_agree = $('input[name="checkbox"]:checked').val();
		
				let comp_atta_data = new FormData();
		
				comp_atta_data.append('gst_doc', gst_doc);
				comp_atta_data.append('pan_doc', pan_doc);
				comp_atta_data.append('tan_doc', tan_doc);
				comp_atta_data.append('cin_doc', cin_doc);
				comp_atta_data.append('other_logo_doc', other_logo_doc);
				comp_atta_data.append('signature_doc', signature_doc);
				comp_atta_data.append('stamp_doc', stamp_doc);
				comp_atta_data.append('gstdocstate', $('#gstdocstate').val());
				comp_atta_data.append('chk_agree', chk_agree);
		
				$.ajax({
					url: base_url + '/update_ca_attachment',
					type: 'POST',
					data: comp_atta_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#CAfrmattadet .message-container");
		
						messageContainer.html(''); // Clear the message container
		
						if (response.class == "succ") {
							$("#gstdocstate").val(response.gstdocstate);
							messageContainer.html('<div class="' + response.class + '">' + response.message + '</div>');
						} else {
							$.each(response, function(idx, obj) {
								messageContainer.append('<div class="err">' + obj + '</div>');
							});
						}
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					},
					error: function(xhr, status, error) {
						$('#loader').hide(); // Hide the loader
						var messageContainer = $("#CAfrmattadet .message-container");
		
						messageContainer.html('<div class="err">An error occurred: ' + error + '</div>');
						messageContainer.show();
		
						// Ensure the message container is visible
						messageContainer.stop(true, true).show();
		
						// Optionally hide the message container after some time
						setTimeout(function() {
							messageContainer.fadeOut("slow");
						}, 3000);
					}
				});
			}
		});

		
		

		//Activate customer
		$('.custCAactive').click(function() {
			var status = $(this).data('stat');
			var cust_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/changeCustomerStatus',
				data: {'status': status, 'id': cust_id},
				success: function(data){
				  //console.log(data.success)
					location.reload();
					window.location.href=data.redirect;
				}
			});
		});
		
		//view Customer Details
		$('.viewCustomerDet').click(function() {
			var cust_id = $(this).data('id');
			$.ajax({
				type: "POST",
				dataType: "json",
				url: base_url + '/viewCustomerDet',
				data: {'id': cust_id},
				success: function(data){
				  $("#cLogo").attr("src", base_url+'/public/uploads/profile/'+data.comp_logo);
				  $("#cName").html(data.name);
				  $("#cEmail").html(data.comp_email);
				  $("#cPhone").html(data.comp_phone);
				  $("#cCompName").html(data.comp_name);
				  $(".customer-mail").html(data.comp_website);
				  $(".customer-whatsapp").html(data.comp_phone);
				  $("#cAddr").html(data.comp_bill_addone +','+ data.comp_bill_pin);
				  $("#cReqFor").html('');
				}
			});
		});
		
		$('.viewCustomerDet').click(function() {
			var cust_id = $(this).data('id');
			$('#requestAccept').click(function() {
				var status = 1;
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/acceptCustomerStatus',
					data: {'status': status, 'id': cust_id},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;
					}
				});
			});
			
			$('#requestDelete').click(function() {
				var status = 3;
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/acceptCustomerStatus',
					data: {'status': status, 'id': cust_id},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;
					}
				});
			});
		});

			//Start add Client
		
			var addcustFrm = $('#addcustFrm').validate({
				rules: {
					// comp_gst_no: {
					// 	required: true
					// },
					comp_name: {
						required: true,
						minlength: 3,
					},
					comp_phone: {
						required: true,
						minlength: 10,
						maxlength: 10,
						number: true
					},
					comp_email: {
						required: true,
						email:true
					},
					agent_name: {
						required: true,
						
					},
		
				},
				messages: {
						// comp_gst_no: {
						// 	required: "GST no. is required",
						// },
						comp_name: {
							required: "Name is required",
						},
						comp_phone: {
							required: "Mobile is required",
							minlength: "10 digits at least"
						},
						comp_email: {
							required: "Email is required",
						},
						agent_name: {
							required: "Agent name is required",
							
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
		
				$('form#addcustFrm').bind('submit',function(){
					//alert('ggg');
					//e.preventDefault();
					if (addcustFrm.form()) {
						$('#addProjectLoader').show();
						var custId = $("#custId").val();
						

						if(custId =="") {
							var custurl = base_url + '/save_client';
						}else{
							var custurl = base_url + '/update_client';
						}
						var custData = $('form#addcustFrm').serialize();
						
		
						$.ajax({
							url: custurl,
							type:'POST',
							data:custData,
							success: function(response) {
								//console.log(response);
								$('#addProjectLoader').hide();
								if (response.class=="succ") {
									$("#addProjectFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
									window.location.href=response.redirect;
								} else {
									$.each(response, function(idx, obj) {
										$("#addProjectFrm .message-container").html('<div class="err">'+obj+'</div>');
									});
								}
							}
						});
		
		
					}
				});

				//------------- Email validation ---------------
				$('#comp_email').on('input', function() {
					const email = $(this).val();
					var email_url = base_url + '/comp_check_email';
	
					if (email.length > 0) {
						$.ajax({
							url: email_url,
							method: 'POST',
							data: {
								comp_email: email,
								
							},
							success: function(response) {
								if (response.available) {
									$('#email-feedback').html('<div style="color: green;">Email is available</div>');
								} else {
									$('#email-feedback').html('<div style="color: #cf0505;">Email is already taken</div>');
								}
							},
							error: function(response) {
								if (response.status === 422) {
									$('#email-feedback').html('<div style="color: #cf0505;">Invalid email address</div>');
								}
							}
						});
					} else {
						$('#email-feedback').html(''); // Clear the message if the input is empty
					}
				});
				
		//Start add agent
		var addAgentFrm = $('#addAgentFrm').validate({
		rules: {
			agent_name: {
				required: true
			},
			agent_email: {
				required: true
			},
			agent_phone: {
				required: true,
				number: true
			},
			agent_whats_no: {
				required: true,
				number: true
			},
			address_lineone: {
				required: true
			},
			agent_country: {
				required: true
			},
			agent_state: {
				required: true
			},
			agent_city: {
				required: true
			},
			agent_pincode: {
				required: true
			},

		},
		messages: {
				agent_name: {
					required: "Name is required"
				},
				agent_email: {
					required: "Email is required"
				},
				agent_phone: {
					required: "Contact is required"
				},
				agent_whats_no: {
					required: "Whats no. is required"
				},
				address_lineone: {
					required: "Address is required"
				},
				agent_country: {
					required: "Country is required"
				},
				agent_state: {
					required: "State is required"
				},
				agent_city: {
					required: "City is required"
				},
				agent_pincode: {
					required: "Pincode is required"
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

		$('form#addAgentFrm').bind('submit',function(){
			if (addAgentFrm.form()) {
				$('#addAgentLoader').show();
				var formAgentData = $('form#addAgentFrm').serialize();
				var agentId = $("#agentId").val();
				if(agentId =="") {
					var suburl = base_url + '/save_agent';
				}else{
					var suburl = base_url + '/update_agent';
				}
				$.ajax({
					url: suburl,
					type:'POST',
					data:formAgentData,
					success: function(response) {
						$('#addAgentLoader').hide();
						if (response.class=="succ") {
							$("#addAgentFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addAgentFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//End add agent
		
		//Activate agent
		$('.agent_active').click(function() {
			var status = $(this).data('stat');
			var agent_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/changeAgentStatus',
				data: {'status': status, 'id': agent_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});
		
		//Delete agent
		$('.agentdelete').click(function() {
			var agent_id = $(this).data('id');
			$('#del_agent').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delAgent',
					data: {'id': agent_id},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});

		//Start add task
		var addTaskFrm = $('#addTaskFrm').validate({
			rules: {
				task_date: {          
						required: true
					},
					task_time: {
						required: true
					},
					company_id: {
						required: true
					},
					task_category: {
						required: true
					},
					// task_sub_category: {
					// 	required: true
					// },
					
					agent_id: {
						required: true
					},
					// gov_fees: {
					// 	required: true
					// },
					services_charges: {
						required: true
					},					
					emp_id: {
						required: true
					},
					advance_payment: {
						required: true
					},
					project_priority: {
						required: true
					},
					due_date:{
						required: true
					},
					project_status: {
						required: true
					},
		
				},
				messages: {
					task_date: {
							required: "Date is required"
						},
						task_time: {
							required: "Time is required"
						},
						company_id: {
							required: "Name is required"
						},
						task_category: {
							required: "Category is required"
						},
						// task_sub_category: {
						// 	required: "Sub category is required"
						// },
						
						agent_id: {
							required: "Agent name is required"
						},
						// gov_fees: {
						// 	required: "Goverment is required"
						// },
						services_charges: {
							required: "Charges is required"
						},						
						emp_id: {
							required: "Name is required"
						},
						advance_payment: {
							required: "Advannce payment is required"
						},
						project_priority: {
							required: "Priority is required"
						},
						due_date:{
							required: "Due date is required"
						},
						project_status: {
							required: "Status is required"
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
		
				$('form#addTaskFrm').bind('submit',function(){
					//alert('hi');
					if (addTaskFrm.form()) {
						$('#addTaskLoader').show();
						var formTaskData = $('form#addTaskFrm').serialize();
						var taskId = $("#taskId").val();
						if(taskId =="") {
							var suburl = base_url + '/save_task';
						}else{
							var suburl = base_url + '/update_task';
						}
						$.ajax({
							url: suburl,
							type:'POST',
							data:formTaskData,
							success: function(response) {
								$('#addTaskLoader').hide();
								if (response.class=="succ") {
									$("#addAgentFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
									window.location.href=response.redirect;
								} else {
									$.each(response, function(idx, obj) {
										$("#addAgentFrm .message-container").html('<div class="err">'+obj+'</div>');
									});
								}
							}
						});
					}
		});

		$('#task_category').on("change",function() {
			var taskcatId = $("#task_category option:selected").val();	
			//alert(taskcatId);		
			
				$.ajax({
					type: "POST",
					dataType: "json",
					url: base_url + '/getcat',
					data: {'id': taskcatId},
					success: function(data){
					  console.log(data.success)
					  if(data !=""){
						$("#gov_fees").val(data.govfee);
						$("#services_charges").val(data.service_charge);
						$("#total_amount").val(Number(data.govfee)+Number(data.service_charge))
						$("#due_amount").val(Number(data.govfee)+Number(data.service_charge))
						$("#advance_payment").val(0);
					  }else{
						$("#gov_fees").val(0);
						$("#services_charges").val(0);
						$("#total_amount").val(0);
						$("#due_amount").val(0);
						$("#advance_payment").val(0);
					  }
					}
				});
			
		});
		
		$("#advance_payment").on("change input",function(){
			var advance_payment = $(this).val();
			var total_amount = $("#total_amount").val();
			var due_amount = Number(total_amount) - Number(advance_payment);
			$("#due_amount").val(due_amount);
		});
		//End add task

	
		//Delete task
		$('.taskdelete').click(function() {
			var taskId = $(this).data('id');			
			$('#del_task').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delTask',
					data: {'id': taskId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});

		//Start add taskQuote
	    var addTaskquoteFrm = $('#addTaskquoteFrm').validate({
				rules: {
					task_cat: {          
							required: true
						},
						// task_sub_cat: {
						// 	required: true
						// },
						govfee: {
							required: true
						},
						service_charge: {
							required: true
						}
			
					},
					messages: {
						task_cat: {
								required: "Category is required"
							},
							// task_sub_cat: {
							// 	required: "Sub category is required"
							// },
							govfee: {
								required: "fee is required"
							},
							service_charge: {
								required: "service charge is required"
							}
			
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
			
					$('form#addTaskquoteFrm').bind('submit',function(){
						//alert('hi');
						if (addTaskquoteFrm.form()) {
							$('#addTaskLoader').show();
							var formQuoteData = $('form#addTaskquoteFrm').serialize();
							var quoteId = $("#quoteId").val();
							if(quoteId =="") {
								var suburl = base_url + '/save_quote';
							}else{
								var suburl = base_url + '/update_quote';
							}
							$.ajax({
								url: suburl,
								type:'POST',
								data:formQuoteData,
								success: function(response) {
									$('#addTaskLoader').hide();
									if (response.class=="succ") {
										$("#addTaskquoteFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
										window.location.href=response.redirect;
									} else {
										$.each(response, function(idx, obj) {
											$("#addTaskquoteFrm .message-container").html('<div class="err">'+obj+'</div>');
										});
									}
								}
							});
						}
					});
		//	End taskQuote

		//Delete taskQuote
		$('.quotedelete').click(function() {
			var quoteId = $(this).data('id');			
			$('#del_quote').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delQuote',
					data: {'id': quoteId},
					success: function(data){
					    //console.log(data.success)
						window.location.href=data.redirect;

					}
				});
			});
		});

		

		//Start add employee
		var addEmployeeFrm = $('#addEmployeeFrm').validate({
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

		$('form#addEmployeeFrm').bind('submit',function(){
			if (addEmployeeFrm.form()) {
				$('#addEmployeeLoader').show();
				var formEmployeeData = $('form#addEmployeeFrm').serialize();
				var empId = $("#empId").val();
				if(empId =="") {
					var suburl = base_url + '/save_employee';
				}else{
					var suburl = base_url + '/update_employee';
				}
				$.ajax({
					url: suburl,
					type:'POST',
					data:formEmployeeData,
					success: function(response) {
						$('#addEmployeeLoader').hide();
						if (response.class=="succ") {
							$("#addEmployeeFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addEmployeeFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		
		$('.emp_active').click(function() {
			var status = $(this).data('stat');
			var emp_id = $(this).data('id');
			//alert(emp_id);
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/changeEmployeeStatus',
				data: {'status': status, 'id': emp_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});
		
		$('.empdelete').click(function() {
			var emp_id = $(this).data('id');
			$('#del_emp').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delEmployee',
					data: {'id': emp_id},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		var addDepertmentFrm = $('#addDepertmentFrm').validate({
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

		$('form#addDepertmentFrm').bind('submit',function(){
			if (addDepertmentFrm.form()) {
				$('#addEmployeeLoader').show();
				var formData = $('form#addDepertmentFrm').serialize();
				var suburl = base_url + '/add_depertment';
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					success: function(response) {
						$('#addEmployeeLoader').hide();
						if (response.class=="succ") {
							$("#addDepertmentFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.reload();
						} else {
							$.each(response, function(idx, obj) {
								$("#addDepertmentFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		
		var addDesignationFrm = $('#addDesignationFrm').validate({
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

		$('form#addDesignationFrm').bind('submit',function(){
			if (addDesignationFrm.form()) {
				$('#addEmployeeLoader').show();
				var formData = {
						 designation_name : $("#addDesignationFrm #designation_name").val(),
						 dept_id : $("#deptName option:selected").val(),
					}
				var suburl = base_url + '/add_designation';
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					success: function(response) {
						$('#addEmployeeLoader').hide();
						if (response.class=="succ") {
							$("#addDesignationFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.reload();
						} else {
							$.each(response, function(idx, obj) {
								$("#addDesignationFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//End add employee
		
		//start reminder
		$('#filterApplyBtn').click(function () {
			var task_category = $("#taskCategorySelect option:selected").val();
			if(task_category == ""){
				alert("Please select task category");
				$('#compTaskLists').html("");
			}else{
				$('#compTaskLists').html("");
				$('#addReminderLoader').show();
				$.ajax({
					method: "POST",
					url: base_url + '/company_task_list',
					data: {'task_category': task_category},
					datatype: 'json',
					success: function(result){
						$('#addReminderLoader').hide();
						$('#compTaskLists').html(result);
					}
				});
			}
        });
		
		var bulkMessageFrm = $('#bulkMessageFrm').validate({
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

		$('form#bulkMessageFrm').bind('submit',function(){
			if (bulkMessageFrm.form()) {
				$('#addReminderLoader').show();
				var formData = {
						reminderText : $("#bulkMessageFrm #reminderText").val(),
						subject_text : $("#bulkMessageFrm #subject_text").val(),
						task_category : $("#taskCategorySelect option:selected").val(),
					}
				var suburl = base_url + '/send_bulk_message';
				$.ajax({
					url: suburl,
					type:'POST',
					data:formData,
					success: function(response) {
						$('#addReminderLoader').hide();
						if (response.class=="succ") {
							$("#bulkMessageFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							//window.location.reload();
						} else {
							$.each(response, function(idx, obj) {
								$("#bulkMessageFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//end reminder

	//------------------------------ Ca Dashboard ---------------------------

	//---------- Fetch Current Month -------------

	var monthNames = [
		"January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December"
	];

	var currentMonth = new Date().getMonth(); 
	var month_payment_status = document.getElementById("month_payment_status");
	var customer_payment_status = document.getElementById("customer_payment_status");
	var task_status_month = document.getElementById("task_status_month");
	var onboard_client_month = document.getElementById("onboard_client_month");
	
	

	month_payment_status.value = monthNames[currentMonth];
	customer_payment_status.value = monthNames[currentMonth];
	task_status_month.value = monthNames[currentMonth];
	onboard_client_month.value = monthNames[currentMonth];
	
	


	function populateFinancialYear() {
		var selectElement = $('#select_ca_financial_year');
	
		// Get the current year and month
		var currentYear = new Date().getFullYear();
		var currentMonth = new Date().getMonth() + 1; 
	
		// Determine the current financial year
		var currentFinancialYear;
		if (currentMonth >= 4) { // Financial year starts in April
			currentFinancialYear = currentYear + '-' + (currentYear + 1);
		} else {
			currentFinancialYear = (currentYear - 1) + '-' + currentYear;
		}
	
		// Add financial years starting from 2022 to the current financial year
		for (var year = 2022; year <= currentYear; year++) {
			var financialYear = year + '-' + (year + 1);
			selectElement.append('<option value="' + financialYear + '">FY ' + financialYear + '</option>');
		}
		selectElement.val(currentFinancialYear);
	}
	// Call the function when the document is ready
		populateFinancialYear();  


	//----------------Customer Payment Status -------------------- 

	if ($('#radial-chart').length > 0) {
		var chart; // Declare chart variable globally to reference it later
	
		function updateRadialChart(received, pending, overdue, totalEarning) {
			// Destroy the existing chart instance if it exists
			if (chart) {
				chart.destroy();
			}
	
			var radialChart = {
				chart: {
					height: 350,
					type: 'radialBar',
					toolbar: {
						show: true,
					}
				},
				plotOptions: {
					radialBar: {
						dataLabels: {
							name: {
								fontSize: '22px',
							},
							value: {
								fontSize: '16px',
								formatter: function(val) {
									return '₹' + val.toFixed(2);
								}
							},
							total: {
								show: true,
								label: 'Total Earning',
								formatter: function(w) {
									return '₹' + totalEarning.toFixed(2); 
								},
								style: {
									color: '#1384ea'
								}
							}
						}
					}
				},
				series: [overdue, received, pending],
				labels: ['Overdue', 'Received', 'Pending'],
				colors: ['#000000', '#22cc62', '#FF0000'], 
			};
	
			// Create a new chart instance
			chart = new ApexCharts(document.querySelector("#radial-chart"), radialChart);
			chart.render();
		}
	
		
	}

	function GetCustomerPaymentStatus(select_ca_financial_year, customer_payment_month){
		var base_url = $("#base_url").val();
		
		$.ajax({
			url: base_url + '/get-customer-payment-status',
			type: 'GET',
			data: {select_ca_financial_year: select_ca_financial_year, customer_payment_month: customer_payment_month},
			success: function(response) {
				// Ensure the response values are properly formatted as numbers
				var totalEarning = parseFloat(response.total_earning) || 0;
				var totalReceived = parseFloat(response.total_received) || 0;
				var totalPending = parseFloat(response.total_pending) || 0;
				var totalOverdue = parseFloat(response.total_overdue) || 0;

				// Update text elements
				$('#total_earning').text('₹' + totalEarning.toFixed(2));
				$('#total_received').text('₹' + totalReceived.toFixed(2));
				$('#total_pending').text('₹' + totalPending.toFixed(2));
				$('#total_overdue').text('₹' + totalOverdue.toFixed(2));

				// Update the radial chart with the new values
				updateRadialChart(totalReceived, totalPending, totalOverdue, totalEarning);
			},
			error: function(err) {
				console.log(err);
			}
		});
	}

	// Event listener for changes
	$('#customer_payment_status').change(function() {
		var customer_payment_month = $(this).val();
		var select_ca_financial_year = $('#select_ca_financial_year').val();

		GetCustomerPaymentStatus(select_ca_financial_year, customer_payment_month);
	});

	// Initial load
	
	

	//---------------- Task status ------------
	
	function GetTaskStatus(select_ca_financial_year, task_status_month) {
		var base_url = $("#base_url").val();
	
		$.ajax({
			url: base_url + '/get-task-status',
			type: 'GET',
			data: {select_ca_financial_year: select_ca_financial_year, task_status_month: task_status_month},
			success: function(response) {
				//console.log(response);
	
				$('#total_task').text(response.total_tasks);
				$('#comp_task').text(response.completed_tasks);
				$('#pending_task').text(response.pending_tasks);
				$('#overdue_task').text(response.overdue_tasks);
	
				var total_tasks = response.total_tasks;
				var completed_tasks = response.completed_tasks;
				var pending_tasks = response.pending_tasks;
				var overdue_tasks = response.overdue_tasks;
				
				var comp_task_percent = (completed_tasks / total_tasks) * 100;
				var pending_task_percent = (pending_tasks / total_tasks) * 100;
				var overdue_task_percent = (overdue_tasks / total_tasks) * 100;
	
				// Update progress bars
				$('#comp_task_bar').css('width', comp_task_percent + '%').attr('aria-valuenow', comp_task_percent);
				$('#pending_task_bar').css('width', pending_task_percent + '%').attr('aria-valuenow', pending_task_percent);
				$('#overdue_task_bar').css('width', overdue_task_percent + '%').attr('aria-valuenow', overdue_task_percent);
	
				// Update the task status table
				var taskStatusTableBody = $('#task_staus_table tbody');
				taskStatusTableBody.empty(); // Clear the table body
	
				$.each(response.tasks, function(index, task) {
					var taskStatus = '';
					var statusBadgeClass = '';
	
					if (task.project_status == 3) {
						taskStatus = 'Completed';
						statusBadgeClass = 'bg-success-light';
					} else if (task.project_status == 1) {
						taskStatus = 'Pending';
						statusBadgeClass = 'bg-warning-light text-warning';
					} else if (task.project_status == 2) {
						taskStatus = 'Ongoing';
						statusBadgeClass = 'bg-info-light';
					} else {
						taskStatus = 'Unknown';
						statusBadgeClass = 'bg-secondary-light';
					}
	
					var newRow = `<tr>
						<td>${task.client_name}</td>
						<td>${task.task_sub_category || task.task_category}</td>
						<td>${task.due_date}</td>
						<td><span class="badge ${statusBadgeClass}">${taskStatus}</span></td>
					</tr>`;
	
					taskStatusTableBody.append(newRow);
				});
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
	

	$('#task_status_month').change(function() {
		var task_status_month = $(this).val();
		var select_ca_financial_year = $('#select_ca_financial_year').val();

		GetTaskStatus(select_ca_financial_year, task_status_month);
	});

	// Initial load
	// var select_ca_financial_year = $('#select_ca_financial_year').val();
	// var task_status_month = $('#task_status_month').val();
	// GetTaskStatus(select_ca_financial_year, task_status_month);

	//----------------- Task wise Clients ---------------

	



	function taskWishClient(financialYear) {
		var base_url = $("#base_url").val();
	
		$.ajax({
			url: base_url + '/get-task-client',
			type: 'GET',
			data: {financialYear: financialYear},
			success: function(response) {
				
	
				if ($('#s-bar').length > 0) {
					var serviceCounts = response.serviceCounts;
	
					// Map service counts to the corresponding chart categories
					var chartData = [
						serviceCounts['ROC Return'] || 0,
						serviceCounts['Income Tax Return'] || 0,
						serviceCounts['TDS'] || 0,
						serviceCounts['Company Incorporation'] || 0,
						serviceCounts['PF & ESIC'] || 0,
						serviceCounts['Auditing'] || 0,
						serviceCounts['GST & Taxation'] || 0,
						serviceCounts['P-tax'] || 0,
						serviceCounts['Outsourcing of work'] || 0,
						serviceCounts['Outsourcing of employee'] || 0,
						serviceCounts['Other'] || 0
					];
	
					// Update the chart with new data
					var sBar = {
						chart: {
							height: 350,
							type: 'bar',
							toolbar: {
								show: true,
							}
						},
						plotOptions: {
							bar: {
								horizontal: true,
							}
						},
						dataLabels: {
							enabled: true
						},
						series: [{
							data: chartData
						}],
						xaxis: {
							categories: ['ROC Compliance', 'Income Tax', 'TDS', 'Company Incorporation', 'PF & ESIC', 'Audits', 'GST & Returns', 'P-tax', 'Outsource Work', 'Outsource Employee', 'Other'],
							tickAmount: 5,
							min: 0,
							max: 100,
							labels: {
								formatter: function(val) {
									return val;
								}
							}
						},
					};
	
					var chart = new ApexCharts(document.querySelector("#s-bar"), sBar);
					chart.render();
				}
			},
			error: function(err) {
				console.log(err);
			}
		});
	}
	
	// var select_ca_financial_year = $('#select_ca_financial_year').val();
	// taskWishClient(select_ca_financial_year);

	//------------------Monthwise Onboard Clients Details---------------

	if ($('#invoice_chart').length > 0) {
		var pieCtx = document.getElementById("invoice_chart"),
			pieConfig = {
				colors: ['#22cc62', '#ff0000'],
				series: [0, 0], // Initially set to zero, will be updated by AJAX
				chart: {
					fontFamily: 'Poppins, sans-serif',
					height: 350,
					type: 'donut',
				},
				labels: ['Request Assign', 'Own Assign'],
				legend: {
					show: false
				},
				responsive: [{
					breakpoint: 480,
					options: {
						chart: {
							width: 200
						},
						legend: {
							position: 'bottom'
						}
					}
				}]
			};
	
		var pieChart = new ApexCharts(pieCtx, pieConfig);
		pieChart.render();
	}

	function getMonthwishOnboardClient(finincialYear, selectMonth){

		var base_url = $("#base_url").val();
	
		$.ajax({
			url: base_url + '/get-monthWish-client',
			type: 'GET',
			data: {finincialYear: finincialYear, selectMonth: selectMonth},
			success: function(response) {
				//console.log(response);
				$('#total_assign').text(response.total_assign);
				$('#request_assign').text(response.requested_assign);
				$('#own_assign').text(response.own_assign);
				
				pieChart.updateSeries([response.requested_assign, response.own_assign]);
				
			},
			error: function(err) {
				console.log(err);
			}
		});
		
	}

	$('#onboard_client_month').change(function() {
		var onboard_client_month = $(this).val();
		var finincialYear = $('#select_ca_financial_year').val();
		
		getMonthwishOnboardClient(finincialYear, onboard_client_month)
	});

	//--------------- Monthwise Payment Status ---------
	function monthWishPayment(finincialYear, month_payment_status_month){
		var base_url = $("#base_url").val();
	
		$.ajax({
			url: base_url + '/get-monthWish-payment',
			type: 'GET',
			data: {finincialYear: finincialYear, month_payment_status_month: month_payment_status_month},
			success: function(response) {
				//console.log(response);
				$('#govt_fees').text(response.total_gov_fees_paid);
				$('#month_total_received').text(response.total_amount_received);
				$('#due_payment').text(response.total_payment_due);
				
				
			},
			error: function(err) {
				console.log(err);
			}
		});


	}

	$('#month_payment_status').change(function() {
		var month_payment_status_month = $(this).val();
		var finincialYear = $('#select_ca_financial_year').val();

		
		monthWishPayment(finincialYear, month_payment_status_month);
		
	});



	//------------------ finincial year change --------------

	function getFinincialYearwish(finincialYear){
		var onboard_client_month = $('#onboard_client_month').val();
		var task_status_month = $('#task_status_month').val();
		var customer_payment_month = $('#customer_payment_status').val();
		var month_payment_status_month = $('#month_payment_status').val();

		taskWishClient(finincialYear); //-------- Call the function ------------
		getMonthwishOnboardClient(finincialYear, onboard_client_month)
		GetTaskStatus(finincialYear, task_status_month);
		GetCustomerPaymentStatus(finincialYear, customer_payment_month);
		monthWishPayment(finincialYear, month_payment_status_month)
	}

	$('#select_ca_financial_year').change(function() {
		var finincialYear = $(this).val();
		
		getFinincialYearwish(finincialYear);
		
	});

	// Initial load
	var select_ca_financial_year = $('#select_ca_financial_year').val();
	getFinincialYearwish(select_ca_financial_year);
					

});

	function clearNoti(el)
	{

		var to_uid = el;
		var base_url = $("#base_url").val();
		if(to_uid > 0){
			$.ajax({
				method: "POST",
				//dataType: "json",
				url: base_url + '/clearNotification',
				data: {'to_uid': to_uid},
				success: function(result){
				 $(".notiCount").html(0);
				 $(".notification-list").html('');
				}
			});	
		}
	}
	
	function getDesignationOptions(el)
	{
		var base_url = $("#base_url").val();
		var id = el.value;
		$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		});
	  $.ajax({
		url: base_url + "/getDesignationOptions?"+id,
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

	function getUserAccess(el) {
		var base_url = $("#base_url").val();
		var select_typee = el.value;
		var customer_type = $("#customer_type").val();
		var reminder_type = $("#reminder_type").val();
	
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
			},
		});
	
		$.ajax({
			url: base_url + "/userListsAccess",
			dataType: "json",
			type: "post",
			data: { sendData: 'getData', customer_type: customer_type, select_type: select_typee },
			success: function (data) {
				//console.log(data);
	
				$("#userId").empty();
	
				var str = "";
				var selectedAttr = reminder_type === 'bulk' ? ' selected' : '';
				$.each(data.matched_names, function (idx, item) {
					str +=
						'<option value="' +
						item.userId +
						'"' + selectedAttr + '>' +
						item.comp_name +
						"</option>";
				});
				$("#userId").html(str);
			},
		});
	}
	


	function getUserAccessByStatus(el) {
        var base_url = $("#base_url").val();
        var customer_type = el.value;
        var select_typee = $("#user_type").val();
		var reminder_type = $("#reminder_type").val();


        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: base_url + "/userListsAccess",
            dataType: "json",
            type: "post",
            data: { sendData: 'getData' ,customer_type: customer_type, select_type: select_typee },
            success: function (data) {
                //console.log(data);

                $("#userId").empty();

                var str = "";
				var selectedAttr = reminder_type === 'bulk' ? ' selected' : '';
                $.each(data.matched_names, function (idx, item) {
					str +=
						'<option value="' +
						item.userId +
						'"' + selectedAttr + '>' +
						item.comp_name +
						"</option>";
				});
                $("#userId").html(str);
            },
        });
    }
	// function getUserReminder(el) {
    //     var base_url = $("#base_url").val();
    //     var reminder_type = el.value;
    //     var select_typee = $("#user_type").val();
	// 	var customer_type = $("#customer_type").val();


    //     $.ajaxSetup({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //     });
    //     $.ajax({
    //         url: base_url + "/userListsAccess",
    //         dataType: "json",
    //         type: "post",
    //         data: { sendData: 'getData' ,customer_type: customer_type, select_type: select_typee },
    //         success: function (data) {
    //             //console.log(data);

    //             $("#userId").empty();

    //             var str = "";
	// 			var selectedAttr = reminder_type === 'bulk' ? ' selected' : '';
    //             $.each(data.matched_names, function (idx, item) {
	// 				str +=
	// 					'<option value="' +
	// 					item.id +
	// 					'"' + selectedAttr + '>' +
	// 					item.comp_name +
	// 					"</option>";
	// 			});
    //             $("#userId").html(str);
    //         },
    //     });
    // }


	

	


