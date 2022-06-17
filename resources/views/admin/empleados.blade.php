
@extends('layouts.admin.crud.list')
@section('content')
    <h1>Lista de Empleados</h1>
    <div class="row py-4 text-right justify-content-end">
        <div class="col">
            <button type="button" id="createEmpleado" class="btn btn-success d-block float-right" data-toggle="modal" data-target="#ajaxModal"><i class="fas fa-user-plus"></i> Crear</button>
        </div>
        
    </div>
    <div class="row py-4">
        <div class="col">
            <table class="table empleados-table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col"><i class="fas fa-user"></i> Nombre</th>
                    <th scope="col"><i class="fas fa-at"></i> Email</th>
                    <th scope="col"><i class="fas fa-venus-mars"></i> Sexo</th>
                    <th scope="col"><i class="fas fa-briefcase"></i> Area</th>
                    <th scope="col"><i class="fas fa-envelope"></i> Boletin</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="ajaxModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="ajaxModalLabel">Crear Empleado</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        Los campos con asteriscos (*) son obligatorios
                    </div>
                    <form id="empleadoForm" name="empleadoForm" class="form-horizontal" >
                        @csrf
                        <input type="hidden" name="id" id='id'>
                        <div class="form-group">
                            <label for="nombre">Nombre completo <span class="text-danger">*</span></label>
                            {!! Form::text('nombre', null, array('id' => 'nombre', 'class' => 'form-control', 'placeholder' => 'Nombre completo', 'required' => 'required' )) !!}
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                            {!! Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required' => 'required' )) !!}
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M" required>
                                <label class="form-check-label" for="masculino">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="femenino" value="F" required>
                                <label class="form-check-label" for="femenino">
                                    Femenino
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="area_id">Areas <span class="text-danger">*</span></label>
                            {!! Form::select('area_id', $areas,[], array('id' => 'area_id', 'class' => 'form-control', 'required' => 'required' )) !!}
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="boletin" name="boletin" value="1">
                            <label class="form-check-label" for="boletin" >Deseo recibir boletín informativo</label>
                        </div>
                        <div class="form-group ">
                            <label for="roles">Roles <span class="text-danger">*</span></label>
                            <div class="form-check">
                                @foreach($roles as $value)
                                    <label>{{ Form::checkbox('roles[]', $value->id, false, array('id' => 'rol-'.$value->id, 'class' => 'form-check-input roles')) }}
                                    {{ $value->nombre }}</label>
                                    <br/>
                                @endforeach
                            </div>
                        </div>
                        <button id="save" type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
