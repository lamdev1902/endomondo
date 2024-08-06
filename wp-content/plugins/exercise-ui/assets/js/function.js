jQuery(function ($) {
	jQuery(document).on('click', 'a.add-exercise-image', function (e) {
		openQuizMediaUploader(e, jQuery(this));
	});

	jQuery(document).on('click', 'span.remove-exercise-img', function (e) {
		var container = $(this)
			.closest('.field')
			.find('.exercise-image-container');
		container.fadeOut();
		container.find('img.exercise-img').attr('src', '');
		container.find('input.exercise-image').val('');
		$(this).closest('.field').find('a.add-exercise-image').text('Add Image');
	});

	$(document).on('change', 'input.video-section', function (e) {
		var container = $(this)
			.closest('.field')
			.find('.exercise-video-container');
		var videoUrl = $(this).val();
		var iframeSrc = '';
		var videoSrc = '';
		var isYouTube = false;
		var isVimeo = false;
		var check = true;

		if (videoUrl) {
			var youtubeMatch = videoUrl.match(
				/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/
			);

			if (youtubeMatch) {
				var videoId = youtubeMatch[1];
				iframeSrc = 'https://www.youtube.com/embed/' + videoId;
				isYouTube = true;
			}

			var vimeoMatchIframe = videoUrl.includes('<iframe') && videoUrl.includes('</iframe>');

			if (isYouTube) {
				var iframe = $(this).closest('.field-item').find('iframe');
				iframe.attr('src', iframeSrc).show();
				$(this).attr('value', iframeSrc);
				$(this).val(iframeSrc);
			} else if (vimeoMatchIframe) {
				var srcMatch = videoUrl.match(/src="([^"]+)"/);
				if (srcMatch) {
					var iframeSrc = srcMatch[1];
					if (iframeSrc) {
						var iframe = $(this).closest('.field-item').find('iframe');
						iframe.attr('src', iframeSrc).show();
						$(this).attr('value', iframeSrc);
						$(this).val(iframeSrc);
					}
				}
			} else if (isValidURL(videoUrl)) {
				var iframe = $(this).closest('.field-item').find('iframe');
				iframe.attr('src', videoUrl).show();
				$(this).attr('value', videoUrl);
				$(this).val(videoUrl);
			} else {
				check = false;
				$(this).attr('value', '');
				$(this).val('');
			}
		} else {
			check = false;
			$(this).attr('value', '');
			$(this).val('');
		}

		check ? container.fadeIn() : container.fadeOut();
	});

	jQuery(document).ready(function ($) {
		$('.muscle-button').on('click', function (e) {
			e.preventDefault();

			validateInput();

			var link = $(this).data('link');
			var formData = $(this)
				.closest('.exercice-form-section')
				.find('form');
			formData = formData.serializeArray();

			var jsonData = {};
			$.each(formData, function (i, field) {
				var parts = field.name.split('[');
				var currentObj = jsonData;

				for (var j = 0; j < parts.length; j++) {
					var key = parts[j].replace(']', '');

					if (j === parts.length - 1) {
						currentObj[key] = field.value || '';
					} else {
						currentObj[key] = currentObj[key] || {};
						currentObj = currentObj[key];
					}
				}
			});

			var editorValue = tinymce.get('description')
				? tinymce.get('description').getContent()
				: $('textarea#description').val();

			if (!jsonData.muscle) {
				jsonData.muscle = {};
			}
			jsonData.muscle.description = editorValue || '';

			jsonData.link = link;
			if ($('.error').length == 0) {
				$('#overlay').fadeIn(300);
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'handle_muscle_data',
						data: jsonData,
						// Add other fields accordingly
					},
					success: function (response) {
						try {
							setTimeout(function () {
								$('#overlay').fadeOut(300);
							}, 500);
							var cleanedResponse = response.replace(/0+$/, '');

							var result = JSON.parse(cleanedResponse);
							if (result.redirect_url) {
								window.location.href = result.redirect_url;
							} else {
								alert('An error occurred.');
							}
						} catch (e) {
							console.error('Parsing error:', e);
							alert('An error occurred.');
						}
					},
					error: function (error) {
						alert('faile');
					},
				});
			}
		});

		$('.equipment-button').on('click', function (e) {
			e.preventDefault();

			validateInput();

			var link = $(this).data('link');
			var formData = $(this)
				.closest('.exercice-form-section')
				.find('form');
			formData = formData.serializeArray();

			var jsonData = {};
			$.each(formData, function (i, field) {
				var parts = field.name.split('[');
				var currentObj = jsonData;

				for (var j = 0; j < parts.length; j++) {
					var key = parts[j].replace(']', '');

					if (j === parts.length - 1) {
						currentObj[key] = field.value || '';
					} else {
						currentObj[key] = currentObj[key] || {};
						currentObj = currentObj[key];
					}
				}
			});

			jsonData.link = link;
			if ($('.error').length == 0) {
				$('#overlay').fadeIn(300);
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'handle_equipment_data',
						data: jsonData,
						// Add other fields accordingly
					},
					success: function (response) {
						try {
							setTimeout(function () {
								$('#overlay').fadeOut(300);
							}, 500);
							var cleanedResponse = response.replace(/0+$/, '');

							var result = JSON.parse(cleanedResponse);
							if (result.redirect_url) {
								window.location.href = result.redirect_url;
							} else {
								alert('An error occurred.');
							}
						} catch (e) {
							console.error('Parsing error:', e);
							alert('An error occurred.');
						}
					},
					error: function (error) {
						alert('faile');
					},
				});
			}
		});

		$('.exercise-button').on('click', function (e) {
			e.preventDefault();

			validateInput();

			var link = $(this).data('link');
			var formData = $(this)
				.closest('.exercice-form-section')
				.find('form');
			formData = formData.serializeArray();

			var jsonData = {};

			$.each(formData, function (i, field) {
				var parts = field.name.split('[');
				var currentObj = jsonData;

				for (var j = 0; j < parts.length; j++) {
					var key = parts[j].replace(']', '');

					if (j === parts.length - 1) {
						if (Array.isArray(currentObj[key])) {
							currentObj[key].push(field.value || '');
						} else if (currentObj[key] !== undefined) {
							currentObj[key] = [
								currentObj[key],
								field.value || '',
							];
						} else {
							currentObj[key] = field.value || '';
						}
					} else {
						currentObj[key] = currentObj[key] || {};
						currentObj = currentObj[key];
					}
				}
			});

			var editorValue = tinymce.get('excDescription')
				? tinymce.get('excDescription').getContent()
				: $('textarea#excDescription').val();

			if (!jsonData.exercise) {
				jsonData.exercise = {};
			}

			jsonData.exercise.description = editorValue || '';
			jsonData.link = link;

			$('.wp-editor-area').each(function () {
				var editorId = $(this).attr('id');
				var editorContent = tinyMCE.get(editorId)
					? tinyMCE.get(editorId).getContent()
					: $(this).val();

				var parts = $(this).attr('name').split('[');
				var currentObj = jsonData;

				for (var j = 0; j < parts.length; j++) {
					var key = parts[j].replace(']', '');

					if (j === parts.length - 1) {
						currentObj[key] = editorContent;
					} else {
						currentObj[key] = currentObj[key] || {};
						currentObj = currentObj[key];
					}
				}
			});

			if ($('.error').length == 0) {
				$('#overlay').fadeIn(300);
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'handle_exercise_data',
						data: jsonData,
					},
					success: function (response) {
						try {
							setTimeout(function () {
								$('#overlay').fadeOut(300);
							}, 500);

							var cleanedResponse = response.replace(/0+$/, '');

							var result = JSON.parse(cleanedResponse);
							if (result.redirect_url) {
								window.location.href = result.redirect_url;
							} else {
								alert('An error occurred.');
							}
						} catch (e) {
							console.error('Parsing error:', e);
							alert('An error occurred.');
						}
					},
					error: function (error) {
						alert('faile');
					},
				});
			}
		});

		var isModalPrimary = false;
		var isModalSecondary = false;
		var isModalEquipment = false;

		$(document).on('click', '.add-primary-option', function (e) {
			e.preventDefault();
			var id = $(this).data('id') ? $(this).data('id') : '';
			$('#exercise-primary-modal').modal('open');

			if (isModalPrimary) {
				return;
			}

			isModalPrimary = true;
			$.ajax({
				url: ajaxurl,
				method: 'POST',
				data: {
					action: 'get_muscle_anatomy',
					exercise_id: id,
					type: 'primary',
				},
				success: function (response) {
					if (response) {
						$('.primary-modal').html(response);
						checkRadioInput('primay');
					} else {
						console.error(
							'Không có dữ liệu trả về từ yêu cầu AJAX.'
						);
					}
				},
				error: function (xhr, status, error) {
					console.error('Lỗi khi gửi yêu cầu AJAX: ' + error);
				},
			});
		});

		$(document).on('change', '.search-option', function (e) {
			e.preventDefault();

			var id = $(this).data('id') ? $(this).data('id') : '';

			var type = $(this).data('type') ? $(this).data('type') : '';

			var value = $(this).val();

			var classModel = '.' + type + '-modal';

			var action = type == "equipment" ? "get_equipment_data" : "get_muscle_anatomy";
			$.ajax({
				url: ajaxurl,
				method: 'POST',
				data: {
					action: action,
					exercise_id: id,
					type: type,
					search: value
				},
				success: function (response) {
					if (response) {
						$(classModel).html(response);
					} else {
						console.error(
							'Không có dữ liệu trả về từ yêu cầu AJAX.'
						);
					}
				},
				error: function (xhr, status, error) {
					console.error('Lỗi khi gửi yêu cầu AJAX: ' + error);
				},
			});
		});

		$(document).on('click', '.add-secondary-option', function (e) {
			e.preventDefault();

			var id = $(this).data('id') ? $(this).data('id') : '';
			$('#exercise-secondary-modal').modal('open');

			if (isModalSecondary) {
				return;
			}

			isModalSecondary = true;

			$.ajax({
				url: ajaxurl,
				method: 'POST',
				data: {
					action: 'get_muscle_anatomy',
					exercise_id: id,
					type: 'secondary',
				},
				success: function (response) {
					if (response) {
						$('.secondary-modal').html(response);
						checkRadioInput('secondary');
					} else {
						console.error(
							'Không có dữ liệu trả về từ yêu cầu AJAX.'
						);
					}
				},
				error: function (xhr, status, error) {
					console.error('Lỗi khi gửi yêu cầu AJAX: ' + error);
				},
			});
		});

		$(document).on('click', '.add-equipment-option', function (e) {
			e.preventDefault();

			var id = $(this).data('id') ? $(this).data('id') : '';
			$('#exercise-equipment-modal').modal('open');

			if (isModalEquipment) {
				return;
			}

			isModalEquipment = true;
			$.ajax({
				url: ajaxurl,
				method: 'POST',
				data: {
					action: 'get_equipment_data',
					exercise_id: id,
					type: 'equipment',
				},
				success: function (response) {
					if (response) {
						$('.equipment-modal').html(response);
						checkRadioInput('equipment');
					} else {
						console.error(
							'Không có dữ liệu trả về từ yêu cầu AJAX.'
						);
					}
				},
				error: function (xhr, status, error) {
					console.error('Lỗi khi gửi yêu cầu AJAX: ' + error);
				},
			});
		});

		$('.add-muscle-primary').click(function () {
			var selectedData = checkedInput('primary-modal', 'primary');
			if (
				$('.primary .exercise-option-table tbody tr.single-tr')
					.length > 0
			) {
				$(
					'.primary .exercise-option-table tbody tr.single-tr'
				).remove();
			}

			var exerciseId = $('.add-primary-option').data('id');

			selectedData.forEach(function (data) {
				var newRow = `
                    <tr>
                        <td></td>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>
                            <input type="hidden" name="exercise[primary][]" value="${data.id}" id="${data.id}">
                            <a href="javascript:void(0)" class="action-item exercise-muscle-edit">Edit</a>
                            <a href="javascript:void(0)" data-type="primary" data-exercise="${exerciseId}" data-id="${data.id}" class="action-item exercise-muscle-delete">Delete</a>
                        </td>
                    </tr>
                `;
				$('.primary .exercise-option-table tbody').append(newRow);
			});

			$('#exercise-primary-modal').find('.close-modal').click();
		});

		$('.add-muscle-secondary').click(function () {
			var selectedData = checkedInput('secondary-modal', 'secondary');

			if (
				$('.secondary .exercise-option-table tbody tr.single-tr')
					.length > 0
			) {
				$(
					'.secondary .exercise-option-table tbody tr.single-tr'
				).remove();
			}

			var exerciseId = $('.add-secondary-option').data('id');

			selectedData.forEach(function (data) {
				var newRow = `
                    <tr>
                        <td></td>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>
                            <input type="hidden" name="exercise[secondary][]" value="${data.id}" id="${data.id}">
                            <a href="javascript:void(0)" class="action-item exercise-muscle-edit">Edit</a>
                            <a href="javascript:void(0)" data-type="secondary" data-exercise="${exerciseId}" data-id="${data.id}" class="action-item exercise-muscle-delete">Delete</a>
                        </td>
                    </tr>
                `;
				$('.secondary .exercise-option-table tbody').append(newRow);
			});

			$('#exercise-secondary-modal').find('.close-modal').click();
		});

		$('.add-equipment').click(function () {
			var selectedData = checkedInput('equipment-modal', 'equipment');

			if (
				$('.equipment .exercise-option-table tbody tr.single-tr')
					.length > 0
			) {
				$(
					'.equipment .exercise-option-table tbody tr.single-tr'
				).remove();
			}

			var exerciseId = $('.add-equipment-option').data('id');
			selectedData.forEach(function (data) {
				var newRow = `
                    <tr>
                        <td></td>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>
                            <input type="hidden" name="exercise[equipment][]" value="${data.id}" id="${data.id}">
                            <a href="javascript:void(0)" class="action-item exercise-muscle-edit">Edit</a>
                            <a href="javascript:void(0)" data-type="equipment" data-exercise="${exerciseId}" data-id="${data.id}" class="action-item exercise-muscle-delete">Delete</a>
                        </td>
                    </tr>
                `;
				$('.equipment .exercise-option-table tbody').append(newRow);
			});

			$('#exercise-equipment-modal').find('.close-modal').click();
		});

		$(document).on('click', '.exercise-muscle-delete', function () {
			var id = $(this).data('id');
			var exerciceid = $(this).data('exercise');
			var type = $(this).data('type');
			var table = $(this).closest('.exercise-option-table');
			var tableList = $('.' + type + '-modal' + ' #the-list');
			isChecked = tableList.find(
				'input[type="checkbox"]:checked[value="' + id + '"]'
			);
			if (isChecked.length > 0) {
				isChecked.prop('checked', false);
				isChecked.removeClass('selected');
			}

			$(this).closest('tr').remove();

			var row = table.find('tbody tr');

			if (row.length == 0) {
				var newRow = `
                <tr class="single-tr">
                    <td colspan="7"><a href="#exercise-${type}-modal" data-id="${exerciceid}" class="add-${type}-option insert-btn">Insert ${type} option</a></h3></td>
                </tr>
                `;
				table.find('tbody').append(newRow);
			}
		});

		$('.inline-edit').click(function () {
			var $this = $(this);
			$this.hide();
			$this.siblings('.inline-edit-input').show().focus();
		});

		$('.inline-edit-input').blur(function () {
			var $this = $(this);
			var value = $this.val();
			var id = $this.closest('tr').data('id');
			var column = $this.closest('td').data('column');
			var func = $this.data('ajax');

			$this.hide();
			$this.siblings('.inline-edit').text(value).show();

			$.post(
				ajaxurl,
				{
					action: func,
					id: id,
					column: column,
					value: value,
				},
				function (response) {
					if (response !== 'success') {
						alert('Error updating record');
					}
				}
			);
		});

		setCheckboxSelectLabels();

		$('.toggle-next').click(function () {
			$(this).next('.checkboxes').slideToggle(400);
		});

		$('.ckkBox').change(function () {
			toggleCheckedAll(this);
			setCheckboxSelectLabels();
		});


		jQuery('#muscle-form')
			.find('input, textarea, select')
			.on('change', function () {
				validateInput();

			});

	});
});

