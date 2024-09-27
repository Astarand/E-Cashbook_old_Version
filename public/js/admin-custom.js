
var base_url = $("#base_url").val();
$(".change-products-form").change(function () {
    $('#searchProductsForm').submit();
});

$("#clearSearch").on("click",function () {
	$(this).closest('form').find("input[type=text], select, textarea").val("");
	 $('#searchProductsForm').submit();
});

$('.orders-page .show-more').click(function () {
    var tr_id = $(this).data('show-tr');
    $('table').find('[data-tr="' + tr_id + '"]').toggle(function () {
        if ($('[data-tr="' + tr_id + '"]').is(':visible')) {
            $('.orders-page .fa-chevron-up').show();
            $('.orders-page .fa-chevron-down').hide();
        } else {
            $('.orders-page .fa-chevron-up').hide();
            $('.orders-page .fa-chevron-down').show();
        }
    });

});

//Color Picker
$('.color-picker').spectrum({
	type: "component",
	showAlpha: false
});

$("form #PreviousBtn1").on("click",function(){
					
			$("#menu1").addClass("active");
			$("#menu2").removeClass("active");

			$("#menu1") .addClass("show");
			$("#menu2") .removeClass("show");
			
			$("#tab1").addClass("active");
			$("#tab2").removeClass("active");
	
});

$("form #NextBtn2").on("click",function(){
					
			$("#menu2").removeClass("active");
			$("#menu3").addClass("active");

			$("#menu2") .removeClass("show");
			$("#menu3") .addClass("show");
			
			$("#tab2").removeClass("active");
			$("#tab3").addClass("active");
	
});

$("form #PreviousBtn2").on("click",function(){
					
			$("#menu2").addClass("active");
			$("#menu3").removeClass("active");

			$("#menu2") .addClass("show");
			$("#menu3") .removeClass("show");
			
			$("#tab2").addClass("active");
			$("#tab3").removeClass("active");
	
});

$("form #NextBtn3").on("click",function(){
					
			$("#menu3").removeClass("active");
			$("#menu4").addClass("active");

			$("#menu3") .removeClass("show");
			$("#menu4") .addClass("show");
			
			$("#tab3").removeClass("active");
			$("#tab4").addClass("active");
	
});

