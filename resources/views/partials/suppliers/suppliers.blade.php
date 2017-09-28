@foreach ($suppliers as $supplier)
    <li>
        <a href="#">
            <!--RESUMEN OPORTUNIDAD-->
            <section class="supplierContain1">
                <!--ICONO RANGO-->
                <figure class="supplierContain1-ranking">
                    <img class="category-p tooltipped" src="/upload/categories/{{$supplier->company[0]->category->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{$supplier->company[0]->category->name}}">
                </figure>

                <div class="datos">
                    <h4>{{$supplier->code}}</h4>
                    <p>{{$supplier->company[0]->category->name}}</p>
                </div>
            </section>
        </a>

        <!--AGREGAR SUPPLIER-->
        <div class="add-supplier">
            <!--PERFIL-->
            <div class="link">
                <a modal="modalProfileSupplier{{$supplier->id}}" href="#" class="will-smith">
                    <span class="icon-gTalents_profile"></span>
                </a>
            </div>

            <!--AGREGAR SUPPLIER-->
            <div class="link">
                <form method="POST" action="{{route('vacancies.invited.supplier', $data['vacancy'])}}">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$supplier->id}}" name="supplier">
                    <a href="#" class="send_form">
                        <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    </a>
                </form>
            </div>
        </div>
        @include('dashboard_user.post.partials.modalsupplier')
    </li>
@endforeach