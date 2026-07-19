@extends('layouts.app')

@section('content')

<div class="container">
    <h1>PERFILES</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nombres</th>
            <th scope="col">Telefono</th>
            <th scope="col">Direccion</th>
            <th scope="col">Biografia</th>
            <th scope="col">Actualizar</th>
            <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody id="tbody-perfil">
            
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        
        const API = '/api/perfiles'

        document.addEventListener('DOMContentLoaded',cargarPerfil);

        async function cargarPerfil(){
            const response = await fetch(API)
            
            const perfil = await response.json()
            
            let bodyPerfil = document.getElementById('tbody-perfil')

            let html = '';

            perfil.forEach(perf => {
                html += `
                    <tr>
                        <td>${perf.nombres}</td>
                        <td>${perf.telefono}</td>
                        <td>${perf.direccion}</td>
                        <td>${perf.biografia}</td>
                        <td><button class="btn btn-primary">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });

            bodyPerfil.innerHTML = html
        }
    </script>
@endpush
@endsection