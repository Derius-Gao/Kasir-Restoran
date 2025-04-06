<?php

use App\Models\ActivityLogModel;
use CodeIgniter\I18n\Time;

if (!function_exists('log_activity')) {
    function log_activity($id_user, $username, $aksi)
    {
        $logModel = new ActivityLogModel();
        $logModel->insert([
            'id_user'   => $id_user,
            'username'  => $username,
            'aksi'    => $aksi,
            'timestamp'=> Time::now('Asia/Jakarta', 'Y-m-d H:i:s'),
            'ip_address'=> $_SERVER['REMOTE_ADDR']
        ]);
    }
}
