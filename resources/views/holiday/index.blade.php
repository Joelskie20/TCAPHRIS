@extends('layouts.master')

@section('title', 'Company Calendar')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
	    <h1>Company Calendar</h1>
    </section>

    <div class="content">
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif

        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Success!</h4>{{ Session::get('message') }}</div>
        @endif
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Holidays</h3>
                @can('add holiday')
                <button type="button" class="btn btn-success pull-right btn-add-department" data-toggle="modal" data-target="#modal-default-add">
                    <i class="fa fa-plus mr05"></i> ADD HOLIDAY
                </button>
                @endcan

                <div class="modal fade" id="modal-default-add">
                    <form action="{{ action('HolidayController@store') }}" method="POST">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Holiday</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-6" id="holiday-date">
                                            <label for="holiday-date-label">Date</label>
                                            <input type="date" class="form-control" id="holiday-date-add-label" name="date" required>
                                        </div>

                                        <div class="form-group col-md-6" id="holiday-type">
                                            <label for="holiday-type-label">Holiday Type</label>
                                            <select class="form-control" name="type">
                                                <option value="Regular Holiday">Regular Holiday</option>
                                                <option value="Special Non-working Holiday">Special Non-working Holiday</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12" id="holiday-name">
                                            <label for="holiday-name-label">Holiday Name</label>
                                            <input type="text" class="form-control" id="holiday-name" name="name" placeholder="Holiday Name...">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-create-department">Create Holiday</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </form>
                    <!-- /.modal-dialog -->
                </div>


            </div>
            <div class="box-body">

                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Holiday Type</th>
                            <th>Holiday Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holidays as $key => $holiday)
                        <div class="modal fade" id="edit-holiday-modal-{{ $holiday->id }}">
                            <form action="{{ action('HolidayController@update', ['id' => $holiday->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Add Holiday</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <!-- DATE-->
                                                <div class="form-group col-md-6" id="holiday-date">
                                                    <label for="holiday-date-label">Date</label>
                                                    <input type="date" class="form-control" id="holiday-date-add-label" name="date" value="{{ $holiday->date }}" required>
                                                </div>
                                                <!-- HOLIDAY TYPE -->
                                                <div class="form-group col-md-6" id="holiday-type">
                                                    <label for="holiday-type-label">Holiday Type</label>
                                                    <select class="form-control" name="type">
                                                        <option value="Regular Holiday" {{ $holiday->type == 'Regular Holiday' ? 'selected' : '' }}>Regular Holiday</option>
                                                        <option value="Special Non-working Holiday" {{ $holiday->type == 'Special Non-working Holiday' ? 'selected' : '' }}>Special Non-working Holiday</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- HOLIDAY NAME -->
                                                <div class="form-group col-md-12" id="holiday-name">
                                                    <label for="holiday-name-label">Holiday Name</label>
                                                    <input type="text" class="form-control" id="holiday-name" name="name" value="{{ $holiday->name }}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-create-department">Create Holiday</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </form>
                            <!-- /.modal-dialog -->
                        </div>
                            <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ Carbon::parse($holiday->date)->format('F d, Y') }}</td>
                            <td>{{ $holiday->type }}</td>
                            <td>{{ $holiday->name }}</td>
                            <td>
                                @can('edit holiday')
                                <button type="button" class="btn btn-success btn-xs" id="edit-item" data-toggle="modal" data-target="#edit-holiday-modal-{{ $holiday->id }}"><i class="fa fa-pencil"></i></button>
                                @endcan

                                @can('delete holiday')
                                <form style="display: inline-block;" action="/company-calendar/{{ $holiday->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"
                                        title="Delete">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                                @endcan
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
        'iDisplayLength': 100
    });
});
</script>
@endsection