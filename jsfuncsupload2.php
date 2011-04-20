'},
                'queueID'        : 'fileQueue',
		'auto'           : true,
onComplete: function(event, queueID, fileObj, response, data) {
      $('#response').append(response);
},
		'multi'          : true
	});
