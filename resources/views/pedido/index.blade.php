@extends('layouts.app')

@section('content')

<div class="container">
    <h1>PEDIDOS</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Estado</th>
            <th scope="col">Total</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody id="tbody-pedido">
            
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
       
        const API = '/api/pedidos'

        document.addEventListener('DOMContentLoaded',cargarPedido);

        async function cargarPedido(){
            const response = await fetch(API)
            
            const pedido = await response.json()
            
            let bodyPedido = document.getElementById('tbody-pedido')

            let html = '';

            pedido.forEach(ped => {
                html += `
                    <tr>
                        <td>${ped.estado}</td>
                        <td>${ped.total}</td>
                        <td><button class="btn btn-primary">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });

            bodyPedido.innerHTML = html
        }
    </script>
@endpush
@endsection