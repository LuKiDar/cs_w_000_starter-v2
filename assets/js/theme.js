(()=>{function e(){10<window.scrollY?document.body.classList.add("is-scrolled"):document.body.classList.remove("is-scrolled")}document.addEventListener("DOMContentLoaded",function(){document.getElementById("navbar-toggle").addEventListener("click",function(e){document.body.classList.toggle("is-menu-active")})}),document.addEventListener("DOMContentLoaded",e),window.addEventListener("scroll",e),document.addEventListener("DOMContentLoaded",function(){0<document.querySelectorAll('a[href^="#slide-"]').length&&[].forEach.call(document.querySelectorAll('a[href^="#slide-"]'),function(n){n.addEventListener("click",function(t){if(t.preventDefault(),document.getElementById(n.getAttribute("href").replace("#",""))){t=n.getAttribute("href").replace("#","");let e=document.getElementById(t).getBoundingClientRect().top+window.scrollY-document.getElementById("header").offsetHeight;0<document.querySelectorAll("#wpadminbar").length&&(e-=document.getElementById("wpadminbar").offsetHeight),window.scroll({top:e,behavior:"smooth"})}})})})})(),document.addEventListener("DOMContentLoaded",function(){0<document.querySelectorAll('[data-modal*="modal-"]').length&&[].forEach.call(document.querySelectorAll('[data-modal*="modal-"]'),function(c){c.addEventListener("click",function(e){var t,n;e.preventDefault(),e=c.dataset.modal,document.getElementById(e)&&(document.body.classList.add("is-modal-active"),document.getElementById(e).classList.add("is-active")),t=c.dataset.modal,n=!1,[].forEach.call(document.querySelectorAll("#"+t+" .modal__close-button"),function(e){e.addEventListener("click",function(e){document.body.classList.remove("is-modal-active"),document.getElementById(t).classList.remove("is-active"),n&&setTimeout(function(){var e=document.getElementById(t);e.parentNode.removeChild(e)},100)})}),document.getElementById(t).addEventListener("click",function(e){e.target.id===t&&(document.body.classList.remove("is-modal-active"),document.getElementById(t).classList.remove("is-active"),n)&&setTimeout(function(){var e=document.getElementById(t);e.parentNode.removeChild(e)},100)})})})}),document.addEventListener("DOMContentLoaded",function(){0<document.querySelectorAll(".tabs").length&&[].forEach.call(document.querySelectorAll(".tabs__title"),function(n){n.addEventListener("click",function(e){e.preventDefault();var e=n.dataset.tab,t=n.classList.contains("is-active");[].forEach.call(document.querySelectorAll(".is-active"),function(e){e.classList.remove("is-active")}),[].forEach.call(document.querySelectorAll(".is-active"),function(e){e.classList.remove("is-active")}),!1===t&&([].forEach.call(document.querySelectorAll('.tabs__title[data-tab="'+e+'"]'),function(e){e.classList.add("is-active")}),document.querySelector("#"+e).classList.add("is-active"))})})}),(()=>{function t(e){let t=e.target;t!==document&&(e=(t=t.classList.contains("accordion__header")?t:t.closest(".accordion__header")).nextElementSibling,t.classList.toggle("is-active"),e.classList.contains("is-active")?(e.classList.remove("is-active"),e.style.maxHeight=null):(e.classList.add("is-active"),e.style.maxHeight=e.scrollHeight+"px"))}document.addEventListener("DOMContentLoaded",function(){0<document.getElementsByClassName("accordion").length&&[].forEach.call(document.querySelectorAll(".accordion__header"),function(e){e.addEventListener("click",function(e){t(e)}),e.addEventListener("keydown",function(e){13!==e.keyCode&&32!==e.keyCode||t(e)})})})})(),document.addEventListener("DOMContentLoaded",function(){0<document.querySelectorAll("input[type=file]").length&&[].forEach.call(document.querySelectorAll("input[type=file]"),function(e){var t=document.createElement("label"),n=(t.htmlFor=e.id,t.classList.add("custom-fileupload"),e.parentNode.insertBefore(t,e),t.appendChild(e),document.createElement("span"));n.classList.add("custom-fileupload__button"),n.innerHTML="Choose a file",t.appendChild(n);let c=document.createElement("span"),o=(c.type="text",c.classList.add("custom-fileupload__input"),c.innerHTML="No file chosen",c.innerHTML);t.appendChild(c),e.addEventListener("change",function(e){let t="";(t=this.files&&1<this.files.length?(this.getAttribute("data-multiple-caption")||"").replace("{count}",this.files.length):e.target.value.split("\\").pop())?(c.classList.remove("placeholder"),c.innerHTML=t):(c.classList.add("placeholder"),c.innerHTML=o)})})}),document.addEventListener("DOMContentLoaded",function(){0<document.querySelectorAll(".custom-select--links").length&&[].forEach.call(document.querySelectorAll(".custom-select--links"),function(t){t.querySelector(".custom-select__title").addEventListener("click",function(e){t.classList.toggle("is-active")},!1)})});