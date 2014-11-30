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
                        <small>Show Users</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                        <li class="active">Show Users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">SD Users</h3>
                                <div class="box-tools">
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Last Login</th>
                                        <th>Last Login</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->last_login}}</td>
                                        <td><td><button type=submit form="ue{{$user->id}}" class="btn btn-warning btn-sm">Edit</button></td></td>
                                        <td><td><button type=submit form="ud{{$user->id}}" class="btn btn-danger btn-sm">Delete</button></td></td>
                                    <form action="{{url('/users/edit_user/'.$user->id)}}" method="get" id="ue{{$user->id}}"></form>
                                    <form action="{{url('/users/delete_user/'.$user->id)}}" method="get" id="ud{{$user->id}}"></form>
                                    </tr>
                                    @endforeach
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
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