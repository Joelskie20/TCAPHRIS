@extends('layouts.master')

@section('title', 'Accounts')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Accounts</h1>
    </section>
    <div class="content">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif        
        <div class="box">
            
            <div class="box-header with-border">
                <h3 class="box-title">Accounts List</h3>
                <a href="/accounts/create" class="btn btn-success pull-right"><i class="fa fa-plus mr05"></i> ADD ACCOUNT</a>
            </div>
            
            <div class="box-body">
					
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Division Name</th>
                            <th>Team Name</th>
                            <th>Name</th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $key => $account)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $account->team->division->name }}</td>
                            <td>{{ $account->team->name }}</td>
                            <td>{{ $account->name }}</td>
                            <td>
                                <a href="/accounts/{{ $account->id }}/edit" class="btn btn-success btn-xs btn-edit"><i class="fa fa-pencil"></i></a>
                                
                                <form style="display: inline-block;" action="/accounts/{{ $account->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" title="Delete"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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