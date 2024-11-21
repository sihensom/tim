// Definisi Produk
const products = [
    { 
        id: 1, 
        name: "Donat mini", 
        price: 5000, 
        image: "donat.jpg", 
        description: "Donat mini adalah berukuran kecil Lembut, dan praktir Untuk camilan. Setelah digoreng, donat in diberi topping nya favorit banyak orang ragam seperti gula halus, cokelat, mesis, atau koju. Rasanya manis dan cocok untuk regala acara, menjadikannya favorit banyak orang." 
    },
    { 
        id: 2, 
        name: "Lukcup", 
        price: 10000, 
        image: "lukcup.jpg", 
        description: "Lukchup ini bentuknya mini dan berwarna-warni Menyerupai buah-buahan /sayuran. Lukchup terbuat dan kacang hijau yg di marak dan dihaluskan lalu di campurkan dengan santan dan gula sehingga Memiliki tekstur lembut dan rasa manis." 
    }
];

// Variabel Global
let currentProductId = null;

// Inisialisasi Utama
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan Produk
    displayProducts();
    // Setup Event Listeners
    setupEventListeners();
});

// Setup Event Listeners Komprehensif
function setupEventListeners() {
    // Filter Harga
    const priceFilter = document.getElementById('price-filter');
    if (priceFilter) {
        priceFilter.addEventListener('change', filterProducts);
    }

    // Filter Brand
    const brandFilter = document.getElementById('brand-filter');
    if (brandFilter) {
        brandFilter.addEventListener('change', filterByBrand);
    }

    // Pencarian Produk
    const searchInput = document.querySelector('.search-bar input');
    if (searchInput) {
        searchInput.addEventListener('input', searchProducts);
    }
}

// Tampilkan Produk dengan Rendering Dinamis
function displayProducts(productsToShow = products) {
    const grid = document.getElementById('product-grid');
    if (!grid) return;

    grid.innerHTML = '';
    
    productsToShow.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.setAttribute('data-id', product.id);
        card.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="product-image">
            <div class="product-info">
                <h3 class="product-title">${product.name}</h3>
                <p class="product-price">Rp ${product.price.toLocaleString()}</p>
            </div>
        `;
        
        card.addEventListener('click', function(event) {
            showProductDetailModal(product.id);
        });

        grid.appendChild(card);
    });
}

// Pencarian Produk
function searchProducts(e) {
    const searchTerm = e.target.value.toLowerCase();
    const filteredProducts = products.filter(product => 
        product.name.toLowerCase().includes(searchTerm)
    );
    displayProducts(filteredProducts);
}

// Tampilkan Modal Detail Produk
function showProductDetailModal(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    currentProductId = productId;

    const modal = document.getElementById('product-detail-modal');
    const productImage = document.getElementById('product-detail-image');
    const productName = document.getElementById('product-detail-name');
    const productDescription = document.getElementById('product-detail-description');
    const productPrice = document.getElementById('product-detail-price');
    const quantitySelect = document.getElementById('quantity-select');

    productImage.src = product.image;
    productName.textContent = product.name;
    productDescription.textContent = product.description;
    productPrice.textContent = `Rp ${product.price.toLocaleString()}`;

    modal.style.display = 'flex';
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

// Tutup Modal Detail Produk
function closeProductDetailModal() {
    const modal = document.getElementById('product-detail-modal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
}

// Checkout Langsung


// Fungsi untuk menampilkan notifikasi
function showNotification(message, type) {
    const notification = document.getElementById('main-notification');
    const notificationText = notification.querySelector('.notification-text');
    
    notification.className = `main-notification ${type}`;
    notificationText.textContent = message;
    notification.style.display = 'flex';

    setTimeout(() => {
        closeMainNotification();
    }, 5000);
}

// Event Listener Tambahan
document.addEventListener('DOMContentLoaded', function() {
    // Close modal saat klik di luar
    window.addEventListener('click', function(event) {
        const productModal = document.getElementById('product-detail-modal');
        
        if (productModal && event.target === productModal) {
            closeProductDetailModal();
        }
    });

    // Close modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const productModal = document.getElementById('product-detail-modal');
            
            if (productModal && productModal.classList.contains('show')) {
                closeProductDetailModal();
            }
        }
    });
});

function directCheckout(productId) {
    const product = products.find(p => p.id === productId);
    const quantity = parseInt(document.getElementById('quantity-select').value);
    
    const checkoutItem = {
        id: product.id,
        name: product.name,
        price: product.price,
        quantity: quantity,
        image: product.image,
        total: product.price * quantity
    };
    
    // Simpan sebagai array
    let checkoutData = JSON.parse(localStorage.getItem('checkoutData')) || [];
    // Jika bukan array, konversi ke array
    if (!Array.isArray(checkoutData)) {
        checkoutData = [checkoutData];
    }
    checkoutData.push(checkoutItem);
    localStorage.setItem('checkoutData', JSON.stringify(checkoutData));
    
    window.location.href = 'checkout.html';
}