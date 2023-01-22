<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page Produits</title>
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
                            <h1>Liste Des Produits</h1>
                            <hr />
                            <!--Pour Appeler le Modal d'Ajout, data-bs-toggle="modal" data-bs-target="#exampleModal" au lieu du href-->
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-primary mt-3">Ajouter Un Produit</a>
                        </div>

                        <div class="mt-3">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom Produit</th>
                                        <th scope="col">Description Produit</th>
                                        <th scope="col">Prix Produit</th>
                                        <th scope="col">Quantité Produit</th>
                                        <th scope="col">Image Produit</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!--$index=counter, $c = $categories-->
                                    @foreach ($products as $index => $p)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->description }}</td>
                                            <td>{{ $p->price }}</td>
                                            <td>{{ $p->qte }}</td>
                                            <td>{{ $p->photo }}</td>

                                            <td>
                                                <!--Pour Appeler le Modal de modiciation selon l'id du modal de modification, data-bs-toggle="modal" data-bs-target="#editProduct" au lieu du href-->
                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#editProduct{{ $p->id }}"
                                                    class="btn btn-success">Modifier</a>
                                                <a href="/admin/products/{{ $p->id }}/delete"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')"
                                                    class="btn btn-danger">Supprimer</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                    class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                    class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.1.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main>

    <!--Modal d'ajout-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Un Produit</h5><button class="btn p-1"
                        type="button" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fas fa-times fs--1"></span></button>
                </div>

                <!--Form Avant modal-body et après les boutons de modal-footer-->
                <!--enctype="multipart/form-data" pour uploader une photo-->
                <form action="/admin/products/store" method="POST" enctype="multipart/form-data">
                    <!--pour sécuriser le formulaire et pour eviter erreur 419-->
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Nom Produit</label>
                            <input class="form-control" name="name" id="exampleFormControlInput1" type="text"
                                placeholder="Taper le nom de produit">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-0">
                            <label class="form-label" for="exampleTextarea">Description Produit</label>
                            <textarea class="form-control" name="description" rows="3"> </textarea>
                            @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!---->
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Prix Produit</label>
                            <input class="form-control" name="price" id="exampleFormControlInput1" type="number"
                                placeholder="Taper le prix de produit">
                            @error('price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Quantité Produit</label>
                            <input class="form-control" name="qte" id="exampleFormControlInput1" type="number"
                                placeholder="Taper la quantité du produit">
                            @error('qte')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Image Produit</label>
                            <input class="form-control" name="photo" id="exampleFormControlInput1" type="file"
                                placeholder="Choisissez la photo du produit">
                            @error('photo')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!---->

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
    @foreach ($products as $index => $p)
        <div class="modal fade" id="editProduct{{ $p->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier Le Produit : <span
                                class="text-primary"> {{ $p->name }} </span></h5><button class="btn p-1"
                            type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                class="fas fa-times fs--1"></span></button>
                    </div>

                    <!--Form Avant modal-body et après les boutons de modal-footer-->
                    <form action="/admin/products/update" method="POST">
                        <!--pour sécuriser le formulaire et pour eviter erreur 419-->
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Nom Produit</label>
                                <input class="form-control" name="name" value="{{ $p->name }}"
                                    id="exampleFormControlInput1" type="text"
                                    placeholder="Taper le nom de produit">
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <label class="form-label" for="exampleTextarea">Description Produit</label>
                                <textarea class="form-control" name="description" rows="3"> {{ $p->description }} </textarea>
                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!---->

                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Prix Produit</label>
                                <input class="form-control" name="price" value="{{ $p->price }}"
                                    id="exampleFormControlInput1" type="number"
                                    placeholder="Taper le prix de produit">
                                @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Quantité Produit</label>
                                <input class="form-control" name="qte" value="{{ $p->qte }}"
                                    id="exampleFormControlInput1" type="number"
                                    placeholder="Taper la quantité de produit">
                                @error('qte')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Photo Produit</label>
                                <input class="form-control" name="photo" value="{{ $p->photo }}"
                                    id="exampleFormControlInput1" type="text"
                                    placeholder="Choisissez la photo de produit">
                                @error('photo')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!---->

                            <!--pour les appeler dans la fonction update par l'id-->
                            <input type="hidden" name="id_product" value="{{ $p->id }}">

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