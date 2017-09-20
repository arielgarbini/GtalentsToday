@extends('layouts.master')
	@section('metadata')
		@parent
	@stop
	@section('title')
		@parent
	@stop
	@section('css')
		@parent
	@stop

@section('content')
<body>
<article class="header-index" id="index">
		@include('partials.navigation')

		<!-- MENSAJE PRINCIPAL-->
		<section class="message">
			<h3>{{ trans('home.How to connect Executive Recruiters around the world') }}
			<p style="font-size: medium;">{{ trans('home.Present candidates, post positions confidentially.') }}<br>
			{{ trans('home.gTalents, the platform that connects Executive Recruiters around the globe.') }}</p></h3><br>
			<div class="message-link">
				<a href="{{URL('loginuser')}}" class="btn-main2">{{ trans('home.Start') }}</a>
			</div>
			<div class="vineta1"></div>
		</section>
		
		<!--GALERIA IMAGENES-->
		<!-- PC-->
		<ul class="rslides pc">
			<li><img src="assets/img/slider-1.png" alt=""></li>
			<li><img src="assets/img/slider-2.png" alt=""></li>
			<li><img src="assets/img/slider-3.png" alt=""></li>
			<li><img src="assets/img/slider-4.png" alt=""></li>
			<li><img src="assets/img/slider-5.png" alt=""></li>
		</ul>

		<!-- TABLET-->
		<ul class="rslides tablet">
			<li><img src="assets/img/slider-1-tablet.png" alt=""></li>
			<li><img src="assets/img/slider-2-tablet.png" alt=""></li>
			<li><img src="assets/img/slider-3-tablet.png" alt=""></li>
			<li><img src="assets/img/slider-4-tablet.png" alt=""></li>
			<li><img src="assets/img/slider-5-tablet.png" alt=""></li>
		</ul>

		<!-- MOBILE-->
		<ul class="rslides mobile">
			<li><img src="assets/img/slider-1-mobile.png" alt=""></li>
			<li><img src="assets/img/slider-2-mobile.png" alt=""></li>
			<li><img src="assets/img/slider-3-mobile.png" alt=""></li>
			<li><img src="assets/img/slider-4-mobile.png" alt=""></li>
			<li><img src="assets/img/slider-5-mobile.png" alt=""></li>
		</ul>
