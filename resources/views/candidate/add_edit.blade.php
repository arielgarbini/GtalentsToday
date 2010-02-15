@extends('layouts.app')

@if($edit)
    @section('page-title', trans('app.edit_candidate'))
@else
    @section('page-title', trans('app.add_candidate'))
@endif

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $edit ? trans('app.edit_candidate') : trans('app.create_new_candidate') }}
            <small>@lang('app.candidate_details')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('candidates.index') }}">@lang('app.candidates')</a></li>
                    <li class="active">{{ $edit ? trans('app.edit') : trans('app.create') }}</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

@if($edit)
    {!! Form::model($candidate, ['route' => ['candidates.update', $candidate->id], 'method' => 'put', 'files' => true, 'id' => 'candidate-form']) !!}
        <div class="row">
            <div class="col-md-8">
                @include('candidate.partials.details', ['profile' => false])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{route('candidates.index.admin')}}" class="btn btn-primary">
                    <i class="fa fa-arrow-left "></i>
                    @lang('app.back')
                </a>
                <button type="submit" class="btn btn-primary" id="update-details-btn">
                    <i class="fa fa-refresh"></i>
                    @lang('app.update_details')
                </button>
            </div>
        </div>
    {!! Form::close() !!}

@else
    {!! Form::open(['route' => 'candidates.store', 'files' => true, 'id' => 'candidate-form']) !!}
        <div class="row">
            <div class="col-md-8">
                @include('candidate.partials.details', ['edit' => false, 'profile' => false])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{route('candidates.index.admin')}}" class="btn btn-primary">
                    <i class="fa fa-arrow-left "></i>
                    @lang('app.back')
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    @lang('app.create_candidate')
                </button>
            </div>
        </div>
    {!! Form::close() !!}
@endif

@stop

@section('scripts')
    @if($edit)
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Candidate\UpdateCandidateRequest', '#candidate-form') !!}
    @else
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Candidate\CreateCandidateRequest', '#candidate-form') !!}
    @endif

    <script>
        $('#file').change(function (e) {
            $('#doc_text').val($('#file').val());
        });
        @if($edit && isset($candidate->accept_terms_cond))
            $("#accept_terms_cond").prop('checked',true);
        @endif  
    </script>
@stop
