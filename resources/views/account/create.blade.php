@extends('layouts.master')

@section('title', 'Create Account')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Create Account</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif        
        <div class="box">
            <div class="box-body">
                <form action="{{ action('AccountController@store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="account-name">Division Name</label>
                        <select class="division" id="division-option">
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="account-name">Team Name</label>
                        <select name="team_id" id="team-option">
                            {{-- @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach --}}
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="account-name">Account Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Account Name...">
                    </div>

                    <div class="form-group">
                        <button type="submit">Create Account</button>
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

    let team = {
        "details": {!! $teams !!}
    };

    $('#division-option').change(function () {
        changeTeamSet($(this).find(':selected').val());
    });

    changeTeamSet($('#division-option').find(':selected').val());

    function changeTeamSet(div_id) {
        let selectOption = "";
        for (let i = 0; i < team.details.length; i++) {
            if (team.details[i].division_id == div_id) {
                selectOption += '<option value="' + team.details[i].id + '">' + team.details[i].name + '</option>';
            }
        }
        $('#team-option').empty().append(selectOption);
    }
});


</script>
@endsection