<?php
//test franco
session_start();
require_once("Config/conexion.php");
require_once("Controllers/UsuarioC.php");
require_once("Controllers/SolicitudC.php");
require_once("Controllers/ProductoC.php");

$accion = $_GET['accion'] ?? 'index';

$acciones_publicas = ['login', 'autenticar', 'register', 'guardarU', 'redireccion'];

if (!in_array($accion, $acciones_publicas)) {
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?accion=login");
        exit;
    }
}

const ROL_TECNICO = 1;
const ROL_CLIENTE = 2;
const ROL_ADMIN = 3;

switch ($accion) {
    case 'login':
        $controller = new UsuarioC();
        $controller->login();
    break;
    
   case 'actualizar':
    $controller = new UsuarioC();
    $controller->actualizar();
break;

    case 'autenticar':
        $controller = new UsuarioC();
        $controller->autenticar();
    break;
        
    case 'logout':
        $controller = new UsuarioC();
        $controller->logout();
    break;

    case 'register':
        $controller = new UsuarioC();
        $controller->crear();
    break;

    case 'guardarU':
        $controller = new UsuarioC();
        $controller->guardarU();
    break;

    case 'redireccion':
        if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == ROL_CLIENTE) {
                $controller = new ProductoC();
                $controller->mostrarPanelCliente();
            } elseif ($_SESSION['rol'] == ROL_TECNICO) {
                include("./Views/Usuario/Tecnico/TecnicoP.php");
            } elseif ($_SESSION['rol'] == ROL_ADMIN) {
                include("./Views/Usuario/Admin/AdminP.php");
            } else {
                echo "<h1>Error: Rol no reconocido.</h1>";
                echo "<p><a href='index.php?accion=logout'>Cerrar Sesión</a></p>";
            }
        } else {
            header("Location: index.php?accion=login");
            exit();
        }
    break;
    
    case 'mostrarHistorial':
        $controller = new HistorialController();
        $controller->mostrarHistorial();
    break;
    
    case 'formularioS':
        $controller = new SolicitudC();
        $controller->formularioS();
    break;

    case 'formularioP':
        $controller = new ProductoC();
        $controller->formularioP();
    break;

    case 'guardarP':
        $controller = new ProductoC();
        $controller->guardarP();
    break;

    case 'borrarP':
        $controller = new ProductoC();
        $controller->borrar();
    break;

    case 'crearS':
        $controller = new SolicitudC();
        $controller->crearS();
    break;
        
    case 'SolicitudesLibres':
        $controller = new SolicitudC();
        $controller->getLibresData();
        require_once("Views/Solicitudes/libres.php");
    break;

    case 'SolicitudesOcupadas':
        $controller = new SolicitudC();
        $controller->getOcupadasData($estado_filter = 'all');
        require_once("Views/Solicitudes/ocupadas.php");
    break;

    case 'SolicitudSelec';
        $controller = new SolicitudC();
        $controller->handleSelectSolicitud($solicitudId, $usuarioId = null);
    break;
        
    default:
        if (isset($_SESSION['usuario'])) {
            header("Location: index.php?accion=redireccion");
        } else {
            header("Location: index.php?accion=login");
        }
        exit();
}
?>
