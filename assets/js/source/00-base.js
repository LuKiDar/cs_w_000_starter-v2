/**
 * Base
 */

(function (){
	'use strict';

	/*** Header ***/
	document.addEventListener('DOMContentLoaded', function (){
		document.getElementById('toggle').addEventListener('click', function (e){
			document.body.classList.toggle('is-menu-active');
		});
	});
	
	// Check if scrolled
	function isScrolled(){
		const scrollpos = window.scrollY;
	
		if ( scrollpos>10 ){
			document.body.classList.add('is-scrolled');
		}
		else {
			document.body.classList.remove('is-scrolled');
		}
	}
	document.addEventListener('DOMContentLoaded', isScrolled);
	window.addEventListener('scroll', isScrolled);


	/*** Slide to section on anchor ***/
	document.addEventListener('DOMContentLoaded', function (){
		if ( document.querySelectorAll('a[href^="#slide-"]').length>0 ){
			[].forEach.call(document.querySelectorAll('a[href^="#slide-"]'), function (item){
				item.addEventListener('click', function (e){
					e.preventDefault();

					if ( document.getElementById( item.getAttribute('href').replace('#', '') ) ){
						let targetId = item.getAttribute('href').replace('#', '');
						let targetOffsetTop = document.getElementById(targetId).getBoundingClientRect().top + window.scrollY - document.getElementById('header').offsetHeight;

						if ( document.querySelectorAll('#wpadminbar').length>0 ){
							targetOffsetTop -= document.getElementById('wpadminbar').offsetHeight;
						}

						window.scroll({
							top: targetOffsetTop,
							behavior: 'smooth'
						});
					}
				});
			});
		}
	});

})();