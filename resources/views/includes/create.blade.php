<!-- Modal -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role_id">Rol</label>
                        <select name="role_id" id="role_id" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nick">Nick</label>
                        <input type="text" class="form-control" name="nick" id="nick">
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Apellido</label>
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
            </form>
        </div>
    </div>
</div>