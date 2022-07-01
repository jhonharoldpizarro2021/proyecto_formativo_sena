<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var tablaEmpleados = jQuery('.empleados-table')
            var tablaProductos = jQuery('.productos-table')
            if(tablaEmpleados.length){
                var table = jQuery('.empleados-table').DataTable({
                    serveside:true,
                    processing:true,
                    ajax:"{{route('empleados.index')}}",
                    columns:[
                        {data:'id', name:'id'},
                        {data:'nombre', name:'nombre'},
                        {data:'email', name:'email'},
                        {data:'sexo', name:'sexo'},
                        {data:'area_id', name:'area'},
                        {data:'boletin', name:'boletin'},
                        {data:'modificar', name:'modificar'},
                        {data:'eliminar', name:'eliminar'}
                    ],
                    responsive: true,
                    "language": {
                        "decimal":        "",
                        "emptyTable":     "No hay datos",
                        "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                        "infoFiltered":   "(Filtrando de _MAX_ total de registros)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "Mostrar _MENU_ registros",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":         "Buscar:",
                        "zeroRecords":    "No se encontratron registros",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                        "aria": {
                        "sortAscending":  ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                        }
                    }
                });
            } else if(tablaProductos.length){
                var table = jQuery('.productos-table').DataTable({
                    serveside:true,
                    processing:true,
                    ajax:"{{route('productos.index')}}",
                    columns:[
                        {data:'id', name:'id'},
                        {data:'nombre', name:'nombre'},
                        {data:'descripcion', name:'descripcion'},
                        {data:'precio', name:'precio'},
                        {data:'modificar', name:'modificar'},
                        {data:'eliminar', name:'eliminar'}
                    ],
                    responsive: true,
                    "language": {
                        "decimal":        "",
                        "emptyTable":     "No hay datos",
                        "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                        "infoFiltered":   "(Filtrando de _MAX_ total de registros)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "Mostrar _MENU_ registros",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":         "Buscar:",
                        "zeroRecords":    "No se encontratron registros",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                        "aria": {
                        "sortAscending":  ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                        }
                    }
                });
            }
            
            $('#createEmpleado').click(function(){
                $('#id').val();
                $('#empleadoForm').trigger("reset");
                $('#ajaxModal').modal('show');
            });
            $('#save').click(function(e){
                e.preventDefault();
                if($('#nombre').val() == ''){
                    alert('Por favor completa el campo del Nombre');
                    $('#nombre').focus();
                } else if($('#email').val() == ''){
                    alert('Por favor completa el campo del Correo Electronico');
                    $('#email').focus();
                } else if ($('input:radio[name="sexo"]:checked').val() == undefined) {
                    alert('Por favor completa el campo del Sexo');
                    $('#masculino').focus();
                } else if($('#area_id').val() == ''){
                    alert('Por favor completa el campo del Area');
                    $('#area_id').focus();
                } else if($('#descripcion').val() == ''){
                    alert('Por favor completa el campo de la Descripcion');
                    $('#descripcion').focus();
                } else if ($('#boletin').not(':checked').length) {
                    alert('Por favor completa el campo del boletin');
                    $('#boletin').focus();
                } else if ($("input[name='roles[]']:checked").length == 0) {
                    alert('Por favor completa el campo del Rol');
                    $('input:radio[name^="roles"]').focus();
                } else{
                    $(this).html('Guardar');
                    $.ajax({
                        data:$("#empleadoForm").serialize(),
                        url: "{{route('empleados.store')}}",
                        type:"POST",
                        dataType:'json',
                        cache: false,
                        crossDomain: false,
                        success:function(data){
                            $('#empleadoForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            table.ajax.reload();
                            alert('Empleado Creado Exitosamente');
                        },
                        error:function(data){
                            console.log('Error:', data);
                            $("#save").html('Guardar');
                        }
                    });
                }



            });
            $('body').on('click','.delete', function(){
                var id = $(this).data("id");
                if (confirm("Seguro que deseas borrar el empleado?")) {
                    $.ajax({
                        type:"DELETE",
                        url: "{{route('empleados.store')}}"+'/'+id,
                        success:function(data){
                            table.ajax.reload();
                            alert('Empleado Eliminado Exitosamente');
                        },
                        error:function(data){
                            console.log('Error:', data)
                        }
                    })
                }
            });
            $('body').on('click','.edit', function(){
                var id = $(this).data("id");
                $.get("{{route('empleados.index')}}"+"/"+id+"/edit",function(data){
                    console.log(data.roles);
                    //$('#ajaxModalLabel').html('Editar Empleado')
                    $('#id').val(data.empleado.id);
                    $('#nombre').val(data.empleado.nombre);
                    $('#email').val(data.empleado.email);
                    if(data.empleado.sexo == 'M'){
                        $('#masculino').prop("checked", true);
                    }
                    if(data.empleado.sexo == 'F'){
                        $('#femenino').prop("checked", true);
                    }
                    $('#area_id').val(data.empleado.area_id);

                    if(data.empleado.boletin == '1'){
                        $('#boletin').prop("checked", true);
                    }
                    $('#descripcion').val(data.empleado.descripcion);
                    if(data.empleado.boletin == '1'){
                        $('#boletin').prop("checked", true);
                    }
                    data.roles.forEach(element => {
                        //console.log(element.rol_id)
                        $('#rol-'+element.rol_id).prop("checked", true);
                    });
                    $('#ajaxModalLabel').html('Actualizar Empleado');
                    $('#ajaxModal').modal('show');
                });
            });
            $('#ajaxModal').on('hidden.bs.modal', function (e) {
                $('#empleadoForm').trigger("reset");
            })
        })
    });
</script>
