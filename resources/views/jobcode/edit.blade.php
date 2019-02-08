@extends('layouts.master')

@section('title', 'Edit Job Code')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Edit Account</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif        
        <div class="box">
            <div class="box-body">
                <form action="{{ action('JobCodeController@update', ['id' => $job_code->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="account-name">Division Name</label>
                        <select name="division_id">
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" {{ ($job_code->account->team->division->id === $division->id) ? 'selected' : '' }}>{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="account-name">Team Name</label>
                        <select name="team_id">
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ $job_code }} {{ ($job_code->account->team->id === $team->id) ? 'selected' : '' }}>{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="account-name">Account Name</label>
                        <select name="account_id">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ $job_code }} {{ ($job_code->account->id === $account->id) ? 'selected' : '' }}>{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="job-code">Job Code</label>
                        <input type="text" name="code" id="code" value="{{ $job_code->code }}">
                    </div>

                    <div class="form-group">
                        <label for="job-name">Job Name</label>
                        <input type="text" name="name" id="name" value="{{ $job_code->name }}">
                    </div>

                    <div class="form-group">
                        <button type="submit">Update Job Code</button>
                        <a href="/accounts">Cancel</a>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table').dataTable({
        'iDisplayLength': 10,
        'columnDefs': [{'targets': 'no-sort','orderable': false,}]
    });
});
</script>
@endsection