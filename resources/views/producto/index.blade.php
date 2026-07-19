@extends('layouts.app')

@section('content')

<div class="container">
    <h1>PRODUCTOS</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Código de barras</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody id="tbody-producto">
            
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        
        const API = '/api/productos'

        document.addEventListener('DOMContentLoaded',cargarProducto);

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
                        <td><button class="btn btn-primary">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });

            bodyProducto.innerHTML = html
        }
    </script>
@endpush
@endsection