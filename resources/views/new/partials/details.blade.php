<div class="panel panel-default">
    <div class="panel-heading">@lang('app.new_details')</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">@lang('app.title')</label>
                        {!! Form::text('title', $edit ? $new->title: '', ['id' => 'title', 'class' => 'form-control','placeholder' => trans('app.title')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="section">@lang('app.section')</label>
                        {!! Form::text('section', $edit ? $new->section: '', ['id' => 'section', 'class' => 'form-control','placeholder' => trans('app.section')]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">@lang('app.description')</label>
                        {!! Form::textarea('description', $edit ? $new->description: '', ['class' => 'form-control', 'id' => 'description', 'placeholder' => trans('app.description')]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
