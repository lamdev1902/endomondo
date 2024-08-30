jQuery(function($) {

	$("#btnClear").on('click', function(){
		$("input[name='info[age]").val('');
		$("input[name='info[weight]").val('');
		$("input[name='info[height][feet]").val('');
		$("input[name='info[height][inches]").val('');
	})

	$('#bmiCalculate').validate({
		rules: {
		    'info[age]':  {
				required: true,
				number: true,
				min: 2,
				max: 120
		    },
		    'info[weight]':  {
				required: true,
				number: true,
				min: 1
		    },
		    'info[height][feet]':  {
				required: true,
				number: true,
				min: 1
		    },
		    'info[height][inches]':  {
				number: true,
		    }
	  	},
	  	messages: {
	  		rsl_balance: {
		      required: 'Please enter the value',
		      number: 'Value is numeric'
		    },
		    rsl_monthly:  {
		    	required: 'Please enter the value',
		      number: 'Value is numeric'
		    },
		    rsl_interest:  {
				required: 'Please enter the value',
				number: 'Value is numeric'
		    }
	  	},
		  submitHandler: function(form) {
			var formData = $('#bmiCalculate').serializeArray();
			var jsonData = {};
            $('.content-bottom').empty();
            $('.container').css('position', 'relative');
            $('.wrapper').css('background', "rgb(250 250 250 / 1)");
            $('.wrapper').css('opacity', "0.3");
            $('#spinner').show();

			$.each(formData, function(i, field) {
				var parts = field.name.split('[');
				var currentObj = jsonData;

				for (var j = 0; j < parts.length; j++) {
					var key = parts[j].replace(']', '');

					if (j === parts.length - 1) {
					if(field.value)
					{
						currentObj[key] = field.value;
					}
					} else {
						currentObj[key] = currentObj[key] || {};
						currentObj = currentObj[key];
					}
				}
			});
			$.ajax({
			 url:'https://www.dev.ehproject.org/',
			  type: 'GET', 
			  cache: false,
			  dataType: "json",
			  data: {
				  jsonData,
				  'get_bmi_tool':true 
			  },
			  success: function(data) {
				  $('.content-top').addClass('bdbottom');
				  $('.content-bottom').html(data);
				  $('#spinner').hide();
				  $('.container').removeAttr('style');
				  $('.wrapper').removeAttr('style');
			  }
		  });
		  return false;
		}
	});
})

