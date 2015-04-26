function getURLVar(key) {
    var value = [];
    
    var query = String(document.location).split('?');
    
    if (query[1]) {
        var part = query[1].split('&');

        for (i = 0; i < part.length; i++) {
            var data = part[i].split('=');
            
            if (data[0] && data[1]) {
                value[data[0]] = data[1];
            }
        }
        
        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    }
} 

$(document).ready(function() {
	route = getURLVar('route');
	
	if (!route) {
		$('#menu #home').addClass('active');
	} else {
		part = route.split('/');
		
		url = part[0];
		
		if (part[1]) {
			url += '/' + part[1];
		}		
		
		$('#menu a[href*=\'index.php?route=' + url + '\']').parents('li[id]').addClass('active');
	}

    // tooltips on hover
    $('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

    // Makes tooltips work on ajax generated content
    $(document).ajaxStop(function() {
        $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
    });
    
    // https://github.com/opencart/opencart/issues/2595
    $.event.special.remove = {
        remove: function(o) {
            if (o.handler) { 
                o.handler.apply(this, arguments);
            }
        }
    }
    
    $('[data-toggle=\'tooltip\']').on('remove', function() {
        $(this).tooltip('destroy');
    }); 

    // Highlight any found errors
    $('.text-danger').each(function() {
        var element = $(this).parent().parent();
        
        if (element.hasClass('form-group')) {
            element.addClass('has-error');
        }
    });
});