                <div class="dual">
                    <!--NOMBRE-->
                    <div class="itemForm">
                        {!! Form::label('first_name', trans('app.name'), [ 'title' => trans('app.name')]) !!}
                        {!! Form::text('first_name', null, ['id' => 'first_name', 'class' => 'validate', 'data-error' => '.errorTxtName','placeholder'=>trans('app.name')]) !!}
                        <div class="errorTxtName"></div>
                    </div>

                    <!--APELLIDO-->
                    <div class="itemForm">
                        {!! Form::label('last_name', trans('app.last_name'), [ 'title' => trans('app.last_name')]) !!}
                        {!! Form::text('last_name', null, ['id' => 'last_name', 'class' => ' validate', 'data-error' => '.errorTxtLastName','placeholder'=>trans('app.last_name')]) !!}
                        <div class="errorTxtLastName"></div>
                    </div>
                </div>

                <!--TELEFONO-->
                <div class="itemForm">
                    {!! Form::label('telf', trans('app.phone'), [ 'title' => trans('app.phone')]) !!}
                        {!! Form::text('telf', null, ['id' => 'telf', 'class' => ' validate', 'data-error' => '.errorTxtTelf','placeholder'=>trans('app.phone')]) !!}
                        <div class="errorTxtTelf"></div>
                </div>

                <!--CORREO ELECTRONICO-->
                <div class="itemForm">
                    {!! Form::label('email', trans('app.email'), [ 'title' => trans('app.email')]) !!}
                        {!! Form::text('email', null, ['id' => 'email', 'class' => ' validate', 'data-error' => '.errorTxtEmail','placeholder'=>trans('app.email')]) !!}
                        <div class="errorTxtEmail"></div>
                </div>

                <!--POSICION ACTUAL-->
                <div class="itemForm">
                    {!! Form::label('actual_position_id`', trans('app.actual_position'), ['class'=>'', 'title' => trans('app.actual_position')]) !!}
                    {!! Form::select('actual_position_id', $positions, null, ['class' => 'browser-default']) !!}
                </div>

                <!--COMPAÑIA ACTUAL-->
                <div class="itemForm">
                    {!! Form::label('company_id', trans('app.company'), ['class'=>'', 'title' => trans('app.company')]) !!}
                    {!! Form::select('company_id', $companies_candidates, null, ['class' => 'browser-default']) !!}
                </div>

                <div class="dual">
                    <!--PAIS-->
                    <div class="itemForm">
                        {!! Form::label('country_id', trans('app.country'), ['class'=>'', 'title' => trans('app.country')]) !!}
                    {!! Form::select('country_id', $countries, null, ['class' => 'browser-default']) !!}
                    </div>

                    <!--COMPENSACION-->
                    <div class="itemForm">
                        {!! Form::label('compensation_id', trans('app.compensation'), ['class'=>'', 'title' => trans('app.compensation')]) !!}
                    {!! Form::select('compensation_id', $compensations, null, ['class' => 'browser-default']) !!}
                    </div>
                </div>

                <!--ADJUNTAR CV-->
                <div class="upload">
                    
                </div>
                <input type="hidden" value="{{ Session::token() }}" name="_token"/>