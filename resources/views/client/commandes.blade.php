<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commande Client</title>
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
            <div class="pb-5">
              <div class="row g-5">
              <div>

                <h3>Commandes</h3>
                <hr/>

                <!--tableau qui contient la liste des commande de client-->
                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>
                          <tr>
                            <th scope="col">Commande N°</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>

                        <tbody>

                            <!--pour parcourir la liste des commandes de l'utilisateur connectée maintenant-->
                            <!--commandes méthode dans le model user pour la relation avec le model Commande-->
                            @foreach (auth()->user()->commandes as $index => $commande)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>

                                    <td>
                                        @if ($commande->etat == "en cours")
                                            <span class="badge bg-primary">{{ $commande->etat }}</span>
                                        @else 
                                            <span class="badge bg-success">{{ $commande->etat }}</span>
                                        @endif
                                    </td>

                                    <td>{{ $commande->getTotal() }} TND</td>
                                    <td>{{ $commande->created_at }}</td>
                                </tr>
                            @endforeach
                          
                        </tbody>

                      </table>

                </div>

              </div>
              </div>
            </div>

            <!--include Footer HTML Code-->
            @include('inc.client.footer')

            
          </div>
        </div>
      </main>

    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
</body>
</html>