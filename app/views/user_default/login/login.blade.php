<!DOCTYPE html>
<html class="bg-black">

    @include('user_default.login.head')

    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="{{url('/user/login')}}" method="post">
                <div class="body bg-gray">
                    @if(isset($message))
                    <div class="form-group">
                        {{{$message}}}
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-Mail"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>

                    <p><a href="{{url('/user/forgot_password')}}">I forgot my password</a></p>

                    <a href="{{url('/user/register')}}" class="text-center">Register a new membership</a>
                </div>
            </form>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>        

    </body>
</html>