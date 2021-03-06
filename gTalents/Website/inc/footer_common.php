	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

    <script src="js/materialize.min.js"></script>

    <!-- complementos -->
    <script src="js/responsiveslides.min.js"></script>
	<script src="js/jquery.nicescroll.js"></script>

	<!--EFECTO SCROLL-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-smoove/0.2.8/jquery.smoove.min.js"></script>
	<script type="text/javascript" src="js/jquery.smoove.js"></script>
	<script type="text/javascript" src="js/jquery-loader.js"></script>

	<!--BANDERAS TELEFONO-->
	<script src="js/intlTelInput.js"></script>

	<!-- UPLOAD-->
	<script src="js/custom-file-input.js"></script>

	<!--ESTRELLAS-->
	<script src="js/jquery.barrating.js"></script>
	<script src="js/examples-barrating.js"></script>

	<!--SCRIPT PROPIOS-->
	<script>
	    $(document).ready(
	    	function() { 
	    		//INICIALIZAR NICESCROLL
	    		$("html").niceScroll({cursorwidth:"12px" , zindex:"9" , cursorborder:"0px", cursorborderradius:"0px"});

	    		$(".modalText, .historial-status").niceScroll({cursorwidth:"12px" , zindex:"9999" , cursorborder:"0px", cursorborderradius:"0px"});

	    		$(".alerts-div, .team, .message-body, .message-main-contact ").niceScroll({cursorwidth:"7px" , zindex:"3" , cursorborder:"0px", cursorborderradius:"0px"});

	    		//Iniciar selectores
				$('select').material_select();

			    //ANIMACION SCROLL
			    $(".bloque").smoove({
			    	offset:'10%'
			    });

			    //RSLIDER
			    $(".rslides").responsiveSlides({
			    	speed: 600,
			    	timeout: 10000
			    });

			    //INICIANDO SLIDER MATERIALICE
			    $('.slider').slider({full_width: true});

			    //INICIADO ACORDEON EN CALIFICACIONES
				$('.collapsible').collapsible();

				//TABS
				$('ul.tabs').tabs();

			    //MAPA DE CONTACTO
			    $("#btn-contact").click(function(){
					$(".contact").fadeToggle('medium');
				})
			   
			   //INICIALIZAR MODALES
			   $('.modal-trigger').leanModal();
			   /*$('.modal').modal();*/

			   //MENU HAMBURGUESA
			    $("#btn-menuHamburguer").click(function(){
					$("nav ul , .hamburguer-1 , .hamburguer-2").fadeToggle('medium');
				})

			   //ACTIVAR RECOVER PASSWORD
			   $('#btn-recover').click(function(){
			   		$("#login-container").hide("slow");
			   		$("#recover-container").show("slow");
			   })

			   //ACTIVAR LOGIN
			   $('#btn-returnContainer').click(function(){
			   		$("#recover-container").hide("slow");
			   		$("#login-container").show("slow");
			   })

			   //ACTIVAR SUB-OPCIONES 1 en confirmacion de registro
			    $(".subopciones-tag, .subopciones-tag2").click(function(){
					$(this).next().fadeToggle('medium')
				})

			   //ACTIVAR SUB-OPCIONES 2 en confirmacion de registro
			    $(".subopciones-select li a").click(function(){
					$(this).toggleClass('active-option')
				})


				//NUEVA CERTIFICACION en confirmacion de registro
			    $("#btn-certificado").click(function(){
					$("#select-certificado").clone().appendTo("#new-certify");
				})

				//CONFIRMACION DE REGISTRO
					//PASO 1-1 a 1-2
				$("#btn-next-confirm1").click(function(){
					$("#paso1-2, #btn-return-confirm1, #btn-next-confirm2").show("slow");
					$("#paso1-1 , #btn-next-confirm1").hide("slow");					
				})

					//REGRESAR
				$("#btn-return-confirm1").click(function(){
					$("#paso1-1, #btn-next-confirm1").show("slow");
					$("#paso1-2 , #btn-return-confirm1, #btn-next-confirm2").hide("slow");
				})

				//PASO 1-2 a 1-3
				$("#btn-next-confirm2").click(function(){
					$("#paso1-3, #btn-return-confirm2, #btn-next-confirm3").show("slow");
					$("#paso1-2, #btn-return-confirm1, #btn-next-confirm2").hide("slow");					
				})

					//REGRESAR
				$("#btn-return-confirm2").click(function(){
					$("#paso1-2, #btn-return-confirm1, #btn-next-confirm2").show("slow");
					$("#paso1-3, #btn-return-confirm2, #btn-next-confirm3").hide("slow");
				})		

				//PASO 1-3 a 2-1
				$("#btn-next-confirm3").click(function(){
					$("#paso2-1, #btn-return-confirm3, #btn-next-confirm4").show("slow");
					$("#paso1-3, #btn-return-confirm2, #btn-next-confirm3").hide("slow");

					//CAMBIAR LEYENDA
					$("#btn-antecentesConfirm").addClass("active");
					$("#btn-infoContactoConfirm,btn-preferenciasConfirm, btn-infoLegalConfirm").removeClass("active");
				})

					//REGRESAR
				$("#btn-return-confirm3").click(function(){
					$("#paso1-3, #btn-return-confirm2, #btn-next-confirm3").show("slow");
					$("#paso2-1, #btn-return-confirm3, #btn-next-confirm4").hide("slow");

					//CAMBIAR LEYENDA
					$("#btn-infoContactoConfirm").addClass("active");
					$("#btn-antecentesConfirm, btn-preferenciasConfirm, btn-infoLegalConfirm").removeClass("active");
				})

				//PASO 2-1 a 2-2
				$("#btn-next-confirm4").click(function(){
					$("#paso2-2, #btn-return-confirm4, #btn-next-confirm5").show("slow");
					$("#paso2-1, #btn-return-confirm3, #btn-next-confirm4").hide("slow");
				})

					//REGRESAR
				$("#btn-return-confirm4").click(function(){
					$("#paso2-1, #btn-return-confirm3, #btn-next-confirm4").show("slow");
					$("#paso2-2, #btn-return-confirm4, #btn-next-confirm5").hide("slow");
				})

				//PASO 2-2 a 3
				$("#btn-next-confirm5").click(function(){
					$("#paso3, #btn-return-confirm5, #btn-next-confirm6").show("slow");
					$("#paso2-2, #btn-return-confirm4, #btn-next-confirm5").hide("slow");

					//CAMBIAR LEYENDA
					$("#btn-preferenciasConfirm").addClass("active");
					$("#btn-antecentesConfirm, #btn-infoContactoConfirm, #btn-infoLegalConfirm").removeClass("active");
				})

					//REGRESAR
				$("#btn-return-confirm5").click(function(){
					$("#paso2-2, #btn-return-confirm4, #btn-next-confirm5").show("slow");
					$("#paso3, #btn-return-confirm5, #btn-next-confirm6").hide("slow");

					//CAMBIAR LEYENDA
					$("#btn-antecentesConfirm").addClass("active");
					$("#btn-infoContactoConfirm, #btn-preferenciasConfirm, #btn-infoLegalConfirm").removeClass("active");
				})

				//PASO 3 a 4-1
				$("#btn-next-confirm6").click(function(){
					$("#paso4-1, #btn-return-confirm6, #btn-next-confirm7").show("slow");
					$("#paso3, #btn-return-confirm5, #btn-next-confirm6").hide("slow");

					//CAMBIAR LEYENDA
					$("#btn-infoLegalConfirm").addClass("active");
					$("#btn-preferenciasConfirm,#btn-antecentesConfirm, #btn-infoContactoConfirm").removeClass("active");
				})

					//REGRESAR
				$("#btn-return-confirm6").click(function(){
					$("#paso3, #btn-return-confirm5, #btn-next-confirm6").show("slow");
					$("#paso4-1, #btn-return-confirm6, #btn-next-confirm7").hide("slow");

					//CAMBIAR LEYENDA
					$("#btn-preferenciasConfirm").addClass("active");
					$("#btn-antecentesConfirm, #btn-infoContactoConfirm, #btn-infoLegalConfirm").removeClass("active");
				})

				//PASO 4-1 a 4-2
				$("#btn-next-confirm7").click(function(){
					$("#paso4-2, #btn-return-confirm7, #btn-next-confirm8").show("slow");
					$("#paso4-1, #btn-return-confirm6, #btn-next-confirm7").hide("slow");
				})

					//REGRESAR
				$("#btn-return-confirm7").click(function(){
					$("#paso4-1, #btn-return-confirm6, #btn-next-confirm7").show("slow");
					$("#paso4-2, #btn-return-confirm7, #btn-next-confirm8").hide("slow");
				})

				//PASO 4-2 a 4-3
				$("#btn-next-confirm8").click(function(){
					$("#paso4-3").show("slow");
					$("#paso4-2, #btn-return-confirm7, #btn-next-confirm8").hide("slow");
				})

				//EFECTO HEADER
				$(window).scroll(function() {
					var alto_rslides = $('.header-index').height()
					if ($(document).scrollTop() > alto_rslides) {
						$('.header-index header').addClass('sticky');
					}
					else {
						$('.header-index header').removeClass('sticky')
					}
				});

				//ANIMACION ENTRE ANCLAS
				/*$(function() {
				  $('a[href*="#"]:not([href="#"])').click(function() {
				    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				      var target = $(this.hash);
				      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				      if (target.length) {
				        $('html, body').animate({
				          scrollTop: target.offset().top
				        }, 1000);
				        return false;
				      }
				    }
				  });
				});*/


				//INDEX-REGISTRADO
				//DESPLEGAR TODA LA LISTA
				$(".btn-viewMore").click(function(){

					$(this).parent().parent().find('.listado-post').toggleClass("ul-complete");
					$(this).parent().parent().find('.pagination').toggleClass("pagination-on");

					$(this).html($(this).text() == 'ver menos' ? 'ver más' : 'ver menos');
				})

				//ELIMINAR UNA ALERTA
				$(".close-alert").click(function(){
					$(this).parent().fadeOut(); 
				})

				//ACTIVAR BUSCADOR DE CANDIDATOS
				$(".btn-search").click(function(){
					$(".active-one").hide();
					$(".active-two").fadeToggle('medium');
				})

				$(".btn-closeInput").click(function(){
					$(".active-two").hide();
					$(".active-one").fadeToggle('medium');
				})

				//TEAM - CANDIDATOS MOBILE
				$("#btn-teamMobile").click(function(){
					$("#teamMobile-container").fadeToggle('medium');
				})

				//MENSAJE CONFIRMACION MODAL REGISTRADO
				$("#btn-modalMain").click(function(){
					$(".formLogin").hide();
					$(".messageModal").fadeToggle('medium');
				})


				//CREAR POST
				//PASO 1 A PASO 2
				$("#next-newPost1").click(function(){
					$("#crear-container").hide();
					$("#detail-container").toggleClass("pagination-on");
					$("#indi-create , #indi-detail").toggleClass("active");
				})

				//PASO 2 A PASO 1
				$("#return-newPost1").click(function(){
					$("#detail-container").removeClass("pagination-on");
					$("#crear-container").addClass("pagination-on");
					$("#indi-create , #indi-detail").toggleClass("active");
				})

				//PASO 2 A PASO 3
				$("#next-newPost2").click(function(){
					$("#detail-container").hide();
					$("#go-container, #detail-container").toggleClass("pagination-on");
					$("#indi-go , #indi-detail").toggleClass("active");
				})

				//ALERTAS EN EL NAV
				$("#btn-alertNav").click(function(){
					$("#alertNavContain").toggleClass("pagination-on");
				})


	    	}
	    );
	</script>
	
	<!-- SCRIPT PARA BANDERAS DE TELEFONOS -->
	<script>
	    $("#phone").intlTelInput({
			// allowDropdown: false,
			// autoHideDialCode: false,
			// autoPlaceholder: "off",
			// dropdownContainer: "body",
			// excludeCountries: ["us"],
			// formatOnDisplay: false,
			// geoIpLookup: function(callback) {
			//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
			//     var countryCode = (resp && resp.country) ? resp.country : "";
			//     callback(countryCode);
			//   });
			// },
			// initialCountry: "auto",
			// nationalMode: false,
			// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
			// placeholderNumberType: "MOBILE",
			// preferredCountries: ['cn', 'jp'],
			// separateDialCode: true,
			utilsScript: "js/utils.js"
	    });
	</script>