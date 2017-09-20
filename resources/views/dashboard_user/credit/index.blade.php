@extends('layouts.app1')

@section('page-title', trans('app.califications'))

@section('content')
     @include('partials.admin-resume');
    
    <!--CONTENEDOR DE CREDITOS-->
    <article class="bills grid">
        <!--TITULO-->
        <section class="bills-title">
            <h3>@lang('app.cr_my_credits')</h3>

            <!--MODAL COMPRA DE CREDITOS-->
            <div class="buy-credits">
                <a href="#" id="buy-credits" class="waves-effect waves-light">
                    <p>@lang('app.buy_credits')</p>
                </a>
            </div>
        </section>

        <!--TABLA DE CREDITOS-->
        <table>
            <thead>
                <tr>
                    <th data-field="id">@lang('app.date')</th>
                    <th data-field="name">@lang('app.credits')</th>
                    <th data-field="price">@lang('app.in_opportunity')</th>
                    <th clasS="P-estatus">@lang('app.events')</th>
                </tr>
            </thead>

            <tbody id="list-credits">
                @foreach($credits as $cre)
                    <tr>
                        <td>{{$cre->created_at->format('d/m/Y')}}</td>
                        <td class="positive">{{$cre->credit}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                <!--CREDITO 1-->
                <!--<tr>
                    <td>25/10/2016</td>
                    <td class="positive">Positivos</td>
                    <td>FrontEnd Developer</td>
                    <td>Devolución por Garantia</td>
                </tr>-->

                <!--CREDITO 2-->
                <!--
                <tr>
                    <td>25/10/2016</td>
                    <td class="positive">Positivos</td>
                    <td>Diseñador UX/UI</td>
                    <td>Compra de Crèdito</td>
                </tr>-->

                <!--CREDITO 3-->
                <!--<tr>
                    <td>25/10/2016</td>
                    <td class="negative">Negativo</td>
                    <td>Reclutador IT</td>
                    <td>Compra de Crèdito</td>
                </tr>-->
            </tbody>
        </table>
    </article>


    <!--MODAL COMPRAR CREDITOS-->
    <div id="modalBuyCredits" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>@lang('app.credit_purchase')</h4>
        </div>

        <div class="modal-content">
            <form action="" class="form-credits">

                <!--PREFIJO-->
                <div class="itemForm">
                    <h3 id="value_credit">
                        <strong>$</strong>0
                    </h3>

                    <select class="browser-default" id="credits">
                        <option value="" selected>@lang('app.select')</option>
                        <option value="2000">2.000 @lang('app.credits')</option>
                        <option value="3000">3.000 @lang('app.credits')</option>
                        <option value="4000">4.000 @lang('app.credits')</option>
                    </select>
                </div>

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            @lang('app.back')
                        </a>
                    </div>

                    <!--INVITAR-->
                    <div class="item">
                        <button class="btn-main" type="button" id="btn-modalMain">
                            @lang('app.buy')
                        </button>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <!--<div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>@lang('app.send_you_the_invoice')</p>
            </div>-->
        </div>
    </div>

@stop

@section('scripts')
   <script>
       function successConfirm(response){
           $('#list-credits').append('<tr><td>'+response.created_at+'</td><td class="positive">'+response.amount+'</td><td></td><td></td></tr>');
           swal({
               title: "{{trans('app.success')}}",
               text: "{{trans('app.credits_purchase_successfully')}}",
               timer: 3000,
               showConfirmButton: false,
               type: "success"
           });
       }

       function successCancel(){
           swal({
               title: "{{trans('app.success')}}",
               text: "{{trans('app.credits_purchase_cancel')}}",
               timer: 3000,
               showConfirmButton: false,
               type: "error"
           });
       }

       function successError(){
           swal({
               title: "{{trans('app.success')}}",
               text: "{{trans('app.credits_purchase_error')}}",
               timer: 3000,
               showConfirmButton: false,
               type: "error"
           });
       }
       $(document).ready(function(){

           $('#credits').change(function(){
               if($(this).val()!='') {
                   var val = $(this).val();
                   $.ajax({
                       url: '{{route("credits.getpay")}}?credits='+val,
                       method: 'GET',
                       success: function (response) {
                           $('#value_credit').html('<strong>$</strong>'+response.value);
                       }
                   });
               } else {
                   $('#value_credit').html('<strong>$</strong>0');
               }
           });

           $('#buy-credits').click(function(){
               $('#modalBuyCredits').modal('open');
           });

           $('#btn-modalMain').click(function(){
               $('#modalBuyCredits').modal('close');
                if($('#credits').val()!=''){
                    $('#loading').show();
                    $.ajax({
                        url: '{{route("credits.getpay.paypal")}}?credits='+$('#credits').val(),
                        method: 'GET',
                        success: function (response) {
                            $('#loading').hide();
                            window.open(response.link, "_blank", "width=800,height=800");
                        },
                        error: function(error){
                            $('#loading').hide();
                            swal({
                                title: "{{trans('app.error')}}",
                                text: '{{trans("app.there_was_error_paypal")}}',
                                timer: 3000,
                                html: true,
                                showConfirmButton: false,
                                type: "error"
                            });
                        }
                    });
                } else {
                    swal({
                        title: "{{trans('app.error')}}",
                        text: '{{trans("app.you_must_select_credits")}}',
                        timer: 3000,
                        html: true,
                        showConfirmButton: false,
                        type: "error"
                    });
                }
           });
       });
   </script>
@stop
