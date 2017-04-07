<div id="modalNewTeam" class="modal modal-userRegistered modal-fixed-footer">

    <div class="modal-header">
        <!--CERRAR MODAL-->
        <div class="close">
            <a href="#!" class="modal-action modal-close">
                <span class="icon-gTalents_close-2"></span>
            </a>
        </div>

        <h4>@lang('app.new_collaborator')</h4>
    </div>

    <div class="modal-content">
        {!! Form::open(array('route' => 'team.store','method'=>'POST', 'id' => 'formCreateCollaborator', 'role' => 'form', 'class' => 'formLogin', 'enctype' => 'multipart/form-data')) !!}
        {{csrf_field()}}
        <!--NOMBRE-->
            <div class="itemForm">
                <label>@lang('app.first_name')</label>
                <input type="text" placeholder="{{trans('app.first_name')}}" id="first_name" name="first_name" class='validate' data-error='.errorTxtName'>
                <div class="errorTxtName"></div>
            </div>

            <!--APELLIDO-->
            <div class="itemForm">
                <label>@lang('app.last_name')</label>
                <input type="text" placeholder="{{trans('app.last_name')}}" id="last_name" name="last_name" class='validate' data-error='.errorTxtLastName'>
                <div class="errorTxtLastName"></div>
            </div>

            <!--CORREO ELECTRONICO-->
            <div class="itemForm">
                <label>@lang('app.email')</label>
                <input type="email" placeholder="{{trans('app.email')}}" id="email" name="email" class='validate' data-error='.errorTxtEmail'>
                <div class="errorTxtEmail"></div>
            </div>

            <!--PREFIJO-->
            <div class="itemForm">
                <label>@lang('app.level_of_access')</label>
                <select class="browser-default validate" id="level_of_access" name="level_of_access" data-error='.errorTxtLevel'>
                    <option value="" disabled selected>@lang('app.choose_an_access_type')</option>
                    <option value="1">@lang('app.administrator')</option>
                    <option value="2">@lang('app.user')</option>
                </select>
                <div class="errorTxtLevel"></div>
            </div>
        <section class="buttonsMain">

            <div class="item">
                <a href="#" class="modal-action modal-close waves-effect btn-return">
                    @lang('app.back')</a>
            </div>
            <div class="item">
                <button class="btn-main" type="submit" name="action">
                    @lang('app.create')</button>
            </div>

        </section>
        {!! Form::close() !!}

    </div>
</div>
