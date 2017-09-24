@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')

	<!--CONTRATAR POSTER-->
	<article class="newPost grid">

		<!--ENCABEZADO ICONOS-->
		<section class="newPost-legend">

			<!--DETALLES-->
			<div class="item active">
				<figure>
					<span class="icon-gTalents_detalles"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
				</figure>
				<p class="p-desp">@lang('app.we_are_glad')</p>
			</div>
		</section>

		<form action="{{route('supplier.calification_supplier.store', $id)}}"  method="POST" class="formLogin" id="formCreate">
			{{csrf_field()}}
			<!-- FORMULARIO PARA CONTRATAR -->
			<section class="newPost-container">
				<!--NOMBRE DE LA POSICION-->
				<div class="itemForm">
					<label>@lang('app.name_position')</label>
					<input readonly value="{{$invoices->name}}" class='validate' data-error='.errorTxtPosition' name="position" type="text" placeholder="{{trans('app.name_position')}}">
					<div class="errorTxtPosition"></div>
				</div>

				<!--NOMBRE DEL CANDIDATO-->
				<div class="itemForm">
					<input type="hidden" name="candidate" value="{{$candidate->id}}">
					<label>@lang('app.name_candidates')</label>
					<input readonly value="{{$candidate->first_name}} {{$candidate->last_name}}" type="text" placeholder="{{trans('app.name_candidates')}}">
				</div>

				<div class="dual">
					<!--SALARIO ANUAL-->
					<div class="itemForm">
						<label>@lang('app.annual_salary')</label>
						<input readonly value="{{$invoices->amount}}" name="salario" class='validate' data-error='.errorTxtSalario' type="text" placeholder="{{trans('app.annual_salary')}}">
						<div class="errorTxtSalario"></div>
					</div>

					<!--FECHA DE INGRESO-->
					<div class="itemForm">
						<label>@lang('app.date_of_admission')</label>
						<input readonly value="{{$date_of_admission}}" name="date_admision" data-error='.errorTxtDateAdmision' type="text" class="validate datepicker" placeholder="{{trans('app.date_of_admission')}}">
						<div class="errorTxtDateAdmision"></div>
					</div>
				</div>

				<!--Detalles de Oferta  y Compensaciones adicionales-->
				<div class="itemForm">
					<label>@lang('app.details_offert')</label>
					<textarea readonly class='validate' data-error='.errorTxtDetails' name="details" id="details" cols="30" rows="10" placeholder="{{trans('app.details_offert')}}">{{$invoices->offer}}</textarea>
					<div class="errorTxtDetails"></div>
				</div>

				<!--COMENTARIO A GTALENTS-->
				<div class="itemForm">
					<label>@lang('app.comments_to') gTalents</label>
					<textarea class='validate' data-error='.errorTxtComments' name="comments" id="comments" cols="30" rows="10" placeholder="{{trans('app.comments_to')}} gTalents"></textarea>
					<div class="errorTxtComments"></div>
				</div>

				<!--CALIFICACION-->
				<div class="feedback-contratar">
					<h3>@lang('app.calificate_poster')</h3>
					<!--ESTRELLAS-->
					<div class="stars-feedback">
						<select id="stars1" name="rating" autocomplete="off">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>

				<!--COMENTARIO AL Poster-->
				<div class="itemForm">
					<label>@lang('app.comments_to') Poster</label>
					<textarea class='validate' data-error='.errorTxtCommentsPoster' name="comments_poster" id="comments_poster" cols="30" rows="10" placeholder="{{trans('app.comments_to')}} Poster"></textarea>
					<div class="errorTxtCommentsPoster"></div>
				</div>

				<div class="btn-container">
					<div class="item">
						<button type="submit" class="btn-main">@lang('app.qualify')</button>
					</div>
				</div>
			</section>
		</form>
	</article>
@stop

@section('scripts')
	<script>
        $(document).ready(function(){

            $('.datepicker').val("{{$date_of_admission}}")
        });

        $("#formCreate").validate({
            rules: {
                position: {
                    required: true
                },
                salario: {
                    required: true,
                    number: true
                },
                date_admision: {
                    required: true
                },
                details: {
                    required: true
                },
                comments: {
                    required: true
                },
                comments_poster: {
                    required: true
                },
            },
            messages: {
                position: {
                    required: "{{trans('app.vacancy_validate.position')}}"
                },
                salario: {
                    required: "{{trans('app.vacancy_validate.salario')}}",
                    number: "{{trans('app.vacancy_validate.salario_number')}}"
                },
                date_admision: {
                    required: "{{trans('app.vacancy_validate.date_admision')}}"
                },
                details: {
                    required: "{{trans('app.vacancy_validate.details')}}"
                },
                comments: {
                    required: "{{trans('app.vacancy_validate.comments')}}"
                },
                comments_poster: {
                    required: "{{trans('app.vacancy_validate.comments_supplier')}}"
                },
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
	</script>
@stop
