@extends('layouts.app')

@section('content')

<div class="container">
    <h1>MARCAS</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody id="tbody-marca">
            
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
       
        const API = '/api/marcas'

        document.addEventListener('DOMContentLoaded',cargarMarca);

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
                        <td><button class="btn btn-primary">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });

            bodyMarca.innerHTML = html
        }
    </script>
@endpush
@endsection