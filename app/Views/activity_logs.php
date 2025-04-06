<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Activity</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Log Activity</h2>
    
    <form method="GET" action="<?= base_url('home/logActivitytab/') ?>">
    <label for="filter-username">Filter berdasarkan Username:</label>
    <select id="filter-username" name="username" onchange="this.form.submit()">
        <option value="">Semua Username</option>
        <?php foreach ($users as $user) : ?>
            <option value="<?= htmlspecialchars($user['username']) ?>" 
                <?= ($selectedUsername == $user['username']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($user['username']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

    
    <table id="log-table">
        <thead>
            <tr>    
                <th>Waktu</th>
                <th>Username</th>
                <th>Aksi</th>
                <th>IP Address</th>
            </tr>
        </thead>
        <tbody id="log-table-body">
            <?php if (!empty($logs)) : ?>
                <?php foreach ($logs as $log) : ?>
                    <tr>
                        <td><?= htmlspecialchars($log['timestamp']) ?></td>
                        <td class="log-username"> <?= htmlspecialchars(trim($log['username'])) ?> </td>
                        <td><?= htmlspecialchars($log['aksi']) ?></td>
                        <td><?= htmlspecialchars($log['ip_address']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" style="text-align: acenter;">Tidak ada log aktivitas</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        function filterLogs() {
        var select = document.getElementById("filter-username");
        var username = select.value;

        // Ambil data melalui AJAX dari URL yang sudah ada
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= base_url('logs') ?>?username=" + username, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("log-table-body").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }


    </script>
</body>