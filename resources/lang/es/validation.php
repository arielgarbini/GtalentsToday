<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => ':attribute debe ser aceptado.',
    'active_url'           => ':attribute no es una URL válida.',
    'after'                => ':attribute debe ser una fecha posterior a :date.',
    'alpha'                => ':attribute solo debe contener letras.',
    'alpha_dash'           => ':attribute solo debe contener letras, números y guiones.',
    'alpha_num'            => ':attribute solo debe contener letras y números.',
    'array'                => ':attribute debe ser un conjunto.',
    'before'               => ':attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => ':attribute tiene que estar entre :min - :max.',
        'file'    => ':attribute debe pesar entre :min - :max kilobytes.',
        'string'  => ':attribute tiene que tener entre :min - :max caracteres.',
        'array'   => ':attribute tiene que tener entre :min - :max ítems.',
    ],
    'boolean'              => 'El campo :attribute debe tener un valor verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_format'          => ':attribute no corresponde al formato :format.',
    'different'            => ':attribute y :other deben ser diferentes.',
    'digits'               => ':attribute debe tener :digits dígitos.',
    'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'Las dimensiones de la imagen :attribute no son validas.',
    'distinct'             => 'El campo :attribute contiene un valor duplicado.',
    'email'                => ':attribute no es un correo válido',
    'exists'               => ':attribute es inválido.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => ':attribute es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => ':attribute debe ser un número entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe tener una cadena JSON válida.',
    'max'                  => [
        'numeric' => ':attribute no debe ser mayor a :max.',
        'file'    => ':attribute no debe ser mayor que :max kilobytes.',
        'string'  => ':attribute no debe ser mayor que :max caracteres.',
        'array'   => ':attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => ':attribute debe ser un archivo con formato: :values.',
    'min'                  => [
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'file'    => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'string'  => ':attribute debe contener al menos :min caracteres.',
        'array'   => ':attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => ':attribute es inválido.',
    'numeric'              => ':attribute debe ser numérico.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato de :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'file'    => 'El tamaño de :attribute debe ser :size kilobytes.',
        'string'  => ':attribute debe contener :size caracteres.',
        'array'   => ':attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'El :attribute debe ser una zona válida.',
    'unique'               => ':attribute ya ha sido registrado.',
    'url'                  => 'El formato :attribute es inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [
        'name'                  => 'nombre',
        'username'              => 'usuario',
        'email'                 => 'correo electrónico',
        'first_name'            => 'nombre',
        'last_name'             => 'apellido',
        'password'              => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'city'                  => 'ciudad',
        'country'               => 'país',
        'country_id'            => 'país',
        'address'               => 'dirección',
        'address_type'          => 'tipo de dirección',
        'address_type_id'       => 'tipo de dirección',
        'phone'                 => 'teléfono',
        'mobile'                => 'móvil',
        'age'                   => 'edad',
        'sex'                   => 'sexo',
        'gender'                => 'género',
        'year'                  => 'año',
        'month'                 => 'mes',
        'day'                   => 'día',
        'hour'                  => 'hora',
        'minute'                => 'minuto',
        'second'                => 'segundo',
        'title'                 => 'título',
        'body'                  => 'contenido',
        'description'           => 'descripción',
        'excerpt'               => 'extracto',
        'date'                  => 'fecha',
        'time'                  => 'hora',
        'subject'               => 'asunto',
        'message'               => 'mensaje',
        'current_company'       => 'compañía actual',
        'availability'          => 'disponibilidad',
        'size'                  => 'cantidad',
        'points'                => 'puntos',
        'profile_position'      => 'posición del perfil',
        'profile_position_id'   => 'posición del perfil',
        'actual_position'       => 'posición actual',
        'actual_position_id'    => 'posición actual',
        'type_of_shared_search' => 'búsquedas que comparte',
        'type_of_shared_search_id' => 'búsquedas que comparte',
        'type_of_involved_search'=> 'búsquedas que participa',
        'type_of_involved_search_id'=> 'búsquedas que participa',
        'type_of_shared_opportunity' => 'oportunidades que comparte',
        'type_of_shared_opportunity_id' => 'oportunidades que comparte',
        'type_of_involved_opportunity' => 'oportunidades que participa',
        'type_of_involved_opportunity_id' => 'oportunidades que participa',
        'cases_number'    => 'número de casos',
        'cases_number_id' => 'número de casos',
        'experience_years'    => 'años de experiencia',
        'experience_years_id' => 'años de experiencia',
        'level_position'    => 'nivel de posiciones',
        'level_position_id' => 'nivel de posiciones',
        'accept_terms_cond' => 'aceptar términos y condiciones',
        'comercial_name'    => 'nombre comercial',
        'register_number'   => 'número de registro',
        'vacancy_create'    => 'crear Vacante',
        'name_position'     => 'nombre de la posición',
        'positions_number'  => 'número de posiciones',
        'career_plan'       => 'plan de carrera',
        'scheme_work'       => 'esquema de Trabajo',
        'responsabilities'  => 'responsabilidades',
        'key_points'        => 'puntos clave',
        'contract_type'     => 'tipo de contrato',
        'sharing'           => 'compartido',
        'vacancy_status'    => 'estado',
        'minimum_salary'    => 'salario mínimo',
        'maximum_salary'    => 'salario máximo',
        'state'             => 'provincia',
        'zip_code'          => 'código postal',
        'profile'           => 'perfil',
        'section'           => 'sección',
        'conditions'                => 'condiciones',
        'general_conditions'        => 'condiciones generales',
        'approximate_total_billing' => 'facturación aproximada',
        'comission'                 => 'comisión',
        'days_warranty'             => 'garantía',
        'required_points'           => 'puntos requeridos',
        'poster_percent'            => 'porcentaje poster',
        'supplier_percent'          => 'porcentaje supplier',
        'gtalents_percent'          => 'porcentaje gtalents',

        'name_position'               => 'Nombre de la posición',
        'positions_number'            => 'Número de posiciones',
        'location'                    => 'Ubicación', 
        'target_companies'            => 'Empresas Objetivo (Opcional)',
        'companies_where_the_candidate_has_worked'  => 'Empresas donde haya trabajado el candidato', 
        'off_limits_companies'        => 'Empresas Off-limits', 
        'required_experience'         => 'Experiencia Requerida',
        'key_position_questions'      => 'Preguntas claves de la posición',
        'search_type'                 => 'Tipo de Búsqueda', 
        'contract_type'               => 'Tipo de Contratación',
        'years_of_experience'         => 'Años de Experiencia',
        'range_salary'                => 'Rango Salarial',
        'fee_charged_to_employer'     =>'Honorario cobrado al empleador',
        'replacement_period'          => 'Periodo de Reemplazo',
        'warranty_employer'           => 'Garantia al Empleador',
        'fee'                         => 'Honorarios', 
        'group1'                       => '%', 
        'group2'                       => '$Fijo' ,
    ],

];