function checkRadioInput(className) {
	var deleteButtons = jQuery(
		'.' + className + ' .exercise-option-table'
	).find('.action-item.exercise-muscle-delete');

	var ids = [];

	deleteButtons.each(function () {
		var id = jQuery(this).data('id');
		ids.push(id);
	});

	var list = jQuery('.' + className + '-modal #the-list tr');
	jQuery('.' + className + '-modal #the-list tr').each(function () {
		var $row = jQuery(this);
		var checkbox = $row.find('input[type="checkbox"]');
		var isChecked = checkbox.is(':checked');

		if (isChecked) {
			var id = $row
				.find('.column-id')
				.contents()
				.filter(function () {
					return this.nodeType === 3;
				})
				.text()
				.trim();

			if (!(jQuery.inArray(parseInt(id), ids) !== -1)) {
				checkbox.prop('checked', false);
				checkbox.removeClass('selected');
			}
		}
	});
}
function checkedInput(className = '', type) {
	var selectedData = [];

	var deleteButtons = jQuery('.' + type + ' .exercise-option-table').find(
		'.action-item.exercise-muscle-delete'
	);

	var ids = [];

	deleteButtons.each(function () {
		var id = jQuery(this).data('id');
		ids.push(id);
	});

	jQuery('.' + className + ' #the-list tr').each(function () {
		var $row = jQuery(this);
		var isChecked = $row
			.find('input[type="checkbox"]:not(.selected)')
			.is(':checked');

		if (isChecked) {
			var id = $row
				.find('.column-id')
				.contents()
				.filter(function () {
					return this.nodeType === 3;
				})
				.text()
				.trim();

			var name = $row
				.find('.column-name')
				.contents()
				.filter(function () {
					return this.nodeType === 3;
				})
				.text()
				.trim();

			if (!(jQuery.inArray(parseInt(id), ids) !== -1)) {
				selectedData.push({ id: id, name: name });
			}
		}
	});

	return selectedData;
}
function openQuizMediaUploader(e, element) {
	e.preventDefault();
	var aysUploader = wp
		.media({
			title: 'Upload',
			button: {
				text: 'Upload',
			},
			frame: 'post', // <-- this is the important part
			state: 'insert',
			library: {
				type: 'image',
			},
			multiple: false,
		})
		.on('insert', function () {
			var state = aysUploader.state();
			var selection = selection || state.get('selection');
			if (!selection) return;

			var attachment = selection.first();
			var display = state.display(attachment).toJSON();
			attachment = attachment.toJSON();
			// Do something with attachment.id and/or attachment.url here
			var imgurl = attachment.sizes[display.size].url;

			element.text('Edit Image');

			element.parent('.field');
			var container = element
				.closest('.field')
				.find('.exercise-image-container');
			container.fadeIn();

			container.find('img.exercise-img').attr('src', imgurl);
			container.find('input.exercise-image').val(imgurl);
		})
		.open();

	return false;
}

