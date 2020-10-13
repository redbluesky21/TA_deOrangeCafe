<?php
// Kategori
Breadcrumbs::for('kategori', function ($trail) {
    $trail->push('Kategori', route('admin.kategori'));
});
Breadcrumbs::for('sub-kategori', function ($trail) {
    $trail->push('Sub Kategori', route('admin.sub-kategori'));
});
Breadcrumbs::for('menu-pesanan', function ($trail) {
    $trail->push('Menu Pesanan', route('admin.menupesanan'));
});
