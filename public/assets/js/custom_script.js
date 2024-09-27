//Class Active
document.addEventListener("DOMContentLoaded", function () {
    const menuLinks = document.querySelectorAll(".sidebar-menu a");

    // Get the last active menu item from localStorage, if available
    const lastActiveMenuItem = localStorage.getItem("activeMenuItem");

    menuLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            // Remove "active" class from all <li> elements
            const menuItems = document.querySelectorAll(".sidebar-menu li");
            menuItems.forEach((item) => {
                item.classList.remove("active");
            });

            // Add "active" class to the parent <li> element
            link.parentElement.classList.add("active");

            // Save the active menu item in localStorage
            localStorage.setItem("activeMenuItem", link.getAttribute("href"));
        });

        // Set the "active" class based on the stored active menu item
        if (
            lastActiveMenuItem &&
            link.getAttribute("href") === lastActiveMenuItem
        ) {
            link.parentElement.classList.add("active");
        }
    });
});

//Add More Brunch
let branchCount = 1;

function addBillingAddress(button) {
    const billingAddressClone = document
        .querySelector(".form-group-item .col-md-6:first-child")
        .cloneNode(true);

    const inputFields = billingAddressClone.querySelectorAll("input");
    inputFields.forEach((input) => {
        input.value = "";
    });

    const titleElement = billingAddressClone.querySelector(".form-title");
    titleElement.textContent = `Branch Address ${branchCount}`;

    const deleteButton = billingAddressClone.querySelector(".btn-primary");
    deleteButton.textContent = "Delete this Branch";
    deleteButton.onclick = function () {
        deleteBranch(this);
    };
    const shippingAddressSection = document.querySelector(
        ".form-group-item .col-md-6:last-child"
    );
    shippingAddressSection.parentNode.insertBefore(
        billingAddressClone,
        shippingAddressSection.nextSibling
    );
    branchCount++;
}

function deleteBranch(button) {
    const branchSection = button.closest(".col-md-6");
    branchSection.parentNode.removeChild(branchSection);
}
//Photo Company Profile
document.addEventListener("DOMContentLoaded", function () {
    function handleFileUpload(inputId, framesId) {
        const fileInput = document.getElementById(inputId);
        const framesDiv = document.getElementById(framesId);

        fileInput.addEventListener("change", function () {
            framesDiv.innerHTML = "";

            const files = this.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (file.type.startsWith("image/")) {
                    const thumbnail = document.createElement("img");
                    thumbnail.classList.add("thumbnail");
                    thumbnail.src = URL.createObjectURL(file);
                    thumbnail.style.height = "150px";
                    thumbnail.style.width = "100px";
                    thumbnail.style.margin = "10px";

                    framesDiv.appendChild(thumbnail);
                } else {
                    const unsupportedFile = document.createElement("p");
                    unsupportedFile.textContent =
                        "Unsupported File: " + file.name;
                    framesDiv.appendChild(unsupportedFile);
                }
            }
        });
    }

    handleFileUpload("inc_certificate", "frames1");
    handleFileUpload("pan_doc", "frames2");
    handleFileUpload("gst_doc", "frames3");
    // handleFileUpload('tan_doc', 'frames3');
    handleFileUpload("trade_doc", "frames4");
    // handleFileUpload('cin_doc', 'frames4');
    handleFileUpload("pf_doc", "frames5");
    // handleFileUpload('other_logo_doc', 'frames5');
    handleFileUpload("ptex_doc", "frames6");
    // handleFileUpload('signature_doc', 'frames6');
    handleFileUpload("first_diraadh_doc", "frames7");
    handleFileUpload("firstpan_doc", "frames8");
    handleFileUpload("first_dirphoto_doc", "frames9");
    handleFileUpload("second_aadha_doc", "frames10");
    handleFileUpload("second_pan_doc", "frames11");
    handleFileUpload("second_dirphoto_doc", "frames12");
    handleFileUpload("other_logo_doc", "frames13");
    handleFileUpload("signature_doc", "frames14");
    handleFileUpload("stamp_doc", "frames15");
    handleFileUpload("stamp_doc", "frames15");
    // handleFileUpload('stamp_doc', 'frames7');
    //handleFileUpload('exp_inv_doc', 'frames100');
});

function sameAsBillAddr() {
    $("#comp_ship_gst_no").val($("#comp_bill_gst_no").val());
    $("#comp_ship_name").val($("#comp_bill_name").val());
    $("#comp_ship_cont_name").val($("#comp_bill_cont_name").val());
    $("#comp_ship_mobile_no").val($("#comp_bill_mobile_no").val());
    $("#comp_ship_addone").val($("#comp_bill_addone").val());
    $("#comp_ship_addtwo").val($("#comp_bill_addtwo").val());
    $("#country_ship")
        .val($("#country option:selected").val())
        .prop("selected", true);

    var selStateOpt = $("#state option:selected");
    $("#state_ship").empty();
    selStateOpt.each(function () {
        $("#state_ship").append($(this).clone());
    });

    var selCityOpt = $("#city option:selected");
    $("#city_ship").empty();
    selCityOpt.each(function () {
        $("#city_ship").append($(this).clone());
    });
    $("#comp_ship_pin").val($("#comp_bill_pin").val());
}

function sameAsBillAddrSales() {
    $("#ship_name").val($("#bill_name").val());
    $("#ship_addone").val($("#bill_addone").val());
    $("#ship_addtwo").val($("#bill_addtwo").val());
    $("#country_ship")
        .val($("#country option:selected").val())
        .prop("selected", true);

    var selStateOpt = $("#state option:selected");
    $("#state_ship").empty();
    selStateOpt.each(function () {
        $("#state_ship").append($(this).clone());
    });

    var selCityOpt = $("#city option:selected");
    $("#city_ship").empty();
    selCityOpt.each(function () {
        $("#city_ship").append($(this).clone());
    });
    $("#ship_pin").val($("#bill_pin").val());
}

function copyBillAddr() {
    $("#cust_ship_gstno").val($("#cust_bill_gstno").val());
    $("#cust_ship_contact").val($("#cust_bill_contact").val());
    $("#cust_ship_mobilno").val($("#cust_bill_mobilno").val());
    $("#cust_ship_designa").val($("#cust_bill_designa").val());
    $("#cust_ship_name").val($("#cust_bill_name").val());
    $("#cust_ship_addone").val($("#cust_bill_addone").val());
    $("#cust_ship_addtwo").val($("#cust_bill_addtwo").val());
    $("#country_ship")
        .val($("#country option:selected").val())
        .prop("selected", true);

    var selStateOpt = $("#state option:selected");
    $("#state_ship").empty();
    selStateOpt.each(function () {
        $("#state_ship").append($(this).clone());
    });

    var selCityOpt = $("#city option:selected");
    $("#city_ship").empty();
    selCityOpt.each(function () {
        $("#city_ship").append($(this).clone());
    });
    $("#cust_ship_pin").val($("#cust_bill_pin").val());
}

function copVenbillAddr() {
    $("#shipping_name").val($("#billing_name").val());
    $("#shipping_address1").val($("#billing_address1").val());
    $("#shipping_address2").val($("#billing_address2").val());
    $("#country_ship")
        .val($("#country option:selected").val())
        .prop("selected", true);

    var selStateOpt = $("#state option:selected");
    $("#state_ship").empty();
    selStateOpt.each(function () {
        $("#state_ship").append($(this).clone());
    });

    var selCityOpt = $("#city option:selected");
    $("#city_ship").empty();
    selCityOpt.each(function () {
        $("#city_ship").append($(this).clone());
    });
    $("#shipping_pincode").val($("#billing_pincode").val());
}

function sameAsAbove() {
    $("#cont_name").val($("#cust_name").val());
    $("#cont_no").val($("#cust_phone").val());
    $("#cont_email").val($("#cust_email").val());
}

function vansameAsAbove() {
    $("#cont_per_name").val($("#vendor_name").val());
    $("#cont_per_number").val($("#vendor_phone").val());
    $("#cont_per_email").val($("#vendor_email").val());
}