function setCheckboxSelectLabels(elem) {
	var wrappers = jQuery('.wrapper');
	jQuery.each(wrappers, function (key, wrapper) {
		var checkboxes = jQuery(wrapper).find('.ckkBox');
		var label = jQuery(wrapper).find('.checkboxes').attr('id');

		var prevText = '';
		jQuery.each(checkboxes, function (i, checkbox) {
			var button = jQuery(wrapper).find('button');
			var val = jQuery(checkbox).val();
			var inputHidden = jQuery(wrapper).find('.val-' + val);
			if (jQuery(checkbox).prop('checked') == true) {
				var text = jQuery(checkbox).next().html();
				var btnText = prevText + text;
				var numberOfChecked = jQuery(wrapper).find(
					'input.val:checkbox:checked'
				).length;
				if (numberOfChecked >= 6) {
					btnText = 'All ' + label + ' Type selected';
				}
				jQuery(button).text(btnText);
				prevText = btnText + ', ';

				inputHidden.val(val);
			} else {
				inputHidden.val('');
			}
		});
	});
}

function toggleCheckedAll(checkbox) {
	var apply = jQuery(checkbox)
		.closest('.wrapper')
		.find('.apply-selection');
	apply.fadeIn('slow');

	var val = jQuery(checkbox).closest('.checkboxes').find('.val');
	var all = jQuery(checkbox).closest('.checkboxes').find('.all');
	var ckkBox = jQuery(checkbox).closest('.checkboxes').find('.ckkBox');

	if (!jQuery(ckkBox).is(':checked')) {
		jQuery(all).prop('checked', true);
		return;
	}

	if (jQuery(checkbox).hasClass('all')) {
		jQuery(val).prop('checked', false);
	} else {
		jQuery(all).prop('checked', false);
	}
}

