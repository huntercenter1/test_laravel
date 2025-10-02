@php
  $editing = isset($person);
  $selectedHobbies = old('hobbies', $editing ? $person->hobbies ?? [] : []);
@endphp

<form method="POST"
      action="{{ $editing ? route('people.update', $person) : route('people.store') }}"
      data-validate="true">
  @csrf
  @if($editing) @method('PUT') @endif

  <div class="mb-3">
    <label class="form-label required">Nombre</label>
    <input type="text" name="name" value="{{ old('name', $editing ? $person->name : '') }}" class="form-control" maxlength="120" required>
    <div class="invalid-feedback">El nombre es requerido.</div>
  </div>

  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="description" rows="3" class="form-control">{{ old('description', $editing ? $person->description : '') }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label required d-block">Género</label>
    <div class="form-check-group">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" {{ old('gender', $editing ? $person->gender : '') === 'M' ? 'checked' : '' }}>
        <label class="form-check-label" for="genderM">Masculino</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="genderF" value="F" {{ old('gender', $editing ? $person->gender : '') === 'F' ? 'checked' : '' }}>
        <label class="form-check-label" for="genderF">Femenino</label>
      </div>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Hobbies</label>
    <div class="form-check">
      @foreach($hobbiesOptions as $value => $label)
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="hobbies[]" id="hob_{{ $value }}" value="{{ $value }}"
                 {{ in_array($value, $selectedHobbies ?? [], true) ? 'checked' : '' }}>
          <label class="form-check-label" for="hob_{{ $value }}">{{ $label }}</label>
        </div>
      @endforeach
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label required">País</label>
    <select name="country_id" class="form-select" required>
      <option value="">-- Selecciona --</option>
      @foreach($countries as $c)
        <option value="{{ $c->id }}" {{ (string)old('country_id', $editing ? $person->country_id : '') === (string)$c->id ? 'selected' : '' }}>
          {{ $c->name }}
        </option>
      @endforeach
    </select>
    <div class="invalid-feedback">Selecciona un país.</div>
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-primary">{{ $editing ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('people.index') }}" class="btn btn-outline-secondary">Cancelar</a>
  </div>
</form>
