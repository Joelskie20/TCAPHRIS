@extends('layouts.master')

@section('title', 'Settings')

@section('content')
<div class="content-wrapper">

    <!-- CONTENT HEADER -->
    <section class="content-header">
        <h1>Settings</h1>
    </section>

    <!-- MAIN CONTENT -->
    <section class="content">

        <div class="nav-tabs-custom">

            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs nav-settings">
                <li data-id="2" class="active"><a href="#tab-security" data-toggle="tab" aria-expanded="false">Security and Login</a></li>
                {{-- <li data-id="3"><a href="#tab-profile" data-toggle="tab" aria-expanded="false">Profile Details</a></li> --}}
            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content">            

                <!-- SECURITY TAB -->
                <div class="tab-pane active" id="tab-security">
                    <h2>Security and Login</h2>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">

                            <!-- CHANGE PASSWORD -->
                            <div id="change-password-form" class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"></h3>
                                </div>
                                <form class="form-horizontal" method="POST" action="/settings/changePassword">
                                    @csrf
                                    <div class="box-body">
                                        <div class="form-group curr-pass">
                                            <label for="current-pass" class="col-sm-4 control-label">Current Password</label>
                                            <div class="col-sm-8 text-field">
                                                <input type="password" class="form-control" id="current-pass" name="current_password" value="{{ old('current_password') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group new-pass">
                                            <label for="new-pass" class="col-sm-4 control-label">New Password</label>
                                            <div class="col-sm-8 text-field">
                                                <input type="password" class="form-control" id="new-pass" name="new_password" value="{{ old('new_password') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group confirm-new-pass">
                                            <label for="confirm-new-pass" class="col-sm-4 control-label">Confirm New Password</label>
                                            <div class="col-sm-8 text-field">
                                                <input type="password" class="form-control" id="confirm-pass" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" required>
                                            </div>
                                        </div>
                                    <div class="box-notif">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                        @endif
                                        @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right btn-update-password">Update Password</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- PROFILE TAB -->
                {{-- <div class="tab-pane" id="tab-profile">
                    <h2>Profile Details</h2>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">

                            <form class="form-horizontal" method="post" action="http://goop.fun/update-profile-photo"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Profile Picture</label>
                                    <div class="col-sm-8">
                                        <p>No photo available.</p> <input type="file" id="photo" class="mt05" name="photo">
                                        <p class="mt10">Image size should not exceed 200kb. Only JPG, GIF or PNG file
                                            types. For best output, please use a square image (e.g. 200x200).</p>
                                        <p class="mt10">Hard refresh or CTRL + F5 to see updated photo.</p>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> --}}

            </div>

        </div>

    </section>

</div>
@endsection