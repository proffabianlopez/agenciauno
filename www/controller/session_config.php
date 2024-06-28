<?php
// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    // Configurar el tiempo de vida de la cookie de sesión y la recolección de basura antes de iniciar la sesión
    ini_set('session.cookie_lifetime', 86400); // 1 día en segundos
    ini_set('session.gc_maxlifetime', 86400);  // 1 día en segundos
    session_start();
    $cookie_duration = 30 * 24 * 60 * 60; // 30 días en segundos
    if (!isset($_SESSION['initiated'])) {
        // Regenerar la ID de sesión para evitar ataques de fijación de sesión
        session_regenerate_id();
        $_SESSION['initiated'] = true;
        // Establecer la cookie persistente
        setcookie('remember_me', session_id(), time() + $cookie_duration, "/");
    }

    // Si la cookie de sesión está presente y no coincide, reanudar la sesión usando la cookie persistente
    if (isset($_COOKIE['remember_me']) && session_id() !== $_COOKIE['remember_me']) {
        // Cerrar la sesión actual
        session_write_close();
        // Establecer la ID de sesión a la ID de la cookie
        session_id($_COOKIE['remember_me']);
        // Iniciar la sesión con la nueva ID
        session_start();
    }
}
?>
