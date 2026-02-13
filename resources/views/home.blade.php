<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora Sueldo Neto</title>

    {{-- Icon page --}}
    <link rel="icon" href="https://static-00.iconduck.com/assets.00/devicon-plain-icon-2048x1941-ps18p8i9.png">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Calculadora Sueldo Neto</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                                Registro de colaboradores
                            </a>
                        </li>
                    </ul>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-danger">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

        {{-- Mensajes de éxito/error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modal-add-worker">
                            <i class="fas fa-plus"></i> Agregar colaborador
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>DNI</th>
                                        <th>Área</th>
                                        <th>Cargo</th>
                                        <th>Sueldo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($workers as $worker)
                                        <tr>
                                            <td>{{ $worker->nombres }}</td>
                                            <td>{{ $worker->apellido_paterno }}</td>
                                            <td>{{ $worker->apellido_materno }}</td>
                                            <td>{{ $worker->dni }}</td>
                                            <td>{{ $worker->area }}</td>
                                            <td>{{ $worker->cargo }}</td>
                                            <td>S/ {{ number_format($worker->sueldo, 2) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" 
                                                        onclick="verDetalle({{ $worker->id }})"
                                                        title="Ver detalle de sueldo">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <button type="button" class="btn btn-primary btn-sm" 
                                                        onclick="editarWorker({{ $worker->id }})"
                                                        title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm" 
                                                        onclick="eliminarWorker({{ $worker->id }})"
                                                        title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No hay trabajadores registrados</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Agregar Trabajador --}}
    <div class="modal fade" id="modal-add-worker" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Agregar Colaborador</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('workers.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            {{-- Columna 1 --}}
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Datos Personales</h6>
                                
                                <div class="mb-3">
                                    <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                           id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                                    @error('nombres')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="apellido_paterno" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" 
                                           id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
                                    @error('apellido_paterno')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="apellido_materno" class="form-label">Apellido Materno <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" 
                                           id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}" required>
                                    @error('apellido_materno')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('dni') is-invalid @enderror" 
                                           id="dni" name="dni" value="{{ old('dni') }}" 
                                           maxlength="8" pattern="[0-9]{8}" required>
                                    @error('dni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Debe contener 8 dígitos</small>
                                </div>

                                <div class="mb-3">
                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                           id="fecha_nacimiento" name="fecha_nacimiento" 
                                           value="{{ old('fecha_nacimiento') }}" 
                                           max="{{ date('Y-m-d') }}" required>
                                    @error('fecha_nacimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                                    <select class="form-select @error('sexo') is-invalid @enderror" 
                                            id="sexo" name="sexo" required>
                                        <option value="">Seleccione...</option>
                                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                                        <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('sexo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="cantidad_hijos" class="form-label">Cantidad de Hijos <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('cantidad_hijos') is-invalid @enderror" 
                                           id="cantidad_hijos" name="cantidad_hijos" 
                                           value="{{ old('cantidad_hijos', 0) }}" 
                                           min="0" required>
                                    @error('cantidad_hijos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Columna 2 --}}
                            <div class="col-md-6">
                                <h6 class="text-primary mb-3">Datos Laborales</h6>

                                <div class="mb-3">
                                    <label for="area" class="form-label">Área <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('area') is-invalid @enderror" 
                                           id="area" name="area" value="{{ old('area') }}" required>
                                    @error('area')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="cargo" class="form-label">Cargo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('cargo') is-invalid @enderror" 
                                           id="cargo" name="cargo" value="{{ old('cargo') }}" required>
                                    @error('cargo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('fecha_ingreso') is-invalid @enderror" 
                                           id="fecha_ingreso" name="fecha_ingreso" 
                                           value="{{ old('fecha_ingreso') }}" required>
                                    @error('fecha_ingreso')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sueldo" class="form-label">Sueldo (S/) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('sueldo') is-invalid @enderror" 
                                           id="sueldo" name="sueldo" 
                                           value="{{ old('sueldo') }}" 
                                           step="0.01" min="0" required>
                                    @error('sueldo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cerrar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Ver Detalle --}}
    <div class="modal fade" id="modal-detalle-worker" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detalle de Sueldo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detalle-content">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Editar Trabajador --}}
    <div class="modal fade" id="modal-edit-worker" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Editar Colaborador</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit-content">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form para eliminar --}}
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- FontAwesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

    <script>
        // Ver detalle de sueldo
        function verDetalle(workerId) {
            const modal = new bootstrap.Modal(document.getElementById('modal-detalle-worker'));
            const content = document.getElementById('detalle-content');
            
            // Mostrar loading
            content.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            `;
            
            modal.show();
            
            // Obtener datos del trabajador
            fetch(`/workers/${workerId}`)
                .then(response => response.json())
                .then(data => {
                    const worker = data.worker;
                    const detalle = data.detalle;
                    
                    content.innerHTML = `
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="text-center mb-3">
                                    <i class="fas fa-user"></i> ${worker.nombres} ${worker.apellido_paterno} ${worker.apellido_materno}
                                </h5>
                                <p class="text-center text-muted">
                                    <strong>DNI:</strong> ${worker.dni} | 
                                    <strong>Cargo:</strong> ${worker.cargo} | 
                                    <strong>Área:</strong> ${worker.area}
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0"><i class="fas fa-calculator"></i> Cálculo de Sueldo Neto</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><strong>Sueldo Base</strong></td>
                                            <td class="text-end">S/ ${parseFloat(detalle.sueldo_base).toFixed(2)}</td>
                                        </tr>
                                        <tr class="table-success">
                                            <td><strong>+ Asignación Familiar</strong></td>
                                            <td class="text-end">S/ ${parseFloat(detalle.asignacion_familiar).toFixed(2)}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <td><strong>Sueldo Bruto =</strong></td>
                                            <td class="text-end"><strong>S/ ${parseFloat(detalle.sueldo_bruto).toFixed(2)}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="table-secondary"><strong>Descuentos</strong></td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>AFP Aportación Obligatoria (10%)</td>
                                            <td class="text-end">S/ ${parseFloat(detalle.descuentos.afp_aportacion).toFixed(2)}</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>AFP Comisión (2.5%)</td>
                                            <td class="text-end">S/ ${parseFloat(detalle.descuentos.afp_comision).toFixed(2)}</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>Renta de 5ta Categoría (10%)</td>
                                            <td class="text-end">S/ ${parseFloat(detalle.descuentos.renta_quinta).toFixed(2)}</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>EPS</td>
                                            <td class="text-end">S/ ${parseFloat(detalle.descuentos.eps).toFixed(2)}</td>
                                        </tr>
                                        <tr class="table-warning">
                                            <td><strong>Total Descuentos =</strong></td>
                                            <td class="text-end"><strong>S/ ${parseFloat(detalle.descuentos.total).toFixed(2)}</strong></td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td><strong>SUELDO NETO =</strong></td>
                                            <td class="text-end"><h5 class="mb-0"><strong>S/ ${parseFloat(detalle.sueldo_neto).toFixed(2)}</strong></h5></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `;
                })
                .catch(error => {
                    content.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> Error al cargar los datos: ${error.message}
                        </div>
                    `;
                });
        }

        // Editar trabajador
        function editarWorker(workerId) {
            const modal = new bootstrap.Modal(document.getElementById('modal-edit-worker'));
            const content = document.getElementById('edit-content');
            
            // Mostrar loading
            content.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            `;
            
            modal.show();
            
            // Obtener datos del trabajador
            fetch(`/workers/${workerId}`)
                .then(response => response.json())
                .then(data => {
                    const worker = data.worker;
                    
                    content.innerHTML = `
                        <form action="/workers/${worker.id}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Datos Personales</h6>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Nombres <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nombres" value="${worker.nombres}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="apellido_paterno" value="${worker.apellido_paterno}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Apellido Materno <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="apellido_materno" value="${worker.apellido_materno}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">DNI <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="dni" value="${worker.dni}" maxlength="8" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="fecha_nacimiento" value="${worker.fecha_nacimiento.split('T')[0]}" max="${new Date().toISOString().split('T')[0]}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sexo <span class="text-danger">*</span></label>
                                        <select class="form-select" name="sexo" required>
                                            <option value="M" ${worker.sexo === 'M' ? 'selected' : ''}>Masculino</option>
                                            <option value="F" ${worker.sexo === 'F' ? 'selected' : ''}>Femenino</option>
                                            <option value="O" ${worker.sexo === 'O' ? 'selected' : ''}>Otro</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Cantidad de Hijos <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="cantidad_hijos" value="${worker.cantidad_hijos}" min="0" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Datos Laborales</h6>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Área <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="area" value="${worker.area}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Cargo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="cargo" value="${worker.cargo}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fecha de Ingreso <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="fecha_ingreso" value="${worker.fecha_ingreso.split('T')[0]}" max="${new Date().toISOString().split('T')[0]}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sueldo (S/) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="sueldo" value="${worker.sueldo}" step="0.01" min="0" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Cerrar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Actualizar
                                </button>
                            </div>
                        </form>
                    `;
                })
                .catch(error => {
                    content.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> Error al cargar los datos: ${error.message}
                        </div>
                    `;
                });
        }

        // Eliminar trabajador
        function eliminarWorker(workerId) {
            if (confirm('¿Está seguro de eliminar este trabajador? Esta acción no se puede deshacer.')) {
                const form = document.getElementById('delete-form');
                form.action = `/workers/${workerId}`;
                form.submit();
            }
        }

        // Reabrir modal si hay errores de validación
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('modal-add-worker'));
                modal.show();
            });
        @endif
    </script>
</body>

</html>
