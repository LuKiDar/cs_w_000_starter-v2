/**
 * Block / Example
 */

(function (){
	'use strict';

	document.addEventListener('DOMContentLoaded', function (){
		if ( document.querySelectorAll('.block-example').length>0 ){
			document.querySelectorAll('.block-example').forEach(function (item){
                console.log('block-example');
                console.log(item);
			});
		}
	});

})();