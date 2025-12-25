{{-- Dynamic Theme CSS --}}
:root {
    --primary-color: {{ $colors['primary'] }};
    --secondary-color: {{ $colors['secondary'] }};
    --accent-color: {{ $colors['accent'] }};
    --text-color: {{ $colors['text'] }};
    --background-color: {{ $colors['background'] }};
}

/* Primary Buttons */
.btn-primary,
.btn-primary:hover,
.btn-primary:focus {
    background-color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}

/* Secondary Buttons */
.btn-secondary {
    background-color: var(--secondary-color) !important;
    border-color: var(--secondary-color) !important;
}

/* Links */
a {
    color: var(--primary-color);
}

a:hover {
    color: var(--secondary-color);
}

/* Badges */
.badge-primary,
.badge.bg-primary {
    background-color: var(--primary-color) !important;
}

.badge-accent {
    background-color: var(--accent-color) !important;
}

/* Cards */
.card-primary .card-header {
    background-color: var(--primary-color) !important;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
}

/* Product Cards */
.product-card:hover {
    border-color: var(--primary-color) !important;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.product-card .price {
    color: var(--accent-color);
    font-weight: bold;
}

/* Package Cards */
.package-card {
    border-top: 3px solid var(--primary-color);
}

.package-card.featured {
    border-top-color: var(--accent-color);
}

.package-card .package-price {
    color: var(--primary-color);
}

/* Navigation */
.navbar-brand {
    color: var(--primary-color) !important;
}

.nav-link.active {
    color: var(--primary-color) !important;
}

/* Text Colors */
.text-primary {
    color: var(--primary-color) !important;
}

.text-secondary {
    color: var(--secondary-color) !important;
}

.text-accent {
    color: var(--accent-color) !important;
}

/* Background Colors */
.bg-primary {
    background-color: var(--primary-color) !important;
}

.bg-secondary {
    background-color: var(--secondary-color) !important;
}

.bg-accent {
    background-color: var(--accent-color) !important;
}

/* Borders */
.border-primary {
    border-color: var(--primary-color) !important;
}

/* Forms */
.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba({{ hexToRgb($colors['primary']) }}, 0.25);
}

/* Alerts */
.alert-primary {
    background-color: rgba({{ hexToRgb($colors['primary']) }}, 0.1);
    border-color: var(--primary-color);
    color: var(--primary-color);
}

@php
function hexToRgb($hex) {
    $hex = str_replace('#', '', $hex);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    return "$r, $g, $b";
}
@endphp
