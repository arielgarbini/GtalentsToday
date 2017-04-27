                <div class="dual">
                    <!--NOMBRE-->
                    <div class="itemForm">
                        {!! Form::label('first_name', trans('app.name'), [ 'title' => trans('app.name')]) !!}
                        {!! Form::text('first_name', null, ['maxlength' => 15, 'id' => 'first_name', 'class' => 'validate', 'data-error' => '.errorTxtName','placeholder'=>trans('app.name')]) !!}
                        <div class="errorTxtName"></div>
                    </div>

                    <!--APELLIDO-->
                    <div class="itemForm">
                        {!! Form::label('last_name', trans('app.last_name'), [ 'title' => trans('app.last_name')]) !!}
                        {!! Form::text('last_name', null, ['maxlength' => 15, 'id' => 'last_name', 'class' => ' validate', 'data-error' => '.errorTxtLastName','placeholder'=>trans('app.last_name')]) !!}
                        <div class="errorTxtLastName"></div>
                    </div>
                </div>

                <!--TELEFONO-->
                <div class="itemForm">
                    {!! Form::label('telf', trans('app.phone'), [ 'title' => trans('app.phone')]) !!}
                    {!! Form::input('telf', 'telff', null, ['maxlength' => 15, 'id' => 'telf', 'class' => 'phone validate', 'data-error' => '.errorTxtTelf','placeholder'=>trans('app.phone')]) !!}
                    <input type="hidden" id="phone3" name="telf">
                        <div class="errorTxtTelf"></div>
                </div>

                <!--CORREO ELECTRONICO-->
                <div class="itemForm">
                    {!! Form::label('email', trans('app.email'), [ 'title' => trans('app.email')]) !!}
                        {!! Form::text('email', null, ['maxlength' => 25, 'id' => 'email', 'class' => ' validate', 'data-error' => '.errorTxtEmail','placeholder'=>trans('app.email')]) !!}
                        <div class="errorTxtEmail"></div>
                </div>

                <!--POSICION ACTUAL-->
                <div class="itemForm">
                    {!! Form::label('actual_position_id`', trans('app.actual_position'), ['class'=>'', 'title' => trans('app.actual_position')]) !!}
                    {!! Form::select('actual_position_id', $positions, null, ['class' => 'browser-default']) !!}
                </div>

                <!--COMPAÑIA ACTUAL-->
                <div class="itemForm">
                    {!! Form::label('company', trans('app.company'), ['class'=>'', 'title' => trans('app.company')]) !!}
                    {!! Form::text('company', null, ['maxlength' => 20, 'id' => 'company', 'class' => 'validate', 'data-error' => '.errorTxtCompany']) !!}
                    <div class="errorTxtCompany"></div>
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
                    <div class="box">
                        {!! Form::file('file', ['accept' =>'application/pdf', 'id' => 'file-'.$dataFile, 'class' => 'inputfile inputfile-2 validate', 'data-error' => '.errorTxtCompany', 'data-multiple-caption' => '{count} files selected']) !!}
<!--                        <input accept="application/pdf" type="file" name="file" id="file-{{$dataFile}}" class="inputfile inputfile-2 validate" data-multiple-caption="{count} files selected" multiple />-->
                        <label for="file-{{$dataFile}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>CV</span></label>
                    </div>
                </div>
                <input type="hidden" value="{{ Session::token() }}" name="_token"/>