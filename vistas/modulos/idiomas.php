<?php
/**
 * Sistema de Gestión de Idiomas
 * Maneja la internacionalización (i18n) para la página pública
 * Idiomas soportados: Español (es), Inglés (en)
 */

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Establecer idioma por defecto si no existe
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es'; // Español por defecto
}

// Cambiar idioma si se recibe el parámetro (validado)
if (isset($_GET['lang'])) {
    $idioma_solicitado = trim($_GET['lang']);
    // Validar que el idioma solicitado esté en la lista de idiomas soportados
    if (in_array($idioma_solicitado, ['es', 'en'], true)) {
        $_SESSION['idioma'] = $idioma_solicitado;
    }
}

// Obtener idioma actual
$idioma_actual = $_SESSION['idioma'];

// Traducciones en español
$traducciones_es = [
    // Navbar
    'nav_conocenos' => 'Conócenos',
    'nav_especialidades' => 'Especialidades',
    'nav_servicios' => 'Servicios',
    'nav_medicos' => 'Médicos',
    'nav_contacto' => 'Contacto',
    'nav_acceso_personal' => 'Acceso Personal',
    
    // Hero Section
    'hero_titulo' => 'Bienvenido a Clínica Médica',
    'hero_descripcion' => 'Atención médica integral con tecnología de punta y el mejor equipo de especialistas',
    'hero_btn_cita' => 'Compra una Cita aquí',
    'hero_btn_resultados' => 'Revisa tus resultados',
    
    // Servicios
    'servicios_titulo' => 'Nuestros Servicios',
    'servicio_diagnostico_titulo' => 'Unidad de Apoyo al Diagnóstico',
    'servicio_diagnostico_desc' => 'Tecnología actualizada y un equipo humano especializado para una experiencia técnica y científica constituyen el diagnóstico preciso para garantizar el seguimiento correspondiente.',
    'servicio_espiritual_titulo' => 'Soporte Espiritual y Emocional',
    'servicio_espiritual_desc' => 'Acompañamiento y presencia en momentos difíciles, un apoyo para cada persona cuando más lo necesite. Una esperanza asegura sostenidos de Jesús hacia del altísimo.',
    'servicio_atencion_titulo' => 'Unidades de Atención',
    'servicio_atencion_desc' => 'Una amplia gama de especialidades y servicios médicos equipados con tecnología sofisticada, ofrecen una óptima experiencia.',
    'servicio_adicionales_titulo' => 'Servicios Adicionales',
    'servicio_adicionales_desc' => 'Diversos servicios adicionales puestos a tu disposición, contribuyen a brindar soluciones especiales.',
    'servicio_hoteleria_titulo' => 'Hotelería Hospitalaria',
    'servicio_hoteleria_desc' => 'Combinando confort, bienestar, seguridad, esperanza, innovación y tecnología en la calidad de atención para alcanzar la plena satisfacción en ti y tu familia.',
    'servicio_productos_titulo' => 'Productos Especiales',
    'servicio_productos_desc' => 'Convencidos que el bienestar de la salud familiar es importante, desarrollamos estrategias para lograr tu tranquilidad.',
    
    // Especialidades
    'especialidades_titulo' => 'Busca Especialidades (Carrusel)',
    'especialidad_neurocirugia' => 'Neurocirugía',
    'especialidad_neurocirugia_desc' => 'La neurocirugía es la especialidad médica dedicada al estudio, diagnóstico y tratamiento quirúrgico.',
    'especialidad_ginecologia' => 'Ginecología y Obstetricia',
    'especialidad_ginecologia_desc' => 'La ginecología es la especialidad médica dedicada al cuidado integral de la salud femenina.',
    'especialidad_neurologia' => 'Neurología',
    'especialidad_neurologia_desc' => 'La neurología es la especialidad médica que se enfoca en la prevención, diagnóstico y tratamiento.',
    'especialidad_endocrinologia' => 'Endocronología',
    'especialidad_endocrinologia_desc' => 'La endocrinología es la especialidad médica dedicada al estudio, diagnóstico y tratamiento.',
    'especialidad_doctor' => 'Doctor',
    
    // Contacto
    'contacto_titulo' => 'Contáctanos',
    'contacto_telefono' => 'Teléfono',
    'contacto_email' => 'Email',
    'contacto_atenciones' => 'Atenciones',
    'contacto_horario' => 'Consultas entre desde<br>Lunes - Sabados 7:30 a 6:00<br>Emergencias las 24 horas',
    
    // Footer
    'footer_clinica_desc' => 'CLÍNICA RODRIGUEZ Y ESPECIALISTAS formó la Clínica Rodríguez, ofreciendo RECURSOS, FEA, SOAT, SCTR, SALUD OCUPACIONAL, etc.',
    'footer_servicios' => 'Servicios',
    'footer_hospitalizacion' => 'Hospitalización',
    'footer_ubi' => 'UVI',
    'footer_emergencia' => 'Emergencia',
    'footer_laboratorio' => 'Laboratorio',
    'footer_sala_operaciones' => 'Sala de Operaciones',
    'footer_especialidades' => 'Especialidades',
    'footer_cardiologia' => 'Cardiología',
    'footer_otros_links' => 'Otros Links',
    'footer_nosotros' => 'Nosotros',
    'footer_blogs' => 'Blogs',
    'footer_contactanos' => 'Contáctanos',
    'footer_faq' => 'Preguntas Frecuentes',
    'footer_privacidad' => 'Políticas De Privacidad',
    'footer_derechos' => 'Todos los derechos reservados',
    
    // Login
    'login_titulo' => 'Sistema Clínico',
    'login_subtitulo' => 'Gestión Médica Integral',
    'login_usuario' => 'Usuario',
    'login_usuario_placeholder' => 'Ingresa tu usuario',
    'login_password' => 'Contraseña',
    'login_password_placeholder' => 'Ingresa tu contraseña',
    'login_btn_ingresar' => 'Iniciar Sesión',
    'login_btn_demo' => 'Acceso Directo (Demo)',
    'login_footer' => 'Sistema Clínico',
];

