// Contador de caracteres para el textarea
const razonTextarea = document.getElementById('razonConsulta');
const razonCounter = document.getElementById('razonCounter');

if (razonTextarea && razonCounter) {
  razonTextarea.addEventListener('input', function() {
    razonCounter.textContent = this.value.length;
  });
}

// Variables globales
let medicoSeleccionado = null;
let horarioSeleccionado = null;

// Detectar idioma actual
const idiomaActual = document.documentElement.lang || 'es';

// Textos traducidos
const textos = {
  es: {
    seleccioneMedico: 'Seleccione un médico',
    horariosDisponibles: 'Horarios disponibles',
    noHayMedicos: 'No hay médicos disponibles para esta especialidad',
    errorCargar: 'Error al cargar los médicos disponibles',
    dias: {
      LUNES: 'Lun',
      MARTES: 'Mar',
      MIÉRCOLES: 'Mié',
      MIERCOLES: 'Mié',
      JUEVES: 'Jue',
      VIERNES: 'Vie',
      SÁBADO: 'Sáb',
      SABADO: 'Sáb',
      DOMINGO: 'Dom'
    }
  },
  en: {
    seleccioneMedico: 'Select a doctor',
    horariosDisponibles: 'Available schedules',
    noHayMedicos: 'No doctors available for this specialty',
    errorCargar: 'Error loading available doctors',
    dias: {
      LUNES: 'Mon',
      MARTES: 'Tue',
      MIÉRCOLES: 'Wed',
      MIERCOLES: 'Wed',
      JUEVES: 'Thu',
      VIERNES: 'Fri',
      SÁBADO: 'Sat',
      SABADO: 'Sat',
      DOMINGO: 'Sun'
    }
  }
};

const t = textos[idiomaActual] || textos.es;

// Listener para el select de especialidad
const especialidadSelect = document.getElementById('especialidad');

if (especialidadSelect) {
  especialidadSelect.addEventListener('change', async function() {
    const especialidadId = this.value;
    
    // Limpiar selecciones previas
    limpiarSelecciones();
    
    if (!especialidadId) {
      return;
    }
    
    // Cargar médicos disponibles
    await cargarMedicosDisponibles(especialidadId);
  });
}

// Función para limpiar selecciones
function limpiarSelecciones() {
  medicoSeleccionado = null;
  horarioSeleccionado = null;
  
  // Remover contenedor de médicos si existe
  const contenedorExistente = document.getElementById('contenedor-medicos');
  if (contenedorExistente) {
    contenedorExistente.remove();
  }
}

// Función para cargar médicos disponibles
// Función para cargar médicos disponibles
async function cargarMedicosDisponibles(especialidadId) {
  try {
    
    const response = await fetch(`${CONFIG.API_BASE_URL}disponibilidad/especialidad/${especialidadId}`, {
      method: 'GET',
      headers: {
        //[CONFIG.API_AUTH_HEADER.split(':')[0]]: CONFIG.API_AUTH_HEADER.split(':')[1]
      }
    });
    
    if (!response.ok) {
      throw new Error('Error en la petición');
    }
    
    const resultado = await response.json();
    
    if (resultado.success && resultado.data.medicosDisponibles) {
      mostrarMedicos(resultado.data.medicosDisponibles);
    } else {
      mostrarMensaje(t.noHayMedicos, 'warning');
    }
    
  } catch (error) {
    console.error('Error:', error);
    mostrarMensaje(t.errorCargar, 'danger');
  }
}

// Función para mostrar los médicos
function mostrarMedicos(medicos) {
  if (medicos.length === 0) {
    mostrarMensaje(t.noHayMedicos, 'warning');
    return;
  }
  
  // Crear contenedor si no existe
  let contenedor = document.getElementById('contenedor-medicos');
  if (!contenedor) {
    contenedor = document.createElement('div');
    contenedor.id = 'contenedor-medicos';
    contenedor.className = 'mb-4';
    
    // Insertar después del select de especialidad
    const especialidadDiv = especialidadSelect.closest('.mb-3');
    especialidadDiv.insertAdjacentElement('afterend', contenedor);
  }
  
  contenedor.innerHTML = '';
  
  // Crear HTML para cada médico
  medicos.forEach(medico => {
    const medicoCard = crearMedicoCard(medico);
    contenedor.appendChild(medicoCard);
  });
}

