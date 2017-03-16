<div class="panel panel-default">
    <div class="panel-heading">@lang('app.category') - <b>{{ $user->profile->category->name }}</b></div>
    <div class="panel-body avatar-wrapper">
        <div class="spinner">
            <div class="spinner-dot"></div>
            <div class="spinner-dot"></div>
            <div class="spinner-dot"></div>
        </div>
        <div id="avatar"></div>
        <div>
            <img class="avatar-preview img-circle" src="{{ $edit ? url('assets/img/'.$user->profile->category->avatar) : url('assets/img/profile.png') }}">    
        </div>
    </div>
</div>
