<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Clients</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
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
            @include('inc.admin.sidebar')

            <!--include NavBar HTML Code-->
            @include('inc.admin.nav')
            
            <div class="content">
                <div class="pb-5">
                    <div class="row g-5">
                        <div>
                            <h1>Liste Des Clients</h1>
                            <hr />
                            
                            <!--tableau qui contient la liste des clients affichées pour l'admin-->
                            <div class="table-responsive">

                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <!--Afficher la liste des clients dont le role est user-->
                                        @foreach ($clients as $index => $client )
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>
                                                    <!--si le client est active qui est par defaut true=1, on va bloquer le user, sinon on va le débloquer par l'affichage d'un badge de message-->
                                                    @if ($client->is_active)
                                                        <span class="badge bg-primary">Active User</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactif User</span>
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    <!--si le client est active qui est par defaut true=1, on va bloquer le user, sinon on va le débloquer par les bouttons-->
                                                    @if ($client->is_active)
                                                        <a class="btn btn-danger" href="/admin/user/{{ $client->id }}/bloquer">Bloquer</a>
                                                    @else
                                                        <a class="btn btn-primary" href="/admin/user/{{ $client->id }}/activer">Activer</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                            
                                    </tbody>

                                </table>

                            </div>

                <!--include Footer HTML Code-->
                @include('inc.admin.footer')


            </div>
        </div>
    </main>

    


    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
</body>

</html>