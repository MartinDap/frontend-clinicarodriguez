<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Especialidades - Clínica Médica' : 'Specialties - Medical Clinic';
$pagina_activa = 'especialidades-info';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

  <!-- Hero -->
  <section class="hero-section" style="min-height: 300px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-bold mb-4"><?php echo t('nav_especialidades'); ?></h1>
          <p class="lead">
            <?php echo idioma_actual() === 'es' ? 'Contamos con especialistas altamente calificados' : 'We have highly qualified specialists'; ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Especialidades -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        
        <!-- Neurocirugía -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-cpu text-primary"></i>
              </div>
              <h5 class="card-title"><?php echo t('especialidad_neurocirugia'); ?></h5>
              <p class="card-text flex-grow-1"><?php echo t('especialidad_neurocirugia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía cerebral' : 'Brain surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de columna' : 'Spine surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Tratamiento de tumores' : 'Tumor treatment'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Ginecología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-gender-female text-danger"></i>
              </div>
              <h5 class="card-title"><?php echo t('especialidad_ginecologia'); ?></h5>
              <p class="card-text flex-grow-1"><?php echo t('especialidad_ginecologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Control prenatal' : 'Prenatal care'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Partos y cesáreas' : 'Deliveries and cesareans'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Salud reproductiva' : 'Reproductive health'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Neurología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-activity text-info"></i>
              </div>
              <h5 class="card-title"><?php echo t('especialidad_neurologia'); ?></h5>
              <p class="card-text flex-grow-1"><?php echo t('especialidad_neurologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Migrañas y cefaleas' : 'Migraines and headaches'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Epilepsia' : 'Epilepsy'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Trastornos del movimiento' : 'Movement disorders'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Endocrinología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-capsule text-success"></i>
              </div>
              <h5 class="card-title"><?php echo t('especialidad_endocrinologia'); ?></h5>
              <p class="card-text flex-grow-1"><?php echo t('especialidad_endocrinologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Diabetes' : 'Diabetes'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Tiroides' : 'Thyroid'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Obesidad' : 'Obesity'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Cardiología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-heart-pulse text-danger"></i>
              </div>
              <h5 class="card-title"><?php echo t('footer_cardiologia'); ?></h5>
              <p class="card-text flex-grow-1">
                <?php echo idioma_actual() === 'es' ? 'Especialidad dedicada al diagnóstico y tratamiento de enfermedades del corazón.' : 'Specialty dedicated to the diagnosis and treatment of heart diseases.'; ?>
              </p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Ecocardiogramas' : 'Echocardiograms'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Electrocardiogramas' : 'Electrocardiograms'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Hipertensión arterial' : 'Arterial hypertension'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Anestesiología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-droplet text-info"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Anestesiología' : 'Anesthesiology'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La anestesiología es la especialidad encargada de brindar seguridad y confort al paciente durante procedimientos quirúrgicos.' : 'Anesthesiology is the specialty responsible for providing safety and comfort to the patient during surgical procedures.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Anestesia general' : 'General anesthesia'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Anestesia regional' : 'Regional anesthesia'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Manejo del dolor' : 'Pain management'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Alergología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-flower1 text-warning"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Alergología' : 'Allergology'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La alergología es la especialidad médica dedicada al estudio, diagnóstico y tratamiento de las enfermedades causadas por reacciones alérgicas.' : 'Allergology is the medical specialty dedicated to the study, diagnosis and treatment of diseases caused by allergic reactions.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Pruebas de alergia' : 'Allergy tests'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Asma' : 'Asthma'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Rinitis alérgica' : 'Allergic rhinitis'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Cirugía General -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-scissors text-secondary"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Cirugía General' : 'General Surgery'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La cirugía general es la especialidad médica encargada de la prevención, diagnóstico y tratamiento quirúrgico de un amplio rango de enfermedades.' : 'General surgery is the medical specialty responsible for the prevention, diagnosis and surgical treatment of a wide range of diseases.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía abdominal' : 'Abdominal surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía laparoscópica' : 'Laparoscopic surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de urgencia' : 'Emergency surgery'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Cirugía Cardiovascular -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-heart text-danger"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Cirugía Cardiovascular' : 'Cardiovascular Surgery'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La cirugía cardiovascular y de tórax es la especialidad médica dedicada al diagnóstico y tratamiento quirúrgico de enfermedades que afectan al corazón y grandes vasos.' : 'Cardiovascular and thoracic surgery is the medical specialty dedicated to the diagnosis and surgical treatment of diseases affecting the heart and large vessels.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de corazón' : 'Heart surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de tórax' : 'Thoracic surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Bypass coronario' : 'Coronary bypass'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Cirugía de Cabeza y Cuello -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-person-circle text-primary"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Cirugía de Cabeza y Cuello' : 'Head and Neck Surgery'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La cirugía de cabeza y cuello es la especialidad médica encargada del diagnóstico y tratamiento quirúrgico de enfermedades benignas y malignas.' : 'Head and neck surgery is the medical specialty responsible for the diagnosis and surgical treatment of benign and malignant diseases.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía facial' : 'Facial surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de cuello' : 'Neck surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de glándulas' : 'Gland surgery'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Medicina General -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-clipboard2-pulse text-success"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Medicina General' : 'General Medicine'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La medicina general es la puerta de entrada al cuidado de la salud. La especialidad encargada de la atención integral del paciente.' : 'General medicine is the gateway to health care. The specialty responsible for comprehensive patient care.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Consulta general' : 'General consultation'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Prevención' : 'Prevention'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Diagnóstico' : 'Diagnosis'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Neumología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-lungs text-info"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Neumología' : 'Pulmonology'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La neumología es la especialidad médica dedicada al estudio, diagnóstico y tratamiento de las enfermedades del sistema respiratorio.' : 'Pulmonology is the medical specialty dedicated to the study, diagnosis and treatment of respiratory system diseases.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Enfermedades pulmonares' : 'Pulmonary diseases'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Bronquitis crónica' : 'Chronic bronchitis'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Neumonía' : 'Pneumonia'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Dermatología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-person-check text-warning"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Dermatología' : 'Dermatology'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La dermatología es la especialidad médica que se ocupa del estudio, diagnóstico y tratamiento de las enfermedades de la piel.' : 'Dermatology is the medical specialty that deals with the study, diagnosis and treatment of diseases of the skin.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Enfermedades de la piel' : 'Skin diseases'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Acné' : 'Acne'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Psoriasis' : 'Psoriasis'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Pediatría -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-emoji-smile text-success"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Pediatría' : 'Pediatrics'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'La pediatría es la especialidad médica dedicada al cuidado integral de la salud de los niños, desde el nacimiento hasta la adolescencia.' : 'Pediatrics is the medical specialty dedicated to comprehensive health care for children, from birth to adolescence.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Control de crecimiento' : 'Growth monitoring'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Vacunación' : 'Vaccination'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Enfermedades infantiles' : 'Childhood diseases'; ?></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
