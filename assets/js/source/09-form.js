/*
 * Form
 */

(function (){
	'use strict';

	/*** Custom input[type=file] ***/
	document.addEventListener('DOMContentLoaded', function (){
		if ( document.querySelectorAll('input[type=file]').length>0 ){
			[].forEach.call(document.querySelectorAll('input[type=file]'), function (item){
				let fileWrapper = document.createElement('label');
				fileWrapper.htmlFor = item.id;
				fileWrapper.classList.add('custom-fileupload');

				item.parentNode.insertBefore(fileWrapper, item);
				fileWrapper.appendChild(item);
				
				let fileButton = document.createElement('span');
				fileButton.classList.add('custom-fileupload__button');
				fileButton.innerHTML = 'Choose a file';

				fileWrapper.appendChild(fileButton);

				let fileInput = document.createElement('span');
				fileInput.type = 'text';
				fileInput.classList.add('custom-fileupload__input');
				fileInput.innerHTML = 'No file chosen';
				const fileInput_val = fileInput.innerHTML;

				fileWrapper.appendChild(fileInput);

				item.addEventListener('change', function (e){
					let file_name = '';

					if ( this.files && this.files.length>1 ){
						file_name = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
					} else {
						file_name = e.target.value.split('\\').pop();
					}

					if ( file_name ){
						fileInput.classList.remove('placeholder');
						fileInput.innerHTML = file_name;
					} else {
						fileInput.classList.add('placeholder');
						fileInput.innerHTML = fileInput_val;
					}
				});
			});
		}
	});


	/*** Custom select ***/
	document.addEventListener('DOMContentLoaded', function (){
		if ( document.querySelectorAll('.custom-select--links').length>0 ){
			[].forEach.call(document.querySelectorAll('.custom-select--links'), function (select){
				let selectTitle = select.querySelector('.custom-select__title');

				selectTitle.addEventListener('click', function (e){
					select.classList.toggle('is-active');
				}, false);
			});
		}
	});
})();