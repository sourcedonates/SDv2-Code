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
                        Users
                        @if($edit_user==true)<small>Edit a User</small>
                        @else <small>Create a User</small>
                        @endif
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                        @if($edit_user==true)<li class="active">Edit User/li>
                            @else <li class="active">Create User</li>
                        @endif
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @if($edit_user==true)
                    <div class="col-xs-6">
                        <div class="box">
                            <div class="box-header">

                                <h3 class="box-title">Edit the User</h3>

                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <div class="col-xs-6">
                        <div class="box">
                            <div class="box-header">

                                <h3 class="box-title">Edit the User Infos</h3>

                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    @else
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">

                                <h3 class="box-title">Create a new User</h3>

                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    @endif
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