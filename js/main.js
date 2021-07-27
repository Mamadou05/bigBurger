
$(function(){
    loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
    loader();
    $('#commander').click(function(){
        alert('Votre commander est passée!');
    });
	console.log('Bismillah');
    
})

function commander(){
	alert('Votre commander est passée!');
}
