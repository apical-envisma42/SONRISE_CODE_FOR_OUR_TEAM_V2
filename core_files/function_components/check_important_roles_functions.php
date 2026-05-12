<?php

// THIS PART CHECKS IMPORTANT FUNCTIONS LIKE MAINTENNANCE MODE ETC

function check_maintenance_mode() {
    global $APP_MAINTENANCE_MODE;
    if(isset($_GET['maintenance_status']) && $_GET['maintenance_status'] === 'check_maintenance'){
    if($APP_MAINTENANCE_MODE === 'OFF') {
        header("Location: ../../../index.php");
        exit();
    } elseif($APP_MAINTENANCE_MODE === 'ON') {
        header("Location: maintenance_page.php?maintenance_status=active_maintenance");
        exit();
    }
}
}

?>