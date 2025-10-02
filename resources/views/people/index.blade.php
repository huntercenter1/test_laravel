@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Listado de Personas</h1>
  <a href="{{ route('people.create') }}" class="btn btn-primary">Crear</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Género</th>
          <th>País</th>
          <th>Hobbies</th>
          <th>Creado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($people as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->gender === 'M' ? 'Masculino' : 'Femenino' }}</td>
            <td>{{ $p->country->name }}</td>
            <td>
              @if(is_array($p->hobbies))
                {{ collect($p->hobbies)->map(fn($h) => match($h){
                  'music' => 'Música', 'sports' => 'Deportes', 'reading' => 'Lectura', default => $h
                })->implode(', ') }}
              @endif
            </td>
            <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
            <td class="text-end">
              <a href="{{ route('people.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
              <form action="{{ route('people.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este registro?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-center text-muted py-4">Sin registros</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="card-footer d-flex justify-content-center">
    {{ $people->links() }}
  </div>
</div>
@endsection
