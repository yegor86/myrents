        
            
		$(function(){
			$('#multiAccordionNo').multiAccordion({
				click: function(event, ui) {
					//console.log('clicked')
				},
				init: function(event, ui) {
					//console.log('whoooooha')
				},
				tabShown: function(event, ui) {
					//console.log('shown')
				},
				tabHidden: function(event, ui) {
					//console.log('hidden')
				}
				
			});
	
			$('#multiAccordionNo').multiAccordion({active: 'none'});

		});