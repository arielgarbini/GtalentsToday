@extends('layouts.app1')

@section('page-title', trans('app.messages'))

@section('content')
  <!-- MENSAJES CONTENEDOR -->
	<article class="message-main grid">
		<!--LISTADO DE CONTACTOS-->
		<section class="message-main-contact">
			<!--SEARCH-->
			<div class="team-container">
				<!-- RESUMEN-->
				<section class="team-container-tools">
					<!-- ACTIVO 1 -->
					<div class="active-one">
						<!--FILTRADO-->
						<select class="browser-default">
							<option value="" disabled selected>@lang('app.all_messages')</option>
							<option value="1">Administrador</option>
							<option value="2">Poster</option>
							<option value="3">Novato</option>
						</select>

						<div class="search-opt1 btn-search">
							<span class="icon-gTalents_search"></span>
						</div>							
					</div>

					<!-- SECCION DE BUSQUEDA -->
					<form class="active-two">
						<input type="text" placeholder="Nombre del Colaborador">
						<!--CERRAR SEGMENTO-->
						<div class="close btn-closeInput">
							<span class="icon-gTalents_close"></span>
						</div>							
					</form>
				</section>
			</div>

			<!-- LISTADO DE SUPPLIER POR POST-->
			<ul class="collapsible" data-collapsible="accordion">
				@foreach($conversations as $conversation)
					<li>
						<div class="collapsible-header" value="{{$conversation->poster_user_id}}" vacancy="{{$conversation->id}}">
							<h3>{{$conversation->name}}</h3>
						</div>
						<div class="collapsible-body">
							<!--PERSONA 1-->
							@foreach($conversation->conversations as $conver)
								<div class="team-card-person show_messages" value="{{$conver->id}}" @if($user_id!=$conver->sender_user_id) sender="{{$conver->sender_user_id}}" @else sender="{{$conver->destinatary_user_id}}" @endif>
									<figure>
										<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
									</figure>
									<div class="datos">
										<h3>{{$conver->code}}</h3>
										<p>{{$conver->created_at->diffForHumans()}}</p>
									</div>
								</div>
							@endforeach
						</div>
					</li>
				@endforeach
			</ul>
		</section>

		<!--MESAJE-->
		<section class="message-main-message">
			<!--CABECERA MENSAJE-->
			<div class="message-header">
				<!--USUARIO-->
				<div class="item">
					<figure>
						<span class="icon-gTalents_message-header"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
					</figure>
					<div class="datos datos_sender">
						<!--<h4>RET-012</h4>
						<p>Agregado recientemente</p>-->
					</div>
				</div>

				<!--OPORTUNIDAD-->
				<div class="item datos_vacancy">
					<!--
					<h4>
						<a href="post-detail.php">Desarrollador Node.js</a>
					</h4>
					<p>Creado por ti</p>
					-->
				</div>
			</div>

			<!--MENSAJE-->
			<div class="message-body">
				<!--FECHA DE CONVERSACION-->
				<!--<h5>20 de Noviembre</h5>-->

				<!--MENSAJE RECIBIDO-->
			</div>

			<!--FORMULARIO ENVIAR MENSAJE-->
			<form method="POST" action="{{route('conversations.message.save')}}" class="message-footer" style="display: none;">
				{{csrf_field()}}
				<input type="hidden" name="conversation" id="conversation">
				<input type="hidden" name="destinatary" id="destinatary">
				<textarea name="message" id="message" cols="30" rows="10" placeholder="{{trans('app.reply_send_message')}}"></textarea>
				<div class="item">
					<button type="submit" class="btn-main" >@lang('app.message')</button>
				</div>
			</form>
		</section>
	</article>
@stop

@section('scripts')
   <script>
	   $(document).ready(function(){
	       user = "{{$user_id}}";
	       $('.show_messages').click(function(){
               $('#conversation').val($(this).attr('value'));
               $('#destinatary').val($(this).attr('sender'));
	           var element = $(this);
	           $.ajax({
	               url: '/conversations/'+$(this).attr('value')+'/messages/',
				   success: function(result){
                       console.log(result);
                       $('.message-footer').show();
	                   $('.datos_sender').html('<h4>'+$(element).find('.datos h3').html()+'</h4><p>'+$(element).find('.datos p').html()+'</p>');
	                   if(user == $(element).parent().parent().find('.collapsible-header').attr('value')){
                           var html = '<h4><a target="_blank" href="/vacancy/'+$(element).parent().parent().find('.collapsible-header').attr('vacancy')+'/show">'+$(element).parent().parent().find('.collapsible-header h3').html()+'</a></h4>';
	                       html += '<p>{{trans("app.created_by_you")}}</p>';
					   } else {
                           var html = '<h4><a target="_blank" href="/vacancy/'+$(element).parent().parent().find('.collapsible-header').attr('vacancy')+'/show_post_user">'+$(element).parent().parent().find('.collapsible-header h3').html()+'</a></h4>';
                           html += '<p></p>';
					   }
	                   $('.datos_vacancy').html(html);
	                   var html = '';
	                   for(var i = 0; i < result.length; i++){
	                       if(result[i].sender_user_id==user){
                               html += '<div class="message-body-general send"><div class="item"><p>'+result[i].message+'</p></div><span>'+result[i].created_at+'</span></div>';
						   } else {
	                           html += '<div class="message-body-general received"><div class="item"><p>'+result[i].message+'</p></div><span>'+result[i].created_at+'</span></div>';
						   }
					   }
					   $('.message-body').html(html);
				   }
			   })
		   });
	   });
   </script>
@stop
