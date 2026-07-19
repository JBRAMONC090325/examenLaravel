@extends('layouts.app')

@section('content')

<div class="container">
    <h1>CATEGORIAS</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody id="tbody-categoria">
            
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
       
        const API = '/api/categorias'

        document.addEventListener('DOMContentLoaded',cargarCategoria);

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
                        <td><button class="btn btn-primary">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });

            bodyCategoria.innerHTML = html
        }
    </script>
@endpush
@endsection