@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Chatroom: Project {{session('ProjectName')}}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Chatroom</div>
            <div class="card-body">
               @livewire('chat', ['userId' => session('UserID'), 'projectId' => session('ProjectID')])
            </div>
        </div>
    </div>

</div>
@endsection
@push('css')
@livewireStyles
@endpush
@push('js')
    @livewireScripts
@endpush