// Función para crear tarjeta de médico
function crearMedicoCard(medico) {
  const card = document.createElement('div');
  card.className = 'medico-card mb-3';
  card.style.cssText = 'border: 1px solid #dee2e6; border-radius: 8px; padding: 15px; background: #f8f9fa;';
  
  // Información del médico
  const medicoInfo = document.createElement('div');
  medicoInfo.className = 'd-flex align-items-center mb-3';
  medicoInfo.innerHTML = `
    <img src="${medico.medicoFotoUrl}" 
         alt="${medico.medicoNombre}" 
         style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
    <div>
      <h5 class="mb-0">${medico.medicoNombre} ${medico.medicoApellido}</h5>
      <small class="text-muted">${t.horariosDisponibles}</small>
    </div>
  `;
  
  card.appendChild(medicoInfo);
  
  // Horarios disponibles
  if (medico.horarios && medico.horarios.length > 0) {
    const horariosContainer = crearHorariosContainer(medico);
    card.appendChild(horariosContainer);
  }
  
  return card;
}

// Función para crear contenedor de horarios
function crearHorariosContainer(medico) {
  const container = document.createElement('div');
  container.className = 'horarios-container';
  
  medico.horarios.forEach(horario => {
    const diaDiv = document.createElement('div');
    diaDiv.className = 'mb-3';
    
    // Título del día
    const diaLabel = document.createElement('div');
    diaLabel.className = 'mb-2';
    diaLabel.style.cssText = 'font-weight: 500; color: #495057;';
    const diaNombreCorto = t.dias[horario.diaNombre.toUpperCase()] || horario.diaNombre;
    diaLabel.textContent = diaNombreCorto;
    diaDiv.appendChild(diaLabel);
    
    // Generar slots de tiempo
    const slotsContainer = document.createElement('div');
    slotsContainer.className = 'd-flex flex-wrap gap-2';
    slotsContainer.style.gap = '8px';
    
    const slots = generarSlots(horario);
    slots.forEach(slot => {
      const slotBtn = crearSlotBoton(slot, medico, horario);
      slotsContainer.appendChild(slotBtn);
    });
    
    diaDiv.appendChild(slotsContainer);
    container.appendChild(diaDiv);
  });
  
  return container;
}

// Función para generar slots de tiempo
function generarSlots(horario) {
  const slots = [];
  const duracionMinutos = horario.duracion;
  
  // Convertir horas a minutos
  const [horaInicioH, horaInicioM] = horario.horaInicio.split(':').map(Number);
  const [horaFinH, horaFinM] = horario.horaFin.split(':').map(Number);
  
  let inicioMinutos = horaInicioH * 60 + horaInicioM;
  const finMinutos = horaFinH * 60 + horaFinM;
  
  while (inicioMinutos + duracionMinutos <= finMinutos) {
    const horaInicio = minutosAHora(inicioMinutos);
    const horaFin = minutosAHora(inicioMinutos + duracionMinutos);
    
    slots.push({
      inicio: horaInicio,
      fin: horaFin,
      dia: horario.diaNombre,
      diaId: horario.diaId
    });
    
    inicioMinutos += duracionMinutos;
  }
  
  return slots;
}

