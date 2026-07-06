<div>
    <h1>Departamentos</h1>
    <ul>
        @foreach ($departamentos as $departamento)
            <li>{{ $departamento->nombre }}</li>
        @endforeach
    </ul>
    {{ $departamentos->links() }}
</div>