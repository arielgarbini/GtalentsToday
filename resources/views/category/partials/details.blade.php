<div class="panel panel-default">
    <div class="panel-heading">@lang('app.category_details')</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">@lang('app.name')</label>
                    {!! Form::text('name', $edit ? $category->name: '', ['id' => 'name', 'class' => 'form-control','placeholder' => trans('app.name')]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="is_active">@lang('app.status')</label>
                    {!! Form::select('is_active', [1 => trans('app.active') ,0 => trans('app.inactive')],null,
                        ['class' => 'form-control', 'id' => 'is_active', $profile ? 'disabled' : '']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="code">@lang('app.code')</label>
                    {!! Form::text('code', $edit ? $category->code: '', ['id' => 'code', 'class' => 'form-control','placeholder' => trans('app.code')]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="required_points">@lang('app.required_points')</label>
                    {!! Form::text('required_points', $edit ? $category->required_points: '', ['id' => 'required_points', 'class' => 'form-control','placeholder' => trans('app.required_points')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="poster_percent">@lang('app.poster_percent') (%)</label>
                    {!! Form::text('poster_percent', $edit ? $category->poster_percent: '', ['id' => 'poster_percent', 'class' => 'form-control','placeholder' => trans('app.poster_percent')]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="supplier_percent">@lang('app.supplier_percent') (%)</label>
                    {!! Form::text('supplier_percent', $edit ? $category->supplier_percent: '', ['id' => 'supplier_percent', 'class' => 'form-control','placeholder' => trans('app.supplier_percent')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gtalents_percent">@lang('app.gtalents_percent') (%)</label>
                    {!! Form::text('gtalents_percent', $edit ? $category->gtalents_percent: '', ['id' => 'gtalents_percent', 'class' => 'form-control','placeholder' => trans('app.gtalents_percent')]) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{route('categories.index')}}" class="btn btn-primary">
                    <i class="fa fa-arrow-left "></i>
                    @lang('app.back')
                </a>
                <button type="submit" class="btn btn-primary" id="update-details-btn">
                    <i class="fa fa-{{ $edit ? 'refresh' : 'save' }}"></i>
                    {{ $edit ? trans('app.update_category') : trans('app.create_category') }}
                </button>
            </div>
        </div>
    </div>
</div>