/* Dynamic Theme CSS - Generated from Database */
:root {
    --primary-color: {{ $colors['primary'] }};
    --secondary-color: {{ $colors['secondary'] }};
    --accent-color: {{ $colors['accent'] }};
    --text-color: {{ $colors['text'] }};
    --background-color: {{ $colors['background'] }};
}

/* Modern Hero Section with Gradient */
.hero-section {
    background: linear-gradient(135deg, {{ $colors['primary'] }} 0%, {{ $colors['secondary'] }} 100%) !important;
    padding: 120px 0 !important;
    color: white !important;
}

.hero-section h1 {
    font-size: 3.5rem !important;
    font-weight: 700 !important;
    margin-bottom: 1.5rem !important;
}

.hero-section p {
    font-size: 1.25rem !important;
    opacity: 0.95 !important;
}

/* Primary Buttons */
.btn-primary {
    background-color: {{ $colors['primary'] }} !important;
    border-color: {{ $colors['primary'] }} !important;
    padding: 12px 32px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
}

.btn-primary:hover {
    background-color: {{ $colors['secondary'] }} !important;
    border-color: {{ $colors['secondary'] }} !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important;
}

/* Secondary Buttons */
.btn-secondary {
    background-color: {{ $colors['secondary'] }} !important;
    border-color: {{ $colors['secondary'] }} !important;
}

/* Modern Package Cards */
.package-card {
    border: none !important;
    border-radius: 16px !important;
    overflow: hidden !important;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
    border-top: 4px solid {{ $colors['primary'] }} !important;
}

.package-card:hover {
    transform: translateY(-12px) !important;
    box-shadow: 0 12px 40px rgba(0,0,0,0.15) !important;
}

.package-card.featured {
    border-top-color: {{ $colors['accent'] }} !important;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
}

.package-card .card-title {
    color: {{ $colors['primary'] }} !important;
    font-weight: 700 !important;
    font-size: 1.75rem !important;
}

.package-card .package-price {
    color: {{ $colors['accent'] }} !important;
    font-size: 2.5rem !important;
    font-weight: 800 !important;
}

/* Modern Product Cards */
.product-card {
    border: none !important;
    border-radius: 12px !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06) !important;
}

.product-card:hover {
    transform: translateY(-8px) !important;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
    border-color: {{ $colors['primary'] }} !important;
}

.product-card img {
    transition: transform 0.3s ease !important;
}

.product-card:hover img {
    transform: scale(1.05) !important;
}

.product-card .price {
    color: {{ $colors['accent'] }} !important;
    font-weight: 700 !important;
    font-size: 1.5rem !important;
}

/* Navigation */
.navbar-brand {
    color: {{ $colors['primary'] }} !important;
    font-weight: 700 !important;
    font-size: 1.5rem !important;
}

.nav-link {
    font-weight: 500 !important;
    transition: color 0.3s ease !important;
}

.nav-link:hover,
.nav-link.active {
    color: {{ $colors['primary'] }} !important;
}

/* Badges */
.badge-primary,
.badge.bg-primary {
    background-color: {{ $colors['primary'] }} !important;
}

.badge-accent {
    background-color: {{ $colors['accent'] }} !important;
}

/* Text Colors */
.text-primary {
    color: {{ $colors['primary'] }} !important;
}

.text-secondary {
    color: {{ $colors['secondary'] }} !important;
}

.text-accent {
    color: {{ $colors['accent'] }} !important;
}

/* Background Colors */
.bg-primary {
    background-color: {{ $colors['primary'] }} !important;
}

.bg-secondary {
    background-color: {{ $colors['secondary'] }} !important;
}

.bg-accent {
    background-color: {{ $colors['accent'] }} !important;
}

/* Links */
a {
    color: {{ $colors['primary'] }};
    transition: color 0.3s ease;
}

a:hover {
    color: {{ $colors['secondary'] }};
}

/* Forms */
.form-control:focus {
    border-color: {{ $colors['primary'] }};
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
}

/* Section Headings */
.section-heading {
    color: {{ $colors['primary'] }} !important;
    font-weight: 700 !important;
    margin-bottom: 3rem !important;
    position: relative !important;
}

.section-heading::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, {{ $colors['primary'] }}, {{ $colors['accent'] }});
    border-radius: 2px;
}
