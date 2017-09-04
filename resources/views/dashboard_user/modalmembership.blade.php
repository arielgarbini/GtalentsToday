<!--MODAL MEMBRESIAS-->
<div id="modalMembresias" class="modal modalText">
    <!--CERRAR-->
    <div class="modal-footer">
        <a class=" modal-action modal-close waves-effect waves-green btn-flat">
            <span class="icon-gTalents_close"></span>
        </a>
    </div>

    <!--CONTENIDO-->
    <div class="modal-content">
        <!--PODRAS CONVERTIRTE EN SOCIO-->
        <article class="generic grid">
            <!--TITULO DE LA SECCION-->
            <section class="generic-title bloque">
                <span class="icon-gTalents_win-23"></span>
                <h2> {{ trans('home.You can become' ) }} <strong>{{ trans('home.member' ) }} </strong> {{ trans('home.if you re' ) }}</h2>
            </section>

            <!--PUNTOS-->
            <section class="skill-A">
                <!--PUNTO 1-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p> {{ trans('home.A global, regional or local Executive Recruitment firm (Retention or Contingency)' ) }} </p>
                </div>

                <!--PUNTO 2-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>{{ trans('home.Human Resources Professionals or experienced leaders with solid network in contacts') }}</p>
                </div>

                <!--PUNTO 3-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p> {{ trans('home.Consulting Firms in Human Resources' ) }} </p>
                </div>

                <!--PUNTO 4-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>{{ trans('home.Independent Executive Recruiters') }} </p>
                </div>
            </section>

            <section class="link">
                <a href="" class="btn-main2">{{ trans('home.Start now' ) }} </a>
            </section>
        </article>

        <!--TIPOS DE SOCIOS-->
        <article class="generic grid">
            <!--TITULO DE LA SECCION-->
            <section class="generic-title">
                <span class="icon-gTalents_mountain"></span>
                <h2>{{ trans('home.Types of') }}<strong> {{ trans('home.member' ) }}  </strong></h2>
            </section>

            <!--TEXTO DE LA SECCION-->
            <section class="paragraph">
                <p> {{ trans('home.We are a global platform that connects Recruiters and HR Professionals anywhere in the world') }} </p>
            </section>

            <!--TIPOS DE SOCIOS-->
            <section class="generic-skill member">
                <!-- POSTER-->
                <div class="item">
                    <figure>
                        <span class="icon-gTalents_poster"></span>
                    </figure>
                    <h3> poster</h3>
                    <p>{{ trans('home.It is the member who publishes the position, who handles the contact with the client and ensures the closure of the project') }} </p>
                </div>

                <!-- SUPPLIER-->
                <div class="item">
                    <figure>
                        <span class="icon-gTalents_supplier-26"></span>
                    </figure>
                    <h3> Supplier</h3>
                    <p>{{ trans('home.It is the member who works in the generation of candidates, who has a clear understanding of the profile and efficiently presents the profiles') }} </p>
                </div>

                <!--GTALENTS STAR-->
                <div class="item">
                    <figure>
                        <span class="icon-gTalents_gtalents-star"></span>
                    </figure>
                    <h3> gtalents star</h3>
                    <p>{{ trans('home.It is the member who has both roles and the one who earns the most income. Duplicate the profits by publishing positions and generating candidates for other publications simultaneously') }} </p>
                </div>
            </section>
        </article>

        <!--COMO RECIBEN LOS PAGOS-->
        <article class="generic grid">
            <!--TITULO DE LA SECCION-->
            <section class="generic-title">
                <span class="icon-gTalents_pagos"></span>
                <h2>{{ trans('home.How do members get paid and in what proportion?')}}</h2>
            </section>

            <!--TEXTO DE LA SECCION-->
            <section class="paragraph">
                <p> {{ trans('home.Accumulate experience and increase your proportion / income as you publish and share candidates successfully. Human resources anywhere around the world')}} </p>
            </section>

            <!--INDICES DE GANANCIAS-->
            <div class="generic-skill member">
                <div class="row">
                    <div class="col m4">
                        <!--INDICES POSTER-->
                        <div class="item">
                            <img src="assets/img/indice-poster.png" alt="">
                        </div>
                    </div>
                    <div class="col m4">
                        <!--INDICES SUPPLIER-->
                        <div class="item">
                            <img src="assets/img/indice-supplier.png" alt="">
                        </div>
                    </div>
                    <div class="col m4">
                        <!--INDICES STAR-->
                        <div class="item">
                            <img src="assets/img/indice-star.png" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <!--PUNTOS de EJEMPLO-->
            <section class="skill-B">
                <div class="example">
                    <h4> {{ trans('home.Example, Invoice Search:')}} USD 40,000</h4>
                </div>
                <!--PUNTO 1-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>  40% Poster: USD <b>16,000</b> - {{ trans('home.Become a Top Poster, your proportion increases as you publish and successfully close projects')}} </p>
                </div>

                <!--PUNTO 2-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>  40% Supplier: USD <b>16,000</b> - {{ trans('home.Become a Top Supplier, in the same way, as you make successful placements, your proportion and income will increase')}} </p>
                </div>

                <!--PUNTO 3-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>  20% gTalents: USD <b>8,000</b> - gTalents {{ trans('home.will reinvest in their loyal members. As our members become frequent users, gTalents will lower their fees to a minimum')}} </p>
                </div>

                <!--PUNTO 4-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>{{ trans('home.The Poster sends an invoice to its client as soon as the candidate has been placed')}} </p>
                </div>

                <!--PUNTO 5-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>{{ trans('home.Global Talent Shift sends an invoice to the Poster for 60% of the value of the initial invoice that was sent to the customer')}} </p>
                </div>

                <!--PUNTO 6-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>{{ trans('home.The Supplier sends an invoice to Global Talent Shift for 40% of the value of the initial invoice sent to the customer')}} </p>
                </div>

                <!--PUNTO 7-->
                <div class="item">
                    <span class="icon-gTalents_point"></span>
                    <p>{{ trans('home.In this way, the Poster receives 40%, Supplier 40% and Global Talent Shift 20%')}} </p>
                </div>
            </section>
        </article>

        <!--RANGOS EN GTALENTS-->
        <article class="generic grid">
            <!--TITULO DE LA SECCION-->
            <section class="generic-title">
                <span class="icon-gTalents_ranking"></span>
                <h2> {{ trans('home.Ranges in')}} <strong>gTalents</strong> {{ trans('home.Climbing up ranks')}}</h2>
            </section>

            <!--TEXTO DE LA SECCION-->
            <section class="paragraph">
                <p>{{ trans('home.Being an active and well-qualified member, you will get great benefits, increasing your income ratio')}} </p>
            </section>

            <!--RANGOS-->
            <section class="skill-rangos">
                <!--RANGO 1-3-->
                <div class="item">
                    <!--RANGO 1-->
                    <div class="item-options">
                        <div class="number">
                            <span class="icon-gTalents_one"></span>
                        </div>
                        <div class="rango">
                            <figure>
                                <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                            </figure>
                            <p>Newbie (Talent Shifty)</p>
                        </div>
                    </div>

                    <!--RANGO 2-->
                    <div class="item-options">
                        <div class="number">
                            <span class="icon-gTalents_two"></span>
                        </div>
                        <div class="rango">
                            <figure class="special">
                                <span class="icon-gTalents_rango-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <p>Hiring Pro </p>
                        </div>
                    </div>

                    <!--RANGO 3-->
                    <div class="item-options">
                        <div class="number">
                            <span class="icon-gTalents_three"></span>
                        </div>
                        <div class="rango">
                            <figure>
                                <span class="icon-gTalents_rango-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                            </figure>
                            <p>Boolean Boss</p>
                        </div>
                    </div>
                </div>

                <!--RANGO 4-6-->
                <div class="item">
                    <!--RANGO 4-->
                    <div class="item-options">
                        <div class="number">
                            <span class="icon-gTalents_four"></span>
                        </div>
                        <div class="rango">
                            <figure class="special">
                                <span class="icon-gTalents_rango-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                            </figure>
                            <p>Staffing Elite</p>
                        </div>
                    </div>

                    <!--RANGO 5-->
                    <div class="item-options">
                        <div class="number">
                            <span class="icon-gTalents_five"></span>
                        </div>
                        <div class="rango">
                            <figure class="special">
                                <span class="icon-gTalents_rango-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                            </figure>
                            <p>Sourcing Guru</p>
                        </div>
                    </div>

                    <!--RANGO 6-->
                    <div class="item-options">
                        <div class="number">
                            <span class="icon-gTalents_six"></span>
                        </div>
                        <div class="rango">
                            <figure class="special">
                                <span class="icon-gTalents_rango-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                            </figure>
                            <p>Global Talent Shifter </p>
                        </div>
                    </div>
                </div>
            </section>
        </article>

        <!--COMO CALIFICO POR OTROS SOCIOS-->
        <article class="generic grid">
            <!--TITULO DE LA SECCION-->
            <section class="generic-title">
                <span class="icon-gTalents_mountain"></span>
                <h2>{{ trans('home.How do I qualify and qualify for other members')}} ? </h2>
            </section>

            <!--TEXTO DE LA SECCION-->
            <section class="paragraph">
                <p class="text-left">{{ trans('home.Once a publication has been successfully closed, the Poster will be able to qualify the Suppliers that worked together and in the same way they will be able to qualify the Poster. Our Audit team will review each case and will sometimes act as a "judge", based on good practice in executive search and global ethical principles')}} </p>

                <p class="text-left">{{ trans('home.Having a good rating will make you climb levels in gTalents, increasing your income and having access to more and better members')}} </p>
            </section>

            <div style="text-align: center; margin-top:10px;">
                <a class=" modal-action modal-close waves-effect waves-green btn-main2">
                    Close
                </a>
            </div>

        </article>

    </div>

</div>