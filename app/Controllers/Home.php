<?php

namespace App\Controllers;
use App\Models\M_der;
use App\Models\UserModel;
use App\Models\ActivityLogModel;
use App\Models\MenuModel;
use App\Models\CartModel;
use App\Models\TransaksiModel;
// Ensure TCPDF is included
use TCPDF;
use Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class Home extends BaseController
{
    public function index()
    {
        echo view('register.php');
    }
    public function pengaturan()
    {
        $db = db_connect();
        $pengaturan = $db->table('pengaturan_app')->get()->getRow();
        echo view('surga');
        echo view('pengaturan', ['pengaturan' => $pengaturan]);
        echo view('neraka');
    }
    public function simpan_pengaturan()
    {
        $db = db_connect();
    
        // Ambil file yang diunggah untuk logo header
        $fileLogo = $this->request->getFile('logo');
    
        // Ambil file yang diunggah untuk logo favicon
        $fileLogoWeb = $this->request->getFile('logo_web');
    
        // Ambil data pengaturan saat ini
        $pengaturan = $db->table('pengaturan_app')->get()->getRow();
    
        // Inisialisasi variabel untuk nama file
        $logoName = $pengaturan->logo; // Gunakan logo lama sebagai default
        $logoWebName = $pengaturan->logo_web; // Gunakan logo_web lama sebagai default
    
        // Proses logo header
        if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
            // Validasi tipe file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($fileLogo->getMimeType(), $allowedTypes)) {
                return redirect()->back()->with('error', 'Hanya file gambar yang diperbolehkan (JPG, PNG, GIF).');
            }
    
            // Generate nama file unik dan pindahkan file
            $logoName = $fileLogo->getRandomName();
            $fileLogo->move(FCPATH . 'uploads', $logoName);
    
            // Hapus logo lama jika ada
            if ($pengaturan->logo && file_exists(FCPATH . 'uploads/' . $pengaturan->logo)) {
                unlink(FCPATH . 'uploads/' . $pengaturan->logo);
            }
        }
    
        // Proses logo favicon
        if ($fileLogoWeb && $fileLogoWeb->isValid() && !$fileLogoWeb->hasMoved()) {
            // Validasi tipe file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/x-icon'];
            if (!in_array($fileLogoWeb->getMimeType(), $allowedTypes)) {
                return redirect()->back()->with('error', 'Hanya file gambar yang diperbolehkan (JPG, PNG, GIF, ICO).');
            }
    
            // Generate nama file unik dan pindahkan file
            $logoWebName = $fileLogoWeb->getRandomName();
            $fileLogoWeb->move(FCPATH . 'uploads', $logoWebName);
    
            // Hapus logo_web lama jika ada
            if ($pengaturan->logo_web && file_exists(FCPATH . 'uploads/' . $pengaturan->logo_web)) {
                unlink(FCPATH . 'uploads/' . $pengaturan->logo_web);
            }
        }
    
        // Ambil data dari input form
        $data = [
            'judul' => $this->request->getPost('judul'),
            'logo' => $logoName, // Simpan nama file logo header ke database
            'logo_web' => $logoWebName, // Simpan nama file logo favicon ke database
        ];
    
        // Update ke database
        $db->table('pengaturan_app')->update($data);
    
        return redirect()->to('home/dashboard')->with('success', 'Pengaturan berhasil diperbarui!');
    }
     public function heder()
    {
     echo view('surga.php');
      echo view('product.php');
        echo view('neraka.php');
    }
    public function dashboard()
    {
        if (session()->get('id_user')>0){
    	echo view('surga.php');
    	echo view('dashboard.php');
        echo view('neraka.php');
            }else{
          return redirect()->to('home/login');
      }
    }
     public function cart()
    {
      echo view('surga.php');
      echo view('cart.php');
        echo view('neraka.php');
    }
      public function login()
    {
        echo view('login.php');
    }
    public function forgot_password()
    {
        echo view ('surgauser');
        echo view ('forgot_password');
        echo view ('nerakauser');
    }
    public function aksi_forgot_password()
    {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
    
        // Cek apakah email ada di database
        $user = $userModel->where('email', $email)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }
    
        // Set zona waktu
        date_default_timezone_set('Asia/Jakarta');
    
        // Generate token dan waktu kadaluwarsa
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", strtotime("+20 minutes"));
    
        // Simpan token di database
        $userModel->update($user['id_user'], [
            'reset_token' => $token_hash,
            'reset_token_expiry' => $expiry
        ]);
    
        // Buat link reset password
        $resetLink = base_url("/home/aksi_reset_password?token=$token");
    
        // Isi email
        $subject = "Reset Password Anda";
        $message = "
        <html>
        <head>
            <title>Reset Password</title>
        </head>
        <body>
            <p>Halo, {$user['nama_user']}!</p>
            <p>Klik link di bawah untuk mereset password Anda:</p>
            <p><a href='$resetLink' style='color: blue;'>Reset Password</a></p>
            <p>Link ini berlaku selama 20 menit.</p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        </body>
        </html>
        ";
    
        // Kirim email dengan PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'boboysigma@gmail.com';
            $mail->Password   = 'wrmx otse xfrt vgoy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
    
            $mail->setFrom('boboysigma@gmail.com', 'Kasir Restoran');
            $mail->addAddress($email);
    
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
    
            $mail->send();
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Gagal mengirim email: {$mail->ErrorInfo}");
        }
    }
    
    public function aksi_reset_password()
    {
        $userModel = new UserModel();
        $token = $this->request->getGet('token');
        $token_hash = hash("sha256", $token);
    
        // Cari user berdasarkan token
        $user = $userModel->where('reset_token', $token_hash)->first();
    
        if (!$user) {
            return redirect()->to('home/login')->with('error', 'Token tidak valid.');
        }
    
        // Cek apakah token masih berlaku
        if (strtotime($user['reset_token_expiry']) < time()) {
            return redirect()->to('home/login')->with('error', 'Token telah kadaluwarsa.');
        }
    
        return view('reset_password_form', ['token' => $token]);
    }
    public function aksi_reset_password_save()
{
    $userModel = new UserModel();
    $token = $this->request->getPost('token');
    $token_hash = hash("sha256", $token);
    $password = $this->request->getPost('password');

    // Validasi password minimal 6 karakter
    if (strlen($password) < 6) {
        return redirect()->back()->with('error', 'Password minimal 6 karakter.');
    }

    // Cari user berdasarkan token
    $user = $userModel->where('reset_token', $token_hash)->first();

    if (!$user) {
        return redirect()->to('home/login')->with('error', 'Token tidak valid.');
    }

    // Cek apakah token masih berlaku
    if (strtotime($user['reset_token_expiry']) < time()) {
        return redirect()->to('home/login')->with('error', 'Token telah kadaluwarsa.');
    }

    // Simpan password baru dan hapus token
    $userModel->update($user['id_user'], [
        'password' => ($password),
        'reset_token' => null,
        'reset_token_expiry' => null
    ]);

    return redirect()->to('home/login')->with('success', 'Password berhasil diperbarui. Silakan login.');
}

