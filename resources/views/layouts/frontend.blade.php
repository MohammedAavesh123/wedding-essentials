<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dahej Ka Saman - Marriage Furniture Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --accent-color: #ffc107;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .package-card {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .package-card:hover {
            transform: translateY(-5px);
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
        }
    </style>
    
    {{-- Dynamic Theme CSS --}}
    <link rel="stylesheet" href="{{ route('theme.css') }}">
    
    @yield('css')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
                <i class="fas fa-couch me-2"></i>Dahej Ka Saman
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.packages.index') }}">Packages</a></li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>My Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item d-flex align-items-center"><a class="btn btn-primary text-white px-3 ms-2" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Dahej Ka Saman</h5>
                    <p>Complete marriage furniture packages at best prices.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                        <li><a href="#" class="text-white">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p><i class="fas fa-phone me-2"></i> +91 98765 43210</p>
                    <p><i class="fas fa-envelope me-2"></i> info@dahejsaman.com</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Dahej Ka Saman. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Popup Modal -->
    <div class="modal fade" id="smartPopup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient text-white border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h5 class="modal-title fw-bold" id="popupTitle">Notification</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img id="popupImage" src="" alt="Offer" class="w-100 d-none" style="max-height: 300px; object-fit: cover;">
                    <div class="p-4">
                        <p id="popupMessage" class="lead mb-3"></p>
                        <a href="#" id="popupLink" class="btn btn-primary btn-lg px-5 d-none">View Offer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Combo Builder - Global Widget -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div class="card shadow-lg" id="comboBuilder" style="width: 350px; display: none;">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="fas fa-layer-group me-2"></i>My Custom Combo</h6>
            </div>
            <div class="card-body">
                <div id="comboItems" class="mb-3">
                    <p class="text-muted small">Select 3 items to create your combo</p>
                </div>
                <div id="comboPrice" class="d-none">
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Regular Price:</span>
                        <span class="text-muted"><s id="regularPrice">₹0</s></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-bold">Combo Price:</span>
                        <span class="fw-bold text-success" id="packagePrice">₹0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-success fw-bold">You Save:</span>
                        <span class="text-success fw-bold" id="savingsAmount">₹0</span>
                    </div>
                    @auth
                        <button class="btn btn-primary w-100" id="bookCombo">
                            <i class="fas fa-shopping-cart me-2"></i>Book Combo
                        </button>
                    @else
                        <button class="btn btn-primary w-100" id="bookCombo">
                            <i class="fas fa-sign-in-alt me-2"></i>Login to Book
                        </button>
                    @endauth
                    <button class="btn btn-outline-secondary w-100 mt-2" id="cancelCombo">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Check if popup has been shown in this session
        const popupShown = localStorage.getItem('popupShown');
        
        if (!popupShown) {
            $.get("{{ route('api.popups') }}", function(data) {
                if (data.length > 0) {
                    let index = 0;
                    
                    function showPopup() {
                        if (index >= data.length) {
                            index = 0;
                        }
                        
                        const popup = data[index];
                        
                        $('#popupTitle').text(popup.title);
                        $('#popupMessage').text(popup.message);
                        
                        // Show image if available
                        if (popup.image) {
                            $('#popupImage').attr('src', popup.image).removeClass('d-none');
                        } else {
                            $('#popupImage').addClass('d-none');
                        }
                        
                        // Show link if package exists
                        if (popup.package && popup.package.slug) {
                            $('#popupLink').attr('href', '/packages/' + popup.package.slug).removeClass('d-none');
                        } else {
                            $('#popupLink').addClass('d-none');
                        }
                        
                        $('#smartPopup').modal('show');
                        
                        index++;
                        
                        // Show next popup after display_interval (only if modal is still open)
                        setTimeout(function() {
                            if ($('#smartPopup').hasClass('show')) {
                                $('#smartPopup').modal('hide');
                                setTimeout(showPopup, popup.display_interval * 1000);
                            }
                        }, popup.display_duration * 1000);
                    }
                    
                    // Start showing popups after 3 seconds
                    setTimeout(showPopup, 3000);
                    
                    // Mark popup as shown when user closes it
                    $('#smartPopup').on('hidden.bs.modal', function () {
                        localStorage.setItem('popupShown', 'true');
                    });
                }
            });
        }
    });
    </script>
    
    <!-- Global Combo Builder Script -->
    <style>
    .combo-item {
        padding: 8px;
        background: #f8f9fa;
        border-radius: 5px;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    </style>
    
    <script>
    // Global Combo Builder
    let comboItems = [];
    const maxComboItems = {{ App\Models\Setting::get('max_combo_items', 3) }};

    document.addEventListener('DOMContentLoaded', function() {
        // Load from localStorage
        if (localStorage.getItem('comboItems')) {
            try {
                comboItems = JSON.parse(localStorage.getItem('comboItems'));
                if (!Array.isArray(comboItems)) comboItems = [];
            } catch(e) {
                comboItems = [];
            }
            updateComboBuilder();
        }
        
        // Event Delegation for Add to Combo buttons
        document.body.addEventListener('click', function(e) {
            const btn = e.target.closest('.add-to-combo, .add-to-combo-detail');
            if (!btn) return;
            
            e.preventDefault();
            e.stopPropagation();
            
            if (comboItems.length >= maxComboItems) {
                showToast(`You can only add ${maxComboItems} items to a combo!`, 'warning');
                return;
            }

            const productId = btn.dataset.productId;
            const productName = btn.dataset.productName;
            const price = parseFloat(btn.dataset.price);
            const packagePrice = parseFloat(btn.dataset.packagePrice);

            if (comboItems.find(item => item.id === productId)) {
                showToast('Item already added to combo!', 'info');
                return;
            }

            comboItems.push({
                id: productId,
                name: productName,
                price: price,
                packagePrice: packagePrice
            });

            localStorage.setItem('comboItems', JSON.stringify(comboItems));
            updateComboBuilder();
            showToast(`${productName} added! (${comboItems.length}/${maxComboItems})`, 'success');
        });
    });

    function updateComboBuilder() {
        const builder = document.getElementById('comboBuilder');
        const itemsDiv = document.getElementById('comboItems');
        const priceDiv = document.getElementById('comboPrice');

        // Hide on booking pages
        if (window.location.href.includes('/booking')) {
            builder.style.display = 'none';
            return;
        }

        if (comboItems.length === 0) {
            builder.style.display = 'none';
            localStorage.removeItem('comboItems');
            return;
        }

        builder.style.display = 'block';

        itemsDiv.innerHTML = comboItems.map((item, index) => `
            <div class="combo-item">
                <span class="small">${item.name}</span>
                <button class="btn btn-sm btn-danger" onclick="removeComboItem(${index})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `).join('');

        if (comboItems.length === maxComboItems) {
            const regularTotal = comboItems.reduce((sum, item) => sum + item.price, 0);
            const packageTotal = comboItems.reduce((sum, item) => sum + item.packagePrice, 0);
            const savings = regularTotal - packageTotal;

            document.getElementById('regularPrice').textContent = '₹' + regularTotal.toLocaleString('en-IN');
            document.getElementById('packagePrice').textContent = '₹' + packageTotal.toLocaleString('en-IN');
            document.getElementById('savingsAmount').textContent = '₹' + savings.toLocaleString('en-IN');
            priceDiv.classList.remove('d-none');
        } else {
            priceDiv.classList.add('d-none');
        }
    }

    function removeComboItem(index) {
        comboItems.splice(index, 1);
        localStorage.setItem('comboItems', JSON.stringify(comboItems));
        updateComboBuilder();
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} position-fixed top-0 start-50 translate-middle-x mt-3`;
        toast.style.zIndex = '9999';
        toast.innerHTML = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    function proceedToBooking() {
        const comboData = {
            items: comboItems,
            total: comboItems.reduce((sum, item) => sum + item.packagePrice, 0)
        };
        
        // Check if user is logged in (passed from blade)
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        
        if (!isLoggedIn) {
            // Save intention to book combo
            localStorage.setItem('redirect_after_login', 'combo_booking');
            window.location.href = "{{ route('login') }}";
            return;
        }
        
        // For authenticated users, proceed directly to booking
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('frontend.booking.combo') }}";
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = "{{ csrf_token() }}";
        form.appendChild(csrfToken);
        
        const itemsInput = document.createElement('input');
        itemsInput.type = 'hidden';
        itemsInput.name = 'combo_items';
        itemsInput.value = JSON.stringify(comboItems);
        form.appendChild(itemsInput);
        
        const priceInput = document.createElement('input');
        priceInput.type = 'hidden';
        priceInput.name = 'total_price';
        priceInput.value = comboData.total;
        form.appendChild(priceInput);
        
        document.body.appendChild(form);
        form.submit();
    }

    // Book combo handler (Manual trigger if needed)
    document.getElementById('bookCombo')?.addEventListener('click', function() {
        if (comboItems.length !== maxComboItems) {
            showToast('Please select exactly 3 items for combo!', 'warning');
            return;
        }
        proceedToBooking();
    });

    // Cancel combo handler
    document.getElementById('cancelCombo')?.addEventListener('click', function() {
        // Clear combo items
        comboItems = [];
        localStorage.removeItem('comboItems');
        sessionStorage.removeItem('comboBuilderMinimized');
        
        // Hide builder
        document.getElementById('comboBuilder').style.display = 'none';
        
        // Remove floating button if exists
        const floatBtn = document.getElementById('comboFloatingBtn');
        if (floatBtn) {
            floatBtn.remove();
        }
        
        showToast('Combo selection cleared!', 'info');
    });
    </script>
    
    @if(session('clear_combo'))
    <script>
        localStorage.removeItem('comboItems');
        comboItems = [];
        updateComboBuilder();
    </script>
    @endif
    @yield('js')
</body>
</html>
