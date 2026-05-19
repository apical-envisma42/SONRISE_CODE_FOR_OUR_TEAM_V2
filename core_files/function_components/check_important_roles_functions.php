<?php

// THIS PART CHECKS IMPORTANT FUNCTIONS LIKE MAINTENNANCE MODE ETC

function check_maintenance_mode($APP_MAINTENANCE_MODE) {
    if(isset($_GET['maintenance_status']) && $_GET['maintenance_status'] === 'check_maintenance') {
    if($APP_MAINTENANCE_MODE === 'ON') {
        header("Location: maintenance_page.php?check_maintenance=active_maintenance");
        exit();
    } else {
        header("Location: poems.php?check_maintenance=active_maintenance");
        exit();
    };
}
}


?>