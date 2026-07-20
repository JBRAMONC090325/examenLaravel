@extends('layouts.app')

@section('content')

<div class="container shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="d-flex justify-content-between">
        <h2>PERFILES</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPerfil">Nuevo Perfil <i class="fa-solid fa-file-circle-plus"></i></button>    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id Usuario</th>
            <th scope="col">Nombres</th>
            <th scope="col">Telefono</th>
            <th scope="col">Direccion</th>
            <th scope="col">Fecha Nacimiento</th>
            <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody id="tbody-perfil">
            
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="crearPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formulario">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                        <label for="user_id" class="form-label">Id Usuario</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" required>
                </div>
                <div class="mb-3">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
            </div>
        </div>
    </form>
  </div>
</div>

@push('scripts')
    <script>
        
        const API = '/api/perfiles'

        document.addEventListener('DOMContentLoaded',cargarPerfil);

        let formulario = document.getElementById("formulario")

        formulario.addEventListener("submit", async function(e){
            e.preventDefault();
            const modalCrear = new bootstrap.Modal(document.getElementById("crearPerfil"))

            let data = new FormData(formulario)

            const response = await fetch(API,{
                method: "POST",
                headers: {
                    "Accept":"application/json"
                },
                body: data
            })

            const resultado = await response.json()

            if(resultado.status){
                formulario.reset()
                modalCrear.hide()
                cargarPerfil()
            }
        })

        async function cargarPerfil(){
            const response = await fetch(API)
            
            const perfil = await response.json()
            
            let bodyPerfil = document.getElementById('tbody-perfil')

            let html = '';

            perfil.forEach(perf => {
                html += `
                    <tr>
                        <td>${perf.user_id}</td>
                        <td>${perf.nombres}</td>
                        <td>${perf.telefono}</td>
                        <td>${perf.direccion}</td>
                        <td>${perf.fecha_nacimiento}</td>
                        <td><button class="btn btn-primary" onclick="getPerfil(${perf.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarPerfil(${perf.id})"><i class="fa-solid fa-trash-can"></i></button></td>
                    </tr>
                `;
            });

            bodyPerfil.innerHTML = html
        }

        async function eliminarPerfil(id){

            let respuesta = confirm("Seguro que desea eliminar el perfil?")
            
            if (!respuesta) return
            
            const response = await fetch(`${API}/${id}`,{
                method: "DELETE",
                headers: {
                    "Accept":"application/json"
                }
            })
            
            const resultado = await response.json()

            alert(resultado.message)

            cargarPerfil()
        }
            
         async function getPerfil(id) {
            const response = await fetch(`${API}/${id}`)
            
            const resultado = await response.json()

            document.getElementById("user_id").value = resultado.user_id
            document.getElementById("nombres").value = resultado.nombres
            document.getElementById("telefono").value = resultado.telefono
            document.getElementById("direccion").value = resultado.direccion
            
            const fechaObj = new Date(resultado.fecha_nacimiento);
            const fechaFormateada = fechaObj.toISOString().split('T')[0];
            document.getElementById("fecha_nacimiento").value = fechaFormateada;

            const modal = new bootstrap.Modal(document.getElementById("crearPerfil"))
            modal.show()

        }

        async function editarPerfil(id) {

            const response = await fetch(`${API}/${id}`, {
                method: "PUT",
                headers: {
                    "Accept":"application/json"
                },
                body: data
            })
            
            const resultado = response.json()
            
        }

    </script>
@endpush
@endsection