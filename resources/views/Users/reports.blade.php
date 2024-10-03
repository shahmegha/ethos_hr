@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users Reports</div>
            <div class="card-body">
                @if(!empty($users))
                <form id="user_report_filter" name="user_report_filter">
                    <select id="user_id" name="user_id">
                        <option>Select User</option>
                         @foreach($users as $user)
                            <option value="{{$user->id}}" @if(app('request')->input('user_id') == $user->id) selected=selected @endif >{{$user->name}}</option>
                         @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                @endif
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush