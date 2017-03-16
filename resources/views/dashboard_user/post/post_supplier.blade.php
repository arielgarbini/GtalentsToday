@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')
    <!--CONTENEDOR INDEX REGISTRADO-->
    <article class="user-main grid">
        <!--OPORTUNIDAD-->
        <section class="user-main-create credits jobs-detail">
            <!--TITULO-->
            <div class="jobs-detail-title">
                <h3>Desarrollador .NET</h3>
                <p>Buenos Aires, Argentina | Jornada Completa</p>
            </div>

            <!--CUERPO DE LA DESCRIPCION-->
            <div class="jobs-detail-body">
                <!--DESCRIPCION DE LA EMPRESA-->
                <h4>Descripción de la empresa contratante</h4>
                <p>Software Factory ubicada en la zona de Colegiales (CABA)</p>

                <!--DESCRIPCION DEL TRABAJO-->
                <h4>Descripción del trabajo</h4>
                <p>Buscamos una persona con ganas de seguir capacitándose en nuevas tecnologías.
                    <br>El trabajo es en relación de dependencia directa con la empresa, y existe la posibilidad de trabajar desde casa algún día a la semana.
                    <br>La búsqueda está orientada a personas que estén interesadas en aplicar tecnologías y metodologías tales como WPF, ASP.net MVC, JQuery, Knockout, Entity Framework, Ajax/Json, HTML5 Bootstrap, webservices y WCF.
                </p>

                <!--EXPERIENCIA DESEADA-->
                <h4>Experiencia Deseada</h4>
                <ul class="jobs-detail-body-kills">
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: C# - WinForm o WPF (Excluyente)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: .NET Framework 3.0 / 4.0 (Excluyente)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Bases de Datos: MS SQL Server u ORACLE (Excluyente)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: ASP.NET MVC (Deseable)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: Java Script (Deseable)</p>
                    </li>
                </ul>
                <p>Es requisito contar con experiencia de 1 a 3 años en algunas de las tecnologías antes mencionadas.</p>

                <!--INFORMACION ADICIONAL-->
                <h4>Información Adicional</h4>
                <p>Se ofrecen excelentes condiciones contractuales, flexibilidad, beneficios y muy buen clima laboral. Las posiciones son en relación de dependencia directa, excelente remuneración + OSDE + 2 semanas de vacaciones.</p>

                <!--HORARIO DE TRABAJO-->
                <h4>Horario de trabajo</h4>
                <p>9 a 18 hs.</p>

                <!--UBICACION-->
                <h4>Ubicación</h4>
                <p>Capital Federal - Colegiales</p>

                <!--TIPO DE CONTRATACION-->
                <h4>Tipo de Contratación</h4>
                <p>Full-time.</p>

                <!--ESPECIALIZACION-->
                <h4>Especialización</h4>
                <p>Diseño, Programación Frontend.</p>

                <!--AÑOS DE EXPERIENCIA-->
                <h4>Años de experiencia</h4>
                <p>3-5 años.</p>

                <!--IDIOMAS-->
                <h4>Idiomas</h4>
                <p>Español.</p>

                <!--RANGO SALARIAL-->
                <h4>Rango Salarial</h4>
                <p>USD 125k - 150k.</p>

                <!--HONORARIO COBRADO AL EMPLEADOR-->
                <h4>Honorario cobrado al empleador</h4>
                <p>23% - Fijo.</p>

                <!--PERIODO DE REEMPLAZO-->
                <h4>Periodo de Reemplazo</h4>
                <p>1 MES.</p>

                <!--LINK DESCARGA-->
                <div class="link">
                    <a href="#">
                        <figure>
                            <span class="icon-gTalents_pdf"></span>
                        </figure>
                        <p>Descripción del puesto</p>
                    </a>
                </div>

                <!--RESUMEN-->
                <ul class="jobs-detail-body-resum">
                    <!--FACTURACION APROXIMADA-->
                    <li>
                        <figure class="icon-verde">
                            <span class="icon-gTalents_billetes"></span>
                        </figure>
                        <div class="datos">
                            <h4>$350</h4>
                            <p>Facturación total aproximada</p>
                        </div>
                    </li>

                    <!--COMISION DEL SUPPLIER-->
                    <li>
                        <figure class="icon-gris">
                            <span class="icon-gTalents_coins"></span>
                        </figure>
                        <div class="datos">
                            <h4>20% de Comisión</h4>
                            <p>Comisión del Supplier</p>
                        </div>
                    </li>

                    <!--COMISION DEL POSTER-->
                    <li>
                        <figure class="icon-gris">
                            <span class="icon-gTalents_coins"></span>
                        </figure>
                        <div class="datos">
                            <h4>5% de Comisión</h4>
                            <p>Comisión del Poster</p>
                        </div>
                    </li>

                    <!--COMPENSACION DE LA POSICION-->
                    <li>
                        <figure class="icon-naranja">
                            <span class="icon-gTalents_stars"></span>
                        </figure>
                        <div class="datos">
                            <h4>1.500 puntos</h4>
                            <p>Compensación de la posición</p>
                        </div>
                    </li>

                    <!--TUS GARANTIAS-->
                    <li>
                        <figure class="icon-naranja">
                            <span class="icon-gTalents_help"></span>
                        </figure>
                        <div class="datos">
                            <h4>Tus Garantias</h4>
                            <p>Velamos por ti</p>
                        </div>
                    </li>

                    <!--COMISION GTALENTS-->
                    <li>
                        <figure>
                            <span class="icon-gTalents_isotipo"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                        </figure>
                        <div class="datos">
                            <h4>30% de Comisión</h4>
                            <p>Comisión de gTalents</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!--INTERESADO - OFERTAS SIMILARES-->
        <section class="user-main-contain">

            <!-- RESUMEN -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>Oportunidad</h3>
                </section>

                <!--CIRCULO RESUMEN-->
                <div class="item-circle">
                    <figure>
                        <h4>57</h4>
                        <span>visitas</span>
                    </figure>
                </div>

                <!--RESUMEN INDICES-->
                <div class="item-resumVisitas">
                    <!--SUPPLIER-->
                    <div class="item-option">
                        <h4>8</h4>
                        <span class="opt-sm">suppliers</span>
                    </div>

                    <!--CANDIDATOS-->
                    <div class="item-option">
                        <h4>13</h4>
                        <span class="opt-sm">candidatos</span>
                    </div>
                </div>
            </div>

            <!-- LISTADO EQUIPOS Y CANDIDATOS -->
            <div class="user-main-contain-resumTeam">
                <ul class="tabs">
                    <li class="tab">
                        <a class="active" href="#mySuppliers">Disponibles</a>
                    </li>
                    <li class="tab">
                        <a href="#myCandidates">En Curso</a>
                    </li>
                    <li class="tab">
                        <a href="#noLeidos">Rechazados</a>
                    </li>
                </ul>

                <!--CANDIDATOS DISPONIBLES-->
                <div class="team-container" id="mySuppliers">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>15 Candidatos</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <form action="" class="formLogin select-colab">
                        <ul class="team">
                            <!-- SUPPLIER 1 -->
                            <li>
                                <p class="check">
                                    <input type="checkbox" id="test5" />
                                    <label for="test5"></label>
                                </p>
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <div class="datos">
                                            <h3>Andres Gonzalez</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='option-team01'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='option-team01' class='dropdown-content'>
                                            <li><a href="#">Ver CV</a></li>
                                            <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                            <li><a href="#">Descartar</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </li>

                            <!-- SUPPLIER 2 -->
                            <li>
                                <p class="check">
                                    <input type="checkbox" id="test6" />
                                    <label for="test6"></label>
                                </p>
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <div class="datos">
                                            <h3>Andres Gonzalez</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='option-team02'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='option-team02' class='dropdown-content'>
                                            <li><a href="#">Ver CV</a></li>
                                            <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                            <li><a href="#">Descartar</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </li>

                            <!-- SUPPLIER 3 -->
                            <li>
                                <p class="check">
                                    <input type="checkbox" id="test7" />
                                    <label for="test7"></label>
                                </p>
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <div class="datos">
                                            <h3>Andres Gonzalez</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='option-team03'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='option-team03' class='dropdown-content'>
                                            <li><a href="#">Ver CV</a></li>
                                            <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                            <li><a href="#">Descartar</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </li>

                            <!-- SUPPLIER 4 -->
                            <li>
                                <p class="check">
                                    <input type="checkbox" id="test8" />
                                    <label for="test8"></label>
                                </p>
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <div class="datos">
                                            <h3>Andres Gonzalez</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='option-team04'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='option-team04' class='dropdown-content'>
                                            <li><a href="#">Ver CV</a></li>
                                            <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                            <li><a href="#">Descartar</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </li>
                        </ul>

                        <div class="send-colab">
                            <a href="#modalSendColab" class="modal-trigger waves-effect waves-light">
                                Enviar Candidatos
                            </a>
                        </div>                      
                    </form>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewCandidato" class="modal-trigger waves-effect waves-light">
                            <p>Nuevo Candidato</p>
                        </a>
                    </section>
                </div>

                <!-- MIS CANDIDATOS EN CURSO -->
                <div class="team-container g-general" id="myCandidates">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>51 Candidatos</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team">
                        <!-- CANDIDATO 1 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>FrontEnd Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb1'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb1' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 2 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Backend Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb2'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb2' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 3 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>UX/UI Designer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb3'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb3' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 4 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Diseñador Grafico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb4'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb4' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 5 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Chef</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb5'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb5' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 6 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Ayudante de Cocina</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb6'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb6' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>                   
                </div>

                <!-- RECHAZADOS -->
                <div class="team-container g-general" id="noLeidos">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>22 No Leidos</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team">
                        <!-- CANDIDATO 1 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>FrontEnd Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido1'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido1' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 2 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Backend Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido2'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido2' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 3 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>UX/UI Designer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido3'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido3' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 4 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Diseñador Grafico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido4'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido4' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 5 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Chef</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido5'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido5' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 6 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Ayudante de Cocina</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido6'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido6' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">Historico</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>               
                </div>
            </div>
        </section>
    </article>


    <!--MODAL CALIFICAR SUPPLIER-->
    <div id="modalSendColab" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Enviar Candidatos</h4>
        </div>

        <div class="modal-content">

            <!--RESPUESTA-->
            <form action="" class="formLogin">
                <!--SLIDER DE CANDIDATOS SELECCIONADOS-->
                <div class="slider">
                    <ul class="slides">
                        <!-- CANDIDATO 1-->
                        <li>
                            <!--TARJETA DEL CANDIDATO-->
                            <div class="profile-colab">
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>Andres Gonzalez</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--DESCARGAR CV-->
                                    <div class="link">
                                        <a href="#">
                                            <span class="icon-gTalents_download"></span>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </li>

                        <!-- CANDIDATO 2-->
                        <li>
                            <!--TARJETA DEL CANDIDATO-->
                            <div class="profile-colab">
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>COLF-857</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--DESCARGAR CV-->
                                    <div class="link">
                                        <a href="#">
                                            <span class="icon-gTalents_download"></span>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </li>

                        <!-- CANDIDATO 3-->
                        <li>
                            <!--TARJETA DEL CANDIDATO-->
                            <div class="profile-colab">
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>VEF-785</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--DESCARGAR CV-->
                                    <div class="link">
                                        <a href="#">
                                            <span class="icon-gTalents_download"></span>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </li>
                    </ul>
                </div>

                        <!--MENSAJE-->
                        <div class="itemForm icon-help">
                            <label>Escribe tu comentario</label>
                            <textarea name="" id="" cols="30" rows="10" placeholder="Escribe tu comentario"></textarea>
                        </div>

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            Regresar
                        </a>
                    </div>

                    <!--INVITAR-->
                    <div class="item">
                        <a href="#" class="btn-main" type="submit" id="btn-modalMain">
                            Invitar
                        </a>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>Candidatos enviados exitosamente</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL VER NOTAS DE CANDIDATOS-->
    <div id="modalHistorico" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Historico del Candidato</h4>
        </div>

        <div class="modal-content">
            <!--TARJETA DEL CANDIDATO-->
            <div class="profile-colab">
                <section class="team-card">
                    <!--PERSONA-->
                    <div class="team-card-person">
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>
                        <div class="datos">
                            <h3>Andres Gonzalez</h3>
                            <p>FrontEnd Developer</p>
                        </div>
                    </div>

                    <!--DESCARGAR CV-->
                    <div class="link">
                        <a href="#">
                            <span class="icon-gTalents_download"></span>
                        </a>
                    </div>
                </section>

            <!--RESPUESTA-->
            <form action="" class="formLogin form-status">
                <!--SELECTOR DE ESTATUS-->
                <div class="itemForm">
                    <select class="browser-default">
                        <option value="1" selected>Estatus 1</option>
                        <option value="2">Estatus 2</option>
                        <option value="3">Estatus 3</option>
                    </select>
                </div>

                <!--HISTORIAL DE ESTATUS-->
                <ul class="historial-status">
                    <!--ESTATUS 1-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 1</p>
                    </li>

                    <!--ESTATUS 2-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 2</p>
                    </li>

                    <!--ESTATUS 3-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 3</p>
                    </li>

                    <!--ESTATUS 4-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 4</p>
                    </li>

                    <!--ESTATUS 5-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 5</p>
                    </li>

                    <!--ESTATUS 6-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 6</p>
                    </li>

                    <!--ESTATUS 7-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 7</p>
                    </li>
                </ul>
                

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            Regresar
                        </a>
                    </div>

                    <!--CONTRATAR-->
                    <div class="item">
                        <a href="contratar.php" class="btn-main" type="submit" id="btn-modalMain">
                            Contratar
                        </a>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>Mensaje enviado exitosamente</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
   
@stop
