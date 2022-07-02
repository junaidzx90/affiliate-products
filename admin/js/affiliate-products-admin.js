jQuery(function( $ ) {
	'use strict';

	function uploadGalleryImage() {
		var imgfile, selectedFiles;
		// If the frame already exists, re-open it.
		if (imgfile) {
			imgfile.open();
			return;
		}
		//Extend the wp.media object
		imgfile = wp.media.frames.file_frame = wp.media({
			title: 'Add images to product gallery',
			button: {
				text: 'Add to gallery'
			},
			multiple: true
		});

		//When a file is selected, grab the URL and set it as the text field's value
		imgfile.on('select', function () {
			selectedFiles = imgfile.state().get('selection');

			selectedFiles.map( function( attachment ) {
				let file = attachment.toJSON();
				$("#gallery__items ul").append(`<li> <img src="${file.url}"><input type="hidden" name="product_galleries[]" value="${file.id}"><span class="delete__gallery">+</span></li>`);
			});
		});

		//Open the uploader dialog
		imgfile.open();
	}

	$("#add__gallery_images").on("click", function(e){
		e.preventDefault();
		uploadGalleryImage();
	});

	$(document).on("click", ".delete__gallery", function(){
		$(this).parent().remove();
	});


	$(document).on("click", ".upload__link_logo", function(e){
		e.preventDefault();
		let btn = $(this);

		let logoFile, selectedLogo;
		// If the frame already exists, re-open it.
		if (logoFile) {
			logoFile.open();
			return;
		}
		//Extend the wp.media object
		logoFile = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Logo',
			button: {
				text: 'Select'
			},
			multiple: false
		});

		//When a file is selected, grab the URL and set it as the text field's value
		logoFile.on('select', function () {
			selectedLogo = logoFile.state().get('selection');
			let logo = selectedLogo.toJSON()[0];
			btn.parent().find("input").val(logo.url);
			btn.parent().find(".logo_preview img").attr("src", logo.url);
		});

		//Open the uploader dialog
		logoFile.open();
	});


	$("#add_link").on("click", function(e){
		e.preventDefault();
		let id = new Date().getTime();
		let linkel = `<li> <span class="delete_link">+</span> <div class="fitem"> <label for="cat-${id}"> Category</label> <select id="cat-${id}" name="aff_links[${id}][category]"> <option value="men">Men</option> <option value="women">Women</option> </select> </div> <div class="fitem"> <label>Logo</label> <button class="button-secondary upload__link_logo">Upload</button> <input type="hidden" name="aff_links[${id}][logo]"> <div class="logo_preview"> <img src=""> </div> </div> <div class="fitem"> <label for="oprice-${id}">Highest price</label> <input id="oprice-${id}" type="number" name="aff_links[${id}][original_price]"> </div> <div class="fitem"> <label for="cprice-${id}">Lowest price</label> <input id="cprice-${id}" type="number" name="aff_links[${id}][current_price]"> </div> <div class="fitem"> <label for="link-${id}">Affiliate Link</label> <input id="link-${id}" type="url" name="aff_links[${id}][affiliate_link]"> </div> </li>`;

		$("#afflinks ul").append(linkel);
	});

	$(document).on("click", ".delete_link", function(){
		$(this).parent().remove();
	});
});
