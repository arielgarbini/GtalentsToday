@extends('layouts.app1')

@section('page-title', trans('app.califications'))

@section('content')

<!--CONTENEDOR DE FACTURAS POR COBRAR-->
	<article class="bills grid">
		<!--TITULO-->
		<section class="bills-title">
			<h3>@lang('app.invoices_to_charged')</h3>
		</section>

		<!--TABLA DE FACTURAS-->
		<table>
			<thead>
				<tr>
					<th data-field="id">@lang('app.date')</th>
					<th data-field="name">@lang('app.in_opportunity')</th>
					<th data-field="price">@lang('app.amount')</th>
					<th clasS="P-estatus">@lang('app.in_status')</th>
				</tr>
			</thead>

			<tbody>
				<!--FACTURA 1-->
				@foreach($charge as $ch)
				<tr>
					<td>{{$ch->created_at->format('d/m/Y')}}</td>
					<td>{{$ch->vacancy->name}}</td>
					<td>{{$ch->amount}} USD</td>
					<td clasS="P-estatus">{{$ch->status}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</article>

	<!--CONTENEDOR DE FACTURAS POR PAGAR-->
	<article class="bills grid">
		<!--TITULO-->
		<section class="bills-title">
			<h3>@lang('app.invoices_to_pay')</h3>
		</section>

		<!--TABLA DE FACTURAS-->
		<table>
			<thead>
				<tr>
					<th data-field="id">@lang('app.date')</th>
					<th data-field="name">@lang('app.in_opportunity')</th>
					<th data-field="price">@lang('app.amount')</th>
					<th clasS="P-estatus">@lang('app.in_status')</th>
					<th class="Tcargo">@lang('app.type_of_position')</th>
					<th>@lang('app.bill')</th>
				</tr>
			</thead>

			<tbody>
				<!--FACTURA 1-->
				@foreach($pay as $ch)
					<tr>
						<td>{{$ch->created_at->format('d/m/Y')}}</td>
						<td>{{$ch->vacancy->name}}</td>
						<td>{{$ch->amount}} USD</td>
						<td clasS="P-estatus">{{$ch->status}}</td>
						<td class="Tcargo">@lang('app.deposit')</td>
						<td>
							<a href="#!">@lang('app.download_invoice')</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</article>
@stop

@section('scripts')
   
@stop