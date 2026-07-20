@extends('layouts.app')

@section('content')

<div class="container shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="d-flex justify-content-evenly">
        <h2>CATEGORIAS</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearCategoria">Nueva Categoría <i class="fa-solid fa-file-circle-plus"></i></button>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Activo</th>
            <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody id="tbody-categoria">
            
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="crearCategoria" tabindex="-1" aria-labelledby="crearCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formulario">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion">
                </div>
                <div class="mb-3">
                    <label for="activo" class="form-label">Activo</label>
                    <input type="text" class="form-control" id="activo" name="activo" required>
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
       
        const API = '/api/categorias'

        document.addEventListener('DOMContentLoaded',cargarCategoria);

        let formulario = document.getElementById("formulario")

        formulario.addEventListener("submit", async function(e){
            e.preventDefault();
            const modalCrear = new bootstrap.Modal(document.getElementById("crearCategoria"))
            
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
                cargarCategoria()
            }
        })

        async function cargarCategoria(){
            const response = await fetch(API)
            
            const categoria = await response.json()
            
            let bodyCategoria = document.getElementById('tbody-categoria')

            let html = '';

            categoria.forEach(cat => {
                html += `
                    <tr>
                        <td>${cat.nombre}</td>
                        <td>${cat.descripcion}</td>
                        <td>${cat.activo}</td>
                        <td><button class="btn btn-primary" onclick="getCategoria(${cat.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarCategoria(${cat.id})"><i class="fa-solid fa-trash-can"></i></button></td>
                    </tr>
                `;
            });

            bodyCategoria.innerHTML = html
        }

        async function eliminarCategoria(id){

            let respuesta = confirm("Seguro que desea eliminar la categoria?")
            
            if (!respuesta) return
            
            const response = await fetch(`${API}/${id}`,{
                method: "DELETE",
                headers: {
                    "Accept":"application/json"
                }
            })
            
            const resultado = await response.json()

            alert(resultado.message)

            cargarCategoria()
        }

        async function getCategoria(id) {
            const response = await fetch(`${API}/${id}`)
            
            const resultado = await response.json()

            document.getElementById("nombre").value = resultado.nombre
            document.getElementById("descripcion").value = resultado.descripcion
            document.getElementById("activo").value = resultado.activo

            const modal = new bootstrap.Modal(document.getElementById("crearCategoria"))
            modal.show()

        }

        async function editarCategoria(id) {

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