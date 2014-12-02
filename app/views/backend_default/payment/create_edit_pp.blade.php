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
                        @if($edit_pp==true)<small>Edit a PP</small>
                        @else <small>Create a new PP</small>
                        @endif
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        @if($edit_pp==true)<li class="active">PP Edit</li>
                        @else <li class="active">PP Create</li>
                        @endif
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-md-12">
                        <div class="box box-warning">
                            <div class="box-header">
                                @if($edit_pp==true)
                                <h3 class="box-title">Edit the Payment Provider</h3>
                                @else
                                <h3 class="box-title">Create a new Payment Provider</h3>
                                @endif
                            </div>
                            <div class="box-body">
                                @if($edit_pp==true)
                                <form method="post" action="{{url('/payment/edit_provider/'.$provider->id)}}" id="provider">
                                @else 
                                <form method="post" action="{{url('/payment/create_provider/')}}">
                                @endif

                                    @if($edit_pp==true)
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input name=id" type="text" class="form-control" value="{{{$provider->id}}}" disabled/>
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Position</label>
                                        @if($edit_pp==true)
                                        <input name="pos" type="text" class="form-control" value="{{{$provider->pos}}}"/>
                                        @else
                                        <input name="pos" type="text" class="form-control"/>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Short Name</label>
                                        @if($edit_pp==true)
                                        <input name="name_short" type="text" class="form-control" value="{{{$provider->name_short}}}"/>
                                        @else
                                        <input name="name_short" type="text" class="form-control"/>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Long Name</label>
                                        @if($edit_pp==true)
                                        <input name="name_long" type="text" class="form-control" value="{{{$provider->name_long}}}"/>
                                        @else
                                        <input name="name_long" type="text" class="form-control"/>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Provider Class</label>
                                        @if($edit_pp==true)
                                        <input name="provider_class" type="text" class="form-control" value="{{{$provider->provider_class}}}"/>
                                        @else
                                        <input name="provider_class" type="text" class="form-control"/>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Select</label>
                                        <select name="type" class="form-control">
                                            @if($edit_pp==true)
                                            @if($provider->type=="ipn")
                                            <option selected value="ipn">ipn</option>
                                            <option value="instant">instant</option>
                                            @elseif($provider->type=="instant")
                                            <option value="ipn">ipn</option>
                                            <option selected value="instant">instant</option>
                                            @endif
                                            @else
                                            <option value="ipn">ipn</option>
                                            <option value="instant">instant</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Currencies</label>
                                        <textarea name="currencies" class="form-control" rows="3" >@if($edit_pp==true){{{($provider->currencies)}}}@endif</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Settings</label>
                                        <textarea name="settings" class="form-control" rows="3" >@if($edit_pp==true){{{($provider->settings)}}}@endif</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <textarea name="price" class="form-control" rows="3" >@if($edit_pp==true){{{($provider->price)}}}@endif</textarea>
                                    </div>
                                    
                                    <button type=submit form="provider" class="btn btn-success">Save</button>
                                </form>
                            </div>


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