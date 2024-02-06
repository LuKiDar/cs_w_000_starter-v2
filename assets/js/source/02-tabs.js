/**
 * Tabs
 */

(function (){
	'use strict';

	document.addEventListener('DOMContentLoaded', function (){
		if ( document.querySelectorAll('.tabs').length>0 ){
			[].forEach.call(document.querySelectorAll('.tabs__title'), function (item){
				item.addEventListener('click', function (e){
					e.preventDefault();

					const targetId = item.dataset.tab;
					const isActiveCurrentTitle = item.classList.contains('is-active');
					
					// Remove active state
					[].forEach.call(document.querySelectorAll('.is-active'), function (title){
						title.classList.remove('is-active');
					});
					[].forEach.call(document.querySelectorAll('.is-active'), function (content){
						content.classList.remove('is-active');
					});

					if ( isActiveCurrentTitle===false ){
						// Add active state
						[].forEach.call(document.querySelectorAll('.tabs__title[data-tab="'+ targetId +'"]'), function (title){
							title.classList.add('is-active');
						});
						document.querySelector('#'+ targetId).classList.add('is-active');
					}
				});
			});
		}
	});

})();