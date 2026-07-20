@extends('layouts.app')

@section('content')

<div class="container shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="d-flex justify-content-evenly">
        <h2>PRODUCTOS</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearProducto" onclick="prepararCreacion()">Nuevo Producto <i class="fa-solid fa-file-circle-plus"></i></button>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Código de barras</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody id="tbody-producto">
            
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="crearProducto" tabindex="-1" aria-labelledby="crearProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formulario">
        <input type="hidden" id="producto_id" name="producto_id">
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
                        <label for="codigo_barras" class="form-label">Código de barras</label>
                        <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock" required>
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
        const API = '/api/productos'

        document.addEventListener('DOMContentLoaded',cargarProducto);

        let formulario = document.getElementById("formulario")

        function prepararCreacion() {
            formulario.reset();
            document.getElementById("producto_id").value = "";
        }

        formulario.addEventListener("submit", async function(e){
            e.preventDefault();
            
            let modalEl = document.getElementById("crearProducto");
            let modalCrear = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);

            let data = new FormData(formulario);
            let id = document.getElementById("producto_id").value;
            
            let url = API;

            if (id) {
                url = `${API}/${id}`;
                data.append('_method', 'PUT'); 
        }

            const response = await fetch(url, {
            method: "POST",
            headers: {
                "Accept": "application/json"
            },
            body: data
            });

            const resultado = await response.json()

            if(resultado.status || response.ok){
                formulario.reset();
                document.getElementById("producto_id").value = "";
                modalCrear.hide();
                cargarProducto();
            } else {
                alert("Hubo un error al guardar el producto.");
            }
        });

        async function cargarProducto(){
            const response = await fetch(API)
            
            const producto = await response.json()
            
            let bodyProducto = document.getElementById('tbody-producto')

            let html = '';

            producto.forEach(prod => {
                html += `
                    <tr>
                        <td>${prod.nombre}</td>
                        <td>${prod.codigo_barras}</td>
                        <td>${prod.precio}</td>
                        <td>${prod.stock}</td>
                        <td><button class="btn btn-primary" onclick="getProducto(${prod.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarProducto(${prod.id})"><i class="fa-solid fa-trash-can"></i></button></td>
                    </tr>
                `;
            });

            bodyProducto.innerHTML = html
        }

        async function eliminarProducto(id){

            let respuesta = confirm("Seguro que desea eliminar el producto?")
            
            if (!respuesta) return

            const response = await fetch(`${API}/${id}`,{
                method: "DELETE",
                headers: {
                    "Accept":"application/json"
                }
            })
            
            const resultado = await response.json()

            alert(resultado.message)

            cargarProducto()
        }
        
        async function getProducto(id) {
            const response = await fetch(`${API}/${id}`);
            const resultado = await response.json();

            document.getElementById("producto_id").value = resultado.id;
            
            document.getElementById("nombre").value = resultado.nombre;
            document.getElementById("codigo_barras").value = resultado.codigo_barras;
            document.getElementById("precio").value = resultado.precio;
            document.getElementById("stock").value = resultado.stock;

            let modalEl = document.getElementById("crearProducto");
            let modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.show();
        }

    </script>
@endpush
@endsection