$("form #PreviousBtn3").on("click",function(){
					
			$("#menu3").addClass("active");
			$("#menu4").removeClass("active");

			$("#menu3") .addClass("show");
			$("#menu4") .removeClass("show");
			
			$("#tab3").addClass("active");
			$("#tab4").removeClass("active");
	
});
		//Add product validation
		var AddPrdFrom = $("#AddPrdFrom").validate({
			rules:{
					
					product_title: {
						required: true,
					},
					 image: {
						required: true,
					},
					 brand_id: {
						required: true,
					},
					 category_id: {
						required: true,
					}
				  },
				  messages: {
					product_title: {
						required: "Name is required",
					},
					image: {
						required: "Image is required",
					},
					brand_id: {
						required: "Brand is required",
					},
					category_id: {
						required: "Category is required",
					},
					
					
				},
			});
			 
			$("form#AddPrdFrom #nextBtn1").on("click",function(){
					if (AddPrdFrom.form()) {
						
						$("#menu1").removeClass("active");
						$("#menu2").addClass("active");

						$("#menu1") .removeClass("show");
						$("#menu2") .addClass("show");
						$("#tab1").removeClass("active");
						$("#tab2").addClass("active");	
					 
					}
			 });
			 
			 //Edit product validation
		var EditPrdFrom = $("#EditPrdFrom").validate({
			rules:{
					
					product_title: {
						required: true,
					},
					 brand_id: {
						required: true,
					},
					 category_id: {
						required: true,
					}
				  },
				  messages: {
					product_title: {
						required: "Name is required",
					},
					brand_id: {
						required: "Brand is required",
					},
					category_id: {
						required: "Category is required",
					},
					
					
				},
			});
			 
			$("form#EditPrdFrom #nextBtn1").on("click",function(){
					if (EditPrdFrom.form()) {
						
						$("#menu1").removeClass("active");
						$("#menu2").addClass("active");

						$("#menu1") .removeClass("show");
						$("#menu2") .addClass("show");
						$("#tab1").removeClass("active");
						$("#tab2").addClass("active");	
					 
					}
			 });
			 
			 
		// Upload More Images on publish product
		$('.finish-upload').click(function () {
			$('.finish-upload .finish-text').hide();
			$('.finish-upload .loadUploadOthers').show();
			var someFormElement = document.getElementById('uploadImagesForm');
			//var formData = new FormData(someFormElement);
			
			let image_upload = new FormData();
			let folder = $('#folder').val(); //folder name creation
			let TotalImages = $('#others')[0].files.length; //Total Images
            let images = $('#others')[0];
            for (let i = 0; i < TotalImages; i++) {
                image_upload.append('images' + i, images.files[i]);
            }
            image_upload.append('TotalImages', TotalImages);
            image_upload.append('folder', folder);
			
			$.ajax({
				url: base_url + '/admin/products/uploadOthersImages',
				type: "POST",
				//data: formData,
				data: image_upload,
				contentType: false,
				processData: false,
				success: function (data)
				{
					$('.finish-upload .finish-text').show();
					$('.finish-upload .loadUploadOthers').hide();
					reloadOthersImagesContainer();
					$('#modalMoreImages').modal('hide');
					document.getElementById("uploadImagesForm").reset();
				}
			});
		});
		
		function reloadOthersImagesContainer() {
			$('.others-images-container').empty();
			$('.others-images-container').load(base_url + '/admin/products/loadOthersImages', {"folder": $('[name="folder"]').val()});
		}
		
		function deleteProduct(el)
		{
			if (confirm('Are you sure you want to delete this?')) 
			{
				$("#loader").show();
				$('#formSaveProduct' + el).submit();
			}
		}
		

 
 
 
 function removeSecondaryProductImage(image, folder, container) {
			$.ajax({
				type: "POST",
				url: base_url + '/admin/products/removeSecondaryImage',
				data: {image: image, folder: folder}
			}).done(function (data) {
				$('#image-container-' + container).remove();
			});
		} 



$('.file-upload__input').change(function() {
	  var file = $(this)[0].files[0].name;
	  $(this).next('div').text(file);
	});
	
$(".IsDeleted").on("click",function(){
	
	 swal({
        title: "Are you sure?",
        text: "User profile will be deleted!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, change it!",
		cancelButtonText: "Cancel",
        closeOnConfirm: false
    }).then((willDelete) => {
        
		if(willDelete)
		{
			
		
        var id = $(this).attr('data-id');
		var isdeleted = 1;
		//alert(id);

		let formdata = new FormData();
		
		formdata.append('id', id); 
		formdata.append('isdeleted', isdeleted); ; 
		
		
			if(id !=""){
				$('#loader').show();
			$.ajax({
					url: base_url + "/userDelete",
					method: "POST",
					data: formdata,
					contentType: false,
					processData: false,
					success: function (response) {
							$('#loader').hide();
							if (response.class=="succ") {    
									window.location.href=response.redirect;
								} else {
									
								}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						$('#loader').hide();
						swal("Error deleting!", "Please try again", "error");
					}
				});
			}
		}
		
    });
	
	
});

$(".switchProduct").find("input[type=checkbox]").on("change",function() {

        var visibility = $(this).prop('checked');
        var id = $(this).attr('data-pid');
		//alert(id);

        if(visibility == true) {
            visibility = 1;
        } else {
            visibility = 0;
        }
		
		let formdata = new FormData();
		
		formdata.append('id', id); 
		formdata.append('visibility', visibility); 
			
		$.ajax({
				url: base_url + "/products/product-status",
				method: "POST",
				data: formdata,
				contentType: false,
				processData: false,
				success: function (response) {

				},
			});
        

    });

$(".switch").find("input[type=checkbox]").on("change",function() {

        var isActive = $(this).prop('checked');
        var id = $(this).attr('data-id');
		//alert(id);

        if(isActive == true) {
            isActive = 1;
        } else {
            isActive = 0;
        }
		
		let formdata = new FormData();
		
		formdata.append('id', id); 
		formdata.append('isActive', isActive); 
			
		$.ajax({
				url: base_url + "/userActive",
				method: "POST",
				data: formdata,
				contentType: false,
				processData: false,
				success: function (response) {

				},
			});
        

    });
	
