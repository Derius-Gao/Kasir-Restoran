<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #444;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Input Menu Baru</h1>
        <form action="<?= base_url('home/simpanMenu') ?>" method="post">
            <label for="nama_menu">Nama Menu:</label>
            <input type="text" id="nama_menu" name="nama_menu" placeholder="Masukkan nama menu" required>

            <label for="harga">Harga:</label>
            <input type="text" 
										class="form-control" 
										name="harga" 
										value="<?= number_format($child->harga, 0, ',', '.') ?>" 
										oninput="formatRupiah(this)" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="tersedia">Tersedia</option>
                <option value="habis">Tidak Tersedia</option>
            </select>

            <label for="kategori">Kategori:</label>
            <select id="kategori" name="kategori" required>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>

            <button type="submit">Simpan Menu</button>
        </form>
    </div>

	<script>
function formatRupiah(element) {
    let value = element.value.replace(/\D/g, ''); // Remove non-numeric characters
    value = new Intl.NumberFormat('id-ID').format(value);
    element.value = value;
}
</script>
</body>
</html>