function validateInput() {

	jQuery('#muscle-form')
		.find('input, textarea, select')
		.each(function () {
			var $input = jQuery(this);
			var value = $input.val().trim();
			var type = $input.attr('type');

			if (jQuery(this).closest('.field').find('.field-label').hasClass('attention')) {
				if ($input.val()) {
					$input.closest('.field-item').removeClass('error');
					$input.closest('.field-item').find('.error-message').remove();
				}
				if ($input.is(':visible')) {
					if (
						$input.is('select') ||
						$input.is('textarea') ||
						type === 'text' ||
						type === 'radio' ||
						type === 'hidden'
					) {
						if (value === '') {
							isValid = false;
							$input
								.closest('.field-item')
								.addClass('error')
								.append(
									'<span class="error-message">This field is required</span>'
								);
						}
					}
				}
			}
		});

	if (jQuery('.error-message').length > 0) {
		jQuery('html, body').animate(
			{
				scrollTop: jQuery('.error').first().offset().top,
			},
			500
		);
	}
}

function isValidURL(string) {
	var urlPattern = new RegExp('^(https?:\\/\\/)?' + // protocol
		'((([a-zA-Z0-9\\$\\_\\+\\!\\*\\,\\;\\=\\:.-]+)\\.[a-zA-Z]{2,})|' + // domain name and extension
		'((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ipv4
		'(\\:\\d+)?(\\/[-a-zA-Z0-9@:%_\\+.~#?&//=]*)?$', 'i'); // port and path
	return !!urlPattern.test(string);
}
