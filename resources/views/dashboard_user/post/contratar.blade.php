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
				<p class="p-desp">@lang('app.you_want_contract')</p>
			</div>
		</section>

		<form action="{{route('vacancies.contract.candidate.post', $vacancy->id)}}" method="POST" class="formLogin" id="formCreate">
			{{csrf_field()}}
			<!-- FORMULARIO PARA CONTRATAR -->
			<section class="newPost-container">
				<!--NOMBRE DE LA POSICION-->
				<div class="itemForm">
					<label>@lang('app.name_position')</label>
					<input class='validate' data-error='.errorTxtPosition' readonly value="{{$vacancy->name}}" name="position" type="text" placeholder="{{trans('app.name_position')}}">
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
						<input name="salario" class='validate' data-error='.errorTxtSalario' type="text" placeholder="{{trans('app.annual_salary')}}">
						<div class="errorTxtSalario"></div>
					</div>

					<!--FECHA DE INGRESO-->
					<div class="itemForm">
						<label>@lang('app.date_of_admission')</label>
						<input name="date_admision" data-error='.errorTxtDateAdmision' type="date" class="validate datepicker" placeholder="{{trans('app.date_of_admission')}}">
						<div class="errorTxtDateAdmision"></div>
					</div>
				</div>

				<!--Detalles de Oferta  y Compensaciones adicionales-->
				<div class="itemForm">
					<label>@lang('app.details_offert')</label>
					<textarea class='validate' data-error='.errorTxtDetails' name="details" id="details" cols="30" rows="10" placeholder="{{trans('app.details_offert')}}"></textarea>
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
					<h3>@lang('app.calificate_supplier')</h3>
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


				<!--COMENTARIO AL SUPPLIER-->
				<div class="itemForm">
					<label>@lang('app.comments_to') Supplier</label>
					<textarea class='validate' data-error='.errorTxtCommentsSupplier' name="comments_supplier" id="comments_supplier" cols="30" rows="10" placeholder="{{trans('app.comments_to')}} Supplier"></textarea>
					<div class="errorTxtCommentsSupplier"></div>
				</div>

				<!--BOTONES UPLOAD-->
				<div class="upload">
					<!-- ADJUNTAR OFERTA DE EMPLEO -->
					<div class="box">
						<input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
						<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>@lang('app.attach_job_offer')</span></label>
					</div>
				</div>

				<div class="btn-container">
					<div class="item">
						<button type="submit" class="btn-main">@lang('app.contract_process')</button>
					</div>
				</div>
			</section>
		</form>
	</article>
@stop

@section('scripts')
	<script>
		$(document).ready(function(){
            $('.datepicker').pickadate({
                lang: 'es',
                format: 'dd/mm/yyyy',
			});
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
                comments_supplier: {
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
                comments_supplier: {
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
