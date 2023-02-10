(function ($, root) {
    
	$(document).ready(function() {	
    	/* ****************************************************************** */
    	/* SEARCH EXPORT
    	/* ****************************************************************** */
    	$('#wp-admin-bar-generate-search a').on('click', function(e) {
    	    var element = $('<div/>')
    	    
    	    element.css({
    	        'position': 'fixed',
    	        'width': '100vw',
    	        'height': '100vh',
    	        'cursor': 'wait',
    	        'background': 'rgba(255,255,255,.65)',
    	        'top': '0',
    	        'left': '0',
    	        'z-index': '100000'
    	    })
    	    
    	    $('body').append(element)
    	    
    		e.preventDefault()
    		
    		$.ajax({
    		    url: $(this).prop('href')
    		}).done(function(data) {
    		    element.remove()
                if(data == '1') {
                    alert('Úspešne vyexportované!')
                } else {
                    alert('Export sa nepodaril!')
                }
    		}).error(function(data) {
    		    element.remove()
                alert('Export sa nepodaril!')
    		})
    	})

		/* ****************************************************************** */
    	/* GENERATE_TO_STATIC
    	/* ****************************************************************** */
    	$('#generate-static').on('click', function(e) {
			e.preventDefault()
    	    var element = $('<div/>')
    	    
    	    element.css({
    	        'position': 'fixed',
    	        'width': '100vw',
    	        'height': '100vh',
    	        'cursor': 'wait',
    	        'background': 'rgba(255,255,255,.65)',
    	        'top': '0',
    	        'left': '0',
    	        'z-index': '100000'
    	    })
    	    
    	    $('body').append(element)
    	    
    		e.preventDefault()
    		
    		$.ajax({
    		    url: $(this).data('href') + '?id=' + $(this).data('id')
    		}).done(function(data) {
    		    element.remove()
				console.log(data)
                if(data == '0') {
					alert('Export na statickú verziu sa nepodaril. Kontaktujte administrátora!')
                } else {
                    alert('Úspešne vygenerované!')
                }
    		}).error(function(data) {
    		    element.remove()
                alert('Export na statickú verziu sa nepodaril. Kontaktujte administrátora!')
    		})
    	})

		$('#export-static-form').on('submit', function(e) {
			e.preventDefault()
    	    var element = $('<div/>')
    	    
    	    element.css({
    	        'position': 'fixed',
    	        'width': '100vw',
    	        'height': '100vh',
    	        'cursor': 'wait',
    	        'background': 'rgba(255,255,255,.65)',
    	        'top': '0',
    	        'left': '0',
    	        'z-index': '100000'
    	    })
    	    
    	    $('body').append(element)
    	    
    		e.preventDefault()
    		
			var url = $('#export-static-form input[name="href"]').val()
			var link = $('#export-static-form input[name="url"]').val()

    		$.ajax({
    		    url: url + '?url=' + encodeURIComponent(link)
    		}).done(function(data) {
    		    element.remove()
				if(data == '-1') {
					alert('Zadajte správnu URL!')
				} else {
					if(data == '0') {
						alert('Export na statickú verziu sa nepodaril. Kontaktujte administrátora!')
					} else {
						alert('Úspešne vygenerované!')
						$('#export-static-form input[name="url"]').val('')
					}
				}
    		}).error(function(data) {
    		    element.remove()
                alert('Export na statickú verziu sa nepodaril. Kontaktujte administrátora!')
    		})
		})
	})
})(jQuery, this);