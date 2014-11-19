<!DOCTYPE html>
<html>

    @include('backend_default.parts.head')

    <body class="skin-blue">

        @include('backend_default.parts.header')

        <div class="wrapper row-offcanvas row-offcanvas-left">
            @include('backend_default.parts.sidebar')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Profile
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User Profile</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">User Profile</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="{{url('/user/profile')}}" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="useridDisplay">User ID</label>
                                            <input name="userid" type="text" class="form-control" id="useridDisplay" value="{{{$user->id}}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="usernameInput">Username</label>
                                            <input name="username" type="text" class="form-control" id="usernameInput" placeholder="Enter your Username" value="{{{isset($username) ? $username : ''}}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="steamidInput">SteamID</label>
                                            <input name="steamid" type="text" class="form-control" id="steamidInput" placeholder="STEAM_0:0:0000000" value="{{{isset($steamid) ? $steamid : ''}}}">
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">User Image</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="{{url('/user/upload_image')}}" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="uploadImage">Select a Image</label>
                                            <input name="userimage" type="file" id="uploadImage">
                                            <p class="help-block">Select a .png image and click on upload</p>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>

                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Callouts</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    @if($setup == true && !isset($message) && !isset($warning))
                                    <div class="callout callout-info">
                                        <h4>Everything is fine</h4>
                                        <p>There are no warnings or errors and your profile is setup</p>
                                    </div>
                                    @endif
                                    @if($setup != true)
                                    <div class="callout callout-danger">
                                        <h4>Your Profile is not setup</h4>
                                        <p>Please setup your profile before continuing</p>
                                    </div>
                                    @endif
                                    @if(isset($message))
                                    <div class="callout callout-info">
                                        <h4>Info:</h4>
                                        <p>{{{$message}}}</p>
                                    </div>
                                    @endif
                                    @if(isset($warning))
                                    <div class="callout callout-danger">
                                        <h4>Warning:</h4>
                                        <p>{{{$warning}}}</p>
                                    </div>
                                    @endif
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div> <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{asset("assets/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{asset("assets/js/AdminLTE/app.js")}}" type="text/javascript"></script>

    </body>
</html>