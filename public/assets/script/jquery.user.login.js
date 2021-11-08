(function( $ ) {

	"use strict";

	var Login = function() 
	{
		var dom = $(document);
		
		var form = $('#form-login');

		var tableName = 'grvfranchise_form';				

		var setMessage = function(title, getMessage, typeClass, pos)
	    {
		    $.toast({
		        heading: title,
		        text: getMessage,
		        icon: typeClass,
		        position: pos
		    });
	    };

		var check = function()
	    {
	    	var btn = '#btn-login-user';

	    	dom.on('click', btn, function(e) {
	    		e.preventDefault();
	    		var me = $(this);
				var formname = 'form-login';
				var form = $('#'+formname);

				var token_csrf = form.find('input[name="'+app_main.csrfName+'"]').val();
	    		// token validation
	    		if( token_csrf == app_main.csrfHash ) {
	    			// process
	        		$('.invalid-feedback').remove();
	        		$('.is-invalid').removeClass('is-invalid');

	    			var valid = false;

	            	var stdmessage = '<div class="invalid-feedback"> Complete el campo requerido.</div>';

		            var field = form.find('input[name="name_user"]');

	                if( field.val() == '' ) {

		                valid = true;
		                field.addClass('is-invalid').next().after(stdmessage);
		            }

		            var field = form.find('input[name="name_user"]');

		            if( field.val() != '' && field.val().length < 3) {

		                valid = true;
		                field.addClass('is-invalid').next().after('<div class="invalid-feedback"> El campo Usuario debe contener más de 2 caracteres.</div>');
		            }

		            var field = form.find('input[name="password_user"]');

	                if( field.val() == '' ) {

		                valid = true;
		                field.addClass('is-invalid').next().after(stdmessage);
		            }

		            if( field.val() != '' && field.val().length < 3) {

		            	valid = true;
		                field.addClass('is-invalid').next().after('<div class="invalid-feedback"> El campo Usuario debe contener más de 2 caracteres.</div>');
		            }

		            if( !valid ) {

		            	var formData = new FormData(document.getElementById(formname));
		            	formData.append('token_nonce', token_csrf);
						formData.append('token_site', app_main.csrfHash);

						var print = $('#response-status');
						print.html('');

						$.ajax({
		                    type: 'post',
		                    url: app_main.url + '/authenticate',
		                    headers: {'X-Requested-With': 'XMLHttpRequest'},
		                    data: formData,
		                    cache: false,
		                    contentType: false,
		                    processData: false,
		                    dataType: 'json',
		                    beforeSend: function() {
		                    	me.attr('disabled','true');
		                    	// disabled controls
				            	$('#'+formname+' input, #'+
				            		formname+' select, #'+
			            			formname+' textarea').attr('disabled','true');
						    },
		                    success: function(response) {
		                    	// confirm status
		                        if( response.status ) {
		                        	
		                        	setTimeout(function(){ 
		                        		window.location.href = response.direct;
		                        	}, 200);
		                        
		                        } else {
		                        	// access denied
		                        	me.removeAttr('disabled');
		                        	$('#'+formname+' input, #'+
				            		formname+' select, #'+
			            			formname+' textarea').removeAttr('disabled');
			            			
		                        	setMessage('Acceso denegado', response.errors, 'error', 'mid-center');			            			
		                        }
		                    },
		                    error: function (xhr, ajaxOptions, thrownError) {
		                        console.log('Error: ' + thrownError);
		                    }
		                });
					}
				
				}// end token
	    	});

	    	var btn = '.unlock-pass';

	    	dom.on('click', btn, function(e) {
	    		e.preventDefault();
	    		var me = $(this);
				var field = $('input[name="password_user"]');
				if( field.attr('type') == 'text' ) {
					me.removeClass('active');
					field.attr('type', 'password');
				} else {
					me.addClass('active');
					field.attr('type', 'text');
				}
	    	});
	    };

	    var slider = function()
	    {
	    	$.sublime_slideshow({
			    src:[
				    {url:app_main.assets+"/img/login/bg1.jpg"},
				    {url:app_main.assets+"/img/login/bg2.jpg"},
			    ],
			    duration: 12,
			    fade: 3,
			    scaling: false,
			    rotating: false,
			    overlay:app_main.assets+"/lib/sublimeSlideshow/pattern.png"
		    });
	    };
	    
		return {
	        //main function to initiate the module
	        init: function() {	        	
	            check();
	            slider();	            
	        }
	    }
	}();

	Login.init();	

})( jQuery );