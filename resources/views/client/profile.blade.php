<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Client</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('dashassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashassets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <style>
      body {
        opacity: 0;
      }
    </style>
</head>
<body>
    <main class="main" id="top">
        <div class="container-fluid px-0">

          <!--include SideBar HTML Code-->
          @include('inc.client.sidebar')

          <!--include NavBar HTML Code-->
          @include('inc.client.nav')

          <div class="content">
            {{-- <div class="pb-5">
              <div class="row g-5"> --}}
                <!--inclusion des alerts de succèes et d'echec -->
                @include('inc.flash-message')

                <h2 class="mt-2">Client Edit Profile</h2>
                <hr/>

                <!--Formulaire contient les infos du client pour les voir et pour les modifier-->
                <form action="/client/profile/update" method="POST">

                    @csrf
                    <div class="mb-3 mt-3">
                        <label class="form-label">Username</label>
                        <!--auth()->user() permet de nous donner les infos du current user connecté-->
                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="mb-3 mt-3">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control" placeholder="Enter your password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>

                </form>

                


              {{-- </div>
            </div> --}}

            <!--include Footer HTML Code-->
            @include('inc.client.footer')

            
          </div>
        </div>
      </main>

    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
</body>
</html>