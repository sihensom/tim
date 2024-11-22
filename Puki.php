<?php
session_start();

// Debug untuk melihat status session
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Periksa status login dengan lebih eksplisit
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

$notification = '';
$notificationType = '';

// Cek apakah ada pesan notifikasi dari session
if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
    $notification = $_SESSION['message'];
    $notificationType = $_SESSION['message_type'];
    // Hapus pesan setelah ditampilkan
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kue Online</title>
    <link rel="stylesheet" href="Shopi2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .hidden { display: none !important; }
        .visible { display: block; }
        .flex-visible { display: flex; }
    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="header-content">
                <img src="logo.png" alt="Logo" class="logo-image">
                <a href="#" class="logo">
             <p>KUE LUKCNUT </p>
                </a>
                
                <!-- Search bar -->
           
              <!-- Cart icon -->

<!-- Dynamic Login/Logout Button -->
<?php if ($is_logged_in): ?>
    <button onclick="showOrderHistory()" class="order-history-btn">
                        <i class="fas fa-history"></i> Riwayat Pesanan
                    </button>
    <a href="logout.php" class="login-logout-btn" style="margin-left: 15px;">Logout</a>
<?php else: ?>
    <a href="Shopi.php" class="login-logout-btn">Login</a>
<?php endif; ?>

        </div>
        
    </header>

   

    <main class="main-content">
        <!-- Sidebar/Filter -->
       <!-- Hapus class yang menyembunyikan sidebar saat logout -->
         <!-- Order History Modal -->
    <div id="orderHistoryModal" class="order-history-modal">
        <div class="order-history-content">
            <span class="close-history" onclick="closeOrderHistory()">&times;</span>
            <h2>Riwayat Pesanan</h2>
            <div id="orderHistoryList">
                <!-- Order history items will be populated here -->
            </div>
        </div>
    </div>
    <div id="successNotification" class="success-notification" style="display: none;">
        Pembelian berhasil!
    </div>
<aside class="sidebar">

    
  
    
</aside>
<div id="main-notification" class="main-notification <?php echo $notificationType; ?>" style="display: <?php echo !empty($notification) ? 'flex' : 'none'; ?>">
    <div class="notification-content">
        <span class="notification-text"><?php echo $notification; ?></span>
        <button class="notification-close" onclick="closeMainNotification()">×</button>
    </div>
</div>
        <!-- Content Area -->
        <div class="content-area <?php echo $is_logged_in ? 'visible' : 'hidden'; ?>">
            <div class="product-grid" id="product-grid">
                <!-- Products will be added here via JavaScript -->
            </div>
        </div>
<!-- Modal Detail Produk -->
<div id="product-detail-modal" class="product-detail-modal" style="display: none;">
    <div class="product-detail-content">
        <span class="close-modal" onclick="closeProductDetailModal()">&times;</span>
        <img id="product-detail-image" src="" alt="Product">
        <div class="product-detail-info">
            <h3 id="product-detail-name"></h3>
            <p id="product-detail-description"></p>
            <p id="product-detail-price"></p>
            <label for="quantity-select">Quantity:</label>
            <select id="quantity-select">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
       
            <button onclick="directCheckout(currentProductId)">Buy Now</button>
            
        </div>
    </div>
</div>
    </main>

    <!-- JavaScript -->
    <script src="Sopi.js"></script>
    <script>
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notification-text');
            if (notification && notificationText) {
                notification.className = 'notification ' + type;
                notificationText.textContent = message;
                notification.style.display = 'block';
                setTimeout(() => {
                    closeNotification();
                }, 3000);
            }
        }

        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }

        <?php if (!empty($message)): ?>
        document.addEventListener('DOMContentLoaded', function() {
            showNotification(<?php echo json_encode($message); ?>, <?php echo json_encode($message_type); ?>);
        });
        <?php endif; ?>
    


 





// Fungsi untuk menampilkan notifikasi
function showMainNotification(message, type) {
    const notification = document.getElementById('main-notification');
    if (notification) {
        notification.classList.remove('success', 'error');  // Hapus kelas sebelumnya
        notification.classList.add(type);  // Tambahkan kelas sesuai type
        const notificationText = notification.querySelector('.notification-text');
        if (notificationText) {
            notificationText.textContent = message;
            notification.style.display = 'flex';
            setTimeout(() => {
                closeMainNotification();
            }, 5000);  // Tutup otomatis setelah 3 detik
        }
    }
}