public function aksi_login()
{
    if ($this->request->getMethod() !== 'post') {
        return redirect()->to('home/login')->with('error', 'Invalid request.');
    }

    $recaptcha_secret = "6LcTh-8qAAAAAMQY29CbLBdF2Wpg-GNTdCz-fqwZ"; 
    $recaptcha_response = $this->request->getPost('g-recaptcha-response');

    // Verify reCAPTCHA with Google
    $verify_url = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verify_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);
    $response_keys = json_decode($response, true);

    if (!$response_keys["success"]) {
        return redirect()->to('home/login')->with('error', 'reCAPTCHA failed. Try again.');
    }

    // Get input values
    $a=$this->request->getpost('email');
          $d=$this->request->getpost('password');   

    $Joyce = new M_der();
    $data = array(
            'email' => $a,
            'password' => ($d),
          );

          $cek = $Joyce->getWhere('user',$data);

        if ($cek != null) {
    session()->set([
            'id_user' => $cek->id_user,
            'username' => $cek->username, // Pastikan username disimpan di session
            'e' => $cek->email,
            'level' => $cek->level,
        ]); 

          return redirect()->to('home/dashboard');
         }else{
          return redirect()->to('home/login');
         }
    } 
    public function logout()
    {
      session()->destroy();
      return redirect()->to('home/login');
    }
    public function menu()
    {
        if (session()->get('id_user') > 0) {
            $menuModel = new MenuModel();
            $data['menus'] = $menuModel->where('status', 'tersedia')->findAll(); // Hanya menampilkan yang tersedia
    
            // Log aktivitas
            $this->logActivity("User mengakses menu");
    
            // Tampilkan view
            echo view('surga.php');
            echo view('menu', $data);
            echo view('neraka.php');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function makanan()
    {
        if (session()->get('id_user') > 0) {
            $menuModel = new MenuModel();
            $data['menus'] = $menuModel->where('kategori', 'makanan')->findAll(); // Hanya menampilkan yang tersedia
    
            // Log aktivitas
            $this->logActivity("User mengakses menu makanan");
    
            // Tampilkan view
            echo view('surga.php');
            echo view('menu', $data);
            echo view('neraka.php');
        } else {
            return redirect()->to('home/login');
        }
    }                                 
public function filterMenu()
{
    $menuModel = new MenuModel();

    // Get search and kategori from the request
    $search = $this->request->getGet('search');
    $kategori = $this->request->getGet('kategori');

    // Build the query
    $query = $menuModel;

    if (!empty($search)) {
        $query = $query->like('nama_menu', $search);
    }

    if (!empty($kategori)) {
        $query = $query->where('kategori', $kategori);
    }

    // Fetch the filtered results
    $data['menus'] = $query->findAll();

    // Log activity
    $this->logActivity("User melakukan pencarian menu dengan kategori: $kategori dan keyword: $search");

    // Load the view with the filtered data
    echo view('surga.php');
    echo view('menu', $data);
    echo view('neraka.php');
}
    public function minuman()
    {
        if (session()->get('id_user') > 0) {
            $menuModel = new MenuModel();
            $data['menus'] = $menuModel->where('kategori', 'minuman')->findAll(); // Hanya menampilkan yang tersedia
    
            // Log aktivitas
            $this->logActivity("User mengakses menu minuman");
    
            // Tampilkan view
            echo view('surga.php');
            echo view('menu', $data);
            echo view('neraka.php');
        } else {
            return redirect()->to('home/login');
        }
    }
public function inputMenu()
{
    // Pastikan hanya admin yang dapat mengakses
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('home/menu')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }

    // Tampilkan form input menu
    echo view('surga.php');
    echo view('input_menu');
    echo view('neraka.php');
}

public function simpanMenu()
{
    
    // Pastikan hanya admin yang dapat mengakses
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('home/menu')->with('error', 'Anda tidak memiliki izin untuk menyimpan menu.');
    }

    $menuModel = new MenuModel();

    // Ambil data dari form
    $data = [
        'nama_menu' => $this->request->getPost('nama_menu'),
        'harga'=> str_replace('.', '', $this->request->getPost('harga')),
        'status' => $this->request->getPost('status'),
        'kategori' => $this->request->getPost('kategori'),
    ];
    $this->logActivity("Admin menambahkan menu baru");

    // Simpan data ke database
    $menuModel->insert($data);

    // Log aktivitas
    
    return redirect()->to('home/menu')->with('success', 'Menu berhasil ditambahkan.');
}
public function usr() {
    if (session()->get('id_user')>0){
    $userModel = new UserModel();
    $data['marah'] = $userModel->getActiveUsers(); // Panggil metode yang baru
    $this->logActivity("User mengakses tabel user");
    // Hitung jumlah user berdasarkan level
    $data['total_admin'] = $userModel->where('level', 'admin')->countAllResults();
    $data['total_kasir'] = $userModel->where('level', 'kasir')->countAllResults();
    $data['total_pelanggan'] = $userModel->where('level', 'pelanggan')->countAllResults();

         echo view('surga.php');
    echo view('tabeluser', $data);
            echo view('neraka.php');
        }else{
            return redirect()->to('home/login');
        }
}
public function deletedUsers()
{
    $userModel = new UserModel();

    // Ambil data pengguna yang dihapus (delete_status = 1)
    $data['deleted_users'] = $userModel->where('delete_status', 1)->findAll();

    echo view('surga');
    echo view('tabeluserdeleted', $data);
    echo view('neraka');
}
public function edituser($id_user)
{
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('home/usr')->with('error', 'Anda tidak memiliki izin untuk mengedit pengguna.');
    }

    $userModel = new UserModel();

    // Cek apakah user ada
    $user = $userModel->find($id_user);
    if (!$user) {
        return redirect()->to('home/usr')->with('error', 'User tidak ditemukan.');
    }

    // Kirim data user ke view
    $data['user'] = $user;

    echo view('surga.php');
    echo view('edituser', $data);
    echo view('neraka.php');
}
public function simpan_user()
{
    // Pastikan hanya admin atau superadmin yang dapat mengakses
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('home/usr')->with('error', 'Anda tidak memiliki izin untuk menyimpan perubahan.');
    }

    $userModel = new UserModel();

    // Ambil username dari session
    $username = session()->get('username');

    // Ambil data dari form
    $id_user = $this->request->getPost('idd');
    $data = [
        'username' => $this->request->getPost('username'),
        'nama_user' => $this->request->getPost('nama_user'),
        'email' => $this->request->getPost('email'),
        'password' => $this->request->getPost('password'),
        'level' => $this->request->getPost('level'),
        'delete_status' => $this->request->getPost('delete_status'),
        'updated_by' => session()->get('username'), // Tambahkan username yang mengedit
        'updated_at' => date('Y-m-d H:i:s'), // Tambahkan waktu pengeditan
    ];

    // Update data user
    $userModel->update($id_user, $data);

    // Log aktivitas
    $this->logActivity("Admin mengedit data user dengan ID $id_user");

    return redirect()->to('home/usr')->with('success', 'Data user berhasil diperbarui.');
}
  public function inputuser()
    {
       if (session()->get('level')=='admin' || session()->get('level')=='superadmin') {
        $this->logActivity("User menginput data user");
        $Joyce= new M_der;
        $where=('id_user');
        $wendy['marah']=$Joyce->tampil('user',$where);
        echo view ('surga.php');
        echo view ('inputuser.php',$wendy);
        echo view ('neraka.php');
      }else{
        return redirect()->to('home/dashboard');
    }
  }
  public function softDeleteUser($id)
{
    $id_user = session()->get('id_user'); // Ambil ID user dari session
    $userModel = new UserModel();

    if ($userModel->softDeleteUser($id, $id_user)) {
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus user.');
    }
}

