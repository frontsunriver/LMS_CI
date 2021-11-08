(function( $ ) {

	"use strict";

	var App = function() 
	{
		var dom = $(document);
		var win = $(window);

		// resize window
		var checkwin = function() {
    		if( win.width() < 700  ) {
    			$('#main-wrap').removeClass('active');
    		}
    	}

    	win.resize(function(){
    		checkwin();
    	});
    	
    	checkwin();

    	// validation characters
	    var validation = function()
	    {
    		$('.validate-text').valCharacters('abcdefghijklmnñopqrstuvwxyzáéíóúiou´ ');
			$('.validate-number').valCharacters('1234567890 ');
			$('.validate-decimal').valCharacters('1234567890.');
			$('.validate-phone').valCharacters('1234567890-()+ ');
			$('.validate-email').valCharacters('abcdefghijklmnñopqrstuvwxyziou1234567890@_-. ');
    		$('.validate-fulltext').valCharacters('áéíóúabcdefghijklmnñopqrstuvwxyzáéiou1234567809,.!?()&_-%´ ');
	    };

	    var body = $('body');

	    var sidebar = function()
	    {
	    	var btn = '#btn-menu-mobile'

	    	// open sidebar mobile
	    	dom.on('click', btn, function(e) {
	    		e.preventDefault();
	    		var bar = $('#sidebar');
	    		if( bar.hasClass('open') ) {
	    			body.removeClass('fix-scroll');
	    			bar.removeClass('open');
	    		} else {
	    			body.addClass('fix-scroll');
	    			bar.addClass('open');
	    		}
	    	});

	    	// click bg sidebar filter
	    	dom.on('click', '#sidebar', function(e){	    	
        		$('#sidebar').removeClass('open');
        		body.removeClass('fix-scroll');
        	});

	    	dom.on('click', '#sidebar #sidebarMenu', function(e){
	    		e.stopPropagation();
        	});
	    };

	    var togglebar = function()
	    {
	    	var btn = '.toggle-menu';
	    	var first = true;

	    	dom.on('change', btn, function(e) {
	    		e.preventDefault();
	    		var me = $(this);
	    		var id = me.val();
	    		var title = me.find('option:selected').text();
	    		$('.men_item').slideUp('normal');
	    		$('.men_'+id).slideDown('normal');
	    		if( first ) {
	    			$('#vertical-menu').removeClass('hide-dropdown');
	    			first = false;
	    		}
	    		$('#title-selected-module').css('display', 'none')
	    				.html(title)
	    				.fadeIn('slow');	
	    	});

	    	var btn = '.toggle-bar';

	    	dom.on('click', btn, function(e) {
	    		var _class= 'active';
	    		// if desktop
	    		if( win.width() > 700 ) {
	    			var to = $('#main-wrap');
		    		if( to.hasClass(_class) ) {
		    			to.removeClass(_class);
		    		} else {
		    			to.addClass(_class);
		    		}
	    		} else {
	    		// other device
	    			var bar = $('#sidebar');
		    		if( bar.hasClass('open') ) {
		    			body.removeClass('fix-scroll');
		    			bar.removeClass('open');
		    		} else {
		    			body.addClass('fix-scroll');
		    			bar.addClass('open');
		    		}
	    		}	    		
	    	});	    	
	    };

	    var tooltip = function()
	    {
	    	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			  return new bootstrap.Tooltip(tooltipTriggerEl)
			});
	    };

	    var periods = function()
	    {
	    	var ddl = '.selectable_period';

	    	dom.on('click', ddl, function(e) {
	    		e.preventDefault();
	    		var me = $(this);
	    		var getId 	 = me.attr('data-id');
	    		var getName  = me.text();
	    		var elements = $('#ddlPeriod *');	    		
	    		// change data
	    		$.ajax({
                    type: 'post',
                    url: app_main.url + '/changePeriods',
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    data: {
                    	'token_nonce': app_main.csrfHash, 
                    	'token_site' : app_main.csrfHash,
                    	'year_selected' : getName,
                    },
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                    	// disabled controls
		            	elements.attr('disabled', true);
				    },
                    success: function(response) {
                    	//console.log(response);
                    	// confirm status
                        if( response.status ) {
                        	$('#ddlPeriod').html(getName);
                        	window.location.reload(true);
                        } else{
                        	$.alert({
		                		icon: 'fa fa-info-circle',
							    title: 'No se logró establecer la conexión',
							    content: 'Por favor vuelva a intentarlo o verifique si la base de datos existe.',
							    type: 'red',
							    typeAnimated: true,
							    escapeKey: true,
							    buttons: {
							    	close: {
							            text: 'Aceptar',
							            btnClass: 'btn-red',
							            keys: ['enter']
							        }
							    }
							});
                        }
                        // access denied
                    	elements.removeAttr('disabled');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('Error: ' + thrownError);
                    }
                });
	    	});
	    };
	    
		return {
	        //main function to initiate the module
	        init: function() {	            
	            validation();
	            togglebar();
	            sidebar();
	            tooltip();
	            periods();
	        }
	    }
	}();

	App.init();

})( jQuery );