<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{asset('assets/icon.png')}}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="{{asset('css/login.css')}}">

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!------ Include the above in your HEAD tag ---------->

        <title>Reset Password</title>
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
            <!-- Tabs Titles -->
            <h1 style="color:white">Reset Password</h1>

                <!-- Icon -->
                <br>
                <div class="fadeIn first">
                    <img src="{{asset('assets/simoreta.png')}}" id="icon" alt="" />
                </div>
                <br>
                <!-- Login Form -->
                
                <form class="form-signin" method="POST" action="{{route('forgotpassword')}}">
                    {{csrf_field()}}
                    <input type="text" id="login" class="fadeIn second form-control @error('nip') is-invalid @enderror" name="nip" placeholder="NIP">
                    @error('nip') <label style="width: 5px"></label> <label class="fadeIn third" style="color:red"> {{$message }}</label> @enderror
                    <input type="submit" class="fadeIn fourth" value="Reset Password">           
                </form>

                <!-- Alert -->
                <div id="formFooter">
                    Click <a href="/">here</a> to login!
                    @if (Session::has('success'))
                        <div class="alert alert-success fadeIn fourth alert-dismissible" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </body>
</html>