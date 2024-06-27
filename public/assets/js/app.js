!function(r){"use strict";function a(){for(var e=document.getElementById("topnav-menu-content").getElementsByTagName("a"),t=0,n=e.length;t<n;t++)"nav-item dropdown active"===e[t].parentElement.getAttribute("class")&&(e[t].parentElement.classList.remove("active"),e[t].nextElementSibling.classList.remove("show"))}function o(e){if(null!==document.getElementById(e)){var t=document.getElementById(e).getAttribute("data-colors");if(t)return(t=JSON.parse(t)).map(function(e){var t=e.replace(" ","");if(-1===t.indexOf(",")){var n=getComputedStyle(document.documentElement).getPropertyValue(t);return n||t}e=e.split(",");return 2!=e.length?t:"rgba("+getComputedStyle(document.documentElement).getPropertyValue(e[0])+","+e[1]+")"});console.warn("data-colors Attribute not found on:",e)}}function e(t,n,a){document.querySelectorAll(".theme-color").forEach(function(e){e.addEventListener("click",function(e){setTimeout(function(){var e=o(a);n.barColor=e,r("#"+a).sparkline(t,n)},0)})})}function t(e){1==r("#light-mode-switch").prop("checked")&&"light-mode-switch"===e?(r("#dark-mode-switch").prop("checked",!1),document.body.setAttribute("data-bs-theme","light"),sessionStorage.setItem("is_visited","light-mode-switch")):1==r("#dark-mode-switch").prop("checked")&&"dark-mode-switch"===e?(1==r("#rtl-mode-switch").prop("checked")?r("html").attr("dir","rtl"):r("html").removeAttr("dir"),r("#light-mode-switch").prop("checked",!1),document.body.setAttribute("data-bs-theme","dark"),sessionStorage.setItem("is_visited","dark-mode-switch")):1==r("#rtl-mode-switch").prop("checked")&&"rtl-mode-switch"===e?(r("html").attr("dir","rtl"),r("#light-mode-switch").prop("checked",!1),r("#dark-mode-switch").prop("checked",!1),r("#bootstrap-style").attr("href","assets/css/bootstrap-rtl.min.css"),r("#app-style").attr("href","assets/css/app-rtl.min.css"),r("html").attr("dir","rtl"),sessionStorage.setItem("is_visited","rtl-mode-switch")):0==r("#rtl-mode-switch").prop("checked")&&"rtl-mode-switch"===e&&(r("html").removeAttr("dir"),r("#bootstrap-style").attr("href","assets/css/bootstrap.min.css"),r("#app-style").attr("href","assets/css/app.min.css"))}function n(){document.webkitIsFullScreen||document.mozFullScreen||document.msFullscreenElement||(console.log("pressed"),r("body").removeClass("fullscreen-enable"))}var s,c,l;r("#side-menu").metisMenu(),r("#vertical-menu-btn").on("click",function(e){e.preventDefault(),r("body").toggleClass("sidebar-enable"),992<=r(window).width()?r("body").toggleClass("vertical-collpsed"):r("body").removeClass("vertical-collpsed")}),r("#sidebar-menu a").each(function(){var e=window.location.href.split(/[?#]/)[0];this.href==e&&(r(this).addClass("active"),r(this).parent().addClass("mm-active"),r(this).parent().parent().addClass("mm-show"),r(this).parent().parent().prev().addClass("mm-active"),r(this).parent().parent().parent().addClass("mm-active"),r(this).parent().parent().parent().parent().addClass("mm-show"),r(this).parent().parent().parent().parent().parent().addClass("mm-active"))}),r(".navbar-nav a").each(function(){var e=window.location.href.split(/[?#]/)[0];this.href==e&&(r(this).addClass("active"),r(this).parent().addClass("active"),r(this).parent().parent().addClass("active"),r(this).parent().parent().parent().addClass("active"),r(this).parent().parent().parent().parent().addClass("active"),r(this).parent().parent().parent().parent().parent().addClass("active"),r(this).parent().parent().parent().parent().parent().parent().addClass("active"))}),r('[data-toggle="fullscreen"]').on("click",function(e){e.preventDefault(),r("body").toggleClass("fullscreen-enable"),document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement?document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen&&document.webkitCancelFullScreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)}),document.addEventListener("fullscreenchange",n),document.addEventListener("webkitfullscreenchange",n),document.addEventListener("mozfullscreenchange",n),r(".right-bar-toggle").on("click",function(e){r("body").toggleClass("right-bar-enabled")}),r(document).on("click","body",function(e){0<r(e.target).closest(".right-bar-toggle, .right-bar").length||r("body").removeClass("right-bar-enabled")}),function(){if(document.getElementById("topnav-menu-content")){for(var e=document.getElementById("topnav-menu-content").getElementsByTagName("a"),t=0,n=e.length;t<n;t++)e[t].onclick=function(e){"#"===e.target.getAttribute("href")&&(e.target.parentElement.classList.toggle("active"),e.target.nextElementSibling.classList.toggle("show"))};window.addEventListener("resize",a)}}(),[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(e){return new bootstrap.Tooltip(e)}),[].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function(e){return new bootstrap.Popover(e)}),window.sessionStorage&&((l=sessionStorage.getItem("is_visited"))?(r(".right-bar input:checkbox").prop("checked",!1),r("#"+l).prop("checked",!0),t(l)):sessionStorage.setItem("is_visited","light-mode-switch")),r("#light-mode-switch, #dark-mode-switch, #rtl-mode-switch").on("change",function(e){t(e.target.id)}),l=o("header-chart-1"),console.log(l),l&&(s=[8,6,4,7,10,12,7,4,9,12,13,11,12],c={type:"bar",height:"35",barWidth:"5",barSpacing:"3",barColor:l},r("#header-chart-1").sparkline(s,c),e(s,c,"header-chart-1")),(l=o("header-chart-2"))&&(s=[8,6,4,7,10,12,7,4,9,12,13,11,12],c={type:"bar",height:"35",barWidth:"5",barSpacing:"3",barColor:l},r("#header-chart-2").sparkline(s,c),e(s,c,"header-chart-2")),r(window).on("load",function(){r("#status").fadeOut(),r("#preloader").delay(350).fadeOut("slow")}),Waves.init()}(jQuery);