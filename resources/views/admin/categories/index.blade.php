<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Catégories</title>
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
                            <h1>Liste Des Catégories</h1>
                            <hr />
                            <!--Pour Appeler le Modal d'Ajout-->
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-primary mt-3">Ajouter Une Catégorie</a>
                        </div>

                        <div class="mt-3">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--$index=counter, $c = $categories-->
                                    @foreach ($categories as $index => $c)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->description }}</td>
                                            <td>
                                                <!--Pour Appeler le Modal de modiciation selon l'id du modal de modification-->
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#editCategory{{ $c->id }}"
                                                    class="btn btn-success">Modifier</a>
                                                <a href="/admin/categories/{{ $c->id }}/delete"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')"
                                                    class="btn btn-danger">Supprimer</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!--include Footer HTML Code-->
                @include('inc.admin.footer')


            </div>
        </div>
    </main>

    <!--Modal d'ajout-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Une Catégorie</h5><button class="btn p-1"
                        type="button" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fas fa-times fs--1"></span></button>
                </div>

                <!--Form Avant modal-body et après les boutons de modal-footer-->
                <form action="/admin/categories/store" method="POST">
                    <!--pour sécuriser le formulaire et pour eviter erreur 419-->
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Nom Catégorie</label>
                            <input class="form-control" name="name" id="exampleFormControlInput1" type="text"
                                placeholder="Taper le nom de la catégorie">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-0">
                            <label class="form-label" for="exampleTextarea">Description Catégorie</label>
                            <textarea class="form-control" name="description" rows="3"> </textarea>
                            @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Okay</button>
                        <button class="btn btn-outline-primary" type="button"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!--2 catégories => 2 modals de modifcations, on utilise foreach-->
    <!--Modal de modification-->
    @foreach ($categories as $index => $c)
        <div class="modal fade" id="editCategory{{ $c->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier La Catégorie : <span
                                class="text-primary"> {{ $c->name }} </span></h5><button class="btn p-1"
                            type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                class="fas fa-times fs--1"></span></button>
                    </div>

                    <!--Form Avant modal-body et après les boutons de modal-footer-->
                    <form action="/admin/categories/update" method="POST">
                        <!--pour sécuriser le formulaire et pour eviter erreur 419-->
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Nom Catégorie</label>
                                <input class="form-control" name="name" value="{{ $c->name }}"
                                    id="exampleFormControlInput1" type="text"
                                    placeholder="Taper le nom de la catégorie">
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <label class="form-label" for="exampleTextarea">Description Catégorie</label>
                                <textarea class="form-control" name="description" rows="3"> {{ $c->description }} </textarea>
                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!--pour les appeler dans la fonction update par l'id-->
                            <input type="hidden" name="id_category" value="{{ $c->id }}">

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Okay</button>
                            <button class="btn btn-outline-primary" type="button"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach


    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
</body>

</html>