// Fungsi untuk menutup notifikasi
function closeMainNotification() {
    const notification = document.getElementById('main-notification');
    if (notification) {
        notification.style.display = 'none';
    }
}

// Fungsi contoh untuk membuka detail produk
function openProductDetail(card) {
    // Logika untuk membuka detail produk, misalnya modal
    const productName = card.querySelector('.showcase-title').textContent;
    alert('Detail produk: ' + productName);  // Menampilkan nama produk sebagai contoh
}


    </script>
    <!-- Cart Modal -->
<!-- Modal Keranjang -->


<!-- Tambahkan setelah header dan sebelum footer -->


<!-- Footer Section -->
<footer class="footer">
    <div class="footer-content">
        <!-- Main Footer -->
        <div class="footer-sections">
            <!-- About Section -->
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Satrio Bakul Sepatu adalah toko sepatu premium yang menyediakan berbagai merek ternama dengan kualitas terbaik dan pelayanan yang memuaskan.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                
                </div>
            </div>

          
            <!-- Contact Section -->
            <div class="footer-section">
                <h3>Hubungi Kami</h3>
                <ul class="contact-info">
                    <li><i class="fas fa-phone"></i> +62 123 456 789</li>
                
                </ul>
            </div>

            <!-- Newsletter Section -->
        
        </div>

        <!-- Bottom Footer -->
        <div class="footer-bottom">
            <p>&copy; 2024 satrio. All rights reserved.</p>
         
        </div>
    </div>
</footer>

<style>
.footer {
    background: linear-gradient(to right, #1a1a1a, #2d2d2d);
    color: #fff;
    padding: 60px 0 20px;
    margin-top: 50px;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
   
}

.footer-sections {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
}

.footer-section h3 {
    color: #fff;
    font-size: 1.2rem;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.footer-section h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background: #ff6b6b;
}

.footer-section p {
    line-height: 1.6;
    color: #b3b3b3;
}

.social-links {
    margin-top: 20px;
}

.social-links a {
    display: inline-block;
    width: 35px;
    height: 35px;
    background: rgba(255, 255, 255, 0.1);
    margin-right: 10px;
    border-radius: 50%;
    text-align: center;
    line-height: 35px;
    color: #fff;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background: #ff6b6b;
    transform: translateY(-3px);
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 12px;
}

.footer-section ul li a {
    color: #b3b3b3;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: #ff6b6b;
}

.contact-info li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
    color: #b3b3b3;
}

.contact-info li i {
    margin-right: 10px;
    color: #ff6b6b;
}


.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.footer-bottom p {
    color: #b3b3b3;
    margin: 0;
}

.footer-bottom-links a {
    color: #b3b3b3;
    text-decoration: none;
    margin-left: 20px;
    transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #ff6b6b;
}

