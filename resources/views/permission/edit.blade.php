@extends('layouts.master')

@section('title', 'Permissions')

@section('styles')
<style>
.permissions-table tr td{vertical-align:middle !important;}
.btn-permission{cursor:pointer;background:none;border:none;outline:none; padding: 5px}
.w70{width:70px;}
</style>
@endsection

@section('content')
<div class="content-wrapper" style="min-height: 695.484px;">

    <!-- CONTENT HEADER -->
    <section class="content-header">
        <h1>Permissions » {{ ucwords($role->name) }}</h1>
    </section>

    <!-- MAIN CONTENT -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <p>Any changes made will be reflected when the user re-logs in.</p>
            </div>
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permissions</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-hover permissions-table">
                            <thead>
                                <tr>
                                    <th>Page or Function</th>
                                    <th>Description</th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ ucwords($permission->name) }}</td>
                                    <td></td>
                                    <td class="w70">
                                        @if($role->hasPermissionTo($permission->id))
                                            <form action="{{ action('PermissionController@destroy', ['id' => $role->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                <button type="submit" class="label label-success btn-permission" id="btn-permission">ALLOWED</button>
                                            </form>
                                        @else
                                            <form action="{{ action('PermissionController@update', ['id' => $role->id]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                <button type="submit" class="label label-danger btn-permission" id="btn-permission">RESTRICTED</button>
                                            </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('#btn-permission').click(function () {
            if($(this).text() == 'ALLOWED') {
                $(this).text('RESTRICTED').removeClass('label-success').addClass('label-danger');
            } else {
                $(this).text('ALLOWED').removeClass('label-danger').addClass('label-success');
            }
            
        });
    });
</script>
@endsection

