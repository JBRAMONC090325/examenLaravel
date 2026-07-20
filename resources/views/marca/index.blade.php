@extends('layouts.app')

@section('content')

<div class="container shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="d-flex justify-content-between">
        <h2>MARCAS</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearMarca">Nueva Marca <i class="fa-solid fa-file-circle-plus"></i></button>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody id="tbody-marca">
            
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="crearMarca" tabindex="-1" aria-labelledby="crearMarcaLabel" aria-hidden="true">
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
       
        const API = '/api/marcas'

        document.addEventListener('DOMContentLoaded',cargarMarca);

        let formulario = document.getElementById("formulario")

        formulario.addEventListener("submit", async function(e){
            e.preventDefault();
            const modalCrear = new bootstrap.Modal(document.getElementById("crearMarca"))
            
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
                cargarMarca()
            }
        })

        async function cargarMarca(){
            const response = await fetch(API)
            
            const marca = await response.json()
            
            let bodyMarca = document.getElementById('tbody-marca')

            let html = '';

            marca.forEach(mar => {
                html += `
                    <tr>
                        <td>${mar.nombre}</td>
                        <td>${mar.descripcion}</td>
                        <td><button class="btn btn-primary" onclick="getMarca(${mar.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarMarca(${mar.id})"><i class="fa-solid fa-trash-can"></i></button></td>
                    </tr>
                `;
            });

            bodyMarca.innerHTML = html
        }

        async function eliminarMarca(id){

            let respuesta = confirm("Seguro que desea eliminar la marca?")
            
            if (!respuesta) return
            
            const response = await fetch(`${API}/${id}`,{
                method: "DELETE",
                headers: {
                    "Accept":"application/json"
                }
            })
            
            const resultado = await response.json()

            alert(resultado.message)

            cargarMarca()
        }

        async function getMarca(id) {
            const response = await fetch(`${API}/${id}`)
            
            const resultado = await response.json()

            document.getElementById("nombre").value = resultado.nombre
            document.getElementById("descripcion").value = resultado.descripcion

            const modal = new bootstrap.Modal(document.getElementById("crearMarca"))
            modal.show()

        }

        async function editarMarca(id) {

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