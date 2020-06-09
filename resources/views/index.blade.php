<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD USERS</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        ul.pagination li {
    display: inline;
    font-size: 12px;
    font-weight: bold;
}

ul.pagination li a {

    color: black;
    padding: 8px 8px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 4px;
}

ul.pagination li a.active {
    background-color: #4CAF50;
    padding: 8px 8px;
    margin: 4px;
    color: white;
    border: 1px solid #4CAF50;
}

ul.pagination li.active {
    /*background-color: #4CAF50;*/
    background-color: #687282;
    padding: 8px 8px;
    margin: 4px;
    color: white;
    border: 1px solid #4CAF50;
}

/*ul.pagination li a:hover:not(.active) {background-color: #ddd;}*/
ul.pagination li a:hover {background-color: #999999;}

ul.pagination li.disabled {
    /*background-color: #cccccc;*/
    color: #ddd;
    padding: 8px 8px;
    border: 1px solid #ddd;
    margin: 4px;
}

    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="row mb-4 justify-content-end">
            <div class="col-12 text-right">
                @if (count($users))
                    <span class="">Usuarios registrados: {{count($users)}}</span>
                @endif
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-register">
                    Registrar usuario
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nick</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->nick}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role->role}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-{{$user->id}}">
                                        Editar
                                    </button>
                                    <form action="{{route('user.delete', $user->id)}}" method="POST" class="form-delete">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <button type="submit" class="btn btn-danger btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @include('includes.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
        <div class="row">
            <div class="col-12">
                @if (count($errors) > 0)
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    @include('includes.create')

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.form-delete').on('submit',function(event){
            // block form submit event
            event.preventDefault();

            // let r = confirm('Confirmar eliminar registro');

            // if(true) {
            //     event.currentTarget.submit();
            // }

                swal({
                    title: "Confirma que quere eliminar éste registro?",
                    text: "Una vez eliminado, no podrás recuperar ésta información!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // swal("Poof! El usuario ha sido eliminado!", {
                        //     icon: "success",
                        // });
                        event.currentTarget.submit();
                    } else {
                        swal("Tu usuario imaginario no será eliminado!");
                    }
                });
            });
        });
    </script>
</body>
</html>