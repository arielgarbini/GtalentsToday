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
                <!--RANGO 1-->
                <?php
                $range = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];
                $i = 0;
                $categories = \Vanguard\Category::all();
                $mitad = ceil(count($categories) / 2) ;
                ?>
                @foreach($categories as $rr)
                    @if($i==0 || $i==$mitad)
                        <div class="item">
                            @endif
                            <div class="item-options">
                                <div class="number">
                                    <img class="category-o" src="/assets/img/gtalents_{{$range[$i]}}.png">
                                </div>
                                <div class="rango">
                                    <img class="category-o" src="/upload/categories/{{$rr->avatar}}">
                                    <p>{{$rr->name}}
                                        @if($rr->required_points!=0)
                                            <br>
                                            <small style="float:left;">@lang('app.required_points'): {{$rr->required_points}}pts</small>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if($i==$mitad-1 || $i==count($categories)-1)
                        </div>
                    @endif
                    <?php
                    $i++;
                    ?>
                @endforeach
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