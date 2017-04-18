<div id="modalEditar<?php if(isset($modal)){ echo $modal; }else{ echo $te->id; } ?>" class="modal modal-userRegistered modal-fixed-footer"">

    <div class="modal-header">
        <!--CERRAR MODAL-->
        <div class="close">
            <a href="#!" class="modal-action modal-close">
                <span class="icon-gTalents_close-2"></span>
            </a>
        </div>

        <h4>@lang('app.edit_candidate')</h4>
    </div>

    <div class="modal-content">
        {!! Form::open(['route' => ['team.update', $te->id], 'method' => 'PUT', 'class' => 'formCreateCollaborator', 'id' => 'formEdit', 'enctype' => 'multipart/form-data']) !!}
        <div class="itemForm">
            <label>@lang('app.first_name')</label>
            <input value="{{$te->user->first_name}}" type="text" placeholder="{{trans('app.first_name')}}" id="first_name" name="first_name" class='validate' data-error='.errorTxtName{{$te->id}}'>
            <div class="errorTxtName{{$te->id}}"></div>
        </div>

        <!--APELLIDO-->
        <div class="itemForm">
            <label>@lang('app.last_name')</label>
            <input value="{{$te->user->last_name}}" type="text" placeholder="{{trans('app.last_name')}}" id="last_name" name="last_name" class='validate' data-error='.errorTxtLastName{{$te->id}}'>
            <div class="errorTxtLastName{{$te->id}}"></div>
        </div>

        <!--CORREO ELECTRONICO-->
        <div class="itemForm">
            <label>@lang('app.email')</label>
            <input value="{{$te->user->email}}" type="email" placeholder="{{trans('app.email')}}" id="email" name="email" class='validate' data-error='.errorTxtEmail{{$te->id}}'>
            <div class="errorTxtEmail{{$te->id}}"></div>
        </div>

        <!--PREFIJO-->
        <div class="itemForm">
            <label>@lang('app.level_of_access')</label>
            <select class="browser-default validate" id="level_of_access" name="level_of_access" data-error='.errorTxtLevel{{$te->id}}'>
                <option value="" disabled>@lang('app.choose_an_access_type')</option>
                <option @if($te->position==1) selected @endif value="1">@lang('app.administrator')</option>
                <option @if($te->position==2) selected @endif value="2">@lang('app.user')</option>
            </select>
            <div class="errorTxtLevel{{$te->id}}"></div>
        </div>
        <section class="buttonsMain">
            <div class="item">
                <a href="#" class="modal-action modal-close waves-effect btn-return">
                    @lang('app.back')
                </a>
            </div>
            <div class="item">
                <button class="btn-main" type="submit" name="action">
                    @lang('app.edit')
                </button>
            </div>
        </section>
        <div class="messageModal">
            <figure>
                <span class="icon-gTalents_win-53"></span>
            </figure>
            <p>@lang('app.team_updated_successfully')</p>
            <!--BTN-MAIN-->
            <div class="item">
                <a href="#!" class="btn-main">
                    @lang('app.continue')
                </a>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>