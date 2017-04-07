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
                <a href="#modalBuyCredits" class="modal-trigger waves-effect waves-light">
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

            <tbody>
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
            <form action="" class="formLogin form-credits">

                <!--PREFIJO-->
                <div class="itemForm">
                    <h3>
                        <strong>$</strong>0
                    </h3>

                    <select class="browser-default">
                        <option value="1" selected>2.000 @lang('app.credits')</option>
                        <option value="2">3.000 @lang('app.credits')</option>
                        <option value="3">4.000 @lang('app.credits')</option>
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
                        <a href="#" class="btn-main" type="submit" id="btn-modalMain">
                            @lang('app.buy')
                        </a>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>@lang('app.send_you_the_invoice')</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        @lang('app.continue')
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
   
@stop
