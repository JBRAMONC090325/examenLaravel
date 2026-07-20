@extends('layouts.app')

@section('content')

<div class="container shadow-lg p-3 mb-5 bg-body-tertiary rounded">
    <div class="d-flex justify-content-between">
        <h2>PEDIDOS</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPedido">Nuevo Pedido <i class="fa-solid fa-file-circle-plus"></i></button>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id Usario</th>
            <th scope="col">Estado</th>
            <th scope="col">Total</th>
            <th scope="col">Operaciones</th>
            </tr>
        </thead>
        <tbody id="tbody-pedido">
            
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="crearPedido" tabindex="-1" aria-labelledby="crearPedidoLabel" aria-hidden="true">
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
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="text" class="form-control" id="total" name="total" required>
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
       
        const API = '/api/pedidos'

        document.addEventListener('DOMContentLoaded',cargarPedido);

        let formulario = document.getElementById("formulario")

        formulario.addEventListener("submit", async function(e){
            e.preventDefault();
            const modalCrear = new bootstrap.Modal(document.getElementById("crearPedido"))
            
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
                cargarPedido()
            }
        })

        async function cargarPedido(){
            const response = await fetch(API)
            
            const pedido = await response.json()
            
            let bodyPedido = document.getElementById('tbody-pedido')

            let html = '';

            pedido.forEach(ped => {
                html += `
                    <tr>
                        <td>${ped.user_id}</td>
                        <td>${ped.estado}</td>
                        <td>${ped.total}</td>
                        <td><button class="btn btn-primary" onclick="getPedido(${ped.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger" onclick="eliminarPedido(${ped.id})"><i class="fa-solid fa-trash-can"></i></button></td>
                    </tr>
                `;
            });

            bodyPedido.innerHTML = html
        }

        async function eliminarPedido(id){

            let respuesta = confirm("Seguro que desea eliminar el pedido?")
            
            if (!respuesta) return
            
            const response = await fetch(`${API}/${id}`,{
                method: "DELETE",
                headers: {
                    "Accept":"application/json"
                }
            })
            
            const resultado = await response.json()

            alert(resultado.message)

            cargarPedido()
        }
        
        async function getPedido(id) {
            const response = await fetch(`${API}/${id}`)
            
            const resultado = await response.json()

            document.getElementById("user_id").value = resultado.user_id
            document.getElementById("estado").value = resultado.estado
            document.getElementById("total").value = resultado.total

            const modal = new bootstrap.Modal(document.getElementById("crearPedido"))
            modal.show()

        }

        async function editarPedido(id) {

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