$(function () {
    $(document).on("click", ".toggle-password", function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $(".pass-input");
        input.attr("type") === "password"
            ? input.attr("type", "text")
            : input.attr("type", "password");
    });
    $(document).on("click", ".toggle-password-conf", function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $(".pass-input-conf");
        input.attr("type") === "password"
            ? input.attr("type", "text")
            : input.attr("type", "password");
    });

    var base_url = $("#base_url").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //Start register
    var signupform = $("#signupform").validate({
        rules: {
            u_type: {
                required: true,
            },
            name: {
                required: true,
                minlength: 3,
            },
            phone: {
                required: true,
                //minlength: 10,
                //maxlength: 10,
                number: true,
            },
            email: {
                required: true,
                email: true,
            },
            state_id: {
                required: true,
            },
            city_id: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            confirm_Password: {
                required: true,
                minlength: 6,
                equalTo: "#password",
            },
        },
        messages: {
            u_type: {
                required: "Type is required",
            },
            name: {
                required: "Name is required",
            },
            phone: {
                required: "Mobile is required",
                //minlength: "10 characters at least"
            },
            email: {
                required: "Email is required",
            },
            state_id: {
                required: "State is required",
            },
            city_id: {
                required: "City is required",
            },
            password: {
                required: "Password is required",
                minlength: "6 characters at least",
            },
            confirm_Password: {
                required: "Re-type your password",
                equalTo: "Password does not match",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#signupform").bind("submit", function () {
        if (signupform.form()) {
            $("#registerLoader").show();
            var formDataReg = {
                u_type: $('input[name="u_type"]:checked').val(),
                name: $("#signupform #name").val(),
                phone: $("#signupform #phone").val(),
                email: $("#signupform #email").val(),
                state_id: $("#state option:selected").val(),
                city_id: $("#city option:selected").val(),
                password: $("#signupform #password").val(),
            };

            $.ajax({
                url: base_url + "/register/user",
                type: "POST",
                data: formDataReg,
                success: function (response) {
                    //$("#signupform button[type=submit]").removeAttr('disabled');
                    $("#registerLoader").hide();
                    if (response.class == "succ") {
                        $("#signupform .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        //window.location.href=response.redirect;
                        $("#signupform #name").val("");
                        $("#signupform #phone").val("");
                        $("#signupform #email").val("");
                        $("#signupform #password").val("");
                        $("#signupform #confirm_Password").val("");
                    } else {
                        /* if(response.email!=""){
									$("#signupform .message-container").html('<div class="err">'+response.email+'</div>');
								}
								*/
                        $("#loader").hide();
                        $.each(response, function (idx, obj) {
                            //alert(obj);
                            $("#signupform .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });
    //Start login user
    var loginform = $("#loginform").validate({
        rules: {
            username: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            username: {
                required: "Email is required",
            },
            password: {
                required: "Password is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
        submitHandler: function (form) {
            //$("#loginform button[type=submit]").attr('disabled', true);
            $("#loginLoader").show();
            var username = $("#loginform #username").val();
            var Password = $("#loginform #password").val();
            var remember = $("#cb1").prop("checked"); // true

            var loginForm = $("#loginForm");
            var formData = loginForm.serialize();
            var formData = {
                email: $("#loginform #username").val(),
                password: $("#loginform #password").val(),
                remember: $("#cb1").prop("checked"),
            };

            $.ajax({
                url: base_url + "/login/user",
                type: "POST",
                data: formData,
                success: function (response) {
                    $("#loginLoader").hide();
                    if (response.class == "succ") {
                        window.location = response.redirect;
                    } else {
                        $("#loginform .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        setTimeout(function () {
                            $("#loginform .message-container div").fadeOut(
                                300,
                                function () {
                                    $("#loginform .message-container").html("");
                                }
                            );
                        }, 10000);
                    }
                },
                error: function (data) {},
            });
        },
    });

    //Start forgot password
    var forgotform = $("#forgotform").validate({
        rules: {
            username: {
                required: true,
                email: true,
            },
        },
        messages: {
            username: {
                required: "Email is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
        submitHandler: function (form) {
            //$("#forgotform button[type=submit]").attr('disabled', true);
            var username = $("#forgotform #username").val();
            var forgotform = $("#forgotform");
            var formDataPass = forgotform.serialize();
            var formDataPass = {
                email: $("#forgotform #username").val(),
            };
            $("#newPasswordLoader").show();
            $.ajax({
                url: base_url + "/save_forgotpassword",
                type: "POST",
                data: formDataPass,
                success: function (response) {
                    $("#newPasswordLoader").hide();
                    $("#forgotform .message-container").html(
                        '<div class="' +
                            response.class +
                            '">' +
                            response.message +
                            "</div>"
                    );
                    setTimeout(function () {
                        $("#forgotform .message-container div").fadeOut(
                            300,
                            function () {
                                $("#forgotform .message-container").html("");
                            }
                        );
                    }, 10000);
                },
                error: function (data) {},
            });
        },
    });

    //Start update company details
    // var frmcompdet = $('#frmcompdet').validate({
    // 		rules: {
    // 			gst_reg: {
    // 				required: true
    // 			},
    // 			// comp_gst_no: {
    // 			// 	required: true
    // 			// },
    //             gst_reg_no: {
    // 				required: {
    //                     depends: function(element) {
    //                         return $('#gst_reg').val() == 'Yes';
    //                     }
    //                 }
    // 			},
    // 			comp_tran_type:{
    // 				required: true
    // 			},
    // 			comp_name: {
    // 				required: true,
    // 				minlength: 3,
    // 			},
    // 			comp_type: {
    // 				required: true,
    // 			},
    // 			comp_phone: {
    // 				required: true,
    // 				minlength: 10,
    // 				maxlength: 10,
    // 				number: true
    // 			},
    // 			comp_email: {
    // 				required: true,
    // 				email:true
    // 			},
    // 			comp_pan_no: {
    // 				required: true,
    // 				minlength: 10
    // 			},
    // 			comp_website: {
    // 				//required: true
    // 			},
    // 			comp_bill_name: {
    // 				required: true
    // 			},
    // 			comp_bill_addone: {
    // 				required: true
    // 			},
    // 			comp_bill_country: {
    // 				required: true
    // 			},
    // 			comp_bill_state: {
    // 				required: true
    // 			},
    // 			comp_bill_city: {
    // 				required: true
    // 			},
    // 			comp_bill_pin: {
    // 				required: true
    // 			},

    // 			// comp_ship_name: {
    // 			// 	required: true
    // 			// },
    // 			// comp_ship_addone: {
    // 			// 	required: true
    // 			// },
    // 			// comp_ship_country: {
    // 			// 	required: true
    // 			// },
    // 			// comp_ship_state: {
    // 			// 	required: true
    // 			// },
    // 			// comp_ship_city: {
    // 			// 	required: true
    // 			// },
    // 			// comp_ship_pin: {
    // 			// 	required: true
    // 			// },

    // 			other_comp: {
    // 				required: function(element) {
    // 					return $("#comp_type").val() === 'Other';
    // 				}
    // 			}

    // 		},

    // 		messages: {
    // 				gst_reg: {
    // 					required: "Statement is required",
    // 				},
    // 				gst_reg_no: {
    // 					required: "GST no. is required",
    // 				},
    // 				comp_tran_type:{
    // 					required: "GST tran type is required",
    // 				},
    // 				comp_name: {
    // 					required: "Name is required",
    // 				},
    // 				comp_type: {
    // 					required: "Type is required",
    // 				},
    // 				comp_phone: {
    // 					required: "Mobile is required",
    // 					minlength: "10 digits at least"
    // 				},
    // 				comp_email: {
    // 					required: "Email is required",
    // 				},
    // 				comp_pan_no: {
    // 					required: "PAN no. is required",
    // 					minlength: "10 characters at least"
    // 				},
    // 				comp_website: {
    // 					//required: "website is required"
    // 				},
    // 				comp_bill_name: {
    // 					required: "Name is required",
    // 				},
    // 				comp_bill_addone: {
    // 					required: "Address line1 is required",
    // 				},
    // 				comp_bill_country: {
    // 					required: "Country is required",
    // 				},
    // 				comp_bill_state: {
    // 					required: "State is required",
    // 				},
    // 				comp_bill_city: {
    // 					required: "City is required",
    // 				},
    // 				comp_bill_pin: {
    // 					required: "Pincode is required",
    // 				},
    // 				comp_ship_name: {
    // 					required: "Name is required",
    // 				},
    // 				// comp_ship_addone: {
    // 				// 	required: "Address line1 is required",
    // 				// },
    // 				// comp_ship_country: {
    // 				// 	required: "Country is required",
    // 				// },
    // 				// comp_ship_state: {
    // 				// 	required: "State is required",
    // 				// },
    // 				// comp_ship_city: {
    // 				// 	required: "City is required",
    // 				// },
    // 				// comp_ship_pin: {
    // 				// 	required: "Pincode is required",
    // 				// },
    // 				other_comp: {
    // 					required: "Type Name is required"
    // 				},

    // 			},
    // 			errorElement: "em",
    // 			errorPlacement: function(error, element) {
    // 				// Add the `help-block` class to the error element
    // 				error.addClass("help-block");
    // 				error.insertAfter(element);
    // 			},
    // 			highlight: function(element, errorClass, validClass) {
    // 				$(element).addClass("has-error").removeClass("has-success");
    // 			},
    // 			unhighlight: function(element, errorClass, validClass) {
    // 				$(element).addClass("has-success").removeClass("has-error");
    // 			},
    // 		});

    var frmcompdet = $("#frmcompdet").validate({
        rules: {
            gst_reg: {
                required: true,
            },
            gst_no: {
                required: function (element) {
                    return $("#gst_reg").val() === "Yes";
                },
                // required: {
                //     function(element) {
                //         return $('#gst_reg').val() === 'Yes';
                //     }
                // }
            },
            comp_tran_type: {
                required: true,
            },
            comp_name: {
                required: true,
                minlength: 3,
            },
            comp_type: {
                required: true,
            },
            comp_phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true,
            },
            comp_email: {
                required: true,
                email: true,
            },
            comp_pan_no: {
                required: true,
                minlength: 10,
            },
            comp_website: {
                //required: true
            },
            comp_bill_name: {
                required: true,
            },
            comp_bill_cont_name: {
                required: true,
            },
            comp_bill_mobile_no: {
                required: true,
            },
            comp_bill_addone: {
                required: true,
            },
            comp_bill_country: {
                required: true,
            },
            comp_bill_state: {
                required: true,
            },
            comp_bill_city: {
                required: true,
            },
            comp_bill_pin: {
                required: true,
            },

            // comp_ship_name: {
            // 	required: true
            // },
            // comp_ship_addone: {
            // 	required: true
            // },
            // comp_ship_country: {
            // 	required: true
            // },
            // comp_ship_state: {
            // 	required: true
            // },
            // comp_ship_city: {
            // 	required: true
            // },
            // comp_ship_pin: {
            // 	required: true
            // },

            other_comp: {
                required: function (element) {
                    return $("#comp_type").val() === "Other";
                },
            },
        },

        messages: {
            gst_reg: {
                required: "Statement is required",
            },
            gst_no: {
                required: "GST no. is required",
            },
            comp_tran_type: {
                required: "GST tran type is required",
            },
            comp_name: {
                required: "Name is required",
            },
            comp_bill_cont_name: {
                required: "Contact Person Name",
            },
            comp_bill_mobile_no: {
                required: "Mobile Number is required",
            },
            comp_type: {
                required: "Type is required",
            },
            comp_phone: {
                required: "Mobile is required",
                minlength: "10 digits at least",
            },
            comp_email: {
                required: "Email is required",
            },
            comp_pan_no: {
                required: "PAN no. is required",
                minlength: "10 characters at least",
            },
            comp_website: {
                //required: "website is required"
            },
            comp_bill_name: {
                required: "Name is required",
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
            comp_ship_name: {
                required: "Name is required",
            },
            // comp_ship_addone: {
            // 	required: "Address line1 is required",
            // },
            // comp_ship_country: {
            // 	required: "Country is required",
            // },
            // comp_ship_state: {
            // 	required: "State is required",
            // },
            // comp_ship_city: {
            // 	required: "City is required",
            // },
            // comp_ship_pin: {
            // 	required: "Pincode is required",
            // },
            other_comp: {
                required: "Type Name is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#frmcompdet").bind("submit", function () {
        if (frmcompdet.form()) {
            $("#loader").show();
            var formCompData = {
                gst_reg: $("#frmcompdet #gst_reg").val(),
                gst_no: $("#frmcompdet #gst_no").val(),
                comp_tran_type: $("#frmcompdet #comp_tran_type").val(),
                comp_name: $("#frmcompdet #comp_name").val(),
                comp_type: $("#frmcompdet #comp_type").val(),
                cin: $("#frmcompdet #cin").val(),
                inc_date: $("#frmcompdet #inc_date").val(),
                comp_tan: $("#frmcompdet #comp_tan").val(),
                comp_phone: $("#frmcompdet #comp_phone").val(),
                comp_email: $("#frmcompdet #comp_email").val(),
                comp_pan_no: $("#frmcompdet #comp_pan_no").val(),
                comp_website: $("#frmcompdet #comp_website").val(),
                other_comp_type: $("#frmcompdet #other_comp").val(),

                comp_bill_gst_no: $("#frmcompdet #comp_bill_gst_no").val(),
                comp_bill_name: $("#frmcompdet #comp_bill_name").val(),
                comp_bill_cont_name: $(
                    "#frmcompdet #comp_bill_cont_name"
                ).val(),
                comp_bill_mobile_no: $(
                    "#frmcompdet #comp_bill_mobile_no"
                ).val(),
                comp_bill_addone: $("#frmcompdet #comp_bill_addone").val(),
                comp_bill_addtwo: $("#frmcompdet #comp_bill_addtwo").val(),
                comp_bill_country: $(
                    "#frmcompdet #country option:selected"
                ).val(),
                comp_bill_state: $("#frmcompdet #state option:selected").val(),
                comp_bill_city: $("#frmcompdet #city option:selected").val(),
                comp_bill_pin: $("#frmcompdet #comp_bill_pin").val(),

                comp_ship_gst_no: $("#frmcompdet #comp_ship_gst_no").val(),
                comp_ship_name: $("#frmcompdet #comp_ship_name").val(),
                comp_ship_cont_name: $(
                    "#frmcompdet #comp_ship_cont_name"
                ).val(),
                comp_ship_mobile_no: $(
                    "#frmcompdet #comp_ship_mobile_no"
                ).val(),
                comp_ship_addone: $("#frmcompdet #comp_ship_addone").val(),
                comp_ship_addtwo: $("#frmcompdet #comp_ship_addtwo").val(),
                comp_ship_country: $(
                    "#frmcompdet #country_ship option:selected"
                ).val(),
                comp_ship_state: $(
                    "#frmcompdet #state_ship option:selected"
                ).val(),
                comp_ship_city: $(
                    "#frmcompdet #city_ship option:selected"
                ).val(),
                comp_ship_pin: $("#frmcompdet #comp_ship_pin").val(),
            };
            $.ajax({
                url: base_url + "/update_compdet",
                type: "POST",
                data: formCompData,
                success: function (response) {
                    var messageContainer = $("#frmcompdet .message-container");
                    messageContainer.html("");

                    if (response.class == "succ") {
                        messageContainer
                            .append(
                                '<div class="' +
                                    response.class +
                                    '">' +
                                    response.message +
                                    "</div>"
                            )
                            .show();
                    } else {
                        $("#loader").hide();
                        $.each(response, function (idx, obj) {
                            messageContainer.append(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }

                    // Hide message container after 3 seconds if there are messages
                    if (messageContainer.children().length > 0) {
                        setTimeout(function () {
                            messageContainer.hide("slow");
                        }, 3000);
                    }
                },
            });
        }
    });

    //Start company business details
    var frmbusdet = $("#frmbusdet").validate({
        rules: {
            comp_nature: {
                required: true,
            },
            exact_comp_nature: {
                required: true,
            },
            // turnover_last_year: {
            // 	required: true,
            // 	number: true
            // },
            start_date: {
                required: true,
            },
        },
        messages: {
            comp_nature: {
                required: "Company nature is required",
            },
            exact_comp_nature: {
                required: "Nature of business is required",
            },
            // turnover_last_year: {
            // 	required: "Turnover is required",
            // },
            start_date: {
                required: "Start date is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#frmbusdet").bind("submit", function () {
        if (frmbusdet.form()) {
            $("#loader").show();
            var formCompBusData = {
                comp_nature: $('input[name="comp_nature"]:checked').val(),
                exact_comp_nature: $("#frmbusdet #exact_comp_nature").val(),
                turnover_last_year: $("#frmbusdet #turnover_last_year").val(),
                start_date: $("#frmbusdet #start_date").val(),
            };
            $.ajax({
                url: base_url + "/update_businessdet",
                type: "POST",
                data: formCompBusData,
                success: function (response) {
                    var messageContainer = $("#frmbusdet .message-container");
                    messageContainer.html("");

                    if (response.class == "succ") {
                        $("#frmbusdet .message-container")
                            .append(
                                '<div class="' +
                                    response.class +
                                    '">' +
                                    response.message +
                                    "</div>"
                            )
                            .show();
                    } else {
                        $("#loader").hide();
                        $.each(response, function (idx, obj) {
                            messageContainer.append(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }

                    // Hide message container after 3 seconds if there are messages
                    if (messageContainer.children().length > 0) {
                        setTimeout(function () {
                            messageContainer.hide("slow");
                        }, 3000);
                    }
                },
            });
        }
    });

    //Start company bank details
    var frmbankdet = $("#frmbankdet").validate({
        rules: {
            bank_name: {
                required: true,
            },
            bank_branch: {
                required: true,
            },
            bank_holder_name: {
                required: true,
            },
            ac_no: {
                required: true,
                number: true,
            },
            ifsc_code: {
                required: true,
            },
            //  ac_upid: {
            // 	required: true
            // },
        },
        messages: {
            bank_name: {
                required: "Bank name is required",
            },
            bank_branch: {
                required: "Brance is required",
            },
            bank_holder_name: {
                required: "Name is required",
            },
            ac_no: {
                required: "A/C is required",
            },
            ifsc_code: {
                required: "IFSC is required",
            },
            //  ac_upid: {
            // 	required: "UPID is required"
            // },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    //$('form#frmbankdet').bind('submit',function(){
    $("form#frmbankdet").on("submit", function (e) {
        //e.preventDefault();
        if (frmbankdet.form()) {
            $("#loader").show();
            var formCompBank = $("form#frmbankdet").serialize();
            $.ajax({
                url: base_url + "/update_bankdet",
                type: "POST",
                data: formCompBank,
                success: function (response) {
                    var messageContainer = $("#frmbankdet .message-container");
                    messageContainer.html(""); // Clear previous messages

                    if (response.class == "succ") {
                        messageContainer
                            .html(
                                '<div class="' +
                                    response.class +
                                    '">' +
                                    response.message +
                                    "</div>"
                            )
                            .show();
                    } else {
                        $("#loader").hide();
                        $.each(response, function (idx, obj) {
                            messageContainer.append(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }

                    // Hide message container after 3 seconds if there are messages
                    if (messageContainer.children().length > 0) {
                        setTimeout(function () {
                            messageContainer.hide("slow");
                        }, 3000);
                    }
                },

                // success: function(response) {
                // 	if (response.class=="succ") {
                // 		$("#frmbankdet .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
                // 	} else {
                // 		$('#loader').hide();
                // 		$.each(response, function(idx, obj) {
                // 			$("#frmbankdet .message-container").html('<div class="err">'+obj+'</div>');
                // 		});
                // 	}
                // }
            });
        }
    });

    //Start company attachments update
    var gstdocstate = $("#gstdocstate").val();
    if (gstdocstate == "") {
        var frmattadet = $("#frmattadet").validate({
            rules: {
                inc_certificate: {
                    //required: true
                },
                pan_doc: {
                    //required: true
                },
                gst_doc: {
                    //required: true
                },
                trade_doc: {
                    //required: true
                },
                pf_doc: {
                    //required: true
                },
                ptex_doc: {
                    //required: true
                },
                first_diraadh_doc: {
                    //required: true
                },
                firstpan_doc: {
                    //required: true
                },
                first_dirphoto_doc: {
                    //required: true
                },
                second_aadha_doc: {
                    //required: true
                },
                second_pan_doc: {
                    //required: true
                },
                second_dirphoto_doc: {
                    //required: true
                },
                other_logo_doc: {
                    //required: true
                },
                signature_doc: {
                    //required: true
                },
                stamp_doc: {
                    //required: true
                },
            },
            messages: {
                inc_certificate: {
                    //required: "Incorporation Certificate is required"
                },
                pan_doc: {
                    //required: "PAN doc is required"
                },
                gst_doc: {
                    //required: "GST is required"
                },
                trade_doc: {
                    //required: "trad doc is required"
                },
                pf_doc: {
                    //required: "PF doc is required"
                },
                ptex_doc: {
                    //required: "P-Tex doc is required"
                },
                first_diraadh_doc: {
                    //required: "Aadhar card doc is required"
                },
                firstpan_doc: {
                    //required: "Pan card doc is required"
                },
                first_dirphoto_doc: {
                    //required: "photo doc is required"
                },
                second_aadha_doc: {
                    //required: "Director Aadhar card doc is required"
                },
                second_pan_doc: {
                    //required: "Pan card doc is required"
                },
                second_dirphoto_doc: {
                    //required: "Director Photo doc is required"
                },
                other_logo_doc: {
                    //required: "Logo is required"
                },
                signature_doc: {
                    //required: "Signature doc is required"
                },
                stamp_doc: {
                    //required: "Stamp doc is required"
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    } else {
        var frmattadet = $("#frmattadet").validate({
            rules: {},
            messages: {},
        });
    }

    $("form#frmattadet").bind("submit", function () {
        //if (frmattadet.form()) {
        $("#loader").show();
        let inc_certificate = $("#frmattadet #inc_certificate").prop(
            "files"
        )[0];
        let pan_doc = $("#frmattadet #pan_doc").prop("files")[0];
        let gst_doc = $("#frmattadet #gst_doc").prop("files")[0];
        let trade_doc = $("#frmattadet #trade_doc").prop("files")[0];
        let pf_doc = $("#frmattadet #pf_doc").prop("files")[0];
        let ptex_doc = $("#frmattadet #ptex_doc").prop("files")[0];
        let first_diraadh_doc = $("#frmattadet #first_diraadh_doc").prop(
            "files"
        )[0];
        let firstpan_doc = $("#frmattadet #firstpan_doc").prop("files")[0];
        let first_dirphoto_doc = $("#frmattadet #first_dirphoto_doc").prop(
            "files"
        )[0];
        let second_aadha_doc = $("#frmattadet #second_aadha_doc").prop(
            "files"
        )[0];
        let second_pan_doc = $("#frmattadet #second_pan_doc").prop("files")[0];
        let second_dirphoto_doc = $("#frmattadet #second_dirphoto_doc").prop(
            "files"
        )[0];
        let other_logo_doc = $("#frmattadet #other_logo_doc").prop("files")[0];
        let signature_doc = $("#frmattadet #signature_doc").prop("files")[0];
        let stamp_doc = $("#frmattadet #stamp_doc").prop("files")[0];
        let chk_agree = $('input[name="checkbox"]:checked').val();

        let comp_atta_data = new FormData();

        comp_atta_data.append("inc_certificate", inc_certificate);
        comp_atta_data.append("pan_doc", pan_doc);
        comp_atta_data.append("gst_doc", gst_doc);
        comp_atta_data.append("trade_doc", trade_doc);
        comp_atta_data.append("pf_doc", pf_doc);
        comp_atta_data.append("ptex_doc", ptex_doc);
        comp_atta_data.append("first_diraadh_doc", first_diraadh_doc);
        comp_atta_data.append("firstpan_doc", firstpan_doc);
        comp_atta_data.append("first_dirphoto_doc", first_dirphoto_doc);
        comp_atta_data.append("second_aadha_doc", second_aadha_doc);
        comp_atta_data.append("second_pan_doc", second_pan_doc);
        comp_atta_data.append("second_dirphoto_doc", second_dirphoto_doc);
        comp_atta_data.append("other_logo_doc", other_logo_doc);
        comp_atta_data.append("signature_doc", signature_doc);
        comp_atta_data.append("stamp_doc", stamp_doc);
        comp_atta_data.append("gstdocstate", gstdocstate);
        comp_atta_data.append("chk_agree", chk_agree);
        //console.log(comp_atta_data);
        $.ajax({
            url: base_url + "/update_comp_attachment",
            type: "POST",
            data: comp_atta_data,
            contentType: false,
            processData: false,
            success: function (response) {
                var messageContainer = $("#frmattadet .message-container");
                messageContainer.html(""); // Clear previous messages

                if (response.class == "succ") {
                    $("#gstdocstate").val(response.gstdocstate);
                    messageContainer
                        .html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        )
                        .show();
                } else {
                    $("#loader").hide();
                    $.each(response, function (idx, obj) {
                        messageContainer.append(
                            '<div class="err">' + obj + "</div>"
                        );
                    });
                }

                // Hide message container after 3 seconds if there are messages
                // if (messageContainer.children().length > 0) {
                //     setTimeout(function() {
                //         messageContainer.hide("slow");
                //     }, 3000);
                // }
            },

            // 	// success: function(response) {
            // 	// 	if (response.class=="succ") {
            // 	// 		$("#gstdocstate").val(response.gstdocstate);
            // 	// 		$("#frmattadet .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
            // 	// 	} else {
            // 	// 		$('#loader').hide();
            // 	// 		$.each(response, function(idx, obj) {
            // 	// 			//alert(obj);
            // 	// 			$("#frmattadet .message-container").html('<div class="err">'+obj+'</div>');
            // 	// 		});
            // 	// 	}
            // 	// }
        });

        //}
    });

    //Start company update profile
    var frmprofileimage = $("#frmprofileimage").validate({
        rules: {
            comp_logo: {
                required: true,
            },
        },
        messages: {
            comp_logo: {
                required: "Image is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("#comp_logo").change(function () {
        if (frmprofileimage.form()) {
            $("#loader").show();
            let comp_logo = $("#frmprofileimage #comp_logo").prop("files")[0];
            let comp_profile_data = new FormData();
            comp_profile_data.append("comp_logo", comp_logo);

            $.ajax({
                url: base_url + "/update_comp_logo",
                type: "POST",
                data: comp_profile_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.class == "succ") {
                        $("#frmprofileimage .message-container")
                            .html(
                                '<div class="' +
                                    response.class +
                                    '">' +
                                    response.message +
                                    "</div>"
                            )
                            .delay(3000)
                            .hide("slow");
                        $("#image-preview").attr(
                            "src",
                            base_url +
                                "/public/uploads/profile/" +
                                response.image_name
                        );
                        $("#image-preview-user").attr(
                            "src",
                            base_url +
                                "/public/uploads/profile/" +
                                response.image_name
                        );
                    } else {
                        $("#loader").hide();
                        $.each(response, function (idx, obj) {
                            console.log(obj);
                            $("#frmprofileimage .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    //Delete company logo delete
    $(".compimagedel").click(function () {
        $("#loader").show();
        let comp_logo_data = new FormData();

        $.ajax({
            url: base_url + "/delete_comp_logo",
            type: "POST",
            data: comp_logo_data,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.class == "succ") {
                    $("#frmprofileimage .message-container")
                        .html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        )
                        .delay(3000)
                        .hide("slow");
                    $("#image-preview").attr(
                        "src",
                        base_url + "/public/assets/img/profiles/avatar-10.jpg"
                    );
                } else {
                    $("#loader").hide();
                    $.each(response, function (idx, obj) {
                        console.log(obj);
                        $("#frmprofileimage .message-container").html(
                            '<div class="err">' + obj + "</div>"
                        );
                    });
                }
            },
        });
    });
    //start GST check value
    var gst_reg = $("#gst_reg option:selected").val();
    if (gst_reg == "Yes") {
        $("#gst_reg_no").show();
        $("#gst_reg_tran").show();
    } else {
        $("#gst_reg_no").hide();
        $("#gst_reg_tran").hide();
    }
    $("#gst_reg").on("change", function (e) {
        var optionSelected = $(this).find("option:selected").val();
        if (optionSelected == "Yes") {
            $("#gst_reg_no").show();
            $("#gst_reg_tran").show();
            $("#gst_reg_no").val("");
            $("#gst_reg_tran").val("");
        } else {
            $("#gst_reg_no").hide();
            $("#gst_reg_tran").hide();
            $("#gst_reg_no").val("");
            $("#gst_reg_tran").val("");
        }
    });

    //End GST check value

    //start company type field value
    var companyType = $("#comp_type option:selected").val();
    if (
        companyType == "One person Company (OPC)" ||
        companyType == "LLP Company" ||
        companyType == "PVT Ltd Company" ||
        companyType == "LTD Company" ||
        companyType == "Section-8 Company"
    ) {
        $("#comp_type_cin").show();
        $("#comp_type_inc_date").show();
    } else if (companyType == "Other") {
        $("#comp_type_other").show();
        $("#comp_type_cin").hide();
        $("#comp_type_inc_date").hide();
    } else {
        $("#comp_type_cin").hide();
        $("#comp_type_inc_date").hide();
    }

    $("#comp_type").on("change", function (e) {
        var optionSelected = $(this).find("option:selected").val();

        if (
            optionSelected == "One person Company (OPC)" ||
            optionSelected == "LLP Company" ||
            optionSelected == "PVT Ltd Company" ||
            optionSelected == "LTD Company" ||
            optionSelected == "Section-8 Company"
        ) {
            $("#comp_type_cin").show();
            $("#comp_type_inc_date").show();
            $("#comp_type_cin").val("");
            $("#comp_type_inc_date").val("");
            $("#comp_type_other").hide();
            $("#other_comp").val("");
        } else if (optionSelected == "Other") {
            $("#comp_type_other").show();
            $("#other_comp").val("");
            $("#comp_type_cin").hide();
            $("#comp_type_inc_date").hide();
        } else {
            $("#comp_type_cin").hide();
            $("#comp_type_inc_date").hide();
            $("#comp_type_cin").val("");
            $("#comp_type_inc_date").val("");
            $("#comp_type_other").hide();
            $("#other_comp").val("");
        }

        // if(optionSelected =="Other"){
        // 	$("#comp_type_other").show();
        // }else{
        // 	$("#comp_type_other").show();

        // }
    });
    //end company type field value
    //Start add customer

    $("form#add_cust_bill #prevBtnTwo").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-A").addClass("active");

        $("#details").hide();
        $("#info").show();
        $("#info").addClass("show");
        $("#info").addClass("active");
    });

    $("form#add_cust_bank #prevBtnThree").on("click", function () {
        $("#tab-C").removeClass("active");
        $("#tab-B").addClass("active");

        $("#bank").hide();
        $("#details").show();
        $("#details").addClass("show");
        $("#details").addClass("active");
    });

    var addCustDetails = $("#add_cust_detail").validate({
        rules: {
            cust_value: {
                required: true,
            },
            gst_reg: {
                required: true,
            },
            cust_pan: {
                required: true,
            },
            cust_name: {
                required: true,
            },
            cust_gst_no: {
                required: true,
            },
            // cust_gst_type: {
            // 	//required: true
            //     required: function(element) {
            // 		return $("#gst_reg").val() === 'Yes';
            // 	}
            // },
            other_comp: {
                required: function (element) {
                    return $("#comp_type").val() === "Other";
                },
            },
            cust_email: {
                required: true,
                email: true,
            },
            cust_phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
            },
            cont_name: {
                required: true,
            },
            cont_no: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
            },
            cont_email: {
                //required: true,
                email: true,
            },
            cont_notes: {
                //required: true
            },
        },
        messages: {
            cust_value: {
                required: "Priority is required",
            },
            gst_reg: {
                required: "Please select the status",
            },
            cust_pan: {
                required: "PAN is required",
            },
            cust_name: {
                required: "Name is required",
            },
            cust_gst_no: {
                required: "GST no. is required",
            },
            cust_gst_type: {
                required: "GST type is required",
            },
            cust_email: {
                required: "Email is required",
            },
            cust_phone: {
                required: "Phone is required",
            },
            cont_name: {
                required: "Name is required",
            },
            cont_no: {
                required: "Contact is required",
            },
            cont_email: {
                //required: "Email formmat not match"
            },
            cont_notes: {
                required: "Notes is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#add_cust_detail #nxtBtnOne").on("click", function () {
        if (addCustDetails.form()) {
            //$("#add_cust_form .message-container").html('');

            $("#tab-A").removeClass("active");
            $("#tab-B").addClass("active");

            $("#info").hide();
            $("#details").show();
            $("#details").addClass("show");
            $("#details").addClass("active");
        }
    });

    var addCustBillDet = $("#add_cust_bill").validate({
        rules: {
            cust_bill_contact: {
                required: true,
            },
            cust_bill_mobilno: {
                required: true,
            },
            cust_bill_designa: {
                required: true,
            },
            cust_bill_name: {
                required: true,
            },
            cust_bill_addone: {
                required: true,
            },
            cust_bill_country: {
                required: true,
            },
            cust_bill_state: {
                required: true,
            },
            cust_bill_city: {
                required: true,
            },
            cust_bill_pin: {
                required: true,
                number: true,
            },

            cust_ship_contact: {
                required: true,
            },
            cust_ship_mobilno: {
                required: true,
            },
            cust_ship_designa: {
                required: true,
            },

            cust_ship_name: {
                required: true,
            },
            cust_ship_addone: {
                required: true,
            },
            cust_ship_country: {
                required: true,
            },
            cust_ship_state: {
                required: true,
            },
            cust_ship_city: {
                required: true,
            },
            cust_ship_pin: {
                required: true,
                number: true,
            },
        },
        messages: {
            cust_bill_contact: {
                required: "Contact person name  is required",
            },
            cust_bill_mobilno: {
                required: "Mobile no is required",
            },
            cust_bill_designa: {
                required: "Designation is required",
            },
            cust_bill_name: {
                required: "Name is required",
            },
            cust_bill_addone: {
                required: "Address line1 is required",
            },
            cust_bill_country: {
                required: "Country is required",
            },
            cust_bill_state: {
                required: "State is required",
            },
            cust_bill_city: {
                required: "City is required",
            },
            cust_bill_pin: {
                required: "Pincode is required",
            },
            cust_ship_contact: {
                required: "Contact person name is required",
            },
            cust_ship_mobilno: {
                required: "Mobile no is required",
            },
            cust_ship_designa: {
                required: "Designation is required",
            },

            cust_ship_name: {
                required: "Name is required",
            },
            cust_ship_addone: {
                required: "Address line1 is required",
            },
            cust_ship_country: {
                required: "Country is required",
            },
            cust_ship_state: {
                required: "State is required",
            },
            cust_ship_city: {
                required: "City is required",
            },
            cust_ship_pin: {
                required: "Pincode is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#add_cust_bill #nxtBtnTwo").on("click", function () {
        if (addCustBillDet.form()) {
            //$("#add_cust_form .message-container").html('');

            $("#tab-B").removeClass("active");
            $("#tab-C").addClass("active");

            $("#details").hide();
            $("#bank").show();
            $("#bank").addClass("show");
            $("#bank").addClass("active");
        }
    });

    var addCustBank = $("#add_cust_bank").validate({
        rules: {
            cust_bank_name: {
                required: true,
            },
            cust_bank_branch: {
                required: true,
            },
            cust_bank_holder_name: {
                required: true,
            },
            cust_ac_no: {
                required: true,
                number: true,
            },
            cust_ifsc_code: {
                required: true,
            },
            cust_ac_upid: {
                required: true,
            },
        },
        messages: {
            cust_bank_name: {
                required: "Bank name is required",
            },
            cust_bank_branch: {
                required: "Brance is required",
            },
            cust_bank_holder_name: {
                required: "Name is required",
            },
            cust_ac_no: {
                required: "A/C is required",
            },
            cust_ifsc_code: {
                required: "IFSC is required",
            },
            cust_ac_upid: {
                required: "UPID is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#add_cust_bank").bind("submit", function () {
        if (addCustBank.form()) {
            //$('#addCustomerLoader').show();
            var formCustomerData =
                $("form#add_cust_detail").serialize() +
                "&" +
                $("form#add_cust_bill").serialize() +
                "&" +
                $("form#add_cust_bank").serialize();
            var custId = $("#custId").val();
            //console.log(custId);
            if (custId == "") {
                var suburl = base_url + "/add_customer";
            } else {
                var suburl = base_url + "/update_customer";
            }
            console.log(formCustomerData);
            $.ajax({
                url: suburl,
                type: "POST",
                data: formCustomerData,
                success: function (response) {
                    //console.log(response);
                    $("#addCustomerLoader").hide();
                    if (response.class == "succ") {
                        //console.log(response);
                        //$("#add_cust_bank .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#add_cust_bank .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });
    //End add customer

    //Activate customer
    $(".cust_active").click(function () {
        var status = $(this).data("stat");
        var cust_id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/changeStatus",
            data: { status: status, id: cust_id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    //Delete customer
    $(".custdelete").click(function () {
        var cust_id = $(this).data("id");
        $("#del_cust").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delCustomer",
                data: { id: cust_id },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    //start CA
    var chooseca = $("input[name='choose_ca']:checked").val();
    if (chooseca == 1) {
        $("#nearestSearchDiv").show();
        $("#searchca").html("");
    } else {
        $("#nearestSearchDiv").hide();
        var ca_city = "";
        var ca_state = "";
        var ca_pincode = "";
        $.ajax({
            method: "POST",
            url: base_url + "/choose_ca",
            data: {
                chooseca: chooseca,
                ca_city: ca_city,
                ca_state: ca_state,
                ca_pincode: ca_pincode,
            },
            datatype: "json",
            success: function (result) {
                //console.log(result)
                $("#searchca").html(result);
            },
        });
    }
    $("input[type=radio][name=choose_ca]").change(function () {
        var chooseca = $(this).val();
        var ca_city = "";
        var ca_state = "";
        var ca_pincode = "";
        if (chooseca == 1) {
            $("#nearestSearchDiv").show();
            $("#searchca").html("");
        } else {
            $("#nearestSearchDiv").hide();
            $.ajax({
                method: "POST",
                url: base_url + "/choose_ca",
                data: {
                    chooseca: chooseca,
                    ca_city: ca_city,
                    ca_state: ca_state,
                    ca_pincode: ca_pincode,
                },
                datatype: "json",
                success: function (result) {
                    //console.log(result)
                    $("#searchca").html(result);
                },
            });
        }
    });

    $("#searchyourca").click(function () {
        var chooseca = $(this).val();
        var ca_state = $("#state_ship option:selected").val();
        var ca_city = $("#city_ship option:selected").val();
        var ca_pincode = $("#ca_pincode").val();
        $("#searchca").html("");

        if (ca_state == "") {
            // if(ca_city == "" || ca_state == ""){
            alert("Please fill state details.");
        } else {
            $("#searchCaLoader").show();
            $.ajax({
                method: "POST",
                url: base_url + "/choose_ca",
                data: {
                    chooseca: chooseca,
                    ca_city: ca_city,
                    ca_state: ca_state,
                    ca_pincode: ca_pincode,
                },
                datatype: "json",
                success: function (result) {
                    //console.log(result)
                    $("#searchca").html(result);
                    $("#searchCaLoader").hide();
                },
            });
        }
    });

    var frmAssignCA = $("#frmAssignCA").validate({
        rules: {
            ca_name: {
                required: true,
            },
            ca_email: {
                required: true,
                email: true,
            },
            ca_phone: {
                required: true,
                number: true,
            },
            ca_addr_one: {
                required: true,
            },
            ca_state: {
                required: true,
            },
            ca_city: {
                required: true,
            },
            ca_pincode: {
                required: true,
                number: true,
            },
        },
        messages: {
            ca_name: {
                required: "CA name is required",
            },
            ca_email: {
                required: "CA email is required",
            },
            ca_phone: {
                required: "CA phone is required",
            },
            ca_addr_one: {
                required: "CA address is required",
            },
            ca_state: {
                required: "CA state is required",
            },
            ca_city: {
                required: "CA city is required",
            },
            ca_pincode: {
                required: "pincode is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    //$('form#frmAssignCA').bind('submit',function(){
    $("form#frmAssignCA #nxtBtnAssign").on("click", function () {
        if (frmAssignCA.form()) {
            $("#firmlist-A").removeClass("active");
            $("#assignsection-B").addClass("active");

            $("#firmlist").hide();
            $("#assignsection").show();
            $("#assignsection").addClass("show");
            $("#assignsection").addClass("active");
        }
    });

    //
    $("form#frmAssignSection #prevBtnTwo").on("click", function () {
        $("#assignsection-B").removeClass("active");
        $("#firmlist-A").addClass("active");

        $("#assignsection").hide();
        $("#firmlist").show();
        $("#firmlist").addClass("show");
        $("#firmlist").addClass("active");
    });

    $("form#frmAssignSection").bind("submit", function () {
        $("#frmAssignCALoader").show();
        //var formCAData = $('form#frmAssignCA').serialize();
        //var formCAData = $('form#frmAssignCA').serialize()+ '&' + $('form#frmAssignSection').serialize();
        var arr = [];
        var ca_set_permission = "";
        $("input[name='ca_set_permission[]']:checked").each(function () {
            arr.push($(this).val());
        });
        ca_set_permission = arr.join(",");
        var formCAData = {
            assign_ca_firm: $('input[name="assign_ca_firm"]:checked').val(),
            ca_name: $("#frmAssignCA #ca_name").val(),
            ca_email: $("#frmAssignCA #ca_email").val(),
            ca_phone: $("#frmAssignCA #ca_phone").val(),
            ca_addr_one: $("#frmAssignCA #ca_addr_one").val(),
            ca_addr_two: $("#frmAssignCA #ca_addr_two").val(),
            ca_state: $("#frmAssignCA #state option:selected").val(),
            ca_city: $("#frmAssignCA #city option:selected").val(),
            ca_pincode: $("#frmAssignCA #ca_pincode").val(),
            ca_set_permission: ca_set_permission,
        };
        var subcaurl = base_url + "/register_ca";
        $.ajax({
            url: subcaurl,
            type: "POST",
            data: formCAData,
            success: function (response) {
                $("#frmAssignCALoader").hide();
                if (response.class == "succ") {
                    $("#frmAssignSection .message-container").html(
                        '<div class="' +
                            response.class +
                            '">' +
                            response.message +
                            "</div>"
                    );
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else {
                    $.each(response, function (idx, obj) {
                        $("#frmAssignSection .message-container").html(
                            '<div class="err">' + obj + "</div>"
                        );
                    });
                }
            },
        });
    });

    //

    $(".request_active").click(function () {
        var status = $(this).data("stat");
        var cust_id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/completeStatus",
            data: { status: status, id: cust_id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    $(".is_email").click(function () {
        var status = $(this).data("stat");
        var cust_id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/isEmailStatus",
            data: { status: status, id: cust_id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    $(".is_whatsapp").click(function () {
        var status = $(this).data("stat");
        var cust_id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/isWhatsappStatus",
            data: { status: status, id: cust_id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    //add ca in admin
    var frmAssignOurCA = $("#frmAssignOurCA").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                number: true,
            },
            addr_one: {
                required: true,
            },
            ca_state: {
                required: true,
            },
            ca_city: {
                required: true,
            },
            pincode: {
                required: true,
                number: true,
            },
        },
        messages: {
            name: {
                required: "CA name is required",
            },
            email: {
                required: "CA email is required",
            },
            phone: {
                required: "CA phone is required",
            },
            addr_one: {
                required: "CA address is required",
            },
            state: {
                required: "CA state is required",
            },
            ca_city: {
                required: "CA city is required",
            },
            pincode: {
                required: "pincode is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#frmAssignOurCA").bind("submit", function () {
        if (frmAssignOurCA.form()) {
            $("#loader").show();
            var caId = $("#caId").val();
            //var formCAData = $('form#frmAssignOurCA').serialize();
            var formCAData = {
                caId: caId,
                //assign_ca_firm : 'ourca',
                name: $("#frmAssignOurCA #name").val(),
                email: $("#frmAssignOurCA #email").val(),
                phone: $("#frmAssignOurCA #phone").val(),
                addr_one: $("#frmAssignOurCA #addr_one").val(),
                addr_two: $("#frmAssignOurCA #addr_two").val(),
                ca_state: $("#frmAssignOurCA #state option:selected").val(),
                ca_city: $("#frmAssignOurCA #city option:selected").val(),
                pincode: $("#frmAssignOurCA #pincode").val(),
            };
            //var subcaurl = base_url + '/register_our_ca';
            if (caId == "") {
                var subcaurl = base_url + "/register_our_ca";
            } else {
                var subcaurl = base_url + "/update_ca";
            }
            $.ajax({
                url: subcaurl,
                type: "POST",
                data: formCAData,
                success: function (response) {
                    if (response.class == "succ") {
                        $("#loader").hide();
                        $("#frmAssignOurCA .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                    } else {
                        $("#loader").hide();
                        $.each(response, function (idx, obj) {
                            $("#frmAssignOurCA .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".show_status").click(function () {
        var status = $(this).data("stat");
        var cust_id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/updateCaStatus",
            data: { status: status, id: cust_id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });
    $("#frmAssignCA").hide();
    $("#caFillOut").click(function () {
        $("#frmAssignCA").show();
    });
    //End CA

    //start add items

    var item_type = $("input[name='item_type']:checked").val();
    if (item_type == "manufacturing") {
        $("#hsn_code").attr("readonly", false);
        $("#sac_code").attr("readonly", true);
        $(".sac_code_sec").hide();
        $(".hsn_code_sec").show();
    } else if (item_type == "reseller") {
        $("#hsn_code").attr("readonly", false);
        $("#sac_code").attr("readonly", true);
        $(".sac_code_sec").show();
        $(".hsn_code_sec").hide();
    } else if (item_type == "service") {
        $("#hsn_code").attr("readonly", true);
        $("#sac_code").attr("readonly", false);
        $(".sac_code_sec").show();
        $(".hsn_code_sec").hide();
    }

    $("input[type=radio][name=item_type]").change(function () {
        if (this.value == "manufacturing") {
            $("#hsn_code").attr("readonly", false);
            $("#sac_code").attr("readonly", true);
            $(".sac_code_sec").hide();
            $(".hsn_code_sec").show();
        } else if (this.value == "reseller") {
            $("#hsn_code").attr("readonly", false);
            $("#sac_code").attr("readonly", true);
            $(".sac_code_sec").show();
            $(".hsn_code_sec").hide();
        } else if (this.value == "service") {
            $("#hsn_code").attr("readonly", true);
            $("#sac_code").attr("readonly", false);
            $(".sac_code_sec").show();
            $(".hsn_code_sec").hide();
        }
    });

    var addItemFrm = $("#addItemFrm").validate({
        rules: {
            item_type: {
                required: true,
            },
            item_name: {
                required: true,
            },
            opening_stock_bal: {
                //required: true,
                number: true,
            },
            item_bill_no: {
                //required: true,
                number: true,
            },
            item_actual_no: {
                //required: true,
                number: true,
            },
            selling_price: {
                //required: true,
                number: true,
            },
            purchase_price: {
                //required: true,
                number: true,
            },
            disc_sell: {
                //required: true,
                number: true,
            },
            wholesale_price: {
                //required: true,
                number: true,
            },
            min_wholesale_quantity: {
                //required: true,
                number: true,
            },
        },
        messages: {
            item_type: {
                required: "Type is required",
            },
            item_name: {
                required: "Item name is required",
            },
            opening_stock_bal: {
                required: "Type Number",
            },
            item_bill_no: {
                //required: "Bill no. is required"
                required: "Type Number",
            },
            item_actual_no: {
                // required: "Actual no. is required"
                required: "Type Number",
            },
            selling_price: {
                // required: "Selling price is required"
                required: "Type Number",
            },
            purchase_price: {
                // required: "Purchase price is required"
                required: "Type Number",
            },
            disc_sell: {
                // required: "Discount is required"
                required: "Type Number",
            },
            wholesale_price: {
                // required: "wholesale price is required"
                required: "Type Number",
            },
            min_wholesale_quantity: {
                // required: "Quantity is required"
                required: "Type Number",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addItemFrm").bind("submit", function () {
        //e.preventDefault();
        if (addItemFrm.form()) {
            $("#addItemLoader").show();
            var itemId = $("#itemId").val();
            if (itemId == "") {
                var itemurl = base_url + "/save_add_item";
            } else {
                var itemurl = base_url + "/update_item";
            }
            //var itemData = $('form#addItemFrm').serialize()+ '&' + $('form#baseUnitFrm').serialize();
            let item_type = $("input[name='item_type']:checked").val();
            let item_name = $("#addItemFrm #item_name").val();
            let base_unit = $("#baseUnitFrm #base_unit option:selected").val();
            let sec_unit = $("#baseUnitFrm #sec_unit option:selected").val();
            let base_unit_other = $("#baseUnitFrm #base_unit_other").val();
            let sac_code = $("#addItemFrm #sac_code").val();
            let hsn_code = $("#addItemFrm #hsn_code").val();
            let opening_stock_bal = $("#addItemFrm #opening_stock_bal").val();
            var opening_stock = "";
            var opening_stock_amt = "";
            var purchase_stock = "";
            var purchase_stock_amt = "";
            var closing_stock = "";
            var closing_stock_amt = "";
            var reseller_stock = "";
            var reseller_stock_amt = "";

            opening_stock = $("input[name='opening_stock[]']:checked")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();
            opening_stock_amt = $("input[name='opening_stock_amt[]']")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();

            purchase_stock = $("input[name='purchase_stock[]']:checked")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();
            purchase_stock_amt = $("input[name='purchase_stock_amt[]']")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();

            closing_stock = $("input[name='closing_stock[]']:checked")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();
            closing_stock_amt = $("input[name='closing_stock_amt[]']")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();

            reseller_stock = $("input[name='reseller_stock[]']:checked")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();
            reseller_stock_amt = $("input[name='reseller_stock_amt[]']")
                .map(function () {
                    if (
                        $(this).val().trim() !== "" &&
                        $(this).val().trim() != "undefined"
                    ) {
                        return $(this).val();
                    }
                })
                .get();

            /*let  opening_stock_name = $("#stockOtherFrm1 #openStockName1").val();
				let  op_stock_oth_amt = $("#stockOtherFrm1 #stockAmount1").val();
				let  purchase_stock_name = $("#stockOtherFrm2 #openStockName2").val();
				let  pu_stock_oth_amt = $("#stockOtherFrm2 #stockAmount2").val();
				let  closing_stock_name = $("#stockOtherFrm3 #openStockName3").val();
				let  cl_stock_oth_amt = $("#stockOtherFrm3 #stockAmount3").val();
				let  reseller_stock_name = $("#stockOtherFrm4 #openStockName4").val();
				let  re_stock_oth_amt = $("#stockOtherFrm4 #stockAmount4").val();
				
				if(opening_stock_name !=undefined && op_stock_oth_amt !=undefined){
					opening_stock = opening_stock+","+opening_stock_name;
					opening_stock_amt = opening_stock_amt+","+op_stock_oth_amt;
				}

				if(purchase_stock_name !=undefined && pu_stock_oth_amt !=undefined){
					purchase_stock = purchase_stock+","+purchase_stock_name;
					purchase_stock_amt = purchase_stock_amt+","+pu_stock_oth_amt;				
				}
				if(closing_stock_name !=undefined && cl_stock_oth_amt !=undefined){
					closing_stock = closing_stock+","+closing_stock_name;
					closing_stock_amt = closing_stock_amt+","+cl_stock_oth_amt;
				}
				if(reseller_stock_name !=undefined && re_stock_oth_amt !=undefined){
					reseller_stock = reseller_stock+","+reseller_stock_name;
					reseller_stock_amt = reseller_stock_amt+","+re_stock_oth_amt;
				}*/

            let item_bill_no = $("#addItemFrm #item_bill_no").val();
            let item_actual_no = $("#addItemFrm #item_actual_no").val();
            let item_date = $("#addItemFrm #item_date").val();
            let selling_price = $("#addItemFrm #selling_price").val();
            let selling_tax = $(
                "#addItemFrm #selling_tax option:selected"
            ).val();
            let wholesale_price = $("#addItemFrm #wholesale_price").val();
            let wholesale_tax = $(
                "#addItemFrm #wholesale_tax option:selected"
            ).val();
            let purchase_price = $("#addItemFrm #purchase_price").val();
            let purchase_tax = $(
                "#addItemFrm #purchase_tax option:selected"
            ).val();
            let disc_sell = $("#addItemFrm #disc_sell").val();
            let disc_sell_type = $(
                "#addItemFrm #disc_sell_type option:selected"
            ).val();
            let min_wholesale_quantity = $(
                "#addItemFrm #min_wholesale_quantity"
            ).val();
            // let  item_tax = $("#addItemFrm #item_tax").val();
            let item_tax = "";
            let prod_desc = $("#addItemFrm #prod_desc").val();

            //let prod_image =   $('#addItemFrm #prod_image').prop('files')[0];
            const totalImages = $("#prod_image")[0].files.length;
            let prod_image = $("#prod_image")[0];
            let itemData = new FormData();

            itemData.append("id", itemId);
            itemData.append("item_type", item_type);
            itemData.append("item_name", item_name);
            itemData.append("base_unit", base_unit);
            itemData.append("sec_unit", sec_unit);
            itemData.append("base_unit_other", base_unit_other);
            itemData.append("sac_code", sac_code);
            itemData.append("hsn_code", hsn_code);
            itemData.append("opening_stock_bal", opening_stock_bal);
            itemData.append("opening_stock", opening_stock);
            itemData.append("opening_stock_amt", opening_stock_amt);
            itemData.append("purchase_stock", purchase_stock);
            itemData.append("purchase_stock_amt", purchase_stock_amt);
            itemData.append("closing_stock", closing_stock);
            itemData.append("closing_stock_amt", closing_stock_amt);
            itemData.append("reseller_stock", reseller_stock);
            itemData.append("reseller_stock_amt", reseller_stock_amt);

            itemData.append("item_bill_no", item_bill_no);
            itemData.append("item_actual_no", item_actual_no);
            itemData.append("item_date", item_date);
            itemData.append("selling_price", selling_price);
            itemData.append("selling_tax", selling_tax);
            itemData.append("wholesale_price", wholesale_price);
            itemData.append("wholesale_tax", wholesale_tax);
            itemData.append("purchase_price", purchase_price);
            itemData.append("purchase_tax", purchase_tax);
            itemData.append("disc_sell", disc_sell);
            itemData.append("disc_sell_type", disc_sell_type);
            itemData.append("min_wholesale_quantity", min_wholesale_quantity);
            itemData.append("item_tax", item_tax);
            itemData.append("prod_desc", prod_desc);
            for (let i = 0; i < totalImages; i++) {
                itemData.append("prod_image" + i, prod_image.files[i]);
            }
            itemData.append("totalImages", totalImages);

            $.ajax({
                url: itemurl,
                type: "POST",
                data: itemData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#addItemLoader").hide();
                    if (response.class == "succ") {
                        $("#addItemFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addItemFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var baseUnitFrm = $("#baseUnitFrm").validate({
        rules: {},
        messages: {},
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#baseUnitFrm").bind("submit", function () {
        //e.preventDefault();
        var prodId = $("#prodId").val();
        if (baseUnitFrm.form() && prodId != "") {
            var addurl = base_url + "/save_baseUnit";
            var baseData = $("form#baseUnitFrm").serialize();

            $.ajax({
                url: addurl,
                type: "POST",
                data: baseData,
                success: function (response) {
                    if (response.class == "succ") {
                        //window.location.reload();
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#baseUnitFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".itemdelete").click(function () {
        var itemId = $(this).data("id");
        $("#del_item").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delItem",
                data: { id: itemId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    var baseUnit = $("#base_unit option:selected").val();
    if (baseUnit == "Other") {
        $("#baseUnitOther").show();
    } else {
        $("#baseUnitOther").hide();
    }
    $("#base_unit").on("change", function (e) {
        var optionSelected = $("option:selected", this);
        var baseUnitType = this.value;
        if (baseUnitType == "Other") {
            $("#baseUnitOther").show();
        } else {
            $("#baseUnitOther").hide();
            $("#base_unit_other").val("");
        }
    });

    var openingStockOtherFrm = $("#openingStockOtherFrm").validate({
        rules: {
            opening_stock_name: {
                required: true,
            },
            op_stock_oth_amt: {
                required: true,
                number: true,
            },
        },
        messages: {},
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#openingStockOtherFrm").bind("submit", function () {
        //e.preventDefault();
        var itemId = $("#itemId").val();
        var item_type = $("input[name='item_type']:checked").val();
        if (openingStockOtherFrm.form() && itemId != "") {
            var addurl = base_url + "/update_stock_other";
            //var stockData = $('form#openingStockOtherFrm').serialize();
            var itemId = $("#itemId").val();
            var other_rowid = $("#other_rowid").val();
            let opening_stock = "";
            let opening_stock_amt = "";
            let stockAmountOther = "";
            if (other_rowid == "manufacturing_stock1") {
                opening_stock = $("input[name='opening_stock[]']:checked")
                    .map(function () {
                        return $(this).val();
                    })
                    .get();
                opening_stock_amt = $("input[name='opening_stock_amt[]']")
                    .map(function () {
                        if ($(this).val().trim() !== "") {
                            return $(this).val();
                        }
                    })
                    .get();
            } else if (other_rowid == "manufacturing_stock2") {
                opening_stock = $("input[name='purchase_stock[]']:checked")
                    .map(function () {
                        return $(this).val();
                    })
                    .get();
                opening_stock_amt = $("input[name='purchase_stock_amt[]']")
                    .map(function () {
                        if ($(this).val().trim() !== "") {
                            return $(this).val();
                        }
                    })
                    .get();

                opening_stock_amt = opening_stock_amt.concat(stockAmountOther);
            } else if (other_rowid == "manufacturing_stock3") {
                opening_stock = $("input[name='closing_stock[]']:checked")
                    .map(function () {
                        return $(this).val();
                    })
                    .get();
                opening_stock_amt = $("input[name='closing_stock_amt[]']")
                    .map(function () {
                        if ($(this).val().trim() !== "") {
                            return $(this).val();
                        }
                    })
                    .get();

                opening_stock_amt = opening_stock_amt.concat(stockAmountOther);
            } else if (other_rowid == "reseller_stock4") {
                opening_stock = $("input[name='reseller_stock[]']:checked")
                    .map(function () {
                        return $(this).val();
                    })
                    .get();
                opening_stock_amt = $("input[name='reseller_stock_amt[]']")
                    .map(function () {
                        if ($(this).val().trim() !== "") {
                            return $(this).val();
                        }
                    })
                    .get();
            }
            //other stock name
            let opening_stockOther = $("input[name='opening_stockOther[]']")
                .map(function () {
                    return $(this).val();
                })
                .get();
            if (opening_stockOther != "") {
                opening_stock = opening_stock + "," + opening_stockOther;
            }
            //other stock amt
            stockAmountOther = $("input[name='stockAmountOther[]']")
                .map(function () {
                    if ($(this).val().trim() !== "") {
                        return $(this).val();
                    }
                })
                .get();
            opening_stock_amt = opening_stock_amt.concat(stockAmountOther);

            let stockData = new FormData();
            stockData.append("id", itemId);
            stockData.append("other_rowid", other_rowid);
            stockData.append("item_type", item_type);
            stockData.append("opening_stock", opening_stock);
            stockData.append("opening_stock_amt", opening_stock_amt);
            $("#stockLoader").show();
            $.ajax({
                url: addurl,
                type: "POST",
                data: stockData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#stockLoader").hide();
                    var messageContainer = $(
                        "#openingStockOtherFrm .message-container"
                    );
                    messageContainer.html(""); // Clear previous messages
                    if (response.class == "succ") {
                        messageContainer.html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        $("#other-open-stock").modal("hide");
                        window.location.reload();
                    } else {
                        $.each(response, function (idx, obj) {
                            messageContainer.html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }

                    if (messageContainer.children().length > 0) {
                        setTimeout(function () {
                            messageContainer.hide("slow");
                        }, 3000);
                    }
                },
            });
        }
    });

    //end add items

    //Start add project

    var addProjectFrm = $("#addProjectFrm").validate({
        rules: {
            proj_name: {
                required: true,
            },
            proj_cat: {
                required: true,
            },
            proj_status: {
                required: true,
            },
            client_name: {
                required: true,
            },
            client_contact: {
                required: true,
                number: true,
            },
            client_email: {
                required: true,
                email: true,
            },
            proj_start_date: {
                required: true,
            },

            proj_cost: {
                required: true,
                number: true,
            },
            proj_details: {
                required: true,
            },
        },
        messages: {
            proj_name: {
                required: "Project name is required",
            },
            proj_cat: {
                required: "Project category is required",
            },
            proj_status: {
                required: "Project status is required",
            },
            client_name: {
                required: "Client name is required",
            },
            client_contact: {
                required: "Client contact is required",
            },
            client_email: {
                required: "Client email is required",
            },
            proj_start_date: {
                required: "Project start date is required",
            },

            proj_cost: {
                required: "Project cost is required",
            },
            proj_details: {
                required: "Project details is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addProjectFrm").bind("submit", function () {
        //e.preventDefault();
        if (addProjectFrm.form()) {
            $("#addProjectLoader").show();
            var projId = $("#projId").val();
            if (projId == "") {
                var projurl = base_url + "/save_add_project";
            } else {
                var projurl = base_url + "/update_project";
            }
            var projectData = $("form#addProjectFrm").serialize();

            $.ajax({
                url: projurl,
                type: "POST",
                data: projectData,
                success: function (response) {
                    $("#addProjectLoader").hide();
                    if (response.class == "succ") {
                        $("#addProjectFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addProjectFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".projectdelete").click(function () {
        var itemId = $(this).data("id");
        $("#del_project").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delProject",
                data: { id: itemId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    $(".proj_active").click(function () {
        var status = $(this).data("stat");
        var cust_id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/changeProjectStatus",
            data: { status: status, id: cust_id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    //End add project

    //Start add assets

    var addAssetFrm = $("#addAssetFrm").validate({
        rules: {
            date: {
                required: true,
            },
            asset_name: {
                required: true,
            },
            assetType: {
                required: true,
            },
            purchase_date: {
                required: true,
            },
            purchase_cost: {
                required: true,
                number: true,
            },
            purchase_by: {
                required: true,
            },
            purchase_date_audit: {
                required: true,
            },
        },
        messages: {
            date: {
                required: "Date is required",
            },
            asset_name: {
                required: "Asset name is required",
            },
            assetType: {
                required: "Asset type is required",
            },
            purchase_date: {
                required: "Purchase date is required",
            },
            purchase_cost: {
                required: "Purchase cost is required",
                number: "Please enter a valid number",
            },
            purchase_by: {
                required: "Purchase by is required",
            },
            purchase_date_audit: {
                required: "Purchase date is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addAssetFrm").bind("submit", function (e) {
        e.preventDefault();
        if (addAssetFrm.form()) {
            var assetId = $("#assetId").val();
            var projurl =
                base_url +
                (assetId === "" ? "/save_add_asset" : "/update_asset");
            var formData = new FormData(this);

            var tangibleAssetsValue = document.querySelector(
                'select[name="tangible_assets"]'
            ).value;
            formData.append("tangible_assets_data", tangibleAssetsValue);

            $.ajax({
                url: projurl,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $("#addAssetLoader").hide();
                    if (response.class == "succ") {
                        $("#addAssetFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addAssetFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".assetdelete").click(function () {
        var itemId = $(this).data("id");
        $("#del_asset").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delAsset",
                data: { id: itemId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    //End add assets

    //Start Asset Voucher

    var addAssetVoucherFrm = $("#addAssetVoucherFrm").validate({
        rules: {
            v_type: {
                required: true,
            },
            voucher_no: {
                required: true,
            },
            voucher_name: {
                required: true,
            },
            branch_name: {
                //required: true
            },
            series_id: {
                //required: true
            },
            invoice_date: {
                required: true,
            },
            // vendor_id: {
            // 	//required: true
            // },
            inv_voucher_no: {
                required: true,
                number: true,
            },
            total_cost: {
                required: true,
                number: true,
            },
        },
        messages: {
            v_type: {
                //required: "Type is required"
            },
            voucher_no: {
                required: "Voucher no. is required",
            },
            voucher_name: {
                required: "Name is required",
            },
            branch_name: {
                required: "Branch is required",
            },
            series_id: {
                required: "Series is required",
            },
            invoice_date: {
                required: "Date is required",
            },
            // vendor_id: {
            // 	required: "Vendor is required"
            // },
            inv_voucher_no: {
                required: "Invoice no. is required",
            },
            total_cost: {
                required: "Total cost is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addAssetVoucherFrm").bind("submit", function () {
        //e.preventDefault();
        if (addAssetVoucherFrm.form()) {
            $("#addVocherLoader").show();
            var vId = $("#vId").val();
            if (vId == "") {
                var projurl = base_url + "/save_add_voucher";
            } else {
                var projurl = base_url + "/update_voucher";
            }
            var projectData = $("form#addAssetVoucherFrm").serialize();

            $.ajax({
                url: projurl,
                type: "POST",
                data: projectData,
                success: function (response) {
                    $("#addVocherLoader").hide();
                    if (response.class == "succ") {
                        $("#addAssetVoucherFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addAssetVoucherFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".assetVoucherDelete").click(function () {
        var itemId = $(this).data("id");
        $("#del_voucher").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delAssetVoucher",
                data: { id: itemId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    var addSeriesFrm = $("#addSeriesFrm").validate({
        rules: {
            series_name: {
                required: true,
            },
        },
        messages: {
            series_name: {
                required: "Series name is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addSeriesFrm").bind("submit", function () {
        //e.preventDefault();
        if (addSeriesFrm.form()) {
            var addurl = base_url + "/save_add_series_name";
            var seriesData = $("form#addSeriesFrm").serialize();

            $.ajax({
                url: addurl,
                type: "POST",
                data: seriesData,
                success: function (response) {
                    if (response.class == "succ") {
                        window.location.reload();
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addSeriesFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    //End Asset Voucher

    //Start Add Sales
    changeCustomer();
    changeCustomer_purchase();
    var addSalesFrm = $("#addSalesFrm").validate({
        rules: {
            seller_name: {
                required: true,
            },
            seller_contact: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true,
            },
            seller_email: {
                required: true,
                email: true,
            },
            seller_pan: {
                required: true,
            },
            seller_addone: {
                required: true,
            },
            seller_country: {
                required: true,
            },
            seller_state: {
                required: true,
            },
            seller_city: {
                required: true,
            },
            seller_pin: {
                required: true,
                number: true,
            },
        },

        messages: {
            seller_name: {
                required: "Seller name is required",
            },
            seller_contact: {
                required: "Contact is required",
            },
            seller_email: {
                required: "Email is required",
            },
            seller_pan: {
                required: "Email is required",
            },
            seller_addone: {
                required: "Address is required",
            },
            seller_country: {
                required: "Country is required",
            },
            seller_state: {
                required: "State is required",
            },
            seller_city: {
                required: "City is required",
            },
            seller_pin: {
                required: "Pincode is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addSalesFrm").bind("submit", function () {
        if (addSalesFrm.form()) {
            $("#addSalesLoader").show();
            var sId = $("#sId").val();
            if (sId == "") {
                var surl = base_url + "/save_sales_invoice";
            } else {
                var surl = base_url + "/update_sales_invoice";
            }
            var salesData =
                $("form#addSalesFrmTop").serialize() +
                "&" +
                $("form#addSalesFrm").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: salesData,
                success: function (response) {
                    $("#addSalesLoader").hide();
                    if (response.class == "succ") {
                        //$("#addSalesFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
                        if (sId == "") {
                            window.location.href = response.redirect;
                        }
                        $("#tab-A").removeClass("active");
                        $("#tab-B").addClass("active");

                        $("#basic").hide();
                        $("#customer").show();
                        $("#customer").addClass("show");
                        $("#customer").addClass("active");
                    } else {
                        $.each(response, function (idx, obj) {
                            //alert(obj);
                            $("#addSalesFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });
    $("form#addSalesFrm #nextBtnSeller").on("click", function () {
        $("#tab-A").removeClass("active");
        $("#tab-B").addClass("active");
        $("#basic").hide();
        $("#customer").show();
        $("#customer").addClass("show");
        $("#customer").addClass("active");
    });

    $("form#addSalesFrmTwo #nextBtnCust").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-C").addClass("active");
        $("#customer").hide();
        $("#product").show();
        $("#product").addClass("show");
        $("#product").addClass("active");
    });

    $("form#addSalesFrmThree #nextBtnProd").on("click", function () {
        $("#tab-c").removeClass("active");
        $("#tab-D").addClass("active");
        $("#product").hide();
        $("#other").show();
        $("#other").addClass("show");
        $("#other").addClass("active");
    });

    $("form#addSalesFrmTwo #prevBtnCust").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-A").addClass("active");

        $("#customer").hide();
        $("#basic").show();
        $("#basic").addClass("show");
        $("#basic").addClass("active");
    });

    $("form#addSalesFrmThree #prevBtnProd").on("click", function () {
        $("#tab-C").removeClass("active");
        $("#tab-B").addClass("active");

        $("#product").hide();
        $("#customer").show();
        $("#customer").addClass("show");
        $("#customer").addClass("active");
    });

    $("form#addSalesFrmFour #prevBtnOther").on("click", function () {
        $("#tab-D").removeClass("active");
        $("#tab-c").addClass("active");

        $("#other").hide();
        $("#product").show();
        $("#product").addClass("show");
        $("#product").addClass("active");
    });

    var addSalesFrmTwo = $("#addSalesFrmTwo").validate({
        rules: {
            inv_name: {
                required: true,
            },
            add_type: {
                required: true,
            },
            cont_person: {
                required: true,
            },
            cont_person_no: {
                required: true,
                //minlength: "10 characters at least"
            },
        },
        messages: {
            inv_name: {
                required: "Customer is required",
            },
            add_type: {
                required: "Address type is required",
            },
            cont_person: {
                required: "contact person name is required",
            },
            cont_person_no: {
                required: "contact person_no type is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addSalesFrmTwo").bind("submit", function () {
        //e.preventDefault();
        if (addSalesFrmTwo.form()) {
            $("#editSalesLoader").show();
            var itemurl = base_url + "/update_sales_customer";
            var custData = $("form#addSalesFrmTwo").serialize();

            $.ajax({
                url: itemurl,
                type: "POST",
                data: custData,
                success: function (result) {
                    $("#editSalesLoader").hide();
                    $("#tab-B").removeClass("active");
                    $("#tab-C").addClass("active");

                    $("#customer").hide();
                    $("#product").show();
                    $("#product").addClass("show");
                    $("#product").addClass("active");
                },
            });
        }
    });

    var signature = $("form#addSalesFrmThree #sign").val();
    if (signature == "") {
        var addSalesFrmThree = $("#addSalesFrmThree").validate({
            rules: {
                signature: {
                    required: true,
                },
                signature_name: {
                    required: true,
                },
            },
            messages: {
                signature: {
                    required: "Signature image is required",
                },
                signature_name: {
                    required: "Signature name is required",
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    } else {
        var addSalesFrmThree = $("#addSalesFrmThree").validate({
            rules: {
                signature_name: {
                    required: true,
                },
            },
            messages: {
                signature_name: {
                    required: "Signature name is required",
                },
            },
        });
    }

    $("form#addSalesFrmThree").bind("submit", function () {
        if (addSalesFrmThree.form()) {
            $("#editSalesLoader").show();
            let signature = $("#addSalesFrmThree #signature").prop("files")[0];
            let signature_name = $("#addSalesFrmThree #signature_name").val();
            let id = $("#sId").val();
            let sales_data = new FormData();

            sales_data.append("signature", signature);
            sales_data.append("signature_name", signature_name);
            sales_data.append("id", id);

            $.ajax({
                url: base_url + "/update_sales_invoice_final",
                type: "POST",
                data: sales_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#editSalesLoader").hide();
                    if (response.class == "succ") {
                        $("#addSalesFrmThree .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        //window.location.href=response.redirect;
                        $("#tab-C").removeClass("active");
                        $("#tab-D").addClass("active");

                        $("#product").hide();
                        $("#other").show();
                        $("#other").addClass("show");
                        $("#other").addClass("active");
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addSalesFrmThree .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var addSalesFrmFour = $("#addSalesFrmFour").validate({
        rules: {
            mode_of_pay: {
                required: true,
            },
            pay_status: {
                required: true,
            },
            order_date: {
                required: true,
            },
            disp_through: {
                required: true,
            },
            other_payment: {
                required: function () {
                    return $("#mode_of_pay").val() === "OTHER";
                },
            },
        },
        messages: {
            mode_of_pay: {
                required: "Payment mode is required",
            },
            pay_status: {
                required: "Payment status is required",
            },
            order_date: {
                required: "Order date is required",
            },
            disp_through: {
                required: "Dispatch through is required",
            },
            other_payment: {
                required: "Specify Other Payment Method is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addSalesFrmFour").bind("submit", function () {
        //e.preventDefault();
        if (addSalesFrmFour.form()) {
            $("#editSalesLoader").show();
            var itemurl = base_url + "/update_sales_other";
            var custData = $("form#addSalesFrmFour").serialize();
            $.ajax({
                url: itemurl,
                type: "POST",
                data: custData,
                success: function (response) {
                    $("#editSalesLoader").hide();
                    if (response.class == "succ") {
                        $("#addSalesFrmFour .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addSalesFrmFour .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var addSalesFrmFive = $("#addSalesFrmFive").validate({
        rules: {
            rate: {
                required: true,
                number: true,
            },
            disc_amt: {
                required: true,
                number: true,
            },
            tax_type: {
                required: true,
            },
        },
        messages: {
            rate: {
                required: "Rate is required",
            },
            disc_amt: {
                required: "Discount is required",
            },
            tax_type: {
                required: "Tax type is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addSalesFrmFive").bind("submit", function () {
        //e.preventDefault();
        if (addSalesFrmFive.form()) {
            var itemurl = base_url + "/update_sales_item";
            var editData = $("form#addSalesFrmFive").serialize();

            $("form#addSalesFrmFive #invoiceData").html("");
            $.ajax({
                url: itemurl,
                type: "POST",
                data: editData,
                success: function (result) {
                    $("form#addSalesFrmFive #invoiceData").html(result);
                },
            });
        }
    });

    $("#prod_id").change(function () {
        var prod_id = $("#prod_id option:selected").val();
        var sId = $("#sId").val();
        if (prod_id != "") {
            $.ajax({
                method: "POST",
                url: base_url + "/getProduct",
                data: { sId: sId, prod_id: prod_id },
                datatype: "json",
                success: function (result) {
                    var res = JSON.parse(result);
                    //console.log(res[0].hsn_sac_code)
                    $("#hsn_sac_code").val(res[0].hsn_sac_code);
                    $("#disc_sell").val(res[0].disc_sell);
                    $("#disc_sell_type").val(res[0].disc_sell_type);
                },
            });
        } else {
            $("#hsn_sac_code").val("");
            $("#disc_sell").val(0);
            $("#prod_gov_fee").val(0);
            $("#billing_type").prop("selectedIndex", 0);
            $("#gst_trans").prop("selectedIndex", 0);
            $("#disc_sell_type").prop("selectedIndex", 0);
        }
    });

    $(".invoicedelete").click(function () {
        var sId = $(this).data("id");
        $("#del_invoice").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delInvoice",
                data: { id: sId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    $(".inv_active").click(function () {
        var status = $(this).data("stat");
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/activateStatus",
            data: { status: status, id: id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    var transType = $("#transport_type option:selected").val();
    if (transType == "Other") {
        $("#transportTypeOther").show();
    } else {
        $("#transportTypeOther").hide();
    }
    $("#transport_type").on("change", function (e) {
        var optionSelected = $("option:selected", this);
        var transportType = this.value;
        if (transportType == "Other") {
            $("#transportTypeOther").show();
            $("#transport_type_other").val("");
        } else {
            $("#transportTypeOther").hide();
            $("#transport_type_other").val("");
        }
    });

    //End Add Sales
    //start Sales & Purchase customer details base on customer
    $("#inv_name").click(function () {
        var invcustId = $("#inv_name option:selected").val();
        if (invcustId != "") {
            $.ajax({
                url: base_url + "/getinvcust?" + invcustId,
                dataType: "json",
                //type: "post",
                data: { id: invcustId },
                success: function (data) {
                    $("#contact_no").val(data.cust_phone);
                    $("#cust_email").val(data.cust_email);
                    $("#gst_reg").val(data.gst_reg);
                    $("#cust_gst_no").val(data.cust_gst_no);
                    $("#cust_pan").val(data.cust_pan);
                    $("#comp_type").val(data.comp_type);
                    $("#cust_gst_type").val(data.cust_gst_type);
                    $("#bill_name").val(data.cust_bill_name);
                    $("#bill_addone").val(data.cust_bill_addone);
                    $("#bill_addtwo").val(data.cust_bill_addtwo);
                    $("#country")
                        .val(data.cust_bill_country)
                        .attr("selected", "selected");
                    $("#state").empty();
                    var stateBillOpt = '<option value="">Select State</option>';
                    $.each(data.stateBill, function (idx, item) {
                        if (item.id == item.sid) {
                            stateBillOpt +=
                                '<option value="' +
                                item.id +
                                '" selected="">' +
                                item.name +
                                "</option>";
                        } else {
                            stateBillOpt +=
                                '<option value="' +
                                item.id +
                                '" >' +
                                item.name +
                                "</option>";
                        }
                    });
                    $("#state").html(stateBillOpt);
                    $("#city").empty();
                    var cityBillOpt = '<option value="">Select City</option>';
                    $.each(data.cityBill, function (idx, item) {
                        if (item.id == item.sid) {
                            cityBillOpt +=
                                '<option value="' +
                                item.id +
                                '" selected="">' +
                                item.name +
                                "</option>";
                        } else {
                            cityBillOpt +=
                                '<option value="' +
                                item.id +
                                '" >' +
                                item.name +
                                "</option>";
                        }
                    });
                    $("#city").html(cityBillOpt);
                    $("#bill_pin").val(data.cust_bill_pin);

                    //Ship section
                    $("#ship_name").val(data.cust_ship_name);
                    $("#ship_addone").val(data.cust_ship_addone);
                    $("#ship_addtwo").val(data.cust_ship_addtwo);
                    $("#country_ship")
                        .val(data.cust_ship_country)
                        .attr("selected", "selected");
                    $("#state_ship").empty();
                    var stateShipOpt = '<option value="">Select State</option>';
                    $.each(data.stateShip, function (idx, item) {
                        if (item.id == item.selid) {
                            stateShipOpt +=
                                '<option value="' +
                                item.id +
                                '" selected="">' +
                                item.name +
                                "</option>";
                        } else {
                            stateShipOpt +=
                                '<option value="' +
                                item.id +
                                '" >' +
                                item.name +
                                "</option>";
                        }
                    });
                    $("#state_ship").html(stateShipOpt);
                    $("#city_ship").empty();
                    var cityShipOpt = '<option value="">Select City</option>';
                    $.each(data.cityShip, function (idx, item) {
                        if (item.id == item.selid) {
                            cityShipOpt +=
                                '<option value="' +
                                item.id +
                                '" selected="">' +
                                item.name +
                                "</option>";
                        } else {
                            cityShipOpt +=
                                '<option value="' +
                                item.id +
                                '" >' +
                                item.name +
                                "</option>";
                        }
                    });
                    $("#city_ship").html(cityShipOpt);
                    $("#ship_pin").val(data.cust_ship_pin);
                },
            });
        } else {
            $("#bill_name").val("");
            $("#bill_addone").val("");
            $("#bill_addtwo").val("");
            $("#state").empty();
            $("#city").empty();
            $("#bill_pin").val("");

            $("#ship_name").val("");
            $("#ship_addone").val("");
            $("#ship_addtwo").val("");
            $("#state_ship").empty();
            $("#city_ship").empty();
            $("#ship_pin").val("");
        }
    });
    //End Sales custmor details base on customr
    //Start Add Sales creditdebit

    var salesCreditDebitFrm = $("#salesCreditDebitFrm").validate({
        rules: {
            inv_num: {
                required: true,
            },
            inv_date: {
                required: true,
            },
            v_name: {
                required: true,
            },
            note_type: {
                required: true,
            },
            note_date: {
                required: true,
            },
            reason_issuance: {
                required: true,
            },
            seller_name: {
                required: true,
            },
            seller_addone: {
                required: true,
            },
            seller_country: {
                required: true,
            },
            seller_state: {
                required: true,
            },
            seller_city: {
                required: true,
            },
            seller_pin: {
                required: true,
                number: true,
            },

            date_of_payment: {
                required: true,
            },
            mode_of_pay: {
                required: true,
            },
            pay_status: {
                required: true,
            },
            other_payment: {
                required: function () {
                    return $("#mode_of_pay").val() === "OTHER";
                },
            },
        },

        messages: {
            inv_num: {
                required: "Invoice no. is required",
            },
            inv_date: {
                required: "Date is required",
            },
            v_name: {
                required: "Buyer is required",
            },
            note_type: {
                required: "Note type is required",
            },
            note_date: {
                required: "Date is required",
            },
            reason_issuance: {
                required: "Reason is required",
            },
            seller_name: {
                required: "Seller name is required",
            },
            seller_addone: {
                required: "Address is required",
            },
            seller_country: {
                required: "Country is required",
            },
            seller_state: {
                required: "State is required",
            },
            seller_city: {
                required: "City is required",
            },
            seller_pin: {
                required: "Pincode is required",
            },
            other_payment: {
                required: "Specify Other Payment Method is required",
            },
            mode_of_pay: {
                required: "Mode of Payment is required",
            },
            date_of_payment: {
                required: "Date of Payment is required",
            },
            pay_status: {
                required: "Payment Status is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#salesCreditDebitFrm").bind("submit", function () {
        if (salesCreditDebitFrm.form()) {
            $("#addSalesLoader").show();
            var sId = $("#sId").val();
            let inv_num = $("#salesCreditDebitFrm #inv_num").val();
            let inv_date = $("#salesCreditDebitFrm #inv_date").val();
            let seller_name = $("#salesCreditDebitFrm #seller_name").val();
            let seller_addone = $("#salesCreditDebitFrm #seller_addone").val();
            let seller_addtwo = $("#salesCreditDebitFrm #seller_addtwo").val();
            let seller_country = $(
                "#salesCreditDebitFrm #country option:selected"
            ).val();
            let seller_state = $(
                "#salesCreditDebitFrm #state option:selected"
            ).val();
            let seller_city = $(
                "#salesCreditDebitFrm #city option:selected"
            ).val();
            let seller_pin = $("#salesCreditDebitFrm #seller_pin").val();
            let v_name = $(
                "#salesCreditDebitFrm #invNameCustomer option:selected"
            ).val();
            let note_type = $(
                "#salesCreditDebitFrm #note_type option:selected"
            ).val();
            let note_date = $("#salesCreditDebitFrm #note_date").val();
            let reason_issuance = $(
                "#salesCreditDebitFrm #reason_issuance option:selected"
            ).val();
            let otherIssuance = $("#salesCreditDebitFrm #otherIssuance").val();
            let v_num = $("#salesCreditDebitFrm #v_num").val();
            let credit_debit_amount = $(
                "#salesCreditDebitFrm #credit_debit_amount"
            ).val();
            let adjusted_amount = $(
                "#salesCreditDebitFrm #adjusted_amount"
            ).val();
            let terms_delivery = $(
                "#salesCreditDebitFrm #terms_delivery"
            ).val();
            let challan_no = $("#salesCreditDebitFrm #challan_no").val();
            let challan_date = $("#salesCreditDebitFrm #challan_date").val();
            let doc_no = $("#salesCreditDebitFrm #doc_no").val();
            let doc_date = $("#salesCreditDebitFrm #doc_date").val();
            let term_condition = $(
                "#salesCreditDebitFrm #term_condition"
            ).val();
            let voucher_doc = $("#salesCreditDebitFrm #voucher_doc").prop(
                "files"
            )[0];

            let date_of_payment = $(
                "#salesCreditDebitFrm #date_of_payment"
            ).val();
            let mode_of_pay = $("#salesCreditDebitFrm #mode_of_pay").val();
            let other_payment = $("#salesCreditDebitFrm #other_payment").val();
            let pay_status = $("#salesCreditDebitFrm #pay_status").val();

            let salesData = new FormData();
            salesData.append("id", sId);
            salesData.append("inv_num", inv_num);
            salesData.append("inv_date", inv_date);
            salesData.append("seller_name", seller_name);
            salesData.append("seller_addone", seller_addone);
            salesData.append("seller_addtwo", seller_addtwo);
            salesData.append("seller_country", seller_country);
            salesData.append("seller_state", seller_state);
            salesData.append("seller_city", seller_city);
            salesData.append("seller_pin", seller_pin);
            salesData.append("v_name", v_name);
            salesData.append("note_type", note_type);
            salesData.append("note_date", note_date);
            salesData.append("reason_issuance", reason_issuance);
            salesData.append("otherIssuance", otherIssuance);
            salesData.append("v_num", v_num);
            salesData.append("credit_debit_amount", credit_debit_amount);
            salesData.append("adjusted_amount", adjusted_amount);
            salesData.append("terms_delivery", terms_delivery);
            salesData.append("challan_no", challan_no);
            salesData.append("challan_date", challan_date);
            salesData.append("doc_no", doc_no);
            salesData.append("doc_date", doc_date);
            salesData.append("term_condition", term_condition);
            salesData.append("voucher_doc", voucher_doc);

            salesData.append("date_of_payment", date_of_payment);
            salesData.append("mode_of_pay", mode_of_pay);
            salesData.append("other_payment", other_payment);
            salesData.append("pay_status", pay_status);
            if (sId == "") {
                var surl = base_url + "/save_sales_invoice_creditdebit";
            } else {
                var surl = base_url + "/update_sales_invoice_creditdebit";
            }
            //var salesData = $('form#salesCreditDebitFrm').serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: salesData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#addSalesLoader").hide();
                    if (response.class == "succ") {
                        //$("#salesCreditDebitFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
                        //if(sId =="") {
                        window.location.href = response.redirect;
                        //}
                        /*$("#tab-A").removeClass("active");
								$("#tab-B").addClass("active");

								$("#info") .hide();
								$("#details") .show();
								$("#details") .addClass('show');
								$("#details") .addClass('active');*/
                    } else {
                        $.each(response, function (idx, obj) {
                            //alert(obj);
                            $("#salesCreditDebitFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });
    $("form#salesCreditDebitFrm #nextBtn").on("click", function () {
        $("#tab-A").removeClass("active");
        $("#tab-B").addClass("active");

        $("#info").hide();
        $("#details").show();
        $("#details").addClass("show");
        $("#details").addClass("active");
    });

    $("form#salesCreditDebitFrmTwo #prevBtn").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-A").addClass("active");

        $("#details").hide();
        $("#info").show();
        $("#info").addClass("show");
        $("#info").addClass("active");
    });

    var signature = $("form#salesCreditDebitFrmTwo #sign").val();
    if (signature == "") {
        var salesCreditDebitFrmTwo = $("#salesCreditDebitFrmTwo").validate({
            rules: {
                signature: {
                    required: true,
                },
                signature_name: {
                    required: true,
                },
            },
            messages: {
                signature: {
                    required: "Signature image is required",
                },
                signature_name: {
                    required: "Signature name is required",
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    } else {
        var salesCreditDebitFrmTwo = $("#salesCreditDebitFrmTwo").validate({
            rules: {
                signature_name: {
                    required: true,
                },
            },
            messages: {
                signature_name: {
                    required: "Signature name is required",
                },
            },
        });
    }

    $("form#salesCreditDebitFrmTwo").bind("submit", function () {
        if (salesCreditDebitFrmTwo.form()) {
            $("#editSalesLoader").show();
            let signature = $("#salesCreditDebitFrmTwo #signature").prop(
                "files"
            )[0];
            let signature_name = $(
                "#salesCreditDebitFrmTwo #signature_name"
            ).val();
            let id = $("#sId").val();
            let sales_data = new FormData();

            sales_data.append("signature", signature);
            sales_data.append("signature_name", signature_name);
            sales_data.append("id", id);

            $.ajax({
                url: base_url + "/update_sales_invoice_final_creditdebit",
                type: "POST",
                data: sales_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#editSalesLoader").hide();
                    if (response.class == "succ") {
                        $("#salesCreditDebitFrmTwo .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $(
                                "#salesCreditDebitFrmTwo .message-container"
                            ).html('<div class="err">' + obj + "</div>");
                        });
                    }
                },
            });
        }
    });

    var salesCreditDebitFrmThree = $("#salesCreditDebitFrmThree").validate({
        rules: {
            rate: {
                required: true,
                number: true,
            },
            disc_amt: {
                required: true,
                number: true,
            },
            tax_type: {
                required: true,
            },
        },
        messages: {
            rate: {
                required: "Rate is required",
            },
            disc_amt: {
                required: "Discount is required",
            },
            tax_type: {
                required: "Tax type is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#salesCreditDebitFrmThree").bind("submit", function () {
        //e.preventDefault();
        if (salesCreditDebitFrmThree.form()) {
            var itemurl = base_url + "/update_sales_item_creditdebit";
            var editData = $("form#salesCreditDebitFrmThree").serialize();

            $("form#salesCreditDebitFrmTwo #invoiceData").html("");
            $.ajax({
                url: itemurl,
                type: "POST",
                data: editData,
                success: function (result) {
                    $("form#salesCreditDebitFrmTwo #invoiceData").html(result);
                },
            });
        }
    });

    $("#prod_id_credit_debit").change(function () {
        var prod_id = $("#prod_id_credit_debit option:selected").val();
        var sId = $("#sId").val();
        if (prod_id != "") {
            $("#invoiceData").html("");
            $.ajax({
                method: "POST",
                url: base_url + "/sales_items_display_creditdebit",
                data: { sId: sId, prod_id: prod_id },
                datatype: "json",
                success: function (result) {
                    //console.log(result)
                    $("#invoiceData").html(result);
                },
            });
        }
    });

    $(".invoiceCreditDebitdelete").click(function () {
        var sId = $(this).data("id");
        $("#del_invoice_creditdebit").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delInvoiceCreditDebit",
                data: { id: sId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    $(".inv_active_creditDebit").click(function () {
        var status = $(this).data("stat");
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/activateSalesCreditDebitStatus",
            data: { status: status, id: id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    $(".inv_paid_creditDebit").click(function () {
        var status = $(this).data("stat");
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/paidInvCreditDebit",
            data: { status: status, id: id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    var returnType = $("#return_reason option:selected").val();
    if (returnType == "Others") {
        $("#returnReasonOther").show();
    } else {
        $("#returnReasonOther").hide();
    }
    $("#return_reason").on("change", function (e) {
        var optionSelected = $("option:selected", this);
        var selType = this.value;
        if (selType == "Others") {
            $("#returnReasonOther").show();
            $("#transport_type_other").val("");
        } else {
            $("#returnReasonOther").hide();
            $("#transport_type_other").val("");
        }
    });

    //End Add Sales creditdebit

    //Start add Vendor
    $("form#add_vendor_bill #prevBtnTwo").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-A").addClass("active");

        $("#details").hide();
        $("#info").show();
        $("#info").addClass("show");
        $("#info").addClass("active");
    });

    $("form#add_vendor_bank #prevBtnThree").on("click", function () {
        $("#tab-C").removeClass("active");
        $("#tab-B").addClass("active");

        $("#bank").hide();
        $("#details").show();
        $("#details").addClass("show");
        $("#details").addClass("active");
    });

    var addVendorDetails = $("#add_vendor_detail").validate({
        rules: {
            vendor_priority: {
                required: true,
            },
            vendor_name: {
                required: true,
            },
            vendor_pan: {
                required: true,
            },

            vendor_email: {
                required: true,
                email: true,
            },
            vendor_phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
            },

            cont_per_name: {
                required: true,
            },
            cont_per_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
            },
            cont_per_email: {
                required: true,
                email: true,
            },
        },
        messages: {
            vendor_priority: {
                required: "Priority is required",
            },
            vendor_pan: {
                required: "PAN is required",
            },
            vendor_name: {
                required: "Name is required",
            },
            vendor_gstin: {
                required: "GST no. is required",
            },
            vendor_gst_type: {
                required: "GST type is required",
            },
            vendor_email: {
                required: "Email is required",
            },
            vendor_phone: {
                required: "Phone is required",
            },
            cont_per_name: {
                required: "Name is required",
            },
            cont_per_number: {
                required: "Contact is required",
            },
            cont_per_email: {
                required: "Email is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#add_vendor_detail #nxtBtnVOne").on("click", function () {
        if (addVendorDetails.form()) {
            //$("#add_cust_form .message-container").html('');

            $("#tab-A").removeClass("active");
            $("#tab-B").addClass("active");

            $("#info").hide();
            $("#details").show();
            $("#details").addClass("show");
            $("#details").addClass("active");
        }
    });

    var addVendorBillDet = $("#add_vendor_bill").validate({
        rules: {
            billing_name: {
                required: true,
            },
            billing_address1: {
                required: true,
            },
            billing_country: {
                required: true,
            },
            billing_state: {
                required: true,
            },
            billing_city: {
                required: true,
            },
            billing_pincode: {
                required: true,
                number: true,
            },

            shipping_name: {
                required: true,
            },
            shipping_address1: {
                required: true,
            },
            shipping_country: {
                required: true,
            },
            shipping_state: {
                required: true,
            },
            shipping_city: {
                required: true,
            },
            shipping_pincode: {
                required: true,
                number: true,
            },
        },
        messages: {
            billing_name: {
                required: "Name is required",
            },
            billing_address1: {
                required: "Address line1 is required",
            },
            billing_country: {
                required: "Country is required",
            },
            billing_state: {
                required: "State is required",
            },
            billing_city: {
                required: "City is required",
            },
            billing_pincode: {
                required: "Pincode is required",
            },
            shipping_name: {
                required: "Name is required",
            },
            shipping_address1: {
                required: "Address line1 is required",
            },
            shipping_country: {
                required: "Country is required",
            },
            shipping_state: {
                required: "State is required",
            },
            shipping_city: {
                required: "City is required",
            },
            shipping_pincode: {
                required: "Pincode is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#add_vendor_bill #nxtBtnVTwo").on("click", function () {
        if (addVendorBillDet.form()) {
            //$("#add_cust_form .message-container").html('');

            $("#tab-B").removeClass("active");
            $("#tab-C").addClass("active");

            $("#details").hide();
            $("#bank").show();
            $("#bank").addClass("show");
            $("#bank").addClass("active");
        }
    });

    var addVendorBank = $("#add_vendor_bank").validate({
        rules: {
            bank_name: {
                required: true,
            },
            bank_branch: {
                required: true,
            },
            acc_holder_name: {
                required: true,
            },
            acc_number: {
                required: true,
                number: true,
            },
            acc_ifsc: {
                required: true,
            },
            // acc_upi_id: {
            // 	required: true
            // },
        },
        messages: {
            bank_name: {
                required: "Bank name is required",
            },
            bank_branch: {
                required: "Brance is required",
            },
            acc_holder_name: {
                required: "Name is required",
            },
            acc_number: {
                required: "A/C is required",
            },
            acc_ifsc: {
                required: "IFSC is required",
            },
            // acc_upi_id: {
            // 	required: "UPID is required"
            // },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#add_vendor_bank").bind("submit", function () {
        if (addVendorBank.form()) {
            $("#addCustomerLoader").show();
            var formVendorData =
                $("form#add_vendor_detail").serialize() +
                "&" +
                $("form#add_vendor_bill").serialize() +
                "&" +
                $("form#add_vendor_bank").serialize();

            var vendorId = $("#vendorId").val();
            //alert(vendorId);
            if (vendorId == "") {
                var suburl = base_url + "/saveaddvendor";
            } else {
                var suburl = base_url + "/update_vendor";
            }
            $.ajax({
                url: suburl,
                type: "POST",
                data: formVendorData,
                success: function (response) {
                    //alert(response);
                    $("#addCustomerLoader").hide();
                    if (response.class == "succ") {
                        //alert('Helwo');
                        //$("#add_vendor_bank .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
                        window.location.href = response.redirect;
                    } else {
                        //alert('Hello');
                        $.each(response, function (idx, obj) {
                            $("#add_vendor_bank .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });
    //End vendor

    //Delete customer
    $(".vendordelete").click(function () {
        var vendor_id = $(this).data("id");
        $("#del_vendor").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/deleteVendor",
                data: { id: vendor_id },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    //Start Add Purchase Invoice
    var addPurchaseFrm = $("#addPurchaseFrm").validate({
        rules: {
            inv_name: {
                required: true,
            },
        },

        messages: {
            inv_name: {
                required: "Customer is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addPurchaseFrm").bind("submit", function () {
        if (addPurchaseFrm.form()) {
            $("#addSalesLoader").show();
            var sId = $("#sId").val();
            if (sId == "") {
                var surl = base_url + "/save_purchase_invoice";
            } else {
                var surl = base_url + "/update_purchase_invoice";
            }
            var salesData =
                $("form#addPurchaseFrmTop").serialize() +
                "&" +
                $("form#addPurchaseFrm").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: salesData,
                success: function (response) {
                    $("#addSalesLoader").hide();
                    if (response.class == "succ") {
                        //$("#addPurchaseFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
                        if (sId == "") {
                            window.location.href = response.redirect;
                        }
                        $("#tab-A").removeClass("active");
                        $("#tab-B").addClass("active");

                        $("#buyer").hide();
                        $("#seller").show();
                        $("#seller").addClass("show");
                        $("#seller").addClass("active");
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addPurchaseFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $("form#addPurchaseFrm #nextBtnBuyer").on("click", function () {
        $("#tab-A").removeClass("active");
        $("#tab-B").addClass("active");
        $("#buyer").hide();
        $("#seller").show();
        $("#seller").addClass("show");
        $("#seller").addClass("active");
    });

    $("form#addPurchaseFrmTwo #nextBtnSeller").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-C").addClass("active");
        $("#seller").hide();
        $("#product").show();
        $("#product").addClass("show");
        $("#product").addClass("active");
    });

    $("form#addPurchaseFrmThree #nextBtnProd").on("click", function () {
        $("#tab-c").removeClass("active");
        $("#tab-D").addClass("active");
        $("#product").hide();
        $("#other").show();
        $("#other").addClass("show");
        $("#other").addClass("active");
    });

    $("form#addPurchaseFrmTwo #prevBtnBuyer").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-A").addClass("active");

        $("#seller").hide();
        $("#buyer").show();
        $("#buyer").addClass("show");
        $("#buyer").addClass("active");
    });

    $("form#addPurchaseFrmThree #prevBtnProd").on("click", function () {
        $("#tab-C").removeClass("active");
        $("#tab-B").addClass("active");

        $("#product").hide();
        $("#seller").show();
        $("#seller").addClass("show");
        $("#seller").addClass("active");
    });

    $("form#addPurchaseFrmFour #prevBtnOther").on("click", function () {
        $("#tab-D").removeClass("active");
        $("#tab-c").addClass("active");

        $("#other").hide();
        $("#product").show();
        $("#product").addClass("show");
        $("#product").addClass("active");
    });

    var addPurchaseFrmTwo = $("#addPurchaseFrmTwo").validate({
        rules: {
            seller_name: {
                required: true,
            },
            seller_contact: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true,
            },
            seller_email: {
                required: true,
                email: true,
            },
            seller_pan: {
                required: true,
            },
            seller_addone: {
                required: true,
            },
            seller_country: {
                required: true,
            },
            seller_state: {
                required: true,
            },
            /*seller_city: {
					required: true
				},
				seller_pin: {
					required: true,
					number:true
				},*/
        },

        messages: {
            seller_name: {
                required: "Seller name is required",
            },
            seller_contact: {
                required: "Contact is required",
            },
            seller_email: {
                required: "Email is required",
            },
            seller_pan: {
                required: "Email is required",
            },
            seller_addone: {
                required: "Address is required",
            },
            seller_country: {
                required: "Country is required",
            },
            seller_state: {
                required: "State is required",
            },
            /*seller_city: {
						required: "City is required"
					},
					seller_pin: {
						required: "Pincode is required"
					},*/
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addPurchaseFrmTwo").bind("submit", function () {
        if (addPurchaseFrmTwo.form()) {
            $("#addSalesLoader").show();
            var sId = $("#sId").val();
            var surl = base_url + "/update_seller_details";
            var sellerData = $("form#addPurchaseFrmTwo").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: sellerData,
                success: function (response) {
                    //console.log(response);
                    $("#addSalesLoader").hide();
                    if (response.class == "succ") {
                        //$("#addPurchaseFrmTwo .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');

                        $("#tab-B").removeClass("active");
                        $("#tab-C").addClass("active");

                        $("#seller").hide();
                        $("#product").show();
                        $("#product").addClass("show");
                        $("#product").addClass("active");
                    } else {
                        $.each(response, function (idx, obj) {
                            //alert(obj);
                            $("#addPurchaseFrmTwo .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var addPurchaseFrmThree = $("#addPurchaseFrmThree").validate({
        rules: {
            signature_name: {
                //required: true
            },
        },
        messages: {
            signature_name: {
                //required: "Signature name is required"
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addPurchaseFrmThree").bind("submit", function () {
        if (addPurchaseFrmThree.form()) {
            $("#editSalesLoader").show();
            let signature_name = $(
                "#addPurchaseFrmThree #signature_name"
            ).val();
            let id = $("#sId").val();
            let sales_data = new FormData();
            sales_data.append("signature_name", signature_name);
            sales_data.append("id", id);

            $.ajax({
                url: base_url + "/update_purchase_invoice_final",
                type: "POST",
                data: sales_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#editSalesLoader").hide();
                    if (response.class == "succ") {
                        $("#addPurchaseFrmThree .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        //window.location.href=response.redirect;
                        $("#tab-C").removeClass("active");
                        $("#tab-D").addClass("active");

                        $("#product").hide();
                        $("#other").show();
                        $("#other").addClass("show");
                        $("#other").addClass("active");
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addPurchaseFrmThree .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var addPurchaseFrmFour = $("#addPurchaseFrmFour").validate({
        rules: {
            mode_of_pay: {
                required: true,
            },
            pay_status: {
                required: true,
            },
            order_date: {
                required: true,
            },
            disp_through: {
                required: true,
            },
            other_payment: {
                required: function () {
                    return $("#mode_of_pay").val() === "OTHER";
                },
            },
        },
        messages: {
            mode_of_pay: {
                required: "Payment mode is required",
            },
            pay_status: {
                required: "Payment status is required",
            },
            order_date: {
                required: "Date is required",
            },
            disp_through: {
                required: "Dispatch through is required",
            },
            other_payment: {
                required: "Other Payment Name is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addPurchaseFrmFour").bind("submit", function () {
        //e.preventDefault();
        if (addPurchaseFrmFour.form()) {
            $("#editSalesLoader").show();
            var itemurl = base_url + "/update_purchase_other";
            //var editData = $('form#addPurchaseFrmFour').serialize();
            let id = $("#sId").val();
            let mode_of_pay = $(
                "#addPurchaseFrmFour #mode_of_pay option:selected"
            ).val();
            let pay_status = $(
                "#addPurchaseFrmFour #pay_status option:selected"
            ).val();
            let other_payment = $("#addPurchaseFrmFour #other_payment").val();
            let bankname = $("#addPurchaseFrmFour #bankname").val();
            let ifsc_code = $("#addPurchaseFrmFour #ifsc_code").val();
            let bank_ac = $("#addPurchaseFrmFour #bank_ac").val();
            let ac_type = $("#addPurchaseFrmFour #ac_type").val();
            let bank_remarks = $("#addPurchaseFrmFour #bank_remarks").val();
            let upi_holder_name = $(
                "#addPurchaseFrmFour #upi_holder_name"
            ).val();
            let upi_id = $("#addPurchaseFrmFour #upi_id").val();
            let upi_remarks = $("#addPurchaseFrmFour #upi_remarks").val();
            let card_type = $(
                "#addPurchaseFrmFour #card_type option:selected"
            ).val();
            let card_no = $("#addPurchaseFrmFour #card_no").val();
            let card_bank_name = $("#addPurchaseFrmFour #card_bank_name").val();
            let card_remarks = $("#addPurchaseFrmFour #card_remarks").val();
            let cash_remarks = $("#addPurchaseFrmFour #cash_remarks").val();
            let total_amount = $("#addPurchaseFrmFour #total_amount").val();
            let advance_amount = $("#addPurchaseFrmFour #advance_amount").val();
            let due_amount = $("#addPurchaseFrmFour #due_amount").val();
            let seller_orderno = $("#addPurchaseFrmFour #seller_orderno").val();
            let order_date = $("#addPurchaseFrmFour #order_date").val();
            let buyer_refno = $("#addPurchaseFrmFour #buyer_refno").val();
            let other_refno = $("#addPurchaseFrmFour #other_refno").val();
            let dispa_docno_one = $(
                "#addPurchaseFrmFour #dispa_docno_one"
            ).val();
            let disp_through = $(
                "#addPurchaseFrmFour #disp_through option:selected"
            ).val();
            let other_dispa_det = $(
                "#addPurchaseFrmFour #other_dispa_det"
            ).val();
            let terms_delivery = $("#addPurchaseFrmFour #terms_delivery").val();

            const totalImages = $("#image_sign")[0].files.length;
            let image_sign = $("#image_sign")[0];
            let frmData = new FormData();
            frmData.append("id", id);
            frmData.append("mode_of_pay", mode_of_pay);
            frmData.append("other_payment", other_payment);
            frmData.append("pay_status", pay_status);
            frmData.append("bankname", bankname);
            frmData.append("ifsc_code", ifsc_code);
            frmData.append("bank_ac", bankname);
            frmData.append("ac_type", ac_type);
            frmData.append("bank_remarks", bank_remarks);
            frmData.append("upi_holder_name", upi_holder_name);
            frmData.append("upi_id", upi_id);
            frmData.append("upi_remarks", upi_remarks);
            frmData.append("card_type", card_type);
            frmData.append("card_no", card_no);
            frmData.append("card_bank_name", card_bank_name);
            frmData.append("card_remarks", card_remarks);
            frmData.append("cash_remarks", cash_remarks);
            frmData.append("total_amount", total_amount);
            frmData.append("advance_amount", advance_amount);
            frmData.append("due_amount", due_amount);
            frmData.append("seller_orderno", seller_orderno);
            frmData.append("order_date", order_date);
            frmData.append("buyer_refno", buyer_refno);
            frmData.append("other_refno", other_refno);
            frmData.append("dispa_docno_one", dispa_docno_one);
            frmData.append("disp_through", disp_through);
            frmData.append("other_dispa_det", other_dispa_det);
            frmData.append("terms_delivery", terms_delivery);
            for (let i = 0; i < totalImages; i++) {
                frmData.append("image_sign" + i, image_sign.files[i]);
            }
            frmData.append("totalImages", totalImages);
            $.ajax({
                url: itemurl,
                type: "POST",
                data: frmData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#editSalesLoader").hide();
                    if (response.class == "succ") {
                        $("#addPurchaseFrmFour .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addPurchaseFrmFour .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var addPurchaseFrmFive = $("#addPurchaseFrmFive").validate({
        rules: {
            rate: {
                required: true,
                number: true,
            },
            disc_amt: {
                required: true,
                number: true,
            },
            tax_type: {
                required: true,
            },
        },
        messages: {
            rate: {
                required: "Rate is required",
            },
            disc_amt: {
                required: "Discount is required",
            },
            tax_type: {
                required: "Tax type is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addPurchaseFrmFive").bind("submit", function () {
        //e.preventDefault();
        if (addPurchaseFrmFive.form()) {
            var itemurl = base_url + "/update_purchase_item";
            var editData = $("form#addPurchaseFrmFive").serialize();

            $("form#addPurchaseFrmFive #invoiceData").html("");
            $.ajax({
                url: itemurl,
                type: "POST",
                data: editData,
                success: function (result) {
                    $("form#addPurchaseFrmFive #invoiceData").html(result);
                },
            });
        }
    });

    $("#purchase_prod_id").change(function () {
        var prod_id = $("#purchase_prod_id option:selected").val();
        var sId = $("#sId").val();
        if (prod_id != "") {
            $("#invoiceData").html("");
            $.ajax({
                method: "POST",
                url: base_url + "/purchase_items_display",
                data: { sId: sId, prod_id: prod_id },
                datatype: "json",
                success: function (result) {
                    //console.log(result)
                    $("#invoiceData").html(result);
                },
            });
        }
    });

    $(".invoicePurdelete").click(function () {
        var sId = $(this).data("id");
        $("#del_purchase_invoice").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delInvoicePurchase",
                data: { id: sId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    $(".inv_pur_active").click(function () {
        var status = $(this).data("stat");
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/activateStatusPurchase",
            data: { status: status, id: id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    //End Add Purchase Invoice

    //Start Add Purchase creditdebit

    var purchaseCreditDebitFrm = $("#purchaseCreditDebitFrm").validate({
        rules: {
            inv_num: {
                required: true,
            },
            inv_date: {
                required: true,
            },
            v_name: {
                required: true,
            },
            note_type: {
                required: true,
            },
            note_date: {
                required: true,
            },
            reason_issuance: {
                required: true,
            },
            seller_name: {
                required: true,
            },
            seller_contact: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true,
            },
            seller_email: {
                required: true,
                email: true,
            },
            seller_addone: {
                required: true,
            },
            seller_country: {
                required: true,
            },
            seller_state: {
                required: true,
            },
            seller_city: {
                required: true,
            },
            seller_pin: {
                required: true,
                number: true,
            },
            other_payment: {
                required: function () {
                    return $("#mode_of_pay").val() === "OTHER";
                },
            },
        },

        messages: {
            inv_num: {
                required: "Invoice no. is required",
            },
            inv_date: {
                required: "Date is required",
            },
            v_name: {
                required: "Buyer is required",
            },
            note_type: {
                required: "Note type is required",
            },
            note_date: {
                required: "Date is required",
            },
            reason_issuance: {
                required: "Reason is required",
            },
            seller_name: {
                required: "Seller name is required",
            },
            seller_contact: {
                required: "Seller no. is required",
            },
            seller_email: {
                required: "Seller email is required",
            },
            seller_addone: {
                required: "Address is required",
            },
            seller_country: {
                required: "Country is required",
            },
            seller_state: {
                required: "State is required",
            },
            seller_city: {
                required: "City is required",
            },
            seller_pin: {
                required: "Pincode is required",
            },
            other_payment: {
                required: "Specify Other Payment Method is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#purchaseCreditDebitFrm").bind("submit", function () {
        if (purchaseCreditDebitFrm.form()) {
            $("#addSalesLoader").show();
            var sId = $("#sId").val();
            let inv_num = $("#purchaseCreditDebitFrm #inv_num").val();
            let inv_date = $("#purchaseCreditDebitFrm #inv_date").val();
            let seller_name = $("#purchaseCreditDebitFrm #seller_name").val();
            let seller_contact = $(
                "#purchaseCreditDebitFrm #seller_contact"
            ).val();
            let seller_email = $("#purchaseCreditDebitFrm #seller_email").val();
            let seller_addone = $(
                "#purchaseCreditDebitFrm #seller_addone"
            ).val();
            let seller_addtwo = $(
                "#purchaseCreditDebitFrm #seller_addtwo"
            ).val();
            let seller_country = $(
                "#purchaseCreditDebitFrm #country option:selected"
            ).val();
            let seller_state = $(
                "#purchaseCreditDebitFrm #state option:selected"
            ).val();
            let seller_city = $(
                "#purchaseCreditDebitFrm #city option:selected"
            ).val();
            let seller_pin = $("#purchaseCreditDebitFrm #seller_pin").val();
            let contact_name = $("#purchaseCreditDebitFrm #contact_name").val();
            let contact_no = $("#purchaseCreditDebitFrm #contact_num").val();
            let v_name = $(
                "#purchaseCreditDebitFrm #invNameCustomer option:selected"
            ).val();
            let note_type = $(
                "#purchaseCreditDebitFrm #note_type option:selected"
            ).val();
            let note_date = $("#purchaseCreditDebitFrm #note_date").val();
            let reason_issuance = $(
                "#purchaseCreditDebitFrm #reason_issuance option:selected"
            ).val();
            let otherIssuance = $(
                "#purchaseCreditDebitFrm #otherIssuance"
            ).val();
            let v_num = $("#purchaseCreditDebitFrm #v_num").val();
            let credit_debit_amount = $(
                "#purchaseCreditDebitFrm #credit_debit_amount"
            ).val();
            let adjusted_amount = $(
                "#purchaseCreditDebitFrm #adjusted_amount"
            ).val();
            let terms_delivery = $(
                "#purchaseCreditDebitFrm #terms_delivery"
            ).val();
            let challan_no = $("#purchaseCreditDebitFrm #challan_no").val();
            let challan_date = $("#purchaseCreditDebitFrm #challan_date").val();
            let doc_no = $("#purchaseCreditDebitFrm #doc_no").val();
            let doc_date = $("#purchaseCreditDebitFrm #doc_date").val();
            let term_condition = $(
                "#purchaseCreditDebitFrm #term_condition"
            ).val();
            let voucher_doc = $("#purchaseCreditDebitFrm #voucher_doc").prop(
                "files"
            )[0];
            let date_of_payment = $(
                "#purchaseCreditDebitFrm #date_of_payment"
            ).val();
            let mode_of_pay = $("#purchaseCreditDebitFrm #mode_of_pay").val();
            let other_payment = $(
                "#purchaseCreditDebitFrm #other_payment"
            ).val();
            let pay_status = $("#purchaseCreditDebitFrm #pay_status").val();

            let salesData = new FormData();
            salesData.append("id", sId);
            salesData.append("inv_num", inv_num);

            salesData.append("inv_date", inv_date);
            salesData.append("seller_name", seller_name);
            salesData.append("seller_contact", seller_contact);
            salesData.append("seller_email", seller_email);
            salesData.append("seller_addone", seller_addone);
            salesData.append("seller_addtwo", seller_addtwo);
            salesData.append("seller_country", seller_country);
            salesData.append("seller_state", seller_state);
            salesData.append("seller_city", seller_city);
            salesData.append("seller_pin", seller_pin);
            salesData.append("contact_name", contact_name);
            salesData.append("contact_no", contact_no);
            salesData.append("v_name", v_name);
            salesData.append("note_type", note_type);
            salesData.append("note_date", note_date);
            salesData.append("reason_issuance", reason_issuance);
            salesData.append("otherIssuance", otherIssuance);
            salesData.append("v_num", v_num);
            salesData.append("credit_debit_amount", credit_debit_amount);
            salesData.append("adjusted_amount", adjusted_amount);
            salesData.append("terms_delivery", terms_delivery);
            salesData.append("challan_no", challan_no);
            salesData.append("challan_date", challan_date);
            salesData.append("doc_no", doc_no);
            salesData.append("doc_date", doc_date);
            salesData.append("term_condition", term_condition);
            salesData.append("voucher_doc", voucher_doc);
            salesData.append("date_of_payment", date_of_payment);
            salesData.append("mode_of_pay", mode_of_pay);
            salesData.append("other_payment", other_payment);
            salesData.append("pay_status", pay_status);

            if (sId == "") {
                var surl = base_url + "/save_purchase_invoice_creditdebit";
            } else {
                var surl = base_url + "/update_purchase_invoice_creditdebit";
            }
            //var salesData = $('form#purchaseCreditDebitFrm').serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: salesData,
                contentType: false,
                processData: false,
                success: function (response) {
                    //console.log(response);
                    $("#addSalesLoader").hide();
                    if (response.class == "succ") {
                        //$("#purchaseCreditDebitFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
                        //if(sId =="") {
                        window.location.href = response.redirect;
                        //}
                        /*$("#tab-A").removeClass("active");
								$("#tab-B").addClass("active");

								$("#info") .hide();
								$("#details") .show();
								$("#details") .addClass('show');
								$("#details") .addClass('active');*/
                    } else {
                        $.each(response, function (idx, obj) {
                            //alert(obj);
                            $(
                                "#purchaseCreditDebitFrm .message-container"
                            ).html('<div class="err">' + obj + "</div>");
                        });
                    }
                },
            });
        }
    });
    $("form#purchaseCreditDebitFrm #nextBtn").on("click", function () {
        $("#tab-A").removeClass("active");
        $("#tab-B").addClass("active");

        $("#info").hide();
        $("#details").show();
        $("#details").addClass("show");
        $("#details").addClass("active");
    });

    $("form#purchaseCreditDebitFrmTwo #prevBtn").on("click", function () {
        $("#tab-B").removeClass("active");
        $("#tab-A").addClass("active");

        $("#details").hide();
        $("#info").show();
        $("#info").addClass("show");
        $("#info").addClass("active");
    });

    var signature = $("form#purchaseCreditDebitFrmTwo #sign").val();
    if (signature == "") {
        var purchaseCreditDebitFrmTwo = $(
            "#purchaseCreditDebitFrmTwo"
        ).validate({
            rules: {
                signature: {
                    required: true,
                },
                signature_name: {
                    required: true,
                },
            },
            messages: {
                signature: {
                    required: "Signature image is required",
                },
                signature_name: {
                    required: "Signature name is required",
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    } else {
        var purchaseCreditDebitFrmTwo = $(
            "#purchaseCreditDebitFrmTwo"
        ).validate({
            rules: {
                signature_name: {
                    required: true,
                },
            },
            messages: {
                signature_name: {
                    required: "Signature name is required",
                },
            },
        });
    }

    $("form#purchaseCreditDebitFrmTwo").bind("submit", function () {
        if (purchaseCreditDebitFrmTwo.form()) {
            $("#editSalesLoader").show();
            let signature = $("#purchaseCreditDebitFrmTwo #signature").prop(
                "files"
            )[0];
            let signature_name = $(
                "#purchaseCreditDebitFrmTwo #signature_name"
            ).val();
            let id = $("#sId").val();
            let sales_data = new FormData();

            sales_data.append("signature", signature);
            sales_data.append("signature_name", signature_name);
            sales_data.append("id", id);

            $.ajax({
                url: base_url + "/update_purchase_invoice_final_creditdebit",
                type: "POST",
                data: sales_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#editSalesLoader").hide();
                    if (response.class == "succ") {
                        $("#purchaseCreditDebitFrmTwo .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $(
                                "#purchaseCreditDebitFrmTwo .message-container"
                            ).html('<div class="err">' + obj + "</div>");
                        });
                    }
                },
            });
        }
    });

    var purchaseCreditDebitFrmThree = $(
        "#purchaseCreditDebitFrmThree"
    ).validate({
        rules: {
            rate: {
                required: true,
                number: true,
            },
            disc_amt: {
                required: true,
                number: true,
            },
            tax_type: {
                required: true,
            },
        },
        messages: {
            rate: {
                required: "Rate is required",
            },
            disc_amt: {
                required: "Discount is required",
            },
            tax_type: {
                required: "Tax type is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#purchaseCreditDebitFrmThree").bind("submit", function () {
        //e.preventDefault();
        if (purchaseCreditDebitFrmThree.form()) {
            var itemurl = base_url + "/update_purchase_item_creditdebit";
            var editData = $("form#purchaseCreditDebitFrmThree").serialize();

            $("form#purchaseCreditDebitFrmTwo #invoiceData").html("");
            $.ajax({
                url: itemurl,
                type: "POST",
                data: editData,
                success: function (result) {
                    $("form#purchaseCreditDebitFrmTwo #invoiceData").html(
                        result
                    );
                },
            });
        }
    });

    $("#prod_id_purchase_credit_debit").change(function () {
        var prod_id = $("#prod_id_purchase_credit_debit option:selected").val();
        var sId = $("#sId").val();
        if (prod_id != "") {
            $("#invoiceData").html("");
            $.ajax({
                method: "POST",
                url: base_url + "/purchase_items_display_creditdebit",
                data: { sId: sId, prod_id: prod_id },
                datatype: "json",
                success: function (result) {
                    //console.log(result)
                    $("#invoiceData").html(result);
                },
            });
        }
    });

    $(".purchaseCreditDebitdelete").click(function () {
        var sId = $(this).data("id");
        $("#del_purchase_creditdebit").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delPurchaseCreditDebit",
                data: { id: sId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    $(".pur_active_creditDebit").click(function () {
        var status = $(this).data("stat");
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/activatePurchaseCreditDebitStatus",
            data: { status: status, id: id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    $(".pur_paid_creditDebit").click(function () {
        var status = $(this).data("stat");
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: base_url + "/paidPurchaseCreditDebit",
            data: { status: status, id: id },
            success: function (data) {
                //console.log(data.success)
                window.location.href = data.redirect;
            },
        });
    });

    //End Add Purchase creditdebit

    //Start for Expenses

    var addExpenseFrm = $("#addExpenseFrm").validate({
        rules: {
            expense_date: {
                required: true,
            },
            expense_cat: {
                required: true,
            },
            expense_type: {
                required: true,
            },
            exp_invno: {
                required: true,
            },
            expense_amt: {
                required: true,
                number: true,
            },
            mode_of_expense: {
                required: true,
            },
            pur_of_expense: {
                required: true,
                minlength: 3,
            },
            approved_by: {
                required: true,
            },
            designation: {
                required: true,
            },
            approved_date: {
                required: true,
            },
        },

        messages: {
            expense_date: {
                required: "Expense date is required",
            },
            pur_of_expense: {
                required: "Purpose is required",
            },
            mode_of_expense: {
                required: "Mode of expense is required",
            },
            expense_cat: {
                required: "Expense category is required",
            },
            expense_type: {
                required: "Expense type is required",
            },
            expense_amt: {
                required: "Amount is required",
            },
            exp_invno: {
                required: "invoice no. is required",
            },
            approved_by: {
                required: "Name is required",
            },
            designation: {
                required: "Designation is required",
            },
            approved_date: {
                required: "Date is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addExpenseFrm").bind("submit", function () {
        if (addExpenseFrm.form()) {
            $("#expenseLoader").show();
            var eId = $("#eId").val();
            if (eId == "") {
                var surl = base_url + "/save_expenses";
            } else {
                var surl = base_url + "/update_expenses";
            }
            //var expensesData = $('form#addExpenseFrm').serialize();
            let expense_cat = $(
                "form#addExpenseFrm #expense_cat option:selected"
            ).val();
            let expense_type = $(
                "form#addExpenseFrm #expense_type option:selected"
            ).val();
            let expense_date = $("form#addExpenseFrm #expense_date").val();
            let exp_invno = $("form#addExpenseFrm #exp_invno").val();
            let expense_amt = $("form#addExpenseFrm #expense_amt").val();
            let mode_of_expense = $(
                "form#addExpenseFrm #mode_of_expense"
            ).val();
            let pur_of_expense = $("form#addExpenseFrm #pur_of_expense").val();
            let approved_by = $("form#addExpenseFrm #approved_by").val();
            let designation = $("form#addExpenseFrm #designation").val();
            let approved_date = $("form#addExpenseFrm #approved_date").val();
            let spec_note = $("form#addExpenseFrm #spec_note").val();
            let other = $("form#addExpenseFrm #other").val();

            let exp_inv_doc = $("form#addExpenseFrm #exp_inv_doc").prop(
                "files"
            )[0];
            let expensesData = new FormData();
            expensesData.append("id", eId);
            expensesData.append("expense_cat", expense_cat);
            expensesData.append("expense_type", expense_type);
            expensesData.append("expense_date", expense_date);
            expensesData.append("exp_invno", exp_invno);
            expensesData.append("expense_amt", expense_amt);
            expensesData.append("mode_of_expense", mode_of_expense);
            expensesData.append("pur_of_expense", pur_of_expense);
            expensesData.append("approved_by", approved_by);
            expensesData.append("designation", designation);
            expensesData.append("approved_date", approved_date);
            expensesData.append("spec_note", spec_note);
            expensesData.append("exp_inv_doc", exp_inv_doc);
            expensesData.append("other", other);
            $.ajax({
                url: surl,
                type: "POST",
                data: expensesData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#expenseLoader").hide();
                    if (response.class == "succ") {
                        $("#addExpenseFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addExpenseFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".expensedelete").click(function () {
        var eId = $(this).data("id");
        $("#del_expense").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delExpenses",
                data: { id: eId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    //End for Expenses

    //Start for Payment

    var addPaymentFrm = $("#payment_detail").validate({
        rules: {
            payment_date: {
                required: true,
            },
            purpose_of_payment: {
                required: true,
            },
            mode_of_payment: {
                required: true,
            },
            customerId: {
                required: true,
            },
            pay_voucher_no: {
                required: true,
            },

            payment_type: {
                required: true,
            },
            payment_type_opt: {
                required: true,
            },
            amount: {
                required: true,
                number: true,
            },
        },

        messages: {
            payment_date: {
                required: "Payment date is required",
            },
            purpose_of_payment: {
                required: "Purpose is required",
            },
            mode_of_payment: {
                required: "Mode of payment is required",
            },
            customerId: {
                required: "Customer name is required",
            },
            pay_voucher_no: {
                required: "Payment voucher no is required",
            },
            payment_type: {
                required: "Payment type is required",
            },
            payment_type_opt: {
                required: "Payment type option is required",
            },
            amount: {
                required: "Amount is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#payment_detail").bind("submit", function () {
        //alert('Hi');
        if (addPaymentFrm.form()) {
            $("#paymentLoader").show();
            var payId = $("#custId").val();
            //alert(payId);
            if (payId == "") {
                var surl = base_url + "/savepayment";
            } else {
                var surl = base_url + "/update_payment";
            }
            var paymentData = $("form#payment_detail").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: paymentData,
                success: function (response) {
                    $("#paymentLoader").hide();
                    if (response.class == "succ") {
                        $("#payment_detail .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#payment_detail .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".paymentdelete").click(function () {
        var payId = $(this).data("id");
        $("#del_payment").click(function () {
            //alert('hi');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delPayment",
                data: { id: payId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    var modeType = $("#mode_of_payment option:selected").val();
    if (modeType == "Cash") {
        $("#cashTypeOther").show();
    } else {
        $("#cashTypeOther").hide();
    }
    $("#mode_of_payment").on("change", function (e) {
        var optionSelected = $("option:selected", this);
        var modePayType = this.value;
        if (modePayType == "Cash") {
            $("#cashTypeOther").show();
            //$("#cash_type").val('');
        } else {
            $("#cashTypeOther").hide();
            //$("#cash_type").val('');
        }
    });
    // End Payment
    //Start for statutory

    var addStatutoryFrm = $("#addStatutoryFrm").validate({
        rules: {
            compId: {
                required: true,
            },
            statutory_doc: {
                required: true,
            },
            /*statutory_due_date: {
					required: true
				},*/
            statutory_msg: {
                required: true,
                minlength: 3,
            },
        },

        messages: {
            compId: {
                required: "Company is required",
            },
            statutory_doc: {
                required: "Document is required",
            },
            /*statutory_due_date: {
						required: "Due date is required"
					},*/
            statutory_msg: {
                required: "Message is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addStatutoryFrm").bind("submit", function () {
        if (addStatutoryFrm.form()) {
            $("#statutoryLoader").show();
            var eId = $("#eId").val();
            if (eId == "") {
                var surl = base_url + "/save_statutory";
            } else {
                var surl = base_url + "/update_statutory";
            }
            var expensesData = $("form#addStatutoryFrm").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: expensesData,
                success: function (response) {
                    $("#statutoryLoader").hide();
                    if (response.class == "succ") {
                        $("#addStatutoryFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addStatutoryFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    //End for statutory

    //Start bank section

    //Start loan section
    var addBankFrm = $("#addBankFrm").validate({
        rules: {
            bank_name: {
                required: true,
            },
            bank_branch: {
                required: true,
            },
            accholder_name: {
                required: true,
            },
            bank_ac_no: {
                required: true,
                number: true,
            },
            ifsc_code: {
                required: true,
            },

            curr_bal: {
                required: true,
                number: true,
            },
        },
        messages: {
            bank_name: {
                required: "Bank name is required",
            },
            bank_branch: {
                required: "Branch is required",
            },
            accholder_name: {
                required: "Account name is required",
            },
            bank_ac_no: {
                required: "Bank a/c no. is required",
            },
            ifsc_code: {
                required: "IFSC code is required",
            },

            curr_bal: {
                required: "Current balance limit is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addBankFrm").bind("submit", function () {
        if (addBankFrm.form()) {
            $("#addBankLoader").show();
            var bankId = $("#bankId").val();
            if (bankId == "") {
                var bankurl = base_url + "/save_bank";
            } else {
                var bankurl = base_url + "/update_bank";
            }
            var bankData = $("form#addBankFrm").serialize();

            $.ajax({
                url: bankurl,
                type: "POST",
                data: bankData,
                success: function (response) {
                    $("#addLoanLoader").hide();
                    if (response.class == "succ") {
                        $("#addBankFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addBankFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var tranDoc = $("form#addTranFrm #tranDoc").val();
    if (tranDoc == "") {
        var addTranFrm = $("#addTranFrm").validate({
            rules: {
                tran_date: {
                    required: true,
                },
                tran_type: {
                    required: true,
                },
                payment_mode: {
                    required: true,
                },
                tran_amt: {
                    required: true,
                    number: true,
                },
                curr_amt: {
                    required: true,
                    number: true,
                },
                message: {
                    required: true,
                },
                tarn_doc: {
                    required: true,
                },
            },
            messages: {
                tran_date: {
                    required: "Date is required",
                },
                tran_type: {
                    required: "Transaction type is required",
                },
                payment_mode: {
                    required: "Payment mode is required",
                },
                tran_amt: {
                    required: "Amount is required",
                },
                curr_amt: {
                    required: "Amount is required",
                },
                message: {
                    required: "Message is required",
                },
                tarn_doc: {
                    required: "Document is required",
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    } else {
        var addTranFrm = $("#addTranFrm").validate({
            rules: {
                tran_date: {
                    required: true,
                },
                tran_type: {
                    required: true,
                },
                payment_mode: {
                    required: true,
                },
                tran_amt: {
                    required: true,
                    number: true,
                },
                curr_amt: {
                    required: true,
                    number: true,
                },
                message: {
                    required: true,
                },
            },
            messages: {
                tran_date: {
                    required: "Date is required",
                },
                tran_type: {
                    required: "Transaction type is required",
                },
                payment_mode: {
                    required: "Payment mode is required",
                },
                tran_amt: {
                    required: "Amount is required",
                },
                curr_amt: {
                    required: "Amount is required",
                },
                message: {
                    required: "Message is required",
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    }

    $("form#addTranFrm").bind("submit", function () {
        //alert('hello');
        //e.preventDefault();
        if (addTranFrm.form()) {
            $("#addBankLoader").show();
            var tranId = $("#tranId").val();
            var bankId = $("#bankId").val();

            let tran_date = $("#addTranFrm #tran_date").val();
            let tran_type = $("#addTranFrm #tran_type").val();
            let payment_mode = $("#addTranFrm #payment_mode").val();
            let purpose = $("#addTranFrm #purpose").val();
            let tran_amt = $("#addTranFrm #tran_amt").val();
            let curr_amt = $("#addTranFrm #curr_amt").val();
            let message = $("#addTranFrm #message").val();
            let tran_doc = $("form#addTranFrm #tran_doc").prop("files")[0];

            var tranData = new FormData();
            tranData.append("tran_date", tran_date);
            tranData.append("tran_type", tran_type);
            tranData.append("payment_mode", payment_mode);
            tranData.append("purpose", purpose);
            tranData.append("tran_amt", tran_amt);
            tranData.append("curr_amt", curr_amt);
            tranData.append("message", message);
            tranData.append("tran_doc", tran_doc);
            tranData.append("id", tranId);
            tranData.append("bankId", bankId);
            //alert(tranId);
            if (tranId == "") {
                var projurl = base_url + "/save_transaction";
            } else {
                var projurl = base_url + "/update_transaction";
            }
            $.ajax({
                url: projurl,
                type: "POST",
                data: tranData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#addBankLoader").hide();
                    if (response.class == "succ") {
                        $("#addTranFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addTranFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    //End bank section

    //Start loan section
    var addLoanFrm = $("#addLoanFrm").validate({
        rules: {
            bank_name: {
                required: true,
            },
            branch: {
                required: true,
            },
            app_name: {
                required: true,
            },
            loan_ac_no: {
                required: true,
                number: true,
            },
            bank_code: {
                required: true,
            },
            credit_limit: {
                required: true,
                number: true,
            },
        },
        messages: {
            bank_name: {
                required: "Bank name is required",
            },
            branch: {
                required: "Branch is required",
            },
            app_name: {
                required: "Applicant name is required",
            },
            loan_ac_no: {
                required: "Loan a/c no. is required",
            },
            bank_code: {
                required: "Bank code is required",
            },
            credit_limit: {
                required: "Credit limit is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addLoanFrm").bind("submit", function () {
        //e.preventDefault();
        if (addLoanFrm.form()) {
            $("#addLoanLoader").show();
            var loanId = $("#loanId").val();
            if (loanId == "") {
                var projurl = base_url + "/save_loan";
            } else {
                var projurl = base_url + "/update_loan";
            }
            var projectData = $("form#addLoanFrm").serialize();

            $.ajax({
                url: projurl,
                type: "POST",
                data: projectData,
                success: function (response) {
                    $("#addLoanLoader").hide();
                    if (response.class == "succ") {
                        $("#addLoanFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addLoanFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var insDoc = $("form#addInsFrm #insDoc").val();
    if (insDoc == "") {
        var addInsFrm = $("#addInsFrm").validate({
            rules: {
                ins_date: {
                    required: true,
                },
                payment_mode: {
                    required: true,
                },
                ins_amt: {
                    required: true,
                    number: true,
                },
                curr_amt: {
                    required: true,
                    number: true,
                },
                message: {
                    required: true,
                },
                ins_doc: {
                    required: true,
                },
            },
            messages: {
                ins_date: {
                    required: "Date is required",
                },
                payment_mode: {
                    required: "Payment mode is required",
                },
                ins_amt: {
                    required: "Amount is required",
                },
                curr_amt: {
                    required: "Amount is required",
                },
                message: {
                    required: "Message is required",
                },
                ins_doc: {
                    required: "Document is required",
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    } else {
        var addInsFrm = $("#addInsFrm").validate({
            rules: {
                ins_date: {
                    required: true,
                },
                payment_mode: {
                    required: true,
                },
                ins_amt: {
                    required: true,
                    number: true,
                },
                curr_amt: {
                    required: true,
                    number: true,
                },
                message: {
                    required: true,
                },
            },
            messages: {
                ins_date: {
                    required: "Date is required",
                },
                payment_mode: {
                    required: "Payment mode is required",
                },
                ins_amt: {
                    required: "Amount is required",
                },
                curr_amt: {
                    required: "Amount is required",
                },
                message: {
                    required: "Message is required",
                },
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).addClass("has-success").removeClass("has-error");
            },
        });
    }

    $("form#addInsFrm").bind("submit", function () {
        //e.preventDefault();
        if (addInsFrm.form()) {
            $("#addLoanLoader").show();
            var insId = $("#insId").val();
            var loanId = $("#loanId").val();

            let ins_date = $("#addInsFrm #ins_date").val();
            let payment_mode = $("#addInsFrm #payment_mode").val();
            let ins_amt = $("#addInsFrm #ins_amt").val();
            let curr_amt = $("#addInsFrm #curr_amt").val();
            let message = $("#addInsFrm #message").val();
            let ins_doc = $("#addInsFrm #ins_doc").prop("files")[0];

            var insData = new FormData();
            insData.append("ins_date", ins_date);
            insData.append("payment_mode", payment_mode);
            insData.append("ins_amt", ins_amt);
            insData.append("curr_amt", curr_amt);
            insData.append("message", message);
            insData.append("ins_doc", ins_doc);
            insData.append("id", insId);
            insData.append("loanId", loanId);

            if (insId == "") {
                var projurl = base_url + "/save_installment";
            } else {
                var projurl = base_url + "/update_installment";
            }
            $.ajax({
                url: projurl,
                type: "POST",
                data: insData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#addLoanLoader").hide();
                    if (response.class == "succ") {
                        $("#addInsFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addInsFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".insDelete").click(function () {
        var insId = $(this).data("id");
        $("#del_installment").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delInstallment",
                data: { id: insId },
                success: function (data) {
                    window.location.href = data.redirect;
                },
            });
        });
    });
    //End loan section

    //Start for Cash Management
    var addCashCreditFrm = $("#addCashCreditFrm").validate({
        rules: {
            cd_date: {
                required: true,
            },
            particulars: {
                required: true,
            },
            cd_amount: {
                required: true,
                number: true,
            },
        },

        messages: {
            cd_date: {
                required: "Date is required",
            },
            particulars: {
                required: "Particulars is required",
            },
            cd_amount: {
                required: "Amount is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addCashCreditFrm").bind("submit", function () {
        if (addCashCreditFrm.form()) {
            $("#cashLoader").show();
            var cId = $("#cId").val();

            if (cId == "") {
                var surl = base_url + "/save_cash_credit";
            } else {
                var surl = base_url + "/update_cash_credit";
            }
            var cData = $("form#addCashCreditFrm").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: cData,
                success: function (response) {
                    $("#cashLoader").hide();
                    if (response.class == "succ") {
                        $("#addCashCreditFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addCashCreditFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    var addCashDebitFrm = $("#addCashDebitFrm").validate({
        rules: {
            cd_date: {
                required: true,
            },
            particulars: {
                required: true,
            },
            cd_amount: {
                required: true,
                number: true,
            },
        },

        messages: {
            cd_date: {
                required: "Date is required",
            },
            particulars: {
                required: "Particulars is required",
            },
            cd_amount: {
                required: "Amount is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addCashDebitFrm").bind("submit", function () {
        if (addCashDebitFrm.form()) {
            $("#cashLoader").show();
            var cId = $("#cId").val();

            if (cId == "") {
                var surl = base_url + "/save_cash_debit";
            } else {
                var surl = base_url + "/update_cash_debit";
            }
            var cData = $("form#addCashDebitFrm").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: cData,
                success: function (response) {
                    $("#cashLoader").hide();
                    if (response.class == "succ") {
                        $("#addCashDebitFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addCashDebitFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    //End for Cash Management
    //Start update cash in hand details
    var addCashHandFrm = $("#addCashHandFrm").validate({
        rules: {
            amount_in_hand: {
                required: true,
                number: true,
            },
        },
        messages: {
            amount_in_hand: {
                required: "Amount is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addCashHandFrm").bind("submit", function () {
        if (addCashHandFrm.form()) {
            $("#cashLoader").show();
            var formCashData = {
                amount_in_hand: $("#addCashHandFrm #amount_in_hand").val(),
            };
            $.ajax({
                url: base_url + "/update_cashinhand",
                type: "POST",
                data: formCashData,
                success: function (response) {
                    $("#cashLoader").hide();
                    if (response.class == "succ") {
                        window.location.href = response.redirect;
                        $("#addCashHandFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                    } else {
                        $.each(response, function (idx, obj) {
                            //alert(obj);
                            $("#addCashHandFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });
    //End update cash in hand details

    //Start Bank statement upload
    var bankStatementFrm = $("#bankStatementFrm").validate({
        rules: {
            bank_id: {
                required: true,
            },
            startdate: {
                required: true,
            },
            enddate: {
                required: true,
            },
            bankstatement: {
                required: true,
            },
        },
        messages: {
            bank_id: {
                required: "Bank is required",
            },
            startdate: {
                required: "Start date is required",
            },
            enddate: {
                required: "End date is required",
            },
            bankstatement: {
                required: "File is required",
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#bankStatementFrm").bind("submit", function () {
        if (bankStatementFrm.form()) {
            $("#bankStatLoader").show();
            let bank_id = $("#bankStatementFrm #bank_id option:selected").val();
            let startdate = $("#bankStatementFrm #startdate").val();
            let enddate = $("#bankStatementFrm #enddate").val();
            let bankstatement = $("#bankStatementFrm #bankstatement").prop(
                "files"
            )[0];

            let statementData = new FormData();

            statementData.append("bank_id", bank_id);
            statementData.append("startdate", startdate);
            statementData.append("enddate", enddate);
            statementData.append("bankstatement", bankstatement);
            $.ajax({
                url: base_url + "/uploadBank_statement",
                type: "POST",
                data: statementData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#bankStatLoader").hide();

                    if (response.class == "succ") {
                        $("#bankStatementFrm")[0].reset();
                        $("#bankStatementFrm .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#bankStatementFrm .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });
    //End Bank statement upload

    //Start for Liabilities
    var addFrmLiabilities = $("#addFrmLiabilities").validate({
        rules: {
            // liab_type: {
            // 	required: true
            // },
            // curr_amount: {
            // 	required: function(element) {
            // 		return $('input[name="liab_type"]:checked').val() === 'c_liabilities';
            // 	}
            // },
            // long_amount: {
            // 	required: function(element) {
            // 		return $('input[name="liab_type"]:checked').val() === 'long_liabilities';
            // 	}
            // },
            // liabilities: {
            // 	atLeastOneChecked: function() {
            // 		return $('input[name="liab_type"]:checked').val() === 'c_liabilities' ? 'input[name="liabilities"]' : false;
            // 	}
            // },
            // liabilities_long: {
            // 	atLeastOneChecked: function() {
            // 		return $('input[name="liab_type"]:checked').val() === 'long_liabilities' ? 'input[name="liabilities_long"]' : false;
            // 	}
            // }
        },
        messages: {
            // liab_type: {
            // 	required: "Please select a liability type."
            // },
            // curr_amount: {
            // 	required: "Please enter the amount for the selected current liability."
            // },
            // long_amount: {
            // 	required: "Please enter the amount for the selected long-term liability."
            // },
            // liabilities: {
            // 	atLeastOneChecked: "Please select at least one current liability."
            // },
            // liabilities_long: {
            // 	atLeastOneChecked: "Please select at least one long-term liability."
            // }
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("has-success").removeClass("has-error");
        },
    });

    $("form#addFrmLiabilities").bind("submit", function () {
        if (addFrmLiabilities.form()) {
            $("#liabLoader").show();
            var liabId = $("#liabId").val();
            if (liabId == "") {
                var surl = base_url + "/saveLiabilities";
            } else {
                var surl = base_url + "/updateLiabilities";
            }
            var liabData = $("form#addFrmLiabilities").serialize();
            $.ajax({
                url: surl,
                type: "POST",
                data: liabData,
                success: function (response) {
                    $("#liabLoader").hide();
                    if (response.class == "succ") {
                        $("#addFrmLiabilities .message-container").html(
                            '<div class="' +
                                response.class +
                                '">' +
                                response.message +
                                "</div>"
                        );
                        window.location.href = response.redirect;
                    } else {
                        $.each(response, function (idx, obj) {
                            $("#addFrmLiabilities .message-container").html(
                                '<div class="err">' + obj + "</div>"
                            );
                        });
                    }
                },
            });
        }
    });

    $(".liabdelete").click(function () {
        var itemId = $(this).data("id");
        $("#del_liab").click(function () {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: base_url + "/delLiabilities",
                data: { id: itemId },
                success: function (data) {
                    //console.log(data.success)
                    window.location.href = data.redirect;
                },
            });
        });
    });

    //End for Liabilities
});

//Start sales items
function delItem(el) {
    var salesItemId = "";
    var sid = "";
    salesItemId = $(el).data("id");
    sid = $(el).data("sid");
    var base_url = $("#base_url").val();
    $("#delItem").click(function () {
        $("form#addSalesFrmThree #invoiceData").html("");
        $.ajax({
            method: "POST",
            //dataType: "json",
            url: base_url + "/delSalesItem",
            data: { id: salesItemId, sid: sid },
            success: function (result) {
                $("form#addSalesFrmThree #invoiceData").html(result);
            },
        });
    });
}

function editItem(el) {
    var id = $(el).data("id");
    var base_url = $("#base_url").val();
    $("#editSalesLoader").show();
    $.ajax({
        method: "POST",
        url: base_url + "/fetchSalesItem",
        data: { id: id },
        datatype: "json",
        success: function (result) {
            $("#editSalesLoader").hide();
            var res = JSON.parse(result);
            res = res[id];
            //console.log(res.disc_sell);
            $("#prod_type").val(res.item_type);
            $("#prod_id").val(res.prod_id);
            $("#billing_type").val(res.billing_type);
            $("#prod_gov_fee").val(res.prod_gov_fee);
            if (res.hsn_code != "") {
                $("#hsn_sac_code").val(res.hsn_code);
            } else {
                $("#hsn_sac_code").val(res.sac_code);
            }
            $("#gst_rate").val(res.gst_rate);
            $("#gst_trans").val(res.gst_trans);
            $("#disc_sell").val(res.disc_sell);
            $("#disc_sell_type").val(res.disc_type);
        },
    });
}

function changeQuantity(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var prod_id = $(el).data("prod_id");
    var quantity = $("#quantity_" + id).val();
    var base_url = $("#base_url").val();

    $("form#addSalesFrmThree #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_sales_item_quantity",
        data: { id: id, sid: sid, prod_id: prod_id, quantity: quantity },
        success: function (result) {
            $("form#addSalesFrmThree #invoiceData").html(result);
        },
    });
}

function changeRate(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var rate = $("#rate_" + id).val();
    var base_url = $("#base_url").val();

    $("form#addSalesFrmThree #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_sales_item_rate",
        data: { id: id, sid: sid, rate: rate },
        success: function (result) {
            $("form#addSalesFrmThree #invoiceData").html(result);
        },
    });
}

//End sales items

//Start sales items credit debit
function delItemCreditDebit(el) {
    var salesItemId = "";
    var sid = "";
    salesItemId = $(el).data("id");
    sid = $(el).data("sid");
    var base_url = $("#base_url").val();
    $("#delItem").click(function () {
        $("form#salesCreditDebitFrmTwo #invoiceData").html("");
        $.ajax({
            method: "POST",
            //dataType: "json",
            url: base_url + "/delSalesItemCreditDebit",
            data: { id: salesItemId, sid: sid },
            success: function (result) {
                $("form#salesCreditDebitFrmTwo #invoiceData").html(result);
            },
        });
    });
}

function editItemCreditDebit(el) {
    var id = $(el).data("id");
    var rate = $(el).data("rate");
    var discamt = $(el).data("discamt");
    var taxtype = $(el).data("taxtype");
    $("#sItemId").val(id);
    $("#rateEdit").val(rate);
    $("#disc_amt_edit").val(discamt);
    $("#tax_type_edit").val(taxtype);
}

function changeQuantityCreditDebit(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var prod_id = $(el).data("prod_id");
    var quantity = $("#quantity_" + id).val();
    var base_url = $("#base_url").val();

    $("form#salesCreditDebitFrmTwo #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_sales_item_quantity_creditdebit",
        data: { id: id, sid: sid, prod_id: prod_id, quantity: quantity },
        success: function (result) {
            $("form#salesCreditDebitFrmTwo #invoiceData").html(result);
        },
    });
}

function changeRateCreditDebit(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var rate = $("#rate_" + id).val();
    var base_url = $("#base_url").val();

    $("form#salesCreditDebitFrmTwo #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_sales_item_rate_creditdebit",
        data: { id: id, sid: sid, rate: rate },
        success: function (result) {
            $("form#salesCreditDebitFrmTwo #invoiceData").html(result);
        },
    });
}

//End sales items credit debit

//Start purchase items
function delItemPurchase(el) {
    var salesItemId = "";
    var sid = "";
    salesItemId = $(el).data("id");
    sid = $(el).data("sid");
    var base_url = $("#base_url").val();
    $("#delItemPurchase").click(function () {
        $("form#addPurchaseFrmThree #invoiceData").html("");
        $.ajax({
            method: "POST",
            //dataType: "json",
            url: base_url + "/delPurchaseItem",
            data: { id: salesItemId, sid: sid },
            success: function (result) {
                $("form#addPurchaseFrmThree #invoiceData").html(result);
            },
        });
    });
}

function editItemPurchase(el) {
    var id = $(el).data("id");
    var base_url = $("#base_url").val();
    $("#editSalesLoader").show();
    $.ajax({
        method: "POST",
        url: base_url + "/fetchPurchaseItem",
        data: { id: id },
        datatype: "json",
        success: function (result) {
            $("#editSalesLoader").hide();
            var res = JSON.parse(result);
            res = res[id];
            //console.log(res.disc_sell);
            $("#prod_type").val(res.item_type);
            $("#prod_id").val(res.prod_id);
            $("#billing_type").val(res.billing_type);
            if (res.hsn_code != "") {
                $("#hsn_sac_code").val(res.hsn_code);
            } else {
                $("#hsn_sac_code").val(res.sac_code);
            }
            $("#gst_rate").val(res.gst_rate);
            $("#gst_trans").val(res.gst_trans);
            $("#disc_sell").val(res.disc_sell);
            $("#disc_sell_type").val(res.disc_type);

            // Billing Type
            var selectedOption = $("#billing_type option:selected").val();
            const billingInputRow = document.getElementById(
                "purchase_billing_input"
            );
            if (selectedOption === "with gst") {
                billingInputRow.style.display = "flex";
            } else {
                billingInputRow.style.display = "none";
            }
        },
    });
}

function changeQuantityPurchase(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var prod_id = $(el).data("prod_id");
    var quantity = $("#quantity_" + id).val();
    var base_url = $("#base_url").val();

    $("form#addPurchaseFrmThree #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_purchase_item_quantity",
        data: { id: id, sid: sid, prod_id: prod_id, quantity: quantity },
        success: function (result) {
            $("form#addPurchaseFrmThree #invoiceData").html(result);
        },
    });
}

function changeRatePurchase(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var rate = $("#rate_" + id).val();
    var base_url = $("#base_url").val();

    $("form#addPurchaseFrmThree #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_purchase_item_rate",
        data: { id: id, sid: sid, rate: rate },
        success: function (result) {
            $("form#addPurchaseFrmThree #invoiceData").html(result);
        },
    });
}
//End purchase items

//Start purchase items credit debit
function delItemPurchaseCreditDebit(el) {
    var salesItemId = "";
    var sid = "";
    salesItemId = $(el).data("id");
    sid = $(el).data("sid");
    var base_url = $("#base_url").val();
    $("#delItemPurchase").click(function () {
        $("form#purchaseCreditDebitFrmTwo #invoiceData").html("");
        $.ajax({
            method: "POST",
            //dataType: "json",
            url: base_url + "/delPurchaseItemCreditDebit",
            data: { id: salesItemId, sid: sid },
            success: function (result) {
                $("form#purchaseCreditDebitFrmTwo #invoiceData").html(result);
            },
        });
    });
}

function editItemPurchaseCreditDebit(el) {
    var id = $(el).data("id");
    var rate = $(el).data("rate");
    var discamt = $(el).data("discamt");
    var taxtype = $(el).data("taxtype");
    $("#sItemId").val(id);
    $("#rateEdit").val(rate);
    $("#disc_amt_edit").val(discamt);
    $("#tax_type_edit").val(taxtype);
}

function changeQuantityPurchaseCreditDebit(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var prod_id = $(el).data("prod_id");
    var quantity = $("#quantity_" + id).val();
    var base_url = $("#base_url").val();

    $("form#purchaseCreditDebitFrmTwo #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_purchase_item_quantity_creditdebit",
        data: { id: id, sid: sid, prod_id: prod_id, quantity: quantity },
        success: function (result) {
            $("form#purchaseCreditDebitFrmTwo #invoiceData").html(result);
        },
    });
}

function changeRatePurchaseCreditDebit(el) {
    var id = $(el).data("id");
    var sid = $(el).data("sid");
    var rate = $("#rate_" + id).val();
    var base_url = $("#base_url").val();

    $("form#purchaseCreditDebitFrmTwo #invoiceData").html("");
    $.ajax({
        method: "POST",
        //dataType: "json",
        url: base_url + "/update_purchase_item_rate_creditdebit",
        data: { id: id, sid: sid, rate: rate },
        success: function (result) {
            $("form#purchaseCreditDebitFrmTwo #invoiceData").html(result);
        },
    });
}
//End purchase items credit debit

//start for expense
function getExpenseOptions(el) {
    var base_url = $("#base_url").val();
    var id = el.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getExpenseOptions?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#expense_type").empty();
            var str = '<option value="">Select</option>';
            $.each(data, function (idx, item) {
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#expense_type").html(str);
        },
    });
}
//End for expense

//start for payment type
function getPaymentOptions(el) {
    var base_url = $("#base_url").val();
    var id = el.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getPaymentOptions?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#payment_type_opt").empty();
            var str = '<option value="">Select</option>';
            $.each(data, function (idx, item) {
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#payment_type_opt").html(str);
        },
    });
}
//End for payment type

function assign_ca(el) {
    var base_url = $("#base_url").val();
    var btn = $(this);
    btn.prop("disabled", true);
    var id = el.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    const that = this;
    var ca_id = $(el).data("id");
    var ca_assign_status = $(el).data("status");
    var dynamicId = "request_for" + ca_id;
    var request_for = document.getElementById(dynamicId).value;
    if (!request_for) {
        alert("Request For field is required.");
        return;
    }

    if (ca_assign_status == 1) {
        ca_assign_status = 0;
    } else {
        ca_assign_status = 1;
    }

    if (ca_id > 0) {
        $.ajax({
            url: base_url + "/assign_ca",
            type: "POST",
            data: {
                ca_id: ca_id,
                ca_assign_status: ca_assign_status,
                set_permission: "",
                request_for: request_for,
            },
            success: function (response) {
                btn.prop("disabled", false);
                if (response.class == "succ") {
                    $("#loader").hide();
                    if (response.ca_assign_status == 1) {
                        $(el).find("span").text("Un-Assign");
                    } else {
                        $(el).find("span").text("Assign");
                    }
                    $(el).data("status", response.ca_assign_status);
                    $("#searchca .message-container").html(
                        '<div class="' +
                            response.class +
                            '">' +
                            response.message +
                            "</div>"
                    );
                } else {
                    $("#loader").hide();
                    $.each(response, function (idx, obj) {
                        $("#searchca .message-container").html(
                            '<div class="err">' + obj + "</div>"
                        );
                    });
                }
            },
        });
    }
}

function show_ca_permission(el) {
    var base_url = $("#base_url").val();
    var id = $(el).data("id");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#permissionDiv").html("");
    if (id > 0) {
        $.ajax({
            url: base_url + "/get_ca_set_permission",
            type: "POST",
            data: { id: id },
            success: function (res) {
                $("#permissionDiv").html(res);
            },
        });
    }
}

function changeCountry(el) {
    var base_url = $("#base_url").val();
    var id = el.value;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getState?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#state").empty();
            $("#city").empty();
            var str = '<option value="">Select State</option>';
            $.each(data, function (idx, item) {
                //$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#state").html(str);
        },
    });
}

function changeState(el) {
    var base_url = $("#base_url").val();
    var id = el.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getCity?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#city").empty();
            var str = '<option value="">Select City</option>';
            $.each(data, function (idx, item) {
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#city").html(str);
        },
    });
}

function changeCountry_ship(el) {
    var base_url = $("#base_url").val();
    var id = el.value;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getState?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#state_ship").empty();
            $("#city_ship").empty();
            var str = '<option value="">Select State</option>';
            $.each(data, function (idx, item) {
                //$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#state_ship").html(str);
        },
    });
}

function changeState_ship(el) {
    var base_url = $("#base_url").val();
    var id = el.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getCity?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#city_ship").empty();
            var str = '<option value="">Select City</option>';
            $.each(data, function (idx, item) {
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#city_ship").html(str);
        },
    });
}

function inv_bill_cust_changeCountry(el) {
    var base_url = $("#base_url").val();
    var id = el.value;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getState?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#cust_bill_state").empty();
            $("#cust_bill_city").empty();
            var str = '<option value="">Select State</option>';
            $.each(data, function (idx, item) {
                //$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#cust_bill_state").html(str);
        },
    });
}

function inv_bill_cust_changeState(el) {
    var base_url = $("#base_url").val();
    var id = el.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getCity?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#cust_bill_city").empty();
            var str = '<option value="">Select City</option>';
            $.each(data, function (idx, item) {
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#cust_bill_city").html(str);
        },
    });
}

function cust_ship_changeCountry_ship(el) {
    var base_url = $("#base_url").val();
    var id = el.value;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getState?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#cust_ship_state").empty();
            $("#cust_ship_city").empty();
            var str = '<option value="">Select State</option>';
            $.each(data, function (idx, item) {
                //$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#cust_ship_state").html(str);
        },
    });
}

function cust_ship_changeState_ship(el) {
    var base_url = $("#base_url").val();
    var id = el.value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: base_url + "/getCity?" + id,
        dataType: "json",
        //type: "post",
        data: { id: id },
        success: function (data) {
            $("#cust_ship_city").empty();
            var str = '<option value="">Select City</option>';
            $.each(data, function (idx, item) {
                str +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.name +
                    "</option>";
            });
            $("#cust_ship_city").html(str);
        },
    });
}

function tally_credit_debit(el) {
    var base_url = $("#base_url").val();
    var id = $(el).data("id");
    var type = $(el).data("type");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    if (id > 0) {
        $.ajax({
            url: base_url + "/tally_credit_debit",
            type: "POST",
            data: { id: id, type: type },
            dataType: "html",
            success: function (res) {
                $("#DesPopUp").modal("show");
                var table = $("#tblgrid");
                table.html(res);
            },
        });
    }
}

function changeCustomer() {
    var base_url = $("#base_url").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var invcustId = $("#invNameCustomer option:selected").val();
    var salesTableID = $("#sId").val();
    //alert(salesTableID);

    if (invcustId != "") {
        $.ajax({
            url: base_url + "/getinvcust?" + invcustId,
            dataType: "json",
            //type: "post",
            data: { id: invcustId, salesTableID: salesTableID },
            success: function (data) {
                // console.log(data);
                // alert(data);

                $("#contact_no").val(data.cust_phone);
                $("#cust_email").val(data.cust_email);
                $("#gst_reg").val(data.gst_reg);
                $("#cust_gst_no").val(data.cust_gst_no);
                $("#cust_pan").val(data.cust_pan);
                $("#comp_type").val(data.comp_type);
                $("#cust_gst_type").val(data.cust_gst_type);
                $("#bill_name").val(data.cust_bill_name);
                $("#bill_addone").val(data.cust_bill_addone);
                $("#bill_addtwo").val(data.cust_bill_addtwo);
                $("#cust_bill_country")
                    .val(data.cust_bill_country)
                    .attr("selected", "selected");
                $("#cust_bill_state").empty();
                var stateBillOpt = '<option value="">Select State</option>';
                $.each(data.stateBill, function (idx, item) {
                    if (item.id == item.sid) {
                        stateBillOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        stateBillOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_bill_state").html(stateBillOpt);
                $("#cust_bill_city").empty();
                var cityBillOpt = '<option value="">Select City</option>';
                $.each(data.cityBill, function (idx, item) {
                    if (item.id == item.sid) {
                        cityBillOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        cityBillOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_bill_city").html(cityBillOpt);
                $("#cust_bill_pin").val(data.cust_bill_pin);

                //Ship section
                //$("#ship_name").val(data.cust_ship_name);
                $("#cust_ship_addone").val(data.cust_ship_addone);
                $("#cust_ship_addtwo").val(data.cust_ship_addtwo);
                $("#cust_ship_country")
                    .val(data.cust_ship_country)
                    .attr("selected", "selected");
                $("#cust_ship_state").empty();
                var stateShipOpt = '<option value="">Select State</option>';
                $.each(data.stateShip, function (idx, item) {
                    if (item.id == item.selid) {
                        stateShipOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        stateShipOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_ship_state").html(stateShipOpt);
                $("#cust_ship_city").empty();
                var cityShipOpt = '<option value="">Select City</option>';
                $.each(data.cityShip, function (idx, item) {
                    if (item.id == item.selid) {
                        cityShipOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        cityShipOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_ship_city").html(cityShipOpt);
                $("#cust_ship_pin").val(data.cust_ship_pin);

                $("#cust_bill_gstno").val(data.cust_bill_gstno);
                $("#cont_person").val(data.cust_bill_contact);
                $("#contact_name").val(data.cust_bill_contact);

                $("#cont_person_no").val(data.cust_bill_mobilno);
                $("#cust_bill_designa").val(data.cust_bill_designa);
                $("#cust_bill_name").val(data.cust_bill_name);
                $("#cust_bill_addtwo").val(data.cust_bill_addtwo);

                $("#cust_ship_gstno").val(data.cust_ship_gstno);
                $("#cust_ship_contact").val(data.cust_ship_contact);
                $("#cust_ship_mobilno").val(data.cust_ship_mobilno);
                $("#cust_ship_designa").val(data.cust_ship_designa);
                $("#cust_ship_name").val(data.cust_ship_name);

                // $("#cust_ship_addone").val(data.cust_ship_addone);
                // $("#cust_ship_addtwo").val(data.cust_ship_addtwo);
            },
        });
    } else {
        $("#contact_no").val("");
        $("#cust_email").val("");
        $("#cust_pan").val("");
        $("#cust_gst_no").val("");
        $("#cust_name").val("");

        $("#cust_bill_addone").val("");
        $("#cust_bill_addtwo").val("");
        $("#cust_bill_state").empty();
        $("#cust_bill_city").empty();
        $("#cust_bill_pin").val("");

        $("#cust_bill_gstno").val("");
        $("#cont_person").val("");
        $("#cont_person_no").val("");
        $("#cust_bill_designa").val("");
        $("#cust_bill_name").val("");
        $("#bill_addone").val("");
        $("#bill_addtwo").val("");

        $("#cust_ship_addone").val("");
        $("#cust_ship_addtwo").val("");
        $("#cust_ship_state").empty();
        $("#cust_ship_city").empty();
        $("#cust_ship_pin").val("");

        $("#cust_ship_gstno").val("");
        $("#cust_ship_contact").val("");
        $("#cust_ship_mobilno").val("");
        $("#cust_ship_designa").val("");
        $("#cust_ship_name").val("");
    }
}
function changeCustomer_purchase() {
    var base_url = $("#base_url").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var invcustId = $("#invNameCustomer option:selected").val();
    var salesTableID = $("#sId").val();
    //alert(salesTableID);

    if (invcustId != "") {
        $.ajax({
            url: base_url + "/getinvcust_purchase?" + invcustId,
            dataType: "json",
            //type: "post",
            data: { id: invcustId, salesTableID: salesTableID },
            success: function (data) {
                //console.log(data);
                //alert(data);

                $("#contact_no").val(data.cust_phone);
                $("#cust_email").val(data.cust_email);
                $("#gst_reg").val(data.gst_reg);
                $("#cust_gst_no").val(data.cust_gst_no);
                $("#cust_pan").val(data.cust_pan);
                $("#comp_type").val(data.comp_type);
                $("#cust_gst_type").val(data.cust_gst_type);
                $("#bill_name").val(data.cust_bill_name);
                $("#bill_addone").val(data.cust_bill_addone);
                $("#bill_addtwo").val(data.cust_bill_addtwo);
                $("#cust_bill_country")
                    .val(data.cust_bill_country)
                    .attr("selected", "selected");
                $("#cust_bill_state").empty();
                var stateBillOpt = '<option value="">Select State</option>';
                $.each(data.stateBill, function (idx, item) {
                    if (item.id == item.sid) {
                        stateBillOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        stateBillOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_bill_state").html(stateBillOpt);
                $("#cust_bill_city").empty();
                var cityBillOpt = '<option value="">Select City</option>';
                $.each(data.cityBill, function (idx, item) {
                    if (item.id == item.sid) {
                        cityBillOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        cityBillOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_bill_city").html(cityBillOpt);
                $("#cust_bill_pin").val(data.cust_bill_pin);

                //Ship section
                //$("#ship_name").val(data.cust_ship_name);
                $("#cust_ship_addone").val(data.cust_ship_addone);
                $("#cust_ship_addtwo").val(data.cust_ship_addtwo);
                $("#cust_ship_country")
                    .val(data.cust_ship_country)
                    .attr("selected", "selected");
                $("#cust_ship_state").empty();
                var stateShipOpt = '<option value="">Select State</option>';
                $.each(data.stateShip, function (idx, item) {
                    if (item.id == item.selid) {
                        stateShipOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        stateShipOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_ship_state").html(stateShipOpt);
                $("#cust_ship_city").empty();
                var cityShipOpt = '<option value="">Select City</option>';
                $.each(data.cityShip, function (idx, item) {
                    if (item.id == item.selid) {
                        cityShipOpt +=
                            '<option value="' +
                            item.id +
                            '" selected="">' +
                            item.name +
                            "</option>";
                    } else {
                        cityShipOpt +=
                            '<option value="' +
                            item.id +
                            '" >' +
                            item.name +
                            "</option>";
                    }
                });
                $("#cust_ship_city").html(cityShipOpt);
                $("#cust_ship_pin").val(data.cust_ship_pin);

                $("#cust_bill_gstno").val(data.cust_bill_gstno);
                $("#cust_bill_contact").val(data.cust_bill_contact);
                //$("#contact_name").val(data.cust_bill_contact);

                $("#cust_bill_mobilno").val(data.cust_bill_mobilno);
                $("#cust_bill_designa").val(data.cust_bill_designa);
                $("#cust_bill_name").val(data.cust_bill_name);
                $("#cust_bill_addtwo").val(data.cust_bill_addtwo);

                $("#cust_ship_gstno").val(data.cust_ship_gstno);
                $("#cust_ship_contact").val(data.cust_ship_contact);
                $("#cust_ship_mobilno").val(data.cust_ship_mobilno);
                $("#cust_ship_designa").val(data.cust_ship_designa);
                $("#cust_ship_name").val(data.cust_ship_name);

                // $("#cust_ship_addone").val(data.cust_ship_addone);
                // $("#cust_ship_addtwo").val(data.cust_ship_addtwo);
            },
        });
    } else {
        $("#contact_no").val("");
        $("#cust_email").val("");
        $("#cust_pan").val("");
        $("#cust_gst_no").val("");
        $("#cust_name").val("");

        $("#cust_bill_addone").val("");
        $("#cust_bill_addtwo").val("");
        $("#cust_bill_state").empty();
        $("#cust_bill_city").empty();
        $("#cust_bill_pin").val("");

        $("#cust_bill_gstno").val("");
        $("#cont_person").val("");
        $("#cont_person_no").val("");
        $("#cust_bill_designa").val("");
        $("#cust_bill_name").val("");
        $("#bill_addone").val("");
        $("#bill_addtwo").val("");

        $("#cust_ship_addone").val("");
        $("#cust_ship_addtwo").val("");
        $("#cust_ship_state").empty();
        $("#cust_ship_city").empty();
        $("#cust_ship_pin").val("");

        $("#cust_ship_gstno").val("");
        $("#cust_ship_contact").val("");
        $("#cust_ship_mobilno").val("");
        $("#cust_ship_designa").val("");
        $("#cust_ship_name").val("");
    }
}

function changeProductType() {
    var base_url = $("#base_url").val();
    var id = $("#prod_type option:selected").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    if (id != "") {
        $.ajax({
            url: base_url + "/getProductType",
            dataType: "json",
            type: "post",
            data: { id: id },
            success: function (data) {
                $("#prod_id").empty();
                var str = '<option value="">Select</option>';
                $.each(data, function (idx, item) {
                    //$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
                    str +=
                        '<option value="' +
                        item.id +
                        '">' +
                        item.name +
                        "</option>";
                });
                $("#prod_id").html(str);
            },
        });
    } else {
        $("#prod_id").html("");
        $("#hsn_sac_code").val("");
        $("#disc_sell").val(0);
        $("#prod_gov_fee").val(0);
        $("#billing_type").prop("selectedIndex", 0);
        $("#gst_trans").prop("selectedIndex", 0);
        $("#disc_sell_type").prop("selectedIndex", 0);
    }
}

function addAnotherProduct() {
    $("#prod_type").prop("selectedIndex", 0);
    $("#prod_id").prop("selectedIndex", 0);
    $("#hsn_sac_code").val("");
    $("#disc_sell").val(0);
    $("#prod_gov_fee").val(0);
    $("#gst_rate").val(0);
    $("#billing_type").prop("selectedIndex", 0);
    $("#gst_trans").prop("selectedIndex", 0);
    $("#disc_sell_type").prop("selectedIndex", 0);
}

function addProductItems() {
    var base_url = $("#base_url").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var prod_id = $("#prod_id option:selected").val();
    var billing_type = $("#billing_type option:selected").val();
    var prod_gov_fee = $("#prod_gov_fee").val();
    var gst_trans = $("#gst_trans option:selected").val();
    var disc_sell = $("#disc_sell").val();
    var disc_sell_type = $("#disc_sell_type option:selected").val();
    var sId = $("#sId").val();
    if (prod_id == "") {
        alert("Please select product");
    } else if (prod_id == undefined) {
        alert("Please select product");
    } else if (billing_type == "") {
        alert("Please select billing type");
    } else if (billing_type == "gov" && prod_gov_fee == "") {
        alert("Please enter fees");
    } else {
    /*else if(gst_trans == ""){
			alert("Please select GST transaction mode");
		}*/
        $("#invoiceData").html("");
        $.ajax({
            method: "POST",
            url: base_url + "/sales_items_display",
            data: {
                sId: sId,
                prod_id: prod_id,
                billing_type: billing_type,
                prod_gov_fee: prod_gov_fee,
                gst_trans: gst_trans,
                disc_sell: disc_sell,
                disc_sell_type: disc_sell_type,
            },
            datatype: "json",
            success: function (result) {
                //console.log(result)
                $("#invoiceData").html(result);
            },
        });
    }
}

function addProductItems_purchase() {
    var base_url = $("#base_url").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var prod_id = $("#prod_id option:selected").val();
    var billing_type = $("#billing_type option:selected").val();
    var gst_rate = $("#gst_rate").val();
    var gst_trans = $("#gst_trans option:selected").val();
    var disc_sell = $("#disc_sell").val();
    var disc_sell_type = $("#disc_sell_type option:selected").val();
    var sId = $("#sId").val();
    if (prod_id == "") {
        alert("Please select product");
    } else if (prod_id == undefined) {
        alert("Please select product");
    } else if (billing_type == "") {
        alert("Please select billing type");
    } else if (billing_type == "with gst" && gst_trans == "") {
        alert("Please select GST transaction mode");
    } else {
        $("#invoiceData").html("");
        $.ajax({
            method: "POST",
            url: base_url + "/purchase_items_display",
            data: {
                sId: sId,
                prod_id: prod_id,
                billing_type: billing_type,
                gst_rate: gst_rate,
                gst_trans: gst_trans,
                disc_sell: disc_sell,
                disc_sell_type: disc_sell_type,
            },
            datatype: "json",
            success: function (result) {
                //console.log(result)
                $("#invoiceData").html(result);
            },
        });
    }
}

function planChangeCheckbox() {
    var base_url = $("#base_url").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var chkVal = $("#planChkbox").is(":checked");
    var plan_type = "Monthly";
    if (chkVal == true) {
        plan_type = "Monthly";
    } else {
        plan_type = "Yearly";
    }
    $("#planHtml").html("");
    $.ajax({
        method: "POST",
        url: base_url + "/ajax_show_plan",
        data: { plan_type: plan_type },
        datatype: "json",
        success: function (result) {
            //console.log(result)
            $("#planHtml").html(result);
        },
    });
}

//Add more bank
$(document).ready(function () {
    var i = 1;
    var n = -1;
    var num = 100;

    // $("body").on("click",".AddMore",function(){

    // 	var i = $('.containerVariant').length + 1;
    // 	$('.containerVariant').first().clone().find("select").attr('name', function(idx, attrVal) {
    // 		//return attrVal+'['+i+']'; // change the name
    // 		var name;
    // 		name = $(this).attr('name');
    // 		name = name.replace(/\[[0-9]+\]/g, '['+i+']');
    // 		$(this).attr('name',name);
    // 	}).end().insertBefore(this).append( $('<button type="button" name="remove" id="'+i+'" class="btn btn-sm btn-outline-danger btn_remove py-1 mb-2">X</button>') );

    // });

	$('#GetIncomeFormSubmit').click(function() {
		// Get selected radio button value
		var incomeType = $('input[name="inlineRadioOptions"]:checked').val();
		var fromDate = $('#from_date').val();
		var toDate = $('#to_date').val();
		var base_url = $("#base_url").val();

		var requestData = {
			incomeType: incomeType,
			fromDate: fromDate,
			toDate: toDate
		};

		$.ajax({
            url: base_url + "/GetIncomeData", 
            method: 'POST', 
            data: requestData, 
            success: function(response) {
                // Handle the successful response
                // alert('Income: ' + response.income); 
                // console.log(response.income); 
                
                $('#totalAmount').html('₹'+ response.income);
                $('#invoiceType').html( response.incomeType );
				
            },
            error: function(xhr, status, error) {
                // Handle any errors that occurred
                alert('An error occurred: ' + xhr.responseText);
            }
        });
	});

    $("body").on("click", ".AddMore", function () {
        var i = $(".containerVariant").length + 1;
        var clonedContainer = $(".containerVariant").first().clone();
        clonedContainer.find("input[type='text']").val("");
        clonedContainer.find("select").attr("name", function (idx, attrVal) {
            var name = attrVal.replace(/\[[0-9]+\]/g, "[" + i + "]");
            return name;
        });

        clonedContainer
            .insertBefore(this)
            .append(
                $(
                    '<button type="button" name="remove" id="' +
                        i +
                        '" class="btn btn-sm btn-outline-danger btn_remove py-1 mb-2">X</button>'
                )
            );
    });

    $("body").on("click", ".btn_remove", function () {
        $(this).parents(".containerVariant").remove();
    });

    $("body").on("click", ".AddMorePartner", function () {
        var i = $(".containerPartner").length + 1;
        $(".containerPartner")
            .first()
            .clone()
            .find("select")
            .attr("name", function (idx, attrVal) {
                //return attrVal+'['+i+']'; // change the name
                var name;
                name = $(this).attr("name");
                name = name.replace(/\[[0-9]+\]/g, "[" + i + "]");
                $(this).attr("name", name);
            })
            .end()
            .insertBefore(this)
            .append(
                $(
                    '<button type="button" name="remove" id="' +
                        i +
                        '" class="btn btn-sm btn-outline-danger btn_remove_partner py-1 mb-2">X</button>'
                )
            );
    });

    $("body").on("click", ".btn_remove_partner", function () {
        $(this).parents(".containerPartner").remove();
    });

    //---------- Dashboaed auto month selected ------
    var monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    var currentMonth = new Date().getMonth();
    var selectElement = document.getElementById("total_receivales");
    var selectElementPayables = document.getElementById("total_payables");

    selectElement.value = monthNames[currentMonth];
    selectElementPayables.value = monthNames[currentMonth];

    //----------- Dashboard Get Financial -------
    function populateFinancialYearSelect() {
        var selectElement = $("#select_financial_year");

        // Get the current year and month
        var currentYear = new Date().getFullYear();
        var currentMonth = new Date().getMonth() + 1;

        // Determine the current financial year
        var currentFinancialYear;
        if (currentMonth >= 4) {
            // Financial year starts in April
            currentFinancialYear = currentYear + "-" + (currentYear + 1);
        } else {
            currentFinancialYear = currentYear - 1 + "-" + currentYear;
        }

        // Add financial years starting from 2022 to the current financial year
        for (var year = 2022; year <= currentYear; year++) {
            var financialYear = year + "-" + (year + 1);
            selectElement.append(
                '<option value="' +
                    financialYear +
                    '">FY ' +
                    financialYear +
                    "</option>"
            );
        }
        selectElement.val(currentFinancialYear);
    }
    // Call the function when the document is ready
    populateFinancialYearSelect(); //-------Select financial year --------

    //----------------- Bank Details for Dashboard ------
    function fetchBankDetails(bankId, Get_financial_year) {
        var base_url = $("#base_url").val();

        if (bankId) {
            $.ajax({
                url: base_url + "/get-bank-details",
                type: "GET",
                data: { id: bankId, Get_financial_year: Get_financial_year },
                success: function (response) {
                    //console.log(response);

                    $("#bank_name").text(response.bank_name);
                    $("#bank_ac_no").text(response.bank_ac_no);
                    $("#accholder_name").text(response.accholder_name);
                    $("#ifsc_code").text(response.ifsc_code);
                    $("#bank_branch").text(response.bank_branch);
                    $("#swift_code").text(response.swift_code);

                    $("#total_balance").text(
                        response.credit_debits.total_balance
                    );
                    $("#total_received").text(
                        response.credit_debits.total_credit
                    );
                    $("#total_expenses").text(
                        response.credit_debits.total_debit
                    );
                    $("#total_lone").text(response.total_loan);
                },
                error: function () {
                    //alert('Failed to fetch bank details');
                },
            });
        }
    }

    // Event listener for when the dropdown selection changes
    $("#cust_bank_id").change(function () {
        var bankId = $(this).val();
        var Get_financial_year = $("#select_financial_year").val();

        fetchBankDetails(bankId, Get_financial_year);
    });

    // Fetch details for the default selected bank on page load
    var defaultBankId = $("#cust_bank_id").val();
    var Get_financial_year = $("#select_financial_year").val();
    fetchBankDetails(defaultBankId, Get_financial_year);

    var columnChart;

    function fetchMonthlyData(financial_year) {
        var base_url = $("#base_url").val();

        // Clear previous data
        $("#total_rec").html(
            '<i class="fa-solid fa-indian-rupee-sign me-1"></i>0/-'
        );
        $("#total_exp").html(
            '<i class="fa-solid fa-indian-rupee-sign me-1"></i>0/-'
        );

        // Destroy existing chart if it exists
        if (columnChart) {
            columnChart.destroy();
        }

        $.ajax({
            url: base_url + "/get-monthly-data",
            type: "GET",
            data: { financial_year: financial_year },
            success: function (response) {
                var receivedData = response.received;
                var expensesData = response.expenses;

                // Update the total receipts and expenses
                $("#total_rec").html(
                    '<i class="fa-solid fa-indian-rupee-sign me-1"></i>' +
                        response.total_receipts +
                        "/-"
                );
                $("#total_exp").html(
                    '<i class="fa-solid fa-indian-rupee-sign me-1"></i>' +
                        response.total_expenses +
                        "/-"
                );

                if ($("#sales_chart").length > 0) {
                    // Create new chart
                    var columnConfig = {
                        colors: ["#22cc62", "#ff0000"],
                        series: [
                            {
                                name: "Received",
                                type: "column",
                                data: receivedData,
                            },
                            {
                                name: "Expenses",
                                type: "column",
                                data: expensesData,
                            },
                        ],
                        chart: {
                            type: "bar",
                            fontFamily: "Poppins, sans-serif",
                            height: 365,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: "60%",
                                endingShape: "rounded",
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        xaxis: {
                            categories: [
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sep",
                                "Oct",
                                "Nov",
                                "Dec",
                                "Jan",
                                "Feb",
                                "Mar",
                            ],
                        },
                        yaxis: {
                            title: {
                                text: "₹ (thousands)",
                            },
                        },
                        fill: {
                            opacity: 1,
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "₹ " + val + " thousands";
                                },
                            },
                        },
                    };

                    // Create and render the new chart
                    columnChart = new ApexCharts(
                        document.getElementById("sales_chart"),
                        columnConfig
                    );
                    columnChart.render();
                }
            },
            error: function () {
                // Handle error
            },
        });
    }

    //---------- Statutory data ---------

    function fetchStatutoryData(financial_year) {
        var base_url = $("#base_url").val();
        $.ajax({
            url: base_url + "/get-Statutory-data",
            type: "GET",
            data: { financial_year: financial_year },
            success: function (response) {
                //console.log(response);

                // Clear the existing table body
                $("#statutoryTableBody").empty();

                // Check if 'received' array has data
                if (response.received && response.received.length > 0) {
                    response.received.forEach((statutory, index) => {
                        // Create a new row for each statutory data
                        let row = `
								<tr>
									<td>${index + 1}</td>
									<td>
										${
                                            statutory.comp_name
                                                ? statutory.comp_name +
                                                  " / " +
                                                  statutory.statutory_doc
                                                : statutory.statutory_doc
                                        }
									</td>
									<td>${moment(statutory.statutory_due_date).format("DD MMM YYYY, hh:mm A")}</td>
									<td>
										${
                                            statutory.status === 1
                                                ? '<span class="badge bg-success-light">Complete</span>'
                                                : statutory.status === 2
                                                ? '<span class="badge bg-warning-light text-warning">Ongoing</span>'
                                                : '<span class="badge bg-danger-light text-danger">Pending</span>'
                                        }
									</td>
								</tr>
							`;
                        $("#statutoryTableBody").append(row); // Append the new row to the table body
                    });
                } else {
                    // If no data, show a message
                    $("#statutoryTableBody").append(
                        '<tr><td colspan="4" class="text-center">No records found</td></tr>'
                    );
                }
            },
            error: function (er) {
                console.log(er);
                // Handle error
            },
        });
    }

    //----------- Customers and Gst Summary ----------------

    function GetCustomerCount(financial_year) {
        var base_url = $("#base_url").val();
        $.ajax({
            url: base_url + "/get-customer-data",
            type: "GET",
            data: { financial_year: financial_year },
            success: function (response) {
                //console.log(response);
                $("#customer_no").text(response.total_customers);
                var percentageChange = response.percentage_change;
                var arrowHtml = "";

                if (percentageChange > 0) {
                    arrowHtml = `<i class="fas fa-arrow-up me-1"></i>${percentageChange}%`;
                    $("#Last_per")
                        .removeClass("text-danger")
                        .addClass("text-success")
                        .html(arrowHtml);
                } else if (percentageChange < 0) {
                    arrowHtml = `<i class="fas fa-arrow-down me-1"></i>${Math.abs(
                        percentageChange
                    )}%`;
                    $("#Last_per")
                        .removeClass("text-success")
                        .addClass("text-danger")
                        .html(arrowHtml);
                } else {
                    // If the percentage change is 0, don't show any arrow
                    $("#Last_per")
                        .removeClass("text-success text-danger")
                        .text("0%");
                }
            },
            error: function (er) {
                console.log(er);
                // Handle error
            },
        });
    }

    //------------ get Turnover By Month ------------
    if ($("#s-line").length > 0) {
        var sline = {
            chart: {
                height: 265,
                type: "line",
                zoom: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "straight",
            },
            series: [
                {
                    name: "Turnover",
                    data: [], // Initialize with empty data
                },
            ],
            title: {
                text: "Monthwise Turnover",
                align: "left",
            },
            grid: {
                row: {
                    colors: ["#f1f2f3", "transparent"],
                    opacity: 0.5,
                },
            },
            xaxis: {
                categories: [
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                    "Jan",
                    "Feb",
                    "Mar",
                ], // Financial Year months
            },
        };
        var chart = new ApexCharts(document.querySelector("#s-line"), sline);
        chart.render();
    }

    function GetMonthWishTurnover(financial_year) {
        var base_url = $("#base_url").val();
        $.ajax({
            url: base_url + "/get-monthlyturnover-data",
            type: "GET",
            data: { financial_year: financial_year },
            success: function (response) {
                //console.log(response);

                // Prepare an array to store the turnover values for each month (April to March)
                var turnoverData = new Array(12).fill(0); // Initialize with 0s for all 12 months

                // Map the response data to the correct financial month index
                response.forEach(function (item) {
                    var monthIndex =
                        (new Date(item.month + "-01").getMonth() + 9) % 12; // Adjust index for financial year starting from April
                    turnoverData[monthIndex] = parseFloat(item.total_amount);
                });

                // Update the chart with the new data
                chart.updateSeries([
                    {
                        name: "Turnover",
                        data: turnoverData,
                    },
                ]);
            },
            error: function (er) {
                console.log(er);
                // Handle error
            },
        });
    }

    //------------------ Get Total receivales ---------

    function fetch_total_receivables(Month, financial_year) {
        var base_url = $("#base_url").val();
        $.ajax({
            url: base_url + "/get-receivables-data",
            type: "GET",
            data: { Month: Month, financial_year: financial_year },
            success: function (response) {
                //console.log(response);
                if (response.total_unpaid !== undefined) {
                    $("#total_unpaid").text(response.total_unpaid);
                    $("#receivables_current").text(
                        response.total_payment_receivables
                    );
                    $("#receivables_overdue").text(
                        response.total_over_due_receivables
                    );
                }
            },
            error: function (er) {
                console.log(er);
                // Handle error
            },
        });
    }

    $("#total_receivales").change(function () {
        var month_name = $(this).val();
        var financial_year = $("#select_financial_year").val();
        fetch_total_receivables(month_name, financial_year);
    });

    //-------- Default fetch receivales----------
    var DefaultMonth = $("#total_receivales").val();
    var financial_year = $("#select_financial_year").val();

    fetch_total_receivables(DefaultMonth, financial_year); //------Function Call ----

    //------------------Get Total Payables -----------

    function fetch_total_payables(Month, financial_year) {
        var base_url = $("#base_url").val();
        $.ajax({
            url: base_url + "/get-payables-data",
            type: "GET",
            data: { Month: Month, financial_year: financial_year },
            success: function (response) {
                console.log(response);

                $("#total_unpaid_Payables").text(
                    response.total_unpaid_Payables
                );
                $("#Payables_current").text(response.total_payment_Payables);
                $("#Payables_overdue").text(response.total_over_due_Payables);
            },
            error: function (er) {
                console.log(er);
                // Handle error
            },
        });
    }

    $("#total_payables").change(function () {
        var month_name = $(this).val();
        var financial_year = $("#select_financial_year").val();
        fetch_total_payables(month_name, financial_year);
    });

    //---------- Default fetch -------
    var DefaultMonth = $("#total_payables").val();
    var financial_year = $("#select_financial_year").val();

    fetch_total_payables(DefaultMonth, financial_year);

    //---------- Get data by finical id Khokan---------

    function fetchFinicaltails(C_year) {
        // Call the function when the document is ready

        var bankId = $("#cust_bank_id").val();
        var Month = $("#total_receivales").val();
        var Month_payables = $("#total_payables").val();

        fetchMonthlyData(C_year);
        fetchStatutoryData(C_year);
        GetCustomerCount(C_year);

        fetchBankDetails(bankId, C_year);
        GetMonthWishTurnover(C_year);
        fetch_total_receivables(Month, C_year);
        fetch_total_payables(Month_payables, C_year);
    }

    $("#select_financial_year").change(function () {
        var Fyear = $(this).val();
        fetchFinicaltails(Fyear);
    });

    //-------- Default fetch ----------
    var DefaultFyear = $("#select_financial_year").val();
    fetchFinicaltails(DefaultFyear);

	

	
});


//27-09-2023
//Button
function openNewTab() {
    window.open("https://services.gst.gov.in/services/searchhsnsac", "_blank");
}

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});
//Show Password
const passwordInput = document.getElementById("passwordInput");
const showPasswordBtn = document.getElementById("showPasswordBtn");
const passwordIcon = document.getElementById("passwordIcon");

showPasswordBtn.addEventListener("click", function (e) {
    e.preventDefault();

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordIcon.classList.remove("fa-eye");
        passwordIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        passwordIcon.classList.remove("fa-eye-slash");
        passwordIcon.classList.add("fa-eye");
    }
});
//Product Select
function addForm(plusButton) {
    // Clone the entire form group
    var formGroup = plusButton.closest(".form-group");
    var formGroupClone = formGroup.cloneNode(true);

    // Reset the selected option in the cloned form
    var selectElement = formGroupClone.querySelector("select");
    selectElement.value = "Select Product";

    // Append the cloned form group to its parent
    formGroup.parentElement.appendChild(formGroupClone);
}
//HSN & SAC
const productRadio = document.querySelector(
    'input[name="item_type"][value="product"]'
);
const serviceRadio = document.querySelector(
    'input[name="item_type"][value="service"]'
);
const sacCodeSection = document.getElementById("sac_code_section");
const hsnCodeSection = document.getElementById("hsn_code_section");

productRadio.addEventListener("change", function () {
    if (productRadio.checked) {
        hsnCodeSection.style.display = "block";
        sacCodeSection.style.display = "none";
    }
});

serviceRadio.addEventListener("change", function () {
    if (serviceRadio.checked) {
        sacCodeSection.style.display = "block";
        hsnCodeSection.style.display = "none";
    }
});

//Custom Select
function showExpensesType() {
    var selectedCategory = document.getElementById("expenses-category").value;

    // Hide all expenses type selects
    var allExpenses = document.querySelectorAll(".form-group[id$='-expenses']");
    for (var i = 0; i < allExpenses.length; i++) {
        allExpenses[i].style.display = "none";
    }

    // Show the selected expenses type
    if (selectedCategory !== "Select") {
        var selectedExpenses = document.getElementById(
            selectedCategory + "-expenses"
        );
        selectedExpenses.style.display = "block";
    }
}

/*Category + "-expenses");
        selectedExpenses.style.display = "block";
    }
}*/