function changeCountry(el)
	  {
		 var id = el.value;
		
			 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		  $.ajax({
			url: base_url + "/getState?"+id,
			dataType: "json",
			//type: "post",
			data: {id: id},
			success: function( data ) {
			  $("#state").empty();
			  $("#city").empty();
			  var str ='<option value="">Select State</option>';
			  $.each(data, function (idx, item) {
					//$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
					str +='<option value="' + item.id + '">' + item.name + '</option>';
				}); 
			  $("#state").html(str);
			  
				
			}

		  });
	  }
	  
	  function changeState(el)
	  {
		 var id = el.value;
		
			 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		  $.ajax({
			url: base_url + "/getCity?"+id,
			dataType: "json",
			//type: "post",
			data: {id: id},
			success: function( data ) {
			  $("#city").empty();
			  var str ='<option value="">Select City</option>';
			  $.each(data, function (idx, item) {
					str +='<option value="' + item.id + '">' + item.name + '</option>';
				}); 
			  $("#city").html(str);

			}

		  });
	  }
	  
	  function changeCountry_buyer(el)
	  {
		 var id = el.value;
		
			 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		  $.ajax({
			url: base_url + "/getState?"+id,
			dataType: "json",
			//type: "post",
			data: {id: id},
			success: function( data ) {
			  $("#onboarding_state").empty();
			  $("#onboarding_city").empty();
			  var str ='<option value="">Select State</option>';
			  $.each(data, function (idx, item) {
					//$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
					str +='<option value="' + item.id + '">' + item.name + '</option>';
				}); 
			  $("#onboarding_state").html(str);

			}

		  });
	  }
	  
	  function changeState_buyer(el)
	  {
		 var id = el.value;
		
			 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		  $.ajax({
			url: base_url + "/getCity?"+id,
			dataType: "json",
			//type: "post",
			data: {id: id},
			success: function( data ) {
			  $("#onboarding_city").empty();
			  var str ='<option value="">Select City</option>';
			  $.each(data, function (idx, item) {
					str +='<option value="' + item.id + '">' + item.name + '</option>';
				}); 
			  $("#onboarding_city").html(str);

			}

		  });
	  }

