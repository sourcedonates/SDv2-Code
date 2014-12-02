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
                        <small>Edit a User</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                        <li class="active">Edit User</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Edit the User</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <form method="post" action="{{url('/users/edit_user/'.$mod_user->id)}}" id="user" role="form">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input name="id" type="text" class="form-control" value="{{{$mod_user->id}}}" disabled/>
                                            </div>

                                            <div class="form-group">
                                                <label>E-Mail</label>
                                                <input name="email" type="text" class="form-control" value="{{{$mod_user->email}}}"/>
                                            </div>

                                            <div class="form-group">
                                                <label>Permissions</label>
                                                <textarea name="permissions" class="form-control" rows="3" disabled>{{{json_encode(json_decode($mod_user->permissions),JSON_PRETTY_PRINT)}}}</textarea>
                                            </div>
                                        </div>
                                        <input name="part" type="hidden" value="user"/>
                                        <input name="id" type="hidden" value="{{{$mod_user->id}}}" />
                                        <div class="box-footer">
                                            <button type=submit form="user" class="btn btn-warning">Edit</button>
                                        </div>
                                    </form>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Edit the User Infos</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <th>User ID</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        @foreach($mod_user_infos as $user_info)
                                        <tr>
                                        <form action="{{url('/users/edit_user/'.$mod_user->id)}}" method="post" id="uie{{{$user_info->id}}}">
                                            <td><input name="id" type="text" class="form-control" value="{{{$user_info->id}}}" disabled/></td>
                                            <td><input name="user_id" type="text" class="form-control" value="{{$user_info->user_id}}" disabled/></td>
                                            <td><input name="type" type="text" class="form-control" value="{{$user_info->type}}" /></td>
                                            <td><input name="value" type="text" class="form-control" value="{{$user_info->value}}" /></td>
                                            <input name="part" type="hidden" value="userinfos_edit"/>
                                        </form>
                                        <form action="{{url('/users/edit_user/'.$user->id)}}" method="post" id="uid{{{$user_info->id}}}">
                                            <input name="id" type="hidden" class="form-control" value="{{{$user_info->id}}}"/>
                                            <input name="part" type="hidden" value="userinfos_delete"/>
                                        </form>
                                        <td><button type="submit" form="uie{{{$user_info->id}}}" class="btn btn-warning btn-sm">Edit</button></td>
                                        <td><button type="submit" form="uid{{{$user_info->id}}}" class="btn btn-danger btn-sm">Delete</button></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Add new User Infos</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <form method="post" action="{{url('/users/edit_user/'.$mod_user->id)}}" id="user" role="form">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <input name="type" type="text" class="form-control""/>
                                            </div>

                                            <div class="form-group">
                                                <label>Value</label>
                                                <input name="value" type="text" class="form-control"/>
                                            </div>

                                            <input name="part" type="hidden" value="userinfos_add"/>
                                            <input name="user_id" type="hidden" value="{{{$mod_user->id}}}" />
                                        </div>
                                    </form>
                                    <div class="box-footer">
                                        <button type="submit" form="user" class="btn btn-default">Add</button>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>  
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