// Función para convertir minutos a formato HH:MM
function minutosAHora(minutos) {
  const horas = Math.floor(minutos / 60);
  const mins = minutos % 60;
  return `${horas.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
}

// Función para crear botón de slot
function crearSlotBoton(slot, medico, horario) {
  const btn = document.createElement('button');
  btn.type = 'button';
  btn.className = 'slot-horario';
  btn.style.cssText = `
    padding: 8px 12px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    background: white;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 14px;
  `;
  
  const diaNombreCorto = t.dias[slot.dia.toUpperCase()] || slot.dia;
  btn.textContent = `${diaNombreCorto} ${slot.inicio}`;
  
  // Hover effect
  btn.addEventListener('mouseenter', function() {
    if (!this.classList.contains('seleccionado')) {
      this.style.background = '#e9ecef';
    }
  });
  
  btn.addEventListener('mouseleave', function() {
    if (!this.classList.contains('seleccionado')) {
      this.style.background = 'white';
    }
  });
  
  // Click para seleccionar
  btn.addEventListener('click', function() {
    // Remover selección previa
    document.querySelectorAll('.slot-horario.seleccionado').forEach(el => {
      el.classList.remove('seleccionado');
      el.style.background = 'white';
      el.style.borderColor = '#dee2e6';
      el.style.color = 'inherit';
    });
    
    // Marcar como seleccionado
    this.classList.add('seleccionado');
    this.style.background = '#0d6efd';
    this.style.borderColor = '#0d6efd';
    this.style.color = 'white';
    
    // Guardar selección
    medicoSeleccionado = medico;
    horarioSeleccionado = {
      diaId: slot.diaId,
      dia: slot.dia,
      horaInicio: slot.inicio,
      horaFin: slot.fin,
      duracion: horario.duracion
    };
    
    console.log('Médico seleccionado:', medicoSeleccionado);
    console.log('Horario seleccionado:', horarioSeleccionado);
  });
  
  return btn;
}

// Función para mostrar mensajes
function mostrarMensaje(texto, tipo) {
  let contenedor = document.getElementById('contenedor-medicos');
  if (!contenedor) {
    contenedor = document.createElement('div');
    contenedor.id = 'contenedor-medicos';
    contenedor.className = 'mb-4';
    
    const especialidadDiv = especialidadSelect.closest('.mb-3');
    especialidadDiv.insertAdjacentElement('afterend', contenedor);
  }
  
  contenedor.innerHTML = `
    <div class="alert alert-${tipo}" role="alert">
      ${texto}
    </div>
  `;
}

// Función para obtener fecha actual en formato YYYY-MM-DD
function obtenerFechaActual() {
  const hoy = new Date();
  const year = hoy.getFullYear();
  const month = String(hoy.getMonth() + 1).padStart(2, '0');
  const day = String(hoy.getDate()).padStart(2, '0');
  return `${year}-${month}-${day}`;
}

// Función para registrar paciente
async function registrarPaciente(datos) {
  try {
    const response = await fetch(`${CONFIG.API_BASE_URL}pacientes`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
        //[API_AUTH_HEADER.split(':')[0]]: API_AUTH_HEADER.split(':')[1]
      },
      body: JSON.stringify({
        paciNombrecompleto: datos.nombreCompleto,
        paciSexo: null,
        paciFecNacimiento: null,
        paciDni: datos.documento,
        paciEstadoCivil: null,
        paciDireccion: null,
        paciTelefono: datos.celular,
        paciEmail: datos.correo,
        paciApoderado: null,
        paciNumhistoria: null,
        paciEstado: 0
      })
    });
    
    if (!response.ok) {
      throw new Error('Error al registrar paciente');
    }
    
    const resultado = await response.json();
    
    if (resultado.success && resultado.data) {
      return resultado.data.paciId;
    } else {
      throw new Error(resultado.message || 'Error al registrar paciente');
    }
    
  } catch (error) {
    console.error('Error en registrarPaciente:', error);
    throw error;
  }
}

// Función para registrar cita
async function registrarCita(pacienteId, medicoId, especialidadNombre, datos) {
  try {
    const fechaActual = obtenerFechaActual();
    
    const response = await fetch(`${CONFIG.API_BASE_URL}citas`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        //[API_AUTH_HEADER.split(':')[0]]: API_AUTH_HEADER.split(':')[1]
      },
      body: JSON.stringify({
        paciente: { paciId: pacienteId },
        medico: { mediId: medicoId },
        citaFecha: fechaActual,
        citaHora: datos.horaInicio + ':00',
        citaTipo: `Consulta general para ${especialidadNombre}`,
        citaMotivo: datos.razonConsulta,
        citaEstado: 'RESERVADO POR PACIENTE',
        citaFechaRegistro: fechaActual
      })
    });
    
    if (!response.ok) {
      throw new Error('Error al registrar cita');
    }
    
    const resultado = await response.json();
    
    if (resultado.success) {
      return resultado;
    } else {
      throw new Error(resultado.message || 'Error al registrar cita');
    }
    
  } catch (error) {
    console.error('Error en registrarCita:', error);
    throw error;
  }
}


// Función para mostrar loading
function mostrarLoading(mostrar) {
  const btnEnviar = document.getElementById('saludo');
  if (mostrar) {
    btnEnviar.disabled = true;
    btnEnviar.innerHTML = idiomaActual === 'es' 
      ? '<span class="spinner-border spinner-border-sm me-2"></span>Procesando...' 
      : '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
  } else {
    btnEnviar.disabled = false;
    btnEnviar.innerHTML = idiomaActual === 'es'
      ? 'Enviar por WhatsApp <i class="bi bi-whatsapp"></i>'
      : 'Send via WhatsApp <i class="bi bi-whatsapp"></i>';
  }
}


// Modificar el submit del formulario para incluir los datos seleccionados
const formCita = document.getElementById('formCita');
if (formCita) {
  formCita.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Validar que se haya seleccionado médico y horario
    if (!medicoSeleccionado || !horarioSeleccionado) {
      alert(idiomaActual === 'es' 
        ? 'Por favor selecciona un médico y un horario' 
        : 'Please select a doctor and schedule');
      return;
    }
    
    // Obtener datos del formulario
    const nombreCompleto = document.getElementById('nombreCompleto').value;
    const documento = document.getElementById('documento').value;
    const celular = document.getElementById('celular').value;
    const correo = document.getElementById('correo').value;
    const razonConsulta = document.getElementById('razonConsulta').value;
    const especialidadSelect = document.getElementById('especialidad');
    const especialidadNombre = especialidadSelect.options[especialidadSelect.selectedIndex].text;

    // Mostrar loading
    mostrarLoading(true);

    try{
        // 1. Registrar paciente
      const pacienteId = await registrarPaciente({
        nombreCompleto,
        documento,
        celular,
        correo
      });

      console.log('Paciente registrado con ID:', pacienteId);

      // 2. Registrar cita
      const resultadoCita = await registrarCita(
        pacienteId,
        medicoSeleccionado.medicoId,
        especialidadNombre,
        {
          horaInicio: horarioSeleccionado.horaInicio,
          razonConsulta
        }
      );
      console.log('Cita registrada:', resultadoCita);

      // Crear mensaje para WhatsApp
        const mensaje = `
            *SOLICITUD DE CITA MÉDICA*

            *Paciente:* ${nombreCompleto}
            *Documento:* ${documento}
            *Teléfono:* ${celular}
            *Correo:* ${correo}

            *Especialidad:* ${especialidadNombre}
            *Médico:* Dr(a). ${medicoSeleccionado.medicoNombre} ${medicoSeleccionado.medicoApellido}
            *Día:* ${horarioSeleccionado.dia}
            *Horario:* ${horarioSeleccionado.horaInicio} - ${horarioSeleccionado.horaFin}

            *Motivo de consulta:*
            ${razonConsulta}
        `.trim();

        // Codificar mensaje para URL
        const mensajeCodificado = encodeURIComponent(mensaje);
        
        // Número de WhatsApp de la clínica
        const numeroWhatsApp = '+51927238131';
        
        // Crear URL de WhatsApp
        const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensajeCodificado}`;
        
        // Abrir WhatsApp
        window.open(urlWhatsApp, '_blank');

        // Limpiar formulario después de un breve delay
        setTimeout(() => {
            formCita.reset();
            limpiarSelecciones();
        }, 1000);


    }catch(error){
        console.error('Error al procesar la cita:', error);
      alert(idiomaActual === 'es'
        ? 'Error al registrar la cita. Por favor, intenta nuevamente.'
        : 'Error registering the appointment. Please try again.');
    }finally{
        mostrarLoading(false);
    }

  });
}

// Contador de caracteres para cada campo
function setupCharCounter(inputId, counterId) {
  const input = document.getElementById(inputId);
  const counter = document.getElementById(counterId);
  
  input.addEventListener('input', function() {
    counter.textContent = this.value.length;
  });
}

// Inicializar contadores
setupCharCounter('razonConsulta', 'razonCounter');

// Validar que solo se ingresen números en DNI/Pasaporte y Teléfono
function validarSoloNumeros(inputId) {
  const input = document.getElementById(inputId);
  
  input.addEventListener('input', function(e) {
    // Remover cualquier caracter que no sea número
    this.value = this.value.replace(/[^0-9]/g, '');
  });
  
  // Prevenir pegar texto no numérico
  input.addEventListener('paste', function(e) {
    e.preventDefault();
    const pasteData = (e.clipboardData || window.clipboardData).getData('text');
    const soloNumeros = pasteData.replace(/[^0-9]/g, '');
    this.value = soloNumeros;
  });
}


