<div class="panel panel-default">
    <div class="panel-heading">@lang('app.invoice_details')</div>
    <div class="panel-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">@lang('app.name')</label>
                        {!! Form::text('name', $edit ? $invoice->name: '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => trans('app.name')]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount">@lang('app.amount')</label>
                        {!! Form::text('amount', $edit ? $invoice->amount: '', ['class' => 'form-control', 'id' => 'amount', 'placeholder' => trans('app.amount')]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">@lang('app.status')</label>
                        {!! Form::select('status', ['Pending' => trans('app.pending') ,'Rejected' => trans('app.Rejected'), 'Confirm' => trans('app.Confirm')], $edit ? $invoice->status: '', ['class' => 'form-control', 'id' => 'status']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="number">@lang('app.number')</label>
                        {!! Form::text('number', $edit ? $invoice->number: '', ['class' => 'form-control', 'id' => 'number', 'placeholder' => trans('app.number')]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_of_admission">@lang('app.date_of_admission')</label>
                        <div class="input-group date">
                            {!! Form::text('date_of_admission', $edit ? $invoice->date_of_admission: '', ['class' => 'form-control datepicker', 'id' => 'date_of_admission', 'placeholder' => trans('app.date_of_admission')]) !!}
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="payment_due">@lang('app.payment_due')</label>
                        <div class="input-group date">
                            {!! Form::text('payment_due', $edit ? $invoice->payment_due: '', ['class' => 'form-control datepickerr', 'id' => 'payment_due', 'placeholder' => trans('app.payment_due')]) !!}
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="offer">@lang('app.offer')</label>
                        {!! Form::textarea('offer', $edit ? $invoice->offer: '', ['class' => 'form-control', 'id' => 'offer', 'placeholder' => trans('app.offer')]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{route('invoices.index')}}" class="btn btn-primary">
                    <i class="fa fa-arrow-left "></i>
                    @lang('app.back')
                </a>
                <button type="submit" class="btn btn-primary" id="update-details-btn">
                    <i class="fa fa-{{ $edit ? 'refresh' : 'save' }}"></i>
                    {{ $edit ? trans('app.update_details') : trans('app.create_invoice') }}
                </button>
            </div>
        </div>
    </div>
</div>