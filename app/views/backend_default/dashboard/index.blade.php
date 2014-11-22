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
                        Blank page
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Callouts</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    @if(!isset($message) && !isset($warning) && !isset($error))
                                    <div class="callout callout-info">
                                        <h4>Everything is fine</h4>
                                        <p>There are no warnings or errors</p>
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
                                    @if(isset($error))
                                    <div class="callout callout-danger">
                                        <h4>Error:</h4>
                                        <p>{{{$error}}}</p>
                                    </div>
                                    @endif
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