@media (max-width: 768px) {
    .footer-sections {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .footer-bottom {
        flex-direction: column;
        text-align: center;
    }

    .footer-bottom-links {
        margin-top: 10px;
    }

    .footer-bottom-links a {
        margin: 0 10px;
    }
}

.main-notification {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    width: 100%;
    max-width: 400px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    justify-content: center;
    align-items: center;
    animation: slideDown 0.5s ease-out;
}

.notification-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.main-notification.success .notification-content {
    background: #4CAF50;
    color: white;
}

.main-notification.error .notification-content {
    background: #f44336;
    color: white;
}

.notification-text {
    flex-grow: 1;
    margin-right: 15px;
    font-size: 16px;
}

.notification-close {
    background: transparent;
    border: none;
    color: inherit;
    font-size: 24px;
    cursor: pointer;
    padding: 0 8px;
    opacity: 0.8;
    transition: opacity 0.3s;
}

.notification-close:hover {
    opacity: 1;
}

@keyframes slideDown {
    from {
        transform: translate(-50%, -100%);
        opacity: 0;
    }
    to {
        transform: translate(-50%, -50%);
        opacity: 1;
    }
}

/* Order History Button */
.order-history-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 15px;
            transition: background-color 0.3s;
        }

        .order-history-btn:hover {
            background-color: #45a049;
        }

        /* Order History Modal */
        .order-history-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
        }

        .order-history-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 800px;
            border-radius: 8px;
            position: relative;
        }

        .close-history {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 28px;
            cursor: pointer;
        }

        .order-card {
            border: 1px solid #ddd;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .order-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        .order-details {
            flex-grow: 1;
        }

        .order-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .confirm-btn, .cancel-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .confirm-btn {
            background-color: #4CAF50;
            color: white;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .star-rating {
            color: #ffd700;
            font-size: 20px;
            margin-top: 10px;
        }

        /* Success Notification */
        .success-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px 25px;
            border-radius: 4px;
            z-index: 1001;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
</style>
<script>// Fungsi untuk menutup notifikasi
function closeMainNotification() {
    const notification = document.getElementById('main-notification');
    if (notification) {
        notification.style.display = 'none';
    }
}

// Auto hide notification setelah 5 detik
document.addEventListener('DOMContentLoaded', function() {
    const notification = document.getElementById('main-notification');
    if (notification && notification.style.display !== 'none') {
        setTimeout(closeMainNotification, 5000);
    }

});

 // Store orders in localStorage
 function storeOrder(orderData) {
            const orders = JSON.parse(localStorage.getItem('orders') || '[]');
            orders.push({
                ...orderData,
                id: Date.now(),
                status: 'pending',
                date: new Date().toLocaleDateString(),
                rating: 0
            });
            localStorage.setItem('orders', JSON.stringify(orders));
            showSuccessNotification();
        }

        // Show success notification
        function showSuccessNotification() {
            const notification = document.getElementById('successNotification');
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        // Show order history
        function showOrderHistory() {
            const modal = document.getElementById('orderHistoryModal');
            const ordersList = document.getElementById('orderHistoryList');
            const orders = JSON.parse(localStorage.getItem('orders') || '[]');
            
            ordersList.innerHTML = '';
            orders.forEach(order => {
                const orderElement = createOrderElement(order);
                ordersList.appendChild(orderElement);
            });
            
            modal.style.display = 'block';
        }

        // Create order element
        function createOrderElement(order) {
            const orderDiv = document.createElement('div');
            orderDiv.className = 'order-card';
            
            orderDiv.innerHTML = `
                <img src="${order.image}" alt="${order.name}" class="order-image">
                <div class="order-details">
                    <h3>${order.name}</h3>
                    <p>Quantity: ${order.quantity}</p>
                    <p>Total: Rp ${(order.price * order.quantity).toLocaleString()}</p>
                    <p>Status: ${order.status}</p>
                    <div class="star-rating">
                        ${getStarRating(order.rating)}
                    </div>
                </div>
                <div class="order-actions">
                    ${order.status === 'pending' ? `
                        <button onclick="confirmOrder(${order.id})" class="confirm-btn">Konfirmasi</button>
                        <button onclick="cancelOrder(${order.id})" class="cancel-btn">Cancel</button>
                    ` : ''}
                </div>
            `;
            
            return orderDiv;
        }

        // Get star rating HTML
        function getStarRating(rating) {
            return Array(5).fill().map((_, i) => 
                `<i class="fas fa-star" style="color: ${i < rating ? '#ffd700' : '#ddd'}"></i>`
            ).join('');
        }

        // Confirm order
        function confirmOrder(orderId) {
            const orders = JSON.parse(localStorage.getItem('orders') || '[]');
            const updatedOrders = orders.map(order => {
                if (order.id === orderId) {
                    return { ...order, status: 'confirmed', rating: 5 };
                }
                return order;
            });
            localStorage.setItem('orders', JSON.stringify(updatedOrders));
            showOrderHistory();
        }

        // Cancel order
        function cancelOrder(orderId) {
            const orders = JSON.parse(localStorage.getItem('orders') || '[]');
            const updatedOrders = orders.filter(order => order.id !== orderId);
            localStorage.setItem('orders', JSON.stringify(updatedOrders));
            showOrderHistory();
        }

        // Close order history
        function closeOrderHistory() {
            document.getElementById('orderHistoryModal').style.display = 'none';
        }

        // Modify your existing directCheckout function
        function directCheckout(productId) {
    const product = products.find(p => p.id === productId);
    const quantity = parseInt(document.getElementById('quantity-select').value);
    
    // Buat objek data checkout
    const checkoutData = {
        name: product.name,
        price: product.price,
        quantity: quantity,
        image: product.image,
        total: product.price * quantity
    };
    
    // Simpan ke localStorage
    localStorage.setItem('checkoutData', JSON.stringify(checkoutData));
    
    // Redirect ke halaman checkout
    window.location.href = 'checkout.html';
}

        // Close when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('orderHistoryModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

</script>
</body>
</html>
