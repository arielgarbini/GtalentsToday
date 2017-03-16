                <div class="dual">
                    <!--NOMBRE-->
                    <div class="itemForm">
                        {!! Form::label('first_name', 'Nombre', [ 'title' => 'Nombre']) !!}
                        {!! Form::text('first_name', null, ['id' => 'first_name', 'class' => 'validate', 'data-error' => '.errorTxtName','placeholder'=>'Nombre']) !!}
                        <div class="errorTxtName"></div>
                    </div>

                    <!--APELLIDO-->
                    <div class="itemForm">
                        {!! Form::label('last_name', 'Apellido', [ 'title' => 'Last Name']) !!}
                        {!! Form::text('last_name', null, ['id' => 'last_name', 'class' => ' validate', 'data-error' => '.errorTxtLastName','placeholder'=>'Apellido']) !!}
                        <div class="errorTxtLastName"></div>
                    </div>
                </div>

                <!--TELEFONO-->
                <div class="itemForm">
                    {!! Form::label('telf', 'Teléfono', [ 'title' => 'Teléfono']) !!}
                        {!! Form::text('telf', null, ['id' => 'telf', 'class' => ' validate', 'data-error' => '.errorTxtTelf','placeholder'=>'Teléfono']) !!}
                        <div class="errorTxtTelf"></div>
                </div>

                <!--CORREO ELECTRONICO-->
                <div class="itemForm">
                    {!! Form::label('email', 'Correo Electrónico', [ 'title' => 'Correo Electrónico']) !!}
                        {!! Form::text('email', null, ['id' => 'email', 'class' => ' validate', 'data-error' => '.errorTxtEmail','placeholder'=>'Correo Electrónico']) !!}
                        <div class="errorTxtEmail"></div>
                </div>

                <!--POSICION ACTUAL-->
                <div class="itemForm">
                    {!! Form::label('actual_position_id`', 'Posición Actual', ['class'=>'', 'title' => 'Posición Actual']) !!}  
                    {!! Form::select('actual_position_id', $positions, null, ['class' => 'browser-default']) !!}
                </div>

                <!--COMPAÑIA ACTUAL-->
                <div class="itemForm">
                    {!! Form::label('company_id', 'Compañía', ['class'=>'', 'title' => 'Compañía']) !!}  
                    {!! Form::select('company_id', $companies, null, ['class' => 'browser-default']) !!}
                </div>

                <div class="dual">
                    <!--PAIS-->
                    <div class="itemForm">
                        {!! Form::label('country_id', 'País', ['class'=>'', 'title' => 'País']) !!}  
                    {!! Form::select('country_id', $countries, null, ['class' => 'browser-default']) !!}
                    </div>

                    <!--COMPENSACION-->
                    <div class="itemForm">
                        {!! Form::label('compensation_id', 'Compensación', ['class'=>'', 'title' => 'Compensación']) !!}  
                    {!! Form::select('compensation_id', $compensations, null, ['class' => 'browser-default']) !!}
                    </div>
                </div>

                <!--ADJUNTAR CV-->
                <div class="upload">
                    
                </div>
                <input type="hidden" value="{{ Session::token() }}" name="_token"/>