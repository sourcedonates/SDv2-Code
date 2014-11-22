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
                                    <h3 class="box-title">Responsive Hover Table</h3>
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
                                            <th>Actions</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>paypal-test</td>
                                            <td>Pay Pal Test</td>
                                            <td>Test\Class</td>
                                            <td><span class="label label-success">IPN</span></td>
                                            <td>Edit Delete</td>
                                        </tr>
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