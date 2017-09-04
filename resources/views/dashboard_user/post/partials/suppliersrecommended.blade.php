@foreach($supliers_recommended as $supplier)
    <li>
        <div class="motivo">

            <section class="supplierContain1">

                <figure class="supplierContain1-ranking">
                    <span class="icon-gTalents_rango-{{$supplier->company[0]->category_id}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                </figure>

                <div class="datos">
                    <h4>{{$supplier->code}}</h4>
                    <p>{{$supplier->company[0]->category->name}}</p>
                </div>
            </section>

            <div class="addSupplier">

                <div class="link">
                    <a modal="modalProfileSupplier{{$supplier->id}}" href="#modalProfileSupplier{{$supplier->id}}" class="modal-job waves-effect waves-light">
                        <span class="icon-gTalents_profile"></span>
                    </a>
                </div>

                <div class="link">
                    <form method="POST" action="{{route('vacancies.invited.supplier', $vacancy->id)}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$supplier->id}}" name="supplier">
                        <a href="#" class="send_form">
                            <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                        </a>
                    </form>
                </div>
            </div>
            @include('dashboard_user.post.partials.modalsupplier')
        </div>
        <span val="{{$supplier->id}}" class="new_supplier icon-gTalents_close close-alert"></span>
    </li>
@endforeach