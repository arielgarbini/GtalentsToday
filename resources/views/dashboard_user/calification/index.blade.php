@extends('layouts.app1')

@section('page-title', trans('app.califications'))

@section('content')
    <!--CONTENEDOR DE CALIFICACIONES-->
    <!-- COMO POSTER-->
    <article class="bills grid">
        <!--TITULO-->
        <section class="bills-title">
            <h3>Como Poster</h3>
            <p>Mis Oportunidades Publicadas</p>
        </section>

        <!--CALIFICACIONES-->
        <ul class="collapsible" data-collapsible="accordion">
            <!--OPORTUNIDAD 1-->
            <li>
                <div class="collapsible-header">
                    <!-- RESUMEN OPORTUNIDAD-->
                    <section class="opportunity-admin">
                        <!--DATOS DEL POST-->
                        <div class="item-activity">
                            <h5>Publicado</h5>
                            <h2>Desarrollador .NET</h2>
                            <h3>Buenos Aires, Argentina | REF49</h3>
                            <p>Publicado | Jue,17 Nov 2016</p>
                        </div>

                        <!--RESUMEN DEL POST-->
                        <div class="item">
                            <!--VISITAS-->
                            <div class="item-option">
                                <h4>47</h4>
                                <span>Visitas</span>
                            </div>

                            <!--CANDIDATOS-->
                            <div class="item-option">
                                <h4>9</h4>
                                <span>Candidatos</span>
                            </div>

                            <!--POR ACEPTAR-->
                            <div class="item-option">
                                <h4>3</h4>
                                <span>Por aceptar</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="collapsible-body">
                    <!--COMENTARIO 1-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>
                </div>
            </li>

            <!--OPORTUNIDAD 2-->
            <li>
                <div class="collapsible-header">
                    <!-- RESUMEN OPORTUNIDAD-->
                    <section class="opportunity-admin">
                        <!--DATOS DEL POST-->
                        <div class="item-activity">
                            <h5>Publicado</h5>
                            <h2>Desarrollador .NET</h2>
                            <h3>Buenos Aires, Argentina | REF49</h3>
                            <p>Publicado | Jue,17 Nov 2016</p>
                        </div>

                        <!--RESUMEN DEL POST-->
                        <div class="item">
                            <!--VISITAS-->
                            <div class="item-option">
                                <h4>3</h4>
                                <span>Visitas</span>
                            </div>

                            <!--CANDIDATOS-->
                            <div class="item-option">
                                <h4>0</h4>
                                <span>Candidatos</span>
                            </div>

                            <!--POR ACEPTAR-->
                            <div class="item-option">
                                <h4>1</h4>
                                <span>Por aceptar</span>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="collapsible-body">
                    <!--COMENTARIO 1-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>

                    <!--COMENTARIO 2-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>

                    <!--COMENTARIO 3-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>
                </div>
            </li>

            <!--OPORTUNIDAD 3-->
            <li>
                <div class="collapsible-header">
                    <!-- RESUMEN OPORTUNIDAD-->
                    <section class="opportunity-admin">
                        <!--DATOS DEL POST-->
                        <div class="item-activity">
                            <h5>Publicado</h5>
                            <h2>Desarrollador .NET</h2>
                            <h3>Buenos Aires, Argentina | REF49</h3>
                            <p>Publicado | Jue,17 Nov 2016</p>
                        </div>

                        <!--RESUMEN DEL POST-->
                        <div class="item">
                            <!--VISITAS-->
                            <div class="item-option">
                                <h4>204</h4>
                                <span>Visitas</span>
                            </div>

                            <!--CANDIDATOS-->
                            <div class="item-option">
                                <h4>41</h4>
                                <span>Candidatos</span>
                            </div>

                            <!--POR ACEPTAR-->
                            <div class="item-option">
                                <h4>27</h4>
                                <span>Por aceptar</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="collapsible-body">
                    <!--COMENTARIO 1-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>
                </div>
            </li>
        </ul>
    </article>

    <!-- COMO SUPPLIER-->
    <article class="bills grid">
        <!--TITULO-->
        <section class="bills-title">
            <h3>Como Supplier</h3>
            <p>Oportunidades en las que participé</p>
        </section>

        <!--CALIFICACIONES-->
        <ul class="collapsible" data-collapsible="accordion">
            <!--OPORTUNIDAD 1-->
            <li>
                <div class="collapsible-header">
                    <!-- RESUMEN OPORTUNIDAD-->
                    <section class="opportunity-admin">
                        <!--DATOS DEL POST-->
                        <div class="item-activity">
                            <h5>Publicado</h5>
                            <h2>Desarrollador .NET</h2>
                            <h3>Buenos Aires, Argentina | REF49</h3>
                            <p>Publicado | Jue,17 Nov 2016</p>
                        </div>

                        <!--RESUMEN DEL POST-->
                        <div class="item">
                            <!--VISITAS-->
                            <div class="item-option">
                                <h4>47</h4>
                                <span>Visitas</span>
                            </div>

                            <!--CANDIDATOS-->
                            <div class="item-option">
                                <h4>9</h4>
                                <span>Candidatos</span>
                            </div>

                            <!--POR ACEPTAR-->
                            <div class="item-option">
                                <h4>3</h4>
                                <span>Por aceptar</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="collapsible-body">
                    <!--COMENTARIO 1-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>
                </div>
            </li>

            <!--OPORTUNIDAD 2-->
            <li>
                <div class="collapsible-header">
                    <!-- RESUMEN OPORTUNIDAD-->
                    <section class="opportunity-admin">
                        <!--DATOS DEL POST-->
                        <div class="item-activity">
                            <h5>Publicado</h5>
                            <h2>Desarrollador .NET</h2>
                            <h3>Buenos Aires, Argentina | REF49</h3>
                            <p>Publicado | Jue,17 Nov 2016</p>
                        </div>

                        <!--RESUMEN DEL POST-->
                        <div class="item">
                            <!--VISITAS-->
                            <div class="item-option">
                                <h4>3</h4>
                                <span>Visitas</span>
                            </div>

                            <!--CANDIDATOS-->
                            <div class="item-option">
                                <h4>0</h4>
                                <span>Candidatos</span>
                            </div>

                            <!--POR ACEPTAR-->
                            <div class="item-option">
                                <h4>1</h4>
                                <span>Por aceptar</span>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="collapsible-body">
                    <!--COMENTARIO 1-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>

                    <!--COMENTARIO 2-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>

                    <!--COMENTARIO 3-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>
                </div>
            </li>

            <!--OPORTUNIDAD 3-->
            <li>
                <div class="collapsible-header">
                    <!-- RESUMEN OPORTUNIDAD-->
                    <section class="opportunity-admin">
                        <!--DATOS DEL POST-->
                        <div class="item-activity">
                            <h5>Publicado</h5>
                            <h2>Desarrollador .NET</h2>
                            <h3>Buenos Aires, Argentina | REF49</h3>
                            <p>Publicado | Jue,17 Nov 2016</p>
                        </div>

                        <!--RESUMEN DEL POST-->
                        <div class="item">
                            <!--VISITAS-->
                            <div class="item-option">
                                <h4>204</h4>
                                <span>Visitas</span>
                            </div>

                            <!--CANDIDATOS-->
                            <div class="item-option">
                                <h4>41</h4>
                                <span>Candidatos</span>
                            </div>

                            <!--POR ACEPTAR-->
                            <div class="item-option">
                                <h4>27</h4>
                                <span>Por aceptar</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="collapsible-body">
                    <!--COMENTARIO 1-->
                    <section class="comment">
                        <!--USUARIO-->
                        <div class="comment-user">
                            <figure>
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <div class="comment-user-datos">
                                <h3>GFE-986</h3>
                                <h4>Hiring Pro</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3"></span>
                                    <span class="icon-gTalents_stars-3 star-null"></span>
                                </figure>
                                <p>Hace 15min</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    Excelente poster! Siempre esta publicando ofertas laborales muy variadas, exigentes y dinamicas que busca sacar lo mejor de los profesionales con un salario muy competitivo. Siempre es un placer conversar con él.
                                </p>
                            </div>

                        </div>
                    </section>
                </div>
            </li>
        </ul>
    </article>

    <!-- REGISTRO DE ACTIVIDADES-->
    <article class="credits grid">
        <!--TITULO DE LA SECCION-->
        <section class="credits-title">
            <h3>234 Registros de Actividades</h3>
        </section>

        <!--LISTADO DE CREDITOS-->
        <ul class="credits-container">
            <!-- ACTIVIDAD 1 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>150</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador .NET</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>

                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>
                        Recomendado
                        <br><strong>12 candidatos</strong>
                    </p>
                </div>
            </li>

            <!-- ACTIVIDAD 2 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>36</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador .NET</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>

                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>Calificado</p>
                    <div class="qualification">
                        <figure>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3 star-null"></span>
                        </figure>
                    </div>
                </div>
            </li>

            <!-- ACTIVIDAD 3 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>85</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador Node.JS</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>
                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>
                        Devolución
                        <br><strong>3 candidatos</strong>
                    </p>
                </div>
            </li>

            <!-- ACTIVIDAD 4 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>150</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador .NET</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>
                </section>

                <!-- MOTIVO-->
                <div class="motivo">
                    <p>
                        Recomendado
                        <br><strong>12 candidatos</strong>
                    </p>
                </div>
            </li>

            <!-- ACTIVIDAD 5 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>36</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador .NET</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>

                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>Calificado</p>
                    <div class="qualification">
                        <figure>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3 star-null"></span>
                        </figure>
                    </div>
                </div>
            </li>

            <!-- ACTIVIDAD 6 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>85</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador Node.JS</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>
                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>
                        Devolución
                        <br><strong>3 candidatos</strong>
                    </p>
                </div>
            </li>

            <!-- ACTIVIDAD 7 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>36</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador .NET</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>

                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>Calificado</p>
                    <div class="qualification">
                        <figure>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3 star-null"></span>
                        </figure>
                    </div>
                </div>
            </li>

            <!-- ACTIVIDAD 8 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>85</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador Node.JS</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>
                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>
                        Devolución
                        <br><strong>3 candidatos</strong>
                    </p>
                </div>
            </li>

            <!-- ACTIVIDAD 9 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>150</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador .NET</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>
                </section>

                <!-- MOTIVO-->
                <div class="motivo">
                    <p>
                        Recomendado
                        <br><strong>12 candidatos</strong>
                    </p>
                </div>
            </li>

            <!-- ACTIVIDAD 10 -->
            <li>
                <!--PUNTAJE GANADO-->
                <figure class="points">
                    <h4>36</h4>
                    <span>puntos</span>
                </figure>

                <!--actividad-->
                <section class="activity-cards">
                    <figure>
                        <span class="icon-gTalents_post"></span>
                    </figure>

                    <!--DATOS-->
                    <div class="item-activity">
                        <h2>Desarrollador .NET</h2>
                        <h3>Buenos Aires, Argentina | REF49</h3>
                        <p>Publicado | Jue,17 Nov 2016</p>
                    </div>

                </section>
                
                <!-- MOTIVO-->
                <div class="motivo">
                    <p>Calificado</p>
                    <div class="qualification">
                        <figure>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3"></span>
                            <span class="icon-gTalents_stars-3 star-null"></span>
                        </figure>
                    </div>
                </div>
            </li>

        </ul>

        <ul class="pagination">
            <li class="disabled">
                <a href="#!">
                    <span class="icon-gTalents_left"></span>
                </a>
            </li>
            <li class="active"><a href="#!">1</a></li>
            <li class="waves-effect"><a href="#!">2</a></li>
            <li class="waves-effect"><a href="#!">3</a></li>
            <li class="waves-effect"><a href="#!">4</a></li>
            <li class="waves-effect"><a href="#!">5</a></li>
            <li class="waves-effect">
                <a href="#!">
                    <span class="icon-gTalents_right"></span>
                </a>
            </li>
        </ul>
    </article>
@stop

@section('scripts')
   
@stop