$(document).ready(function () {
	
	$.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
	$.ajax({
		
			url: base_url + '/admin/getOrdersByMonth',
			type:'POST',
			//data:formData,
			success:function(response){
				
				$('#container-by-month').html(response);

			}
					
		});
    
	$("#orderMonth").on("click",function(){
		
		$(this).addClass("active");
		$("#saleMonth").removeClass("active");
		$("#productMonth").removeClass("active");
		$("#franchiseMonth").removeClass("active");
		$("#buyerMonth").removeClass("active");
		$("#merchantMonth").removeClass("active");
		
		 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		
		$.ajax({
					url: base_url + '/admin/getOrdersByMonth',
					type:'POST',
					//data:formData,
					success:function(response){
						
						$('#container-by-month').html(response);

					}
					
				});
	});
	
	$("#productMonth").on("click",function(){
		
		$("#orderMonth").removeClass("active");
		$("#saleMonth").removeClass("active");
		$(this).addClass("active");
		$("#franchiseMonth").removeClass("active");
		$("#buyerMonth").removeClass("active");
		$("#merchantMonth").removeClass("active");
		
		 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		
		$.ajax({
					url: base_url + '/admin/getProductsByMonths',
					type:'POST',
					//data:formData,
					success:function(response){
						
						$('#container-by-month').html(response);

					}
					
				});
	});
	
	$("#saleMonth").on("click",function(){
		
		$("#orderMonth").removeClass("active");
		$(this).addClass("active");
		$("#productMonth").removeClass("active");
		$("#franchiseMonth").removeClass("active");
		$("#buyerMonth").removeClass("active");
		$("#merchantMonth").removeClass("active");
		
		 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		
		$.ajax({
					url: base_url + '/admin/getSaleByMonths',
					type:'POST',
					//data:formData,
					success:function(response){
						
						$('#container-by-month').html(response);

					}
					
				});
	});
	
	$("#franchiseMonth").on("click",function(){
		
		$("#orderMonth").removeClass("active");
		$("#saleMonth").removeClass("active");
		$("#productMonth").removeClass("active");
		$(this).addClass("active");
		$("#buyerMonth").removeClass("active");
		$("#merchantMonth").removeClass("active");
		
		 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		
		$.ajax({
					url: base_url + '/admin/getFranchiseByMonths',
					type:'POST',
					//data:formData,
					success:function(response){
						
						$('#container-by-month').html(response);

					}
					
				});
	});
	
	$("#buyerMonth").on("click",function(){
		
		$("#orderMonth").removeClass("active");
		$("#saleMonth").removeClass("active");
		$("#productMonth").removeClass("active");
		$("#franchiseMonth").removeClass("active");
		$("#merchantMonth").removeClass("active");
		$(this).addClass("active");
		
		 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		
		$.ajax({
					url: base_url + '/admin/getBuyerByMonths',
					type:'POST',
					//data:formData,
					success:function(response){
						
						$('#container-by-month').html(response);

					}
					
				});
	});
	
	$("#merchantMonth").on("click",function(){
		
		$("#orderMonth").removeClass("active");
		$("#saleMonth").removeClass("active");
		$("#productMonth").removeClass("active");
		$("#franchiseMonth").removeClass("active");
		$("#buyerMonth").removeClass("active");
		$(this).addClass("active");
		
		 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
		
		$.ajax({
					url: base_url + '/admin/getMerchantByMonths',
					type:'POST',
					//data:formData,
					success:function(response){
						
						$('#container-by-month').html(response);

					}
					
				});
	});
	
	/*--------------------Buyer Profile------------*/
			
			var buyerProfile = $("#buyer_profile").validate({
				//errorElement: 'span',
			rules:{
					
					phone: {
						required: true,
						minlength: 10,
						maxlength: 10,
						number: true
					},
					 name: {
						required: true,
						minlength: 3,
						maxlength: 50,
					}, 
					email: {
						required: true,
						email:true
					},
					position: {
						required: true,
						minlength: 3,
						maxlength: 50,
					}, 
					unit: {
						required: true,
						maxlength: 50,
					},
					street: {
						required: true,
						minlength: 3,
						maxlength: 50,
					},
					country: {
						required: true,
					},
					state: {
						required: true,
					},
					city: {
						required: true,
					},
					zipcode: {
						required: true,
						number: true
					},
					company_name: {
						required: true,
						minlength: 3,
						maxlength: 50,
					},
					comp_reg_year: {
						required: true,
					},
					type_of_business: {
						required: true,
					},
					field_of_business: {
						required: true,
					},
					onboarding_unit: {
						required: true,
						maxlength: 50,
					},
					onboarding_street_add: {
						required: true,
						minlength: 3,
						maxlength: 50,
					},
					onboarding_country: {
						required: true,
					},
					onboarding_state: {
						required: true,
					},
					onboarding_city: {
						required: true,
					},
					onboarding_postalcode: {
						required: true,
						number: true
					},
					 business_desc: {
						minlength: 12,
						maxlength: 50,
					}, 
					
					
					
					business_reg_no: {
						required: true,
						number: true,
					},
					id_no: {
						required: true,
						number: true,
					},
					bank_id: {
						required: true,
					},
					account_no: {
						required: true,
						number: true,
					},
					account_name: {
						required: true,
					}
				  },
				  messages: {
					name: {
						required: "Name is required",
					},
					phone: {
						required: "Mobile is required",
						minlength: "10 characters at least"
					},
					email: {
						required: "Email is required",
					},
					position: {
						required: "Position is required",
					},
					unit: {
						required: "Unit is required",
					},
					street: {
						required: "Street is required",
					},
					country: {
						required: "Country is required",
					},
					state: {
						required: "State is required",
					},
					city: {
						required: "City is required",
					},
					zipcode: {
						required: "Zipcode is required",
					},
					company_name: {
						required: "Company name is required",
					},
					comp_reg_year: {
						required: "Company reg. year is required",
					},
					type_of_business: {
						required: "Type of business is required",
					},
					field_of_business: {
						required: "Fields of business is required",
					},
					onboarding_unit: {
						required: "Unit is required",
					},
					onboarding_street_add: {
						required: "Street is required",
					},
					onboarding_country: {
						required: "Country is required",
					},
					onboarding_state: {
						required: "State is required",
					},
					onboarding_city: {
						required: "City is required",
					},
					onboarding_postalcode: {
						required: "Postalcode is required",
					},
					/* business_desc: {
						required: "Business description is required",
					}, */
					
					
					business_reg_no: {
						required: "Business registration no. is required",
					},
					id_no: {
						required: "ID no. is required",
					},
					bank_id: {
						required: "Bank ID is required",
					},
					account_no: {
						required: "Account number is required",
					},
					account_name: {
						required: "Account name is required",
					}
					
				},
			});
			
			$("form#buyer_profile #nxtBtn1").on("click",function(){
					if (buyerProfile.form()) {
						
							
								$("#tab-A").removeClass("active");
								$("#tab-B").addClass("active");

								$("#pane-A") .hide();
								$("#pane-B") .show();
								$("#pane-B") .addClass('show');
								$("#pane-B") .addClass('active');
								
								$('#onboarding_unit').val($('#unit').val());
								$('#onboarding_street_add').val($('#street').val());
								$('#onboarding_postalcode').val($('#zipcode').val());
								
								
								
								//selected onboarding country
								
								//var index = $("#onboarding_country select").length + 1;
								$("#countryDiv").html('');
								//Clone the DropDownList
								var on_country = $("#country").clone();
								//alert(on_country);
					 
								//Set the ID and Name
								on_country.attr("id", "onboarding_country");
								on_country.attr("name", "onboarding_country");
								on_country.attr("onChange", "changeCountry_buyer(this);");
					 
								//[OPTIONAL] Copy the selected value
								var selectedValue = $("#country option:selected").val();
								on_country.find("option[value = '" + selectedValue + "']").attr("selected", "selected");
					 
								//Append to the DIV.
								$("#countryDiv").html(on_country);
								
								//selected onboarding state
								$("#stateDiv").html('');
								var on_state = $("#state").clone();
					 
								on_state.attr("id", "onboarding_state");
								on_state.attr("name", "onboarding_state");
								on_state.attr("onChange", "changeState_buyer(this);");
					 
								var selectedValue = $("#state option:selected").val();
								on_state.find("option[value = '" + selectedValue + "']").attr("selected", "selected");
					 
								$("#stateDiv").html(on_state);
								
								//selected onboarding city
								$("#cityDiv").html('');
								
								var on_city = $("#city").clone();
					 
								on_city.attr("id", "onboarding_city");
								on_city.attr("name", "onboarding_city");
								
								var selectedValue = $("#city option:selected").val();
								on_city.find("option[value = '" + selectedValue + "']").attr("selected", "selected");
								$("#cityDiv").html(on_city);	
							
					 
					}
			 });
			 
			 $("form#buyer_profile #prevBtn1").on("click",function(){
					
							$("#tab-B").removeClass("active");
							$("#tab-A").addClass("active");

							$("#pane-B") .hide();
							$("#pane-A") .show();
							$("#pane-A") .addClass('show');
							$("#pane-A") .addClass('active');
					 
					
			 });
			 
			 $("form#buyer_profile #nxtBtn2").on("click",function(){
					if (buyerProfile.form()) {
							$("#tab-B").removeClass("active");
							$("#tab-C").addClass("active");

							$("#pane-B") .hide();
							$("#pane-C") .show();
							$("#pane-C") .addClass('show');
							$("#pane-C") .addClass('active');
					 
					}
			 });
			 
			 $("form#buyer_profile #prevBtn2").on("click",function(){
					
							$("#tab-C").removeClass("active");
							$("#tab-B").addClass("active");

							$("#pane-C") .hide();
							$("#pane-B") .show();
							$("#pane-B") .addClass('show');
							$("#pane-B") .addClass('active');
					 
					
			 });
			 
			 
			 $('form#buyer_profile').bind('submit',function(){
			 if (buyerProfile.form()) {
					
					let id = $('#userid').val(); 
					let name = $('#name').val(); 
					let position = $('#position').val(); 
					let phone = $('#phone').val(); 
					let email = $('#email').val(); 
					
					let unit = $('#unit').val(); 
					let street = $('#street').val(); 
					let country = $('#country').val(); 
					let state = $('#state').val(); 
					let city = $('#city').val(); 
					let zipcode = $('#zipcode').val(); 
					
					let company_name = $('#company_name').val(); 
					let comp_reg_year = $('#comp_reg_year').val(); 
					let type_of_business = $('#type_of_business').val(); 
					let field_of_business = $('#field_of_business').val(); 
					
					
					let onboarding_unit = $('#onboarding_unit').val(); 
					let onboarding_street_add = $('#onboarding_street_add').val(); 
					let onboarding_country = $('#onboarding_country').val(); 
					let onboarding_state = $('#onboarding_state').val(); 
					let onboarding_city = $('#onboarding_city').val(); 
					let onboarding_postalcode = $('#onboarding_postalcode').val(); 
					let business_desc = $('#business_desc').val(); 
					
					
					
					let business_reg_no = $('#business_reg_no').val(); 
					let business_reg_file = $('#buyer_profile #business_reg_file').prop('files')[0];
					let id_no = $('#id_no').val(); 
					let id_no_file = $('#buyer_profile #id_no_file').prop('files')[0];
					let store_logo = $('#buyer_profile #store_logo').prop('files')[0];
					let store_banner =   $('#buyer_profile #store_banner').prop('files')[0];
					let avatar = $('#buyer_profile #avatar').prop('files')[0];
					
					let business_reg_file_old = $('#business_reg_file_old').val(); 
					let id_no_file_old = $('#id_no_file_old').val(); 
					//alert(store_banner);
					
					let bank_id = $('#bank_id').val();
					let account_no = $('#account_no').val();
					let account_name = $('#account_name').val();
					
					let buyer_data = new FormData();
					
					buyer_data.append('id', id);
					buyer_data.append('name', name);
					buyer_data.append('position', position);
					buyer_data.append('phone', phone);
					buyer_data.append('email', email);
					
					buyer_data.append('unit', unit);
					buyer_data.append('street', street);
					buyer_data.append('country', country);
					buyer_data.append('state', state);
					buyer_data.append('city', city);
					buyer_data.append('zipcode', zipcode);
					
					buyer_data.append('company_name', company_name);
					buyer_data.append('comp_reg_year', comp_reg_year);
					buyer_data.append('type_of_business', type_of_business);
					buyer_data.append('field_of_business', field_of_business);
					
					buyer_data.append('onboarding_unit', onboarding_unit);
					buyer_data.append('onboarding_street_add', onboarding_street_add);
					buyer_data.append('onboarding_country', onboarding_country);
					buyer_data.append('onboarding_state', onboarding_state);
					buyer_data.append('onboarding_city', onboarding_city);
					buyer_data.append('onboarding_postalcode', onboarding_postalcode);
					buyer_data.append('business_desc', business_desc);
					
					
					
					buyer_data.append('business_reg_no', business_reg_no);
					buyer_data.append('business_reg_file', business_reg_file);
					buyer_data.append('onboarding_country', onboarding_country);
					buyer_data.append('id_no', id_no);
					buyer_data.append('id_no_file', id_no_file);
					buyer_data.append('store_logo', store_logo);
					buyer_data.append('store_banner', store_banner);
					buyer_data.append('avatar', avatar);
					
					
					buyer_data.append('bank_id', bank_id);
					buyer_data.append('account_no', account_no);
					buyer_data.append('account_name', account_name);
					
					buyer_data.append('business_reg_file_old', business_reg_file_old);
					buyer_data.append('id_no_file_old', id_no_file_old);
					
					$('#loader').show();
					$.ajax({
						url: base_url + '/admin/update-buyer-profile',
						type: "POST",
						//data: formData,
						data: buyer_data,
						contentType: false,
						processData: false,
						success: function (response)
						{
								
								if (response.class=="succ") {                                           

									$('#loader').hide();
									$(".message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
									window.location.reload();
									/* thankModal_buyer = true;
									if (thankModal_buyer) {
										$('#thankModal_buyer').modal('show'); 
										thankModal_buyer = false;
									} */
									//$("#buyer_profile")[0].reset();
									$(".message-container").html('');
								} else {
									$('#loader').hide();
									$.each(response, function(idx, obj) {
										//alert(obj);
										$("#buyer_profile .message-container").html('<div class="err">'+obj+'</div>');
									});
									
								}
						}
					});
				}
				
			 });
			 
			 
			 //Start Seller profile update
			 
			 var sellerProfile = $("#seller_profile").validate({
			rules:{
					
					phone: {
						required: true,
						minlength: 10,
						maxlength: 10,
						number: true
					},
					 name: {
						required: true,
						minlength: 3,
						maxlength: 50,
					}, 
					email: {
						required: true,
						email:true
					},
					password: {
						required: true,
						minlength: 6,
					}, 
					position: {
						required: true,
						minlength: 3,
						maxlength: 50,
					}, 
					store_name: {
						required: true,
						minlength: 3,
						maxlength: 50,
					},
					store_id: {
						required: true,
						minlength: 3,
						maxlength: 50,
					},
					/* store_url: {
						required: true,
						maxlength: 60,
					}, */
					owner_name: {
						required: true,
						minlength: 3,
						maxlength: 50,
					},
					type_of_business: {
						required: true,
					},
					comp_reg_year: {
						required: true,
					},
					unit: {
						required: true,
						maxlength: 50,
					},
					street: {
						required: true,
						minlength: 3,
						maxlength: 50,
					},
					zipcode: {
						required: true,
						number: true
					},
					country: {
						required: true,
					},
					state: {
						required: true,
					},
					city: {
						required: true,
					},
					product_category: {
						required: true,
					},
					store_desc: {
						required: true,
						minlength: 12,
						maxlength: 300,
					},
					business_reg_no: {
						required: true,
						number: true,
					},
					id_no: {
						required: true,
						number: true,
					},
					bank_id: {
						required: true,
					},
					account_no: {
						required: true,
						number: true,
					},
					account_name: {
						required: true,
					}
				  },
				  messages: {
					name: {
						required: "Name is required",
					},
					phone: {
						required: "Mobile is required",
						minlength: "10 characters at least"
					},
					email: {
						required: "Email is required",
					},
					password: {
						required: "Password is required",
					},
					position: {
						required: "Position is required",
					},
					store_name: {
						required: "Store name is required",
					},
					store_id: {
						required: "Store ID is required",
					},
					/* store_url: {
						required: "Store URL is required",
					}, */
					owner_name: {
						required: "Owner name is required",
					},
					type_of_business: {
						required: "Type of business is required",
					},
					comp_reg_year: {
						required: "Company reg. year is required",
					},
					unit: {
						required: "Unit is required",
					},
					street: {
						required: "Street is required",
					},
					zipcode: {
						required: "Zipcode is required",
					},
					country: {
						required: "Country is required",
					},
					state: {
						required: "State is required",
					},
					city: {
						required: "City is required",
					},
					product_category: {
						required: "Product category is required",
					},
					store_desc: {
						required: "Store description is required",
					},
					business_reg_no: {
						required: "Business registration no. is required",
					},
					id_no: {
						required: "ID no. is required",
					},
					bank_id: {
						required: "Bank ID is required",
					},
					account_no: {
						required: "Account number is required",
					},
					account_name: {
						required: "Account name is required",
					}
				},
			});
			
			
			$("form#seller_profile #nxtBtn").on("click",function(){
					if (sellerProfile.form()) {
						
						
							$("#tab-A").removeClass("active");
							$("#tab-B").addClass("active");

							$("#pane-A") .hide();
							$("#pane-B") .show();
							$("#pane-B") .addClass('show');
							$("#pane-B") .addClass('active');
					 
					}
			 });
			 
			 $("form#seller_profile #prevBtn").on("click",function(){
					
							$("#tab-B").removeClass("active");
							$("#tab-A").addClass("active");

							$("#pane-B") .hide();
							$("#pane-A") .show();
							$("#pane-A") .addClass('show');
							$("#pane-A") .addClass('active');
					 
					
			 });
			 
			 
			 
			 $('form#seller_profile').bind('submit',function(){
			 if (sellerProfile.form()) {
					
							let id = $('#userid').val(); 
							let name = $('#name').val(); 
							let position = $('#position').val(); 
							let phone = $('#phone').val(); 
							let email = $('#email').val(); 
							let password = $('#password').val(); 
							
							let store_name = $('#store_name').val(); 
							let store_id = $('#store_id').val(); 
							let store_url = $('#store_url').val(); 
							let owner_name = $('#owner_name').val(); 
							let type_of_business = $('#type_of_business').val(); 
							let comp_reg_year = $('#comp_reg_year').val(); 
							let unit = $('#unit').val(); 
							let street = $('#street').val(); 
							let country = $('#country').val(); 
							let state = $('#state').val(); 
							let city = $('#city').val(); 
							let zipcode = $('#zipcode').val(); 
							let product_category = $('#product_category').val(); 
							let store_desc = $('#store_desc').val(); 
							let business_reg_no = $('#business_reg_no').val(); 
							let business_reg_file = $('#seller_profile #business_reg_file').prop('files')[0];
							let id_no = $('#id_no').val(); 
							let id_no_file = $('#seller_profile #id_no_file').prop('files')[0];
							let store_logo = $('#seller_profile #store_logo').prop('files')[0];
							let store_banner =   $('#seller_profile #store_banner').prop('files')[0];
							let avatar = $('#seller_profile #avatar').prop('files')[0];
							//alert(store_banner);
							
							let business_reg_file_old = $('#business_reg_file_old').val(); 
							let id_no_file_old = $('#id_no_file_old').val();
							
							let bank_id = $('#bank_id').val();
							let account_no = $('#account_no').val();
							let account_name = $('#account_name').val();
							
							let seller_data = new FormData();
							
							seller_data.append('id', id);
							seller_data.append('name', name);
							seller_data.append('position', position);
							seller_data.append('phone', phone);
							seller_data.append('email', email);
							seller_data.append('password', password);
							
							seller_data.append('store_name', store_name);
							seller_data.append('store_id', store_id);
							seller_data.append('store_url', store_url);
							seller_data.append('owner_name', owner_name);
							seller_data.append('type_of_business', type_of_business);
							seller_data.append('comp_reg_year', comp_reg_year);
							seller_data.append('unit', unit);
							seller_data.append('street', street);
							seller_data.append('country', country);
							seller_data.append('state', state);
							seller_data.append('city', city);
							seller_data.append('zipcode', zipcode);
							seller_data.append('product_category', product_category);
							seller_data.append('store_desc', store_desc);
							seller_data.append('business_reg_no', business_reg_no);
							seller_data.append('business_reg_file', business_reg_file);
							seller_data.append('id_no', id_no);
							seller_data.append('id_no_file', id_no_file);
							seller_data.append('store_logo', store_logo);
							seller_data.append('store_banner', store_banner);
							seller_data.append('avatar', avatar);
							
							seller_data.append('bank_id', bank_id);
							seller_data.append('account_no', account_no);
							seller_data.append('account_name', account_name);
							
							seller_data.append('business_reg_file_old', business_reg_file_old);
							seller_data.append('id_no_file_old', id_no_file_old);
							
							$('#loader').show();
							$.ajax({
								url: base_url + '/admin/update-seller-profile',
								type: "POST",
								//data: formData,
								data: seller_data,
								contentType: false,
								processData: false,
								success: function (response)
								{
										
										if (response.class=="succ") {                                           
											//window.location.href=response.redirect;
											$('#loader').hide();
											$(".message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
											window.location.reload();
											/* thankModal_seller = true;
											if (thankModal_seller) {
												$('#thankModal_seller').modal('show'); 
												thankModal_seller = false;
											} */
											//$("#seller_profile")[0].reset();
											
										} else {
											$('#loader').hide();
											$.each(response, function(idx, obj) {
												//alert(obj);
												$("#seller_profile .message-container").html('<div class="err">'+obj+'</div>');
											});
											
										}
								}
							});
					
					
				}
				
			 });
			 
			 //End Seller profile update
			 
	
});