<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Prueba PHP - Laravel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap (opcional por CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .required::after { content:" *"; color:#d00; }
  </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-white border-bottom mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('people.index') }}">Prueba PHP</a>
  </div>
</nav>

<main class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">
      <strong>Corrige los siguientes errores:</strong>
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @yield('content')
</main>

<script>
/**
 * Validación básica en cliente:
 * - Campos requeridos
 * - Al menos un hobby si se quiere forzar (aquí lo dejamos opcional para coincidir con validación del servidor)
 */
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('form[data-validate="true"]').forEach(form => {
    form.addEventListener('submit', (e) => {
      let valid = true;

      const name = form.querySelector('input[name="name"]');
      const genderRadios = form.querySelectorAll('input[name="gender"]');
      const country = form.querySelector('select[name="country_id"]');

      if (!name.value.trim()) { valid = false; name.classList.add('is-invalid'); }
      else { name.classList.remove('is-invalid'); }

      let genderSelected = false;
      genderRadios.forEach(r => { if (r.checked) genderSelected = true; });
      if (!genderSelected) { valid = false; genderRadios[0].closest('.form-check-group').classList.add('border','border-danger','rounded'); }
      else { genderRadios[0].closest('.form-check-group').classList.remove('border','border-danger','rounded'); }

      if (!country.value) { valid = false; country.classList.add('is-invalid'); }
      else { country.classList.remove('is-invalid'); }

      if (!valid) {
        e.preventDefault();
        e.stopPropagation();
        alert('Por favor completa los campos obligatorios.');
      }
    });
  });
});
</script>
</body>
</html>
