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
                        Payment
                        <small>Available PPs</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Available PPs</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Activated Payment Providers</h3>
                                    <div class="box-tools">
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <th>Pos</th>
                                            <th>Short Name</th>
                                            <th>Long Name</th>
                                            <th>Provider Class</th>
                                            <th>Type</th>
                                            <th> </th>
                                            <th> </th>
                                        </tr>
                                        @foreach($paymentproviders as $ppr)
                                        <tr>
                                            <td>{{$ppr->id}}</td>
                                            <td>{{$ppr->pos}}</td>
                                            <td>{{$ppr->name_short}}</td>
                                            <td>{{$ppr->name_long}}</td>
                                            <td>{{{$ppr->provider_class}}}</td>
                                            <!--<td><span class="label label-success">IPN</span></td>-->
                                            <td>{{$ppr->type}}</td>
                                            <td><td><button type=submit form="ppe{{$ppr->id}}" class="btn btn-warning btn-sm">Edit</button></td></td>
                                            <td><td><button type=submit form="ppd{{$ppr->id}}" class="btn btn-danger btn-sm">Delete</button></td></td>
                                            <form action="{{url('/payment/edit_provider')}}" method="post" id="ppe{{$ppr->id}}"><input type="hidden" name="pprid" value="{{$ppr->id}}"></form>
                                            <form action="{{url('/payment/delete_provider')}}" method="post" id="ppd{{$ppr->id}}"><input type="hidden" name="pprid" value="{{$ppr->id}}"></form>
                                        </tr>
                                        @endforeach
                                    </table>
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