// Traducciones en inglés
$traducciones_en = [
    // Navbar
    'nav_conocenos' => 'About Us',
    'nav_especialidades' => 'Specialties',
    'nav_servicios' => 'Services',
    'nav_medicos' => 'Doctors',
    'nav_contacto' => 'Contact',
    'nav_acceso_personal' => 'Staff Access',
    
    // Hero Section
    'hero_titulo' => 'Welcome to Medical Clinic',
    'hero_descripcion' => 'Comprehensive medical care with cutting-edge technology and the best team of specialists',
    'hero_btn_cita' => 'Book an Appointment',
    'hero_btn_resultados' => 'Check Your Results',
    
    // Servicios
    'servicios_titulo' => 'Our Services',
    'servicio_diagnostico_titulo' => 'Diagnostic Support Unit',
    'servicio_diagnostico_desc' => 'Updated technology and a specialized human team for a technical and scientific experience constitute the precise diagnosis to guarantee the corresponding follow-up.',
    'servicio_espiritual_titulo' => 'Spiritual and Emotional Support',
    'servicio_espiritual_desc' => 'Accompaniment and presence in difficult times, support for each person when they need it most. A hope ensured sustained by Jesus towards the Most High.',
    'servicio_atencion_titulo' => 'Care Units',
    'servicio_atencion_desc' => 'A wide range of specialties and medical services equipped with sophisticated technology, offering an optimal experience.',
    'servicio_adicionales_titulo' => 'Additional Services',
    'servicio_adicionales_desc' => 'Various additional services at your disposal, contribute to providing special solutions.',
    'servicio_hoteleria_titulo' => 'Hospital Hospitality',
    'servicio_hoteleria_desc' => 'Combining comfort, wellness, security, hope, innovation and technology in the quality of care to achieve full satisfaction for you and your family.',
    'servicio_productos_titulo' => 'Special Products',
    'servicio_productos_desc' => 'Convinced that family health well-being is important, we develop strategies to achieve your peace of mind.',
    
    // Especialidades
    'especialidades_titulo' => 'Search Specialties (Carousel)',
    'especialidad_neurocirugia' => 'Neurosurgery',
    'especialidad_neurocirugia_desc' => 'Neurosurgery is the medical specialty dedicated to the study, diagnosis and surgical treatment.',
    'especialidad_ginecologia' => 'Gynecology and Obstetrics',
    'especialidad_ginecologia_desc' => 'Gynecology is the medical specialty dedicated to comprehensive women\'s health care.',
    'especialidad_neurologia' => 'Neurology',
    'especialidad_neurologia_desc' => 'Neurology is the medical specialty that focuses on the prevention, diagnosis and treatment.',
    'especialidad_endocrinologia' => 'Endocrinology',
    'especialidad_endocrinologia_desc' => 'Endocrinology is the medical specialty dedicated to the study, diagnosis and treatment.',
    'especialidad_doctor' => 'Doctor',
    
    // Contacto
    'contacto_titulo' => 'Contact Us',
    'contacto_telefono' => 'Phone',
    'contacto_email' => 'Email',
    'contacto_atenciones' => 'Office Hours',
    'contacto_horario' => 'Consultations from<br>Monday - Saturday 7:30 AM to 6:00 PM<br>Emergency 24 hours',
    
    // Footer
    'footer_clinica_desc' => 'CLINIC RODRIGUEZ AND SPECIALISTS formed Rodriguez Clinic, offering RESOURCES, FEA, SOAT, SCTR, OCCUPATIONAL HEALTH, etc.',
    'footer_servicios' => 'Services',
    'footer_hospitalizacion' => 'Hospitalization',
    'footer_ubi' => 'ICU',
    'footer_emergencia' => 'Emergency',
    'footer_laboratorio' => 'Laboratory',
    'footer_sala_operaciones' => 'Operating Room',
    'footer_especialidades' => 'Specialties',
    'footer_cardiologia' => 'Cardiology',
    'footer_otros_links' => 'Other Links',
    'footer_nosotros' => 'About Us',
    'footer_blogs' => 'Blogs',
    'footer_contactanos' => 'Contact Us',
    'footer_faq' => 'Frequently Asked Questions',
    'footer_privacidad' => 'Privacy Policies',
    'footer_derechos' => 'All rights reserved',
    
    // Login
    'login_titulo' => 'Clinical System',
    'login_subtitulo' => 'Comprehensive Medical Management',
    'login_usuario' => 'Username',
    'login_usuario_placeholder' => 'Enter your username',
    'login_password' => 'Password',
    'login_password_placeholder' => 'Enter your password',
    'login_btn_ingresar' => 'Log In',
    'login_btn_demo' => 'Direct Access (Demo)',
    'login_footer' => 'Clinical System',
];

// Seleccionar traducciones según idioma actual
$traducciones = ($idioma_actual === 'en') ? $traducciones_en : $traducciones_es;

/**
 * Obtiene la traducción de una clave
 * @param string $clave Clave de traducción
 * @return string Texto traducido o la clave si no existe traducción
 */
function t($clave) {
    global $traducciones;
    return isset($traducciones[$clave]) ? $traducciones[$clave] : $clave;
}

/**
 * Obtiene el idioma actual de la sesión
 * @return string Código del idioma actual ('es' o 'en')
 */
function idioma_actual() {
    global $idioma_actual;
    return $idioma_actual;
}
?>
