/**
 * Modal
 */

(function (){
	'use strict';

	/*** Open modal **/
	function openModal(modalID){
		if ( document.getElementById(modalID) ){
			document.body.classList.add('is-modal-active');
			document.getElementById(modalID).classList.add('is-active');
		}
	}

	/*** Close modal **/
	function closeModal(modalID, removeModal=false){
		[].forEach.call(document.querySelectorAll('#'+ modalID +' .modal__close-button'), function (item){
			item.addEventListener('click', function (e){
				document.body.classList.remove('is-modal-active');
				document.getElementById(modalID).classList.remove('is-active');

				if ( removeModal ){
					setTimeout(function (){
						let modalElem = document.getElementById(modalID);
						modalElem.parentNode.removeChild(modalElem);
					}, 100);
				}
			});
		});

		document.getElementById(modalID).addEventListener('click', function (e){
			if ( e.target.id===modalID){
				document.body.classList.remove('is-modal-active');
				document.getElementById(modalID).classList.remove('is-active');
				
				if ( removeModal ){
					setTimeout(function (){
						let modalElem = document.getElementById(modalID);
						modalElem.parentNode.removeChild(modalElem);
					}, 100);
				}
			}
		});
	}

	/*** Init ***/
	document.addEventListener('DOMContentLoaded', function (){
		if ( document.querySelectorAll('[data-modal*="modal-"]').length>0 ){
			[].forEach.call(document.querySelectorAll('[data-modal*="modal-"]'), function (item){
				item.addEventListener('click', function (e){
					e.preventDefault();

					openModal(item.dataset.modal);
					closeModal(item.dataset.modal);
				});
			});
		}
	});

})();