</article>

	<!-- PORQUE GTALENTS-->
	<article class="generic grid" id="pqGtalents">
		<!--TITULO DE LA SECCION-->
		<section class="generic-title first-padding bloque">
			<h2> {{ trans('home.Why join') }} <strong>gTalents</strong>?</h2>
		</section>

		<!--TEXTO DE LA SECCION-->
		<section class="paragraph bloque">
			<p>{{ trans('home.We are the most trusted technology platform created and designed by experienced Executive Recruiters for Executive Recruiters, efficiently connecting them around the world to post positions, send and receive candidates and increase revenue.') }}</p>
		</section>
		
		<!--SKILL GTALENTS-->
		<section class="row generic-skill bloque">
			<!-- ALTA CARGA DE TRABAJO-->
			<div class="col s6 item">
				<figure>
					<span class="icon-gTalents_alta-carga"></span>
				</figure>
				<h3>{{ trans('home.HIGH LOAD OF WORK? LOW VOLUME OF SEARCHES') }}</h3>
				<p>{{ trans('home.Share a publication, share candidates.') }} </p>
			</div>

			<!-- FUERA DE TU AREA DE EXPERTISE-->
			<div class="col s6 item">
				<figure>
					<span class="icon-gTalents_area"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span><span class="path14"></span><span class="path15"></span><span class="path16"></span><span class="path17"></span><span class="path18"></span><span class="path19"></span><span class="path20"></span><span class="path21"></span><span class="path22"></span><span class="path23"></span><span class="path24"></span><span class="path25"></span><span class="path26"></span><span class="path27"></span><span class="path28"></span><span class="path29"></span><span class="path30"></span><span class="path31"></span><span class="path32"></span><span class="path33"></span><span class="path34"></span><span class="path35"></span><span class="path36"></span><span class="path37"></span><span class="path38"></span><span class="path39"></span><span class="path40"></span><span class="path41"></span><span class="path42"></span><span class="path43"></span><span class="path44"></span><span class="path45"></span><span class="path46"></span><span class="path47"></span><span class="path48"></span><span class="path49"></span><span class="path50"></span><span class="path51"></span><span class="path52"></span><span class="path53"></span><span class="path54"></span><span class="path55"></span><span class="path56"></span><span class="path57"></span><span class="path58"></span><span class="path59"></span></span>
				</figure>
				<h3> {{ trans('home.Outside your area of ​​expertise and geographical area') }}</h3>
				<p> {{ trans('home.Leave it to the local experts and deliver excellent results for your global customers.') }} </p>
			</div>

			<!-- ALTO VOLUMEN DE BUSQUEDAS-->
			<div class="col s6 item">
				<figure>
					<span class="icon-gTalents_search-team"></span>
				</figure>
				<h3> {{ trans('home.HIGH VOLUME OF SEARCHES BUT LOW DELIVERY FORCE') }} </h3>
				<p>{{ trans('home.If you have strong business skills and a strong network of contacts but not enough resources to execute the searches, you share a publication and receive qualified candidates within the first week.') }}
				</p>
			</div>

			<!--SOLIDA FUERZA DE ENTREGA-->
			<div class="col s6 item">
				<figure>
					<span class="icon-gTalents_sleep"></span>
				</figure>
				<h3> {{ trans('home.SOLID DELIVERY STRENGTH BUT LOW VOLUME') }} </h3>
				<p>   {{ trans('home.If you have strong search skills and a solid database but not enough resources to get new clients, find a publication, send qualified candidates and make placements') }} </p>
			</div>
		</section>
	</article>

	<!--VENTAJAS-->
	<article class="titleWin ventajas first-margin bloque" id="ventajas">

		<section class="titleWin-container">
			<h2> {{ trans('home.The advantages of gTalents') }}</h2>
			<p> {{ trans('home.We are an innovative technology platform with a sophisticated data analysis engine that will work 24/7 for you. Together with our experienced consultants who will review the behavior of all activities on the platform')  }} </p>
			<div class="titleWin-container-link">
				<a href="#modalVentajas" class=" modal-trigger waves-effect waves-light btn-main2"> {{ trans('home.Read more') }}  </a>
			</div>
			<div class="vineta2"></div>			
		</section>
	</article>

	<!-- PASOS SENCILLOS PARA COMENZAR-->
	<article class="generic grid" id="comoComenzar">
		<!--TITULO DE LA SECCION-->
		<section class="generic-title first-padding bloque">
			<h2>  {{ trans('home.The advantages of gTalents Simple steps for')}}  <strong>{{ trans('home.Start') }}</strong>?</h2>
		</section>
		
		<!--PASOS-->
		<section class="generic-skill generic-index bloque">
			<!-- PASO 1-->
			<div class="item">
				<figure>
					<span class="icon-gTalents_one"></span>
				</figure>
				<h3>{{ trans('home.Register')}} </h3>
				<p> {{ trans('home.Create your account with gTalents. All members will remain anonymous for a maximum level of confidentiality of identity, clients and projects')}}  </p>
			</div>

			<!-- PASO 2-->
			<div class="item">
				<figure>
					<span class="icon-gTalents_two"></span>
				</figure>
				<h3>{{ trans('home.Check')}} </h3>
				<p> {{ trans('home.We will contact you to verify your account and have a brief presentation')}} </p>
			</div>

			<!-- PASO 3-->
			<div class="item">
				<figure>
					<span class="icon-gTalents_three"></span>
				</figure>
				<h3> {{ trans('home.Demo')}}  </h3>
				<p> {{ trans('home.We ll easily show you how to use the platform in the most efficient way to maximize profits. This will not take more than 10 minutes')}} </p>
			</div>

			<!--PASO 4-->
			<div class="item">
				<figure>
					<span class="icon-gTalents_four"></span>
				</figure>
				<h3>  {{ trans('home.Create your profile')}}  </h3>
				<p> {{ trans('home.It is very important for us to know the type of projects in which each member is specialized. In this way we can optimize the success rate of all projects')}}   </p>
			</div>

			<!--PASO 5-->
			<div class="item">
				<figure>
					<span class="icon-gTalents_five"></span>
				</figure>
				<h3> {{ trans('home.You are now a member')}} </h3>
				<p> {{ trans('home.You are now a member, your compliance signature will be required')}} </p>
			</div>

			<!--PASO 6-->
			<div class="item">
				<figure>
					<span class="icon-gTalents_six"></span>
				</figure>
				<h3>{{ trans('home.are you ready')}} </h3>
				<p> {{ trans('home.You are ready to increase your income. Post and send candidates')}} </p>
			</div>
		</section>
	</article>

	<!--MEMBRESIAS-->
	<article class="titleWin membresias first-margin bloque" id="membresias">

		<section class="titleWin-container">
			<h2> {{ trans('home.Memberships')}}!</h2>
			<p> {{ trans('home.Build up experience and increase your share / income as you successfully publish and share candidates')}} </p>
			<div class="titleWin-container-link">
				<a href="#modalMembresias" class=" modal-trigger waves-effect waves-light btn-main2">{{ trans('home.Read more') }} </a>
			</div>
			<div class="vineta2"></div>			
		</section>
	</article>

	<!--PREGUNTAS FRECUENTES-->
	<article class="titleWin question bloque" id="question">

		<section class="titleWin-container">
			<h2>  {{ trans('home.Frequently Asked Questions')}}</h2>
			<div class="titleWin-container-link">
				<a href="#modalQuestion" class=" modal-trigger waves-effect waves-light btn-main2">{{ trans('home.Read more') }}</a>
			</div>
			<div class="vineta1"></div>			
		</section>
	</article>
	
	<!--GARANTIAS-->
	<article class="titleWin garantias bloque" id="garantias">

		<section class="titleWin-container">
			<h2> {{ trans('home.Our Guarantees')}} </h2>
			<!--			<p> {{ trans('home.We care to offer you the best experience in our 24/7 technology platform. That is why we invite you to read our guarantees')}}</p>-->
			<div class="titleWin-container-link">
				<a href="#modalGarantias" class=" modal-trigger waves-effect waves-light btn-main2">{{ trans('home.Read more') }}</a>
			</div>
			<div class="vineta1"></div>			
		</section>
	</article>

	<!--CONTACTO-->
	<article class="generic grid contact-index bloque" id="contacto">
		<!--TITULO DE LA SECCION-->
		<section class="generic-title">
			<h2> </h2>
		</section>

		<!--TEXTO DE LA SECCION
		<section class="paragraph">
			<p> {{ trans('home.We will respond to your concerns in a short time')}} </p>
		</section> -->

		<!-- CTA CONTACTO-->
		<div class="link-contact">
			<a href="#!" class="btn-main2" id="btn-contact">{{ trans('home.Contact us')}}!</a>
		</div>		
	</article>

	<!--CONTENEDOR MAPA-->
	<article class="titleWin contact bloque">
		<!--MAPA-->
		
		<!--FORMULARIO DE CONTACTO-->			
		<section class="contact-formulario">
			<!--TITULO
			<div class="title">
				<h3>  {{ trans('home.Tell us about your concerns')}} !</h3>
				<p>  {{ trans('home.We will give you an answer as soon as possible')}}  </p>
			</div> -->


			<!--FORMULARIO-->
			<form action="">
				<!--NOMBRE-->
				<div class="itemForm">
					<input type="text" placeholder="{{ trans('home.Name')}} ">
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
					<input type="email" placeholder="{{ trans('home.Email')}} ">
				</div>

				<!--PAIS-->
				<div class="itemForm">
					<select class="browser-default">
						<option value="" disabled selected>{{ trans('home.Select a country')}} </option>
						@foreach($countries as $country)
							@if($country['name']!='')
							<option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
							@endif
						@endforeach
					</select>
				</div>

				<!--MENSAJE-->
				<div class="itemForm">
					<textarea name="" id="" cols="30" rows="10" placeholder="{{ trans('home.Write your concerns')}}"></textarea>
				</div>

				<!--SUBMIT-->
				<div class="submit">
					<button type="submit" class="btn-main2">{{ trans('home.Send message')}}</button>
				</div>
			</form>
		</section>
	</article>

	<!--MODALES-->
	<!--MODAL VENTAJAS-->
	<div id="modalVentajas" class="modal modalText">
		<!--CERRAR-->
		<div class="modal-footer">
			<a class=" modal-action modal-close waves-effect waves-green btn-flat">
				<span class="icon-gTalents_close"></span>
			</a>
		</div>

		<!--CONTENIDO-->
		<div class="modal-content">
			<!--EFICIENTANDO PROCESOS-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title">
					<span class="icon-gTalents_team-10"></span>
					<h2> {{ trans('home.Eficientando the')}}  <strong> {{ trans('home.Processes')}} </strong></h2>
				</section>

				<!--TEXTO DE LA SECCION-->
				<section class="paragraph">
					<p class="text-left"> {{ trans('home.We are an innovative technology platform with a sophisticated data analysis engine that will work 24/7 for you. Together with our experienced consultants who will personally review the behavior of all activities on the platform, our reports will assign the most efficient signature wherever you are for each particular search, considering all possible factors to optimize all projects')}} </p>
					<p class="text-left"> {{ trans('home.Communicate efficiently with your member through our platform and get all the necessary details to make the placement')}} </p>
				</section>

				<!--PUNTOS-->
				<section class="skill-A">
					<!--PUNTO 1-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.No duplicates, no effort in vain. We maximize the success rate')}} </p>
					</div>

					<!--PUNTO 2-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.The Suppliers will be qualified to present the candidates for each project')}}   </p>
					</div>

					<!--PUNTO 3-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.We do not assign searches to more than 2 different Suppliers')}} </p>
					</div>

					<!--PUNTO 4-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.We choose the best Supplier for each particular search, maximizing the success rate')}} </p>
					</div>

					<!--PUNTO 5-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.Candidates will not be contacted on several occasions for the same position')}}</p>
					</div>

					<!--PUNTO 6-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.High specialization without frontiers')}} </p>
					</div>
				</section>

				<section class="paragraph">
					<p> {{ trans('home.We are a global platform that connects Recruiters and HR Professionals anywhere in the world. Posting a position, within the first week, you will receive solid potential candidates from qualified recruiters with specific expertise in a location, industry or function')}} </p>
				</section>				
			</article>

			<!--PORQUE UNIRSE A GTALENTS-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title bloque">
					<figure>
						<span class="icon-gTalents_isotipo"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>
					</figure>
					<h2> {{ trans('home.Why join') }} <strong>gTalents</strong>?</h2>
				</section>

				<!--PUNTOS-->
				<section class="skill-B">
					<!--PUNTO 1-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.A recruiting firm with international clients will have immediate access to the best talent available in the market in a very short time, especially when they work in searches outside their country or region of origin, industry or specialization') }} </p>
					</div>

					<!--PUNTO 2-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.Your customers will notice that you have increased your geographic reach and experience in other industries immediately') }} </p>
					</div>

					<!--PUNTO 3-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.By posting a vacancy, you will receive candidates during the first few days from a gTalents member, without creating a new contract with your counterpart') }} </p>
					</div>

					<!--PUNTO 4-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.Efficient and transparent communication between members. Get feedback, get all the necessary information and make placements') }} </p>
					</div>

					<!--PUNTO 5-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.Share CVs through our platform and monitor the status of your candidates in real time') }} </p>
					</div>

					<!--PUNTO 6-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.Choose which positions will work based on your area of ​​expertise, we will help you find the best position for your signature') }} </p>
					</div>

					<!--PUNTO 7-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.Registration and free membership. Increase your income' ) }} </p>
					</div>
					<div style="text-align: center;">
					  <a class=" modal-action modal-close waves-effect waves-green btn-main2">
						  {{ trans('home.closeButton' ) }}
					  </a>
					</div>
				</section>			
			</article>

		</div>
	</div>

	<!--MODAL GARANTIAS-->
	<div id="modalGarantias" class="modal modalText">
		<!--CERRAR-->
		<div class="modal-footer">
			<a class=" modal-action modal-close waves-effect waves-green btn-flat">
				<span class="icon-gTalents_close"></span>
			</a>
		</div>

		<!--CONTENIDO-->
		<div class="modal-content">
			<!--GARANTIAS-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title">
					<span class="icon-gTalents_garantia"></span>
					<h2> {{ trans('home.Our' ) }}  <strong> {{ trans('home.Guarantee' ) }}</strong></h2>
				</section>

				<!--TEXTO DE LA SECCION-->
				<section class="paragraph">
					<p class="text-left"> {{ trans('home.In the event that a Poster does not make the 60% payment of the invoice as agreed at the outset, gTalents will continue to GUARANTEE the credit to the Supplier. That is to say, if a candidate generated by a member begins to work within the client, the member will receive the credit of the commission earned by the project and that is a guarantee of gTalents' ) }} </p>

					<p class="text-left">{{ trans('home.In the same way, in case the candidate placed resignation or has been dismissed within the period of relocation agreed at the beginning of the process and the Supplier does not conduct the process of Replacement, the Poster will receive the full credit for this project' ) }} </p>

					<p class="text-left">
						{{ trans('home.We do not assign searches to more than 2 different Suppliers. Candidates will not be contacted on several occasions for the same position. The Suppliers will be qualified to present the indicated candidates for each project to do the placement' ) }} 
					</p>

					<p class="text-left">
						{{ trans('home.In this way, we choose the best Supplier for each particular search, maximizing the success rate for both parties, this with the support of our efficient data analysis engine' ) }} 
					</p>
				</section>			
			</article>
		</div>
	</div>

	<!--MODAL MEMBRESIAS-->
	<div id="modalMembresias" class="modal modalText">
		<!--CERRAR-->
		<div class="modal-footer">
			<a class=" modal-action modal-close waves-effect waves-green btn-flat">
				<span class="icon-gTalents_close"></span>
			</a>
		</div>

		<!--CONTENIDO-->
		<div class="modal-content">
			<!--PODRAS CONVERTIRTE EN SOCIO-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title bloque">
					<span class="icon-gTalents_win-23"></span>
					<h2> {{ trans('home.You can become' ) }} <strong>{{ trans('home.member' ) }} </strong> {{ trans('home.if you re' ) }}</h2>
				</section>

				<!--PUNTOS-->
				<section class="skill-A">
					<!--PUNTO 1-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.A global, regional or local Executive Recruitment firm (Retention or Contingency)' ) }} </p>
					</div>

					<!--PUNTO 2-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.Human Resources Professionals or experienced leaders with solid network in contacts') }}</p>
					</div>

					<!--PUNTO 3-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p> {{ trans('home.Consulting Firms in Human Resources' ) }} </p>
					</div>

					<!--PUNTO 4-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.Independent Executive Recruiters') }} </p>
					</div>
				</section>

				<section class="link">
					<a href="" class="btn-main2">{{ trans('home.Start now' ) }} </a>
				</section>				
			</article>

			<!--TIPOS DE SOCIOS-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title">
					<span class="icon-gTalents_mountain"></span>
					<h2>{{ trans('home.Types of') }}<strong> {{ trans('home.member' ) }}  </strong></h2>
				</section>

				<!--TEXTO DE LA SECCION-->
				<section class="paragraph">
					<p> {{ trans('home.We are a global platform that connects Recruiters and HR Professionals anywhere in the world') }} </p>
				</section>

				<!--TIPOS DE SOCIOS-->
				<section class="generic-skill member">
					<!-- POSTER-->
					<div class="item">
						<figure>
							<span class="icon-gTalents_poster"></span>
						</figure>
						<h3> poster</h3>
						<p>{{ trans('home.It is the member who publishes the position, who handles the contact with the client and ensures the closure of the project') }} </p>
					</div>

					<!-- SUPPLIER-->
					<div class="item">
						<figure>
							<span class="icon-gTalents_supplier-26"></span>
						</figure>
						<h3> Supplier</h3>
						<p>{{ trans('home.It is the member who works in the generation of candidates, who has a clear understanding of the profile and efficiently presents the profiles') }} </p>
					</div>

					<!--GTALENTS STAR-->
					<div class="item">
						<figure>
							<span class="icon-gTalents_gtalents-star"></span>
						</figure>
						<h3> gtalents star</h3>
						<p>{{ trans('home.It is the member who has both roles and the one who earns the most income. Duplicate the profits by publishing positions and generating candidates for other publications simultaneously') }} </p>
					</div>
				</section>				
			</article>

			<!--COMO RECIBEN LOS PAGOS-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title">
					<span class="icon-gTalents_pagos"></span>
					<h2>{{ trans('home.How do members get paid and in what proportion?')}}</h2>
				</section>

				<!--TEXTO DE LA SECCION-->
				<section class="paragraph">
					<p> {{ trans('home.Accumulate experience and increase your proportion / income as you publish and share candidates successfully. Human resources anywhere around the world')}} </p>
				</section>

				<!--INDICES DE GANANCIAS-->
				<div class="generic-skill member">
					<div class="row">
						<div class="col m4">
							<!--INDICES POSTER-->
							<div class="item">
								<img src="assets/img/indice-poster.png" alt="">
							</div>
						</div>
						<div class="col m4">
							<!--INDICES SUPPLIER-->
							<div class="item">
								<img src="assets/img/indice-supplier.png" alt="">
							</div>
						</div>
						<div class="col m4">
							<!--INDICES STAR-->
							<div class="item">
								<img src="assets/img/indice-star.png" alt="">
							</div>
						</div>
					</div>
				</div>

				<!--PUNTOS de EJEMPLO-->
				<section class="skill-B">
					<div class="example">
						<h4> {{ trans('home.Example, Invoice Search:')}} USD 40,000</h4>
					</div>
					<!--PUNTO 1-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>  40% Poster: USD <b>16,000</b> - {{ trans('home.Become a Top Poster, your proportion increases as you publish and successfully close projects')}} </p>
					</div>

					<!--PUNTO 2-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>  40% Supplier: USD <b>16,000</b> - {{ trans('home.Become a Top Supplier, in the same way, as you make successful placements, your proportion and income will increase')}} </p>
					</div>

					<!--PUNTO 3-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>  20% gTalents: USD <b>8,000</b> - gTalents {{ trans('home.will reinvest in their loyal members. As our members become frequent users, gTalents will lower their fees to a minimum')}} </p>
					</div>

					<!--PUNTO 4-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.The Poster sends an invoice to its client as soon as the candidate has been placed')}} </p>
					</div>

					<!--PUNTO 5-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.Global Talent Shift sends an invoice to the Poster for 60% of the value of the initial invoice that was sent to the customer')}} </p>
					</div>

					<!--PUNTO 6-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.The Supplier sends an invoice to Global Talent Shift for 40% of the value of the initial invoice sent to the customer')}} </p>
					</div>

					<!--PUNTO 7-->
					<div class="item">
						<span class="icon-gTalents_point"></span>
						<p>{{ trans('home.In this way, the Poster receives 40%, Supplier 40% and Global Talent Shift 20%')}} </p>
					</div>
				</section>
			</article>

			<!--RANGOS EN GTALENTS-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title">
					<span class="icon-gTalents_ranking"></span>
					<h2> {{ trans('home.Ranges in')}} <strong>gTalents</strong> {{ trans('home.Climbing up ranks')}}</h2>
				</section>

				<!--TEXTO DE LA SECCION-->
				<section class="paragraph">
					<p>{{ trans('home.Being an active and well-qualified member, you will get great benefits, increasing your income ratio')}} </p>
				</section>

				<!--RANGOS-->
				<section class="skill-rangos">
					<!--RANGO 1-3-->
						<!--RANGO 1-->
						<?php
						$range = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight'];
						$i = 0;
						$mitad = ceil(count($categories) / 2) ;
						?>
						@foreach($categories as $rr)
							@if($i==0 || $i==$mitad)
								<div class="item">
							@endif
						<div class="item-options">
							<div class="number">
								<img class="category-o" src="/assets/img/gtalents_{{$range[$i]}}.png">
							</div>
							<div class="rango">
								<img class="category-o" src="/upload/categories/{{$rr->avatar}}">
								<p>{{$rr->name}}</p>
							</div>
						</div>
							@if($i==$mitad-1 || $i==count($categories)-1)
								</div>
							@endif
							<?php
								$i++;
							?>
						@endforeach
				</section>		
			</article>

			<!--COMO CALIFICO POR OTROS SOCIOS-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title">
					<span class="icon-gTalents_mountain"></span>
					<h2>{{ trans('home.How do I qualify and qualify for other members')}} ? </h2>
				</section>

				<!--TEXTO DE LA SECCION-->
				<section class="paragraph">
					<p class="text-left">{{ trans('home.Once a publication has been successfully closed, the Poster will be able to qualify the Suppliers that worked together and in the same way they will be able to qualify the Poster. Our Audit team will review each case and will sometimes act as a "judge", based on good practice in executive search and global ethical principles')}} </p>

					<p class="text-left">{{ trans('home.Having a good rating will make you climb levels in gTalents, increasing your income and having access to more and better members')}} </p>
				</section>			
				
				<div style="text-align: center; margin-top:10px;">
					<a class=" modal-action modal-close waves-effect waves-green btn-main2">
						Close
					</a>
				</div>

			</article>

		</div>

	</div>

	<!--MODAL QUESTION-->
	<div id="modalQuestion" class="modal modalText">
		<!--CERRAR-->
		<div class="modal-footer">
			<a class=" modal-action modal-close waves-effect waves-green btn-flat">
				<span class="icon-gTalents_close"></span>
			</a>
		</div>

		<!--CONTENIDO-->
		<div class="modal-content">
			<!--PODRAS CONVERTIRTE EN SOCIO-->
			<article class="generic grid">
				<!--TITULO DE LA SECCION-->
				<section class="generic-title bloque">
					<span class="icon-gTalents_question"></span>
					<h2>{{ trans('home.Frequently Asked Questions') }}</h2>
				</section>

				<!--PREGUNTAS FRECUENTES-->
				<ul class="collapsible" data-collapsible="accordion">
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>1. {{ trans('home.frequent_questions.01.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>a. {{ trans('home.frequent_questions.01.answer01')}}</p>
							<p>b. {{ trans('home.frequent_questions.01.answer02')}}</p>
							<p>c. {{ trans('home.frequent_questions.01.answer03')}}</p>
							<p>d. {{ trans('home.frequent_questions.01.answer04')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>2. {{ trans('home.frequent_questions.02.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.02.answer01')}}</p>
						</div>
					</li>
					
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>3. {{ trans('home.frequent_questions.03.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.03.answer01')}}</p>
							<p>{{ trans('home.frequent_questions.03.answer02')}}</p>
                                                        <p>{{ trans('home.frequent_questions.03.answer03')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>4. {{ trans('home.frequent_questions.04.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.04.answer01')}}</p>
							<p>{{ trans('home.frequent_questions.04.answer02')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>5. {{ trans('home.frequent_questions.05.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.05.answer01')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>6. {{ trans('home.frequent_questions.06.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.06.answer01')}}</p>
							<p>{{ trans('home.frequent_questions.06.answer02')}}</p>
							<p>{{ trans('home.frequent_questions.06.answer03')}}</p>
							<p>{{ trans('home.frequent_questions.06.answer04')}}</p>
							<p>{{ trans('home.frequent_questions.06.answer05')}}</p>
							<p>{{ trans('home.frequent_questions.06.answer06')}}</p>
							<p>{{ trans('home.frequent_questions.06.answer07')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>7. {{ trans('home.frequent_questions.07.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.07.answer01')}}<a href="#modalGarantias" class=" modal-trigger waves-effect waves-light">{{ trans('home.frequent_questions.07.answer02')}}</a>{{ trans('home.frequent_questions.07.answer03')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>8. {{ trans('home.frequent_questions.08.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.08.answer01')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>9. {{ trans('home.frequent_questions.09.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.09.answer01')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>10. {{ trans('home.frequent_questions.10.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.10.answer01')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>11. {{ trans('home.frequent_questions.11.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.11.answer01')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>12. {{ trans('home.frequent_questions.12.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.12.answer01')}}</p>
							<p>{{ trans('home.frequent_questions.12.answer02')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>13. {{ trans('home.frequent_questions.13.title')}}</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.frequent_questions.13.answer01')}}</p>
						</div>
					</li>
				<!--<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>{{ trans('home.How can I access my account') }} gTalents?</h5>
						</div>
						<div class="collapsible-body">
							<p>{{ trans('home.We are an innovative technology platform with a sophisticated data analysis engine that will work 24/7 for you. Together with our experienced consultants who will personally review the behavior of all activities on the platform, our reports will assign the most efficient signature wherever you are for each particular search, considering all possible factors to optimize all projects')}}</p>
							<p>{{ trans('home.Communicate efficiently with your member through our platform and get all the necessary details to make the placement')}}</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>{{ trans('home.Question')}} 2</h5>
						</div>
						<div class="collapsible-body">
							<p>Lorem ipsum dolor sit amet.</p>
						</div>
					</li>
					<li>
						<div class="collapsible-header">
							<span class="icon-gTalents_point"></span>
							<h5>{{ trans('home.Question')}} 3</h5>
						</div>
						<div class="collapsible-body">
							<p>Lorem ipsum dolor sit amet.</p>
						</div>
					</li>-->
				</ul>
			
				<div style="text-align: center;">
					<a class=" modal-action modal-close waves-effect waves-green btn-main2">
						Close
					</a>
				</div>
			
			</article>

		</div>

	</div>



@include('partials.footer')

@stop

@section('scripts')
  	<script>
  		//NIMACION ENTRE ANCLAS < 1298
  		function menu_resize() {
		    var ancho_patron = $(window).width();
		    if(ancho_patron>1297) {
		        $('.header-container nav ul').removeAttr('style')
		    } 
		    else {
			    //CERRAR MODAL AL PRESIONAR OPCIONES
			    $('.header-container nav ul li.item a').click(function(){
			        $('.icon-gTalents_close-simple.hamburguer-2').click()
			    })
		   }
		}

		$(window).resize(function(){
		    menu_resize();
		})

  		//ANIMACION ENTRE ANCLAS > 1298
	    $(document).ready(
	    	function() { 
	    		menu_resize();

				//ANIMACION ENTRE ANCLAS
				$(function(){
					//DESPLAZAMIENTO
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
				});
	    	}
	    );
	</script>

@stop	