@extends('layouts.master')

@section('title', 'Add Position')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
	    <h1>Add Position</h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ action('PositionController@store') }}" method="POST">
              @csrf
              
              <div class="box-body" style="padding-bottom: 0">
                <div class="form-group {{ ($errors->any()) ? 'has-error' : '' }}">
                  <label for="description">Position Name</label>
                  
                  <input type="text" class="form-control" id="position_name" name="name" placeholder="Enter..." required>
                  @if($errors->any())
                    @foreach($errors->all() as $error)
                      <span class="help-block">{{ $error }}</span>
                    @endforeach
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/positions" class="btn btn-default">Back</a>
              </div>
            </form>
            
          </div>
    </div>
</div>
@endsection