public function restoreUser($id)
{
    $id_user = session()->get('id_user'); // Ambil ID user dari session
    $userModel = new UserModel();

    if ($userModel->restoreUser($id, $id_user)) {
        return redirect()->back()->with('success', 'User berhasil direstore.');
    } else {
        return redirect()->back()->with('error', 'Gagal merestore user.');
    }
}

public function restoreAllUsers()
{
    $id_user = session()->get('id_user'); // Ambil ID user dari session
    $userModel = new UserModel();

    if ($userModel->restoreAllUsers($id_user)) {
        return redirect()->back()->with('success', 'Semua user berhasil direstore.');
    } else {
        return redirect()->back()->with('error', 'Gagal merestore semua user.');
    }
}
public function input_user1()
{
    $userModel = new UserModel();
    
    // Ambil ID user yang sedang login
    $id_user = session()->get('id_user'); 

    $data = [
        'id_user'    => $this->request->getPost('id_user'),
        'nama_user'  => $this->request->getPost('nama_user'),
        'username'   => $this->request->getPost('username'),
        'email'      => $this->request->getPost('email'),
        'password'   => $this->request->getPost('password'), // Hash password
        'level'      => $this->request->getPost('level'),
        'created_by' => $id_user, // Simpan siapa yang membuat
        'created_at' => date('Y-m-d H:i:s'), // Simpan waktu pembuatan
    ];

    $userModel->insertUser($data); // Gunakan model untuk menyimpan data

    return redirect()->to('/home/usr')->with('success', 'User berhasil ditambahkan.');
}
       public function aksi_registrasi()
   {
            $Joyce= new M_der;
           $data = array(
            'id_user'=> $this->request->getPost('id_user'),
            'username'=> $this->request->getPost('username'),
            'nama_user'=> $this->request->getPost('nama_user'),
            'email'=> $this->request->getPost('email'),
           'password'=> $this->request->getPost('password'),
            'level'=> "pelanggan"
           );

           $Joyce->input('user',$data);
          
            return redirect()->to('home/login');
          
   }
      public function register()
    {
        echo view('register.php');
    }
    private function logActivity($action)
{
    $id_user = session()->get('id_user'); // Ambil id_user dari session
    $ip_address = $this->request->getIPAddress();

    if ($id_user) {
        // Ambil data user dari tabel user
        $userModel = new UserModel();
        $user = $userModel->find($id_user);

        if ($user) {
            $username = $user['username']; // Ambil username dari tabel user

            // Simpan log aktivitas
            $logModel = new ActivityLogModel();
            $logModel->insert([
                'id_user' => $id_user,
                'username' => $username,
                'aksi' => $action,
                'timestamp' => date('Y-m-d H:i:s'),
                'ip_address' => $ip_address
            ]);
        } else {
            log_message('error', 'User not found in database for id_user: ' . $id_user);
        }
    } else {
        log_message('error', 'Session id_user is missing.');
    }
}
    public function logActivitytab()
{
    if (!session()->has('id_user')) {
        return redirect()->to('/home/login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    $logModel = new ActivityLogModel();
    $level = session()->get('level');
    $userId = session()->get('id_user');
    $selectedUsername = $this->request->getGet('username'); // Ambil username dari GET

    // Ambil daftar user untuk dropdown
    $users = $logModel->select('username')->distinct()->findAll();

    // Ambil log sesuai level user
    if ($level == 'admin' || $level == 'superadmin') {
        if (!empty($selectedUsername)) {
            $logs = $logModel->where('username', $selectedUsername)->findAll();
        } else {
            $logs = $logModel->findAll();
        }
    } else {
        $logs = $logModel->where('id_user', $userId)->findAll();
    }

    // Catat aktivitas user
    $this->logActivity("User melihat Logs");

    $data = [
        'logs' => $logs,
        'users' => $users,
        'selectedUsername' => $selectedUsername // Tambahkan ini agar bisa dipakai di view
    ];

    echo view('surga', $data);
    echo view('activity_logs', $data);
    echo view('neraka',$data);

}
public function addToCart($id_menu)
{
    $this->logActivity("User menambahkan item ke keranjang");
    $cartModel = new CartModel();
    $id_user = session()->get('id_user'); // Get the logged-in user's ID from the session

    // Log the inputs

    if (!$id_user) {
        return redirect()->to('home/login')->with('error', 'You must be logged in to add items to the cart.');
    }

    $cartModel->addToCart($id_menu, $id_user);

    return redirect()->to('home/menu')->with('success', 'Item added to cart.');
}

   public function getCart()
{
    $cartModel = new CartModel();
    $menuModel = new MenuModel();

    $cartItems = $cartModel->findAll();
    $cart = [];

    foreach ($cartItems as $item) {
        $menu = $menuModel->find($item['id_menu']);
        if ($menu) {
            $cart[] = [
                'id_keranjang' => $item['id_keranjang'],
                'nama_menu' => $menu['nama_menu'],
                'harga' => $menu['harga'],
                'kategori' => $menu['kategori'],
                'jumlah' => $item['jumlah'],
            ];
        }
    }

    return $this->response->setJSON(['cart' => $cart]);
}
public function update_cart()
{
    $cartModel = new CartModel();
    $id_user = session()->get('id_user');

    $productId = $this->request->getPost('id');
    $newQuantity =  $this->request->getPost('jumlah');

    // Validate the new quantity
    if ($newQuantity < 1) {
        return redirect()->to('home/viewCart')->with('error', 'Quantity must be at least 1.');
    }

    // Update the quantity in the database for the logged-in user
    $cartModel->where('id_keranjang', $productId)
              ->where('id_user', $id_user)
              ->set(['jumlah' => $newQuantity])
              ->update();

    return redirect()->to('home/viewCart')->with('success', 'Cart updated successfully.');
}
public function remove_cart()
{
    $cartModel = new CartModel();
    $id_user = session()->get('id_user');

    $productId = $this->request->getPost('id');

    // Remove the item from the database for the logged-in user
    $cartModel->where('id_keranjang', $productId)
              ->where('id_user', $id_user)
              ->delete();

    return redirect()->to('home/viewCart')->with('success', 'Item removed from cart.');
}
public function viewCart()
{
    $this->logActivity("User mengakses keranjang");
    $cartModel = new CartModel();
    $menuModel = new MenuModel();

    // Get the logged-in user's ID
    $id_user = session()->get('id_user');

    if (!$id_user) {
        return redirect()->to('home/login')->with('error', 'You must be logged in to view your cart.');
    }

    // Fetch cart items for the user
    $cartItems = $cartModel->getCartByUser($id_user);

    // Merge cart items with menu data
    $cart = [];
    foreach ($cartItems as $item) {
        $menu = $menuModel->find($item['id_menu']);
        if ($menu) {
            $cart[] = [
                'id_keranjang' => $item['id_keranjang'],
                'nama_menu' => $menu['nama_menu'],
                'kategori' => $menu['kategori'],
                'harga' => $menu['harga'],
                'jumlah' => $item['jumlah']
            ];
        }
    }

    // Pass data to the view
    $data = [
        'cart' => $cart
    ];

    echo view('surga.php');
    echo view('cart_view', $data);
    echo view('neraka.php');
}

public function checkout()
{
    $this->logActivity("User Melakukan checkout");
    $cartModel = new CartModel();
    $transaksiModel = new TransaksiModel();

    $id_user = session()->get('id_user');

    if (!$id_user) {
        return redirect()->to('home/login')->with('error', 'You must be logged in to checkout.');
    }

    // Fetch cart items for the user
    $cartItems = $cartModel->getCartByUser($id_user);

    if (empty($cartItems)) {
        return redirect()->to('home/viewCart')->with('error', 'Your cart is empty.');
    }

    // Handle file upload
    $file = $this->request->getFile('bukti_pembayaran');
    $buktiPembayaran = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('uploads/', $newName);
        $buktiPembayaran = 'uploads/' . $newName;
    } else {
        return redirect()->back()->with('error', 'Upload gagal! Pastikan file sesuai.');
    }

    // Calculate total price
    $totalHarga = 0;
    foreach ($cartItems as $item) {
        $totalHarga += $item['harga'] * $item['jumlah'];
    }

    // Insert into `transaksi` table
    $transaksiData = [
        'id_user' => $id_user,
        'tanggal' => date('Y-m-d H:i:s'),
        'total_harga' => $totalHarga,
        'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
        'bukti_pembayaran' => $buktiPembayaran,
        'status_pembayaran' => 'pending' // Default status
    ];
    $id_transaksi = $transaksiModel->insert($transaksiData, true); // Get the inserted ID

    // Clear the cart
    $cartModel->where('id_user', $id_user)->delete();

    return redirect()->to('home/viewCart')->with('success', 'Checkout successful!');
}
public function cetakBukti($id_transaksi)
{
    $transaksiModel = new TransaksiModel();
    $transaksi = $transaksiModel->find($id_transaksi);
    if (!$transaksi) {
        return redirect()->to('home/transaksi')->with('error', 'Transaksi tidak ditemukan.');
    }

    // Initialize TCPDF
    $dompdf = new \Dompdf\Dompdf();
    $html = view('bukti_pembayaran_pdf', ['transaksi' => $transaksi]);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("bukti_pembayaran_{$id_transaksi}.pdf");
}
public function updateStatusPembayaran($id_transaksi)
{
    // Pastikan hanya admin atau superadmin yang dapat mengakses
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('home/transaksi')->with('error', 'Anda tidak memiliki izin untuk memperbarui status pembayaran.');
    }

    $transaksiModel = new TransaksiModel();

    // Cek apakah transaksi ada
    $transaksi = $transaksiModel->find($id_transaksi);
    if (!$transaksi) {
        return redirect()->to('home/transaksi')->with('error', 'Transaksi tidak ditemukan.');
    }

    // Perbarui status pembayaran menjadi "Lunas"
    $transaksiModel->update($id_transaksi, ['status_pembayaran' => 'Lunas']);

    // Log aktivitas
    $this->logActivity("Admin memperbarui status pembayaran transaksi ID $id_transaksi menjadi Lunas");

    return redirect()->to('home/transaksi')->with('success', 'Status pembayaran berhasil diperbarui menjadi Lunas.');
}
public function updateStatusPembayaran2($id_transaksi)
{
    // Pastikan hanya admin atau superadmin yang dapat mengakses
    if (session()->get('level') !== 'admin' && session()->get('level') !== 'superadmin') {
        return redirect()->to('home/transaksi')->with('error', 'Anda tidak memiliki izin untuk memperbarui status pembayaran.');
    }

    $transaksiModel = new TransaksiModel();

    // Cek apakah transaksi ada
    $transaksi = $transaksiModel->find($id_transaksi);
    if (!$transaksi) {
        return redirect()->to('home/transaksi')->with('error', 'Transaksi tidak ditemukan.');
    }

    // Perbarui status pembayaran menjadi "Batal"
    $transaksiModel->update($id_transaksi, ['status_pembayaran' => 'Batal']);

    // Log aktivitas
    $this->logActivity("Admin memperbarui status pembayaran transaksi ID $id_transaksi menjadi Batal");

    return redirect()->to('home/transaksi')->with('success', 'Status pembayaran berhasil diperbarui menjadi Batal.');
}
public function transaksi()
{
    $this->logActivity("User mengakses halaman transaksi");
    $transaksiModel = new TransaksiModel();
    $id_user = session()->get('id_user');
    $level = session()->get('level');

    if (!$id_user) {
        return redirect()->to('home/login')->with('error', 'You must be logged in to view transactions.');
    }

    // Fetch transactions based on user level
    if ($level === 'admin' || $level === 'superadmin') {
        // Admin dan superadmin dapat melihat semua transaksi
        $transactions = $transaksiModel->findAll();
    } else {
        // Pengguna biasa hanya dapat melihat transaksi mereka sendiri
        $transactions = $transaksiModel->where('id_user', $id_user)->findAll();
    }

    // Pass data to the view
    $data = [
        'transactions' => $transactions
    ];

    echo view('surga.php');
    echo view('transaksi_view', $data);
    echo view('neraka.php');
}
}