<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Find the page
$page = \App\Models\Page::find(1);

if (!$page) {
    echo "Page with ID 1 not found.\n";
    exit(1);
}

echo "Found page: " . $page->title . "\n";

// Create the content blocks data
$blocks = [
    [
        'type' => 'section_with_link',
        'data' => [
            'block_id' => 'hero-banner',
            'title' => 'Kawasan Industri Strategis untuk Pertumbuhan Bisnis',
            'subtitle' => 'Dukungan Infrastruktur Lengkap untuk Kesuksesan Bisnis Anda',
            'description' => 'Fasilitas lengkap, aksesibilitas tinggi, dan dukungan profesional bagi investor.',
            'url' => '#layanan-home',
            'button_label' => 'Lihat Layanan',
            'video_url' => 'https://www.youtube.com/embed/1t_z7FMcsOw?autoplay=1&loop=1&mute=1&controls=0&playlist=1t_z7FMcsOw&modestbranding=1&showinfo=0'
        ]
    ],
    [
        'type' => 'section_with_image',
        'data' => [
            'block_id' => 'about-home',
            'title' => 'Pilar Industri Jawa Tengah',
            'subtitle' => 'tentang kiw',
            'description' => 'PT Kawasan Industri Wijayakusuma (KIW) merupakan perusahaan yang bergerak di bidang pengembangan dan pengelolaan kawasan industri. Pemegang saham KIW antara lain; Kementerian BUMN, PT Danareksa (Persero), Pemerintah Provinsi Jawa Tengah, dan Pemerintah Kabupaten Cilacap.',
            'url' => '/profil-perusahaan',
            'button_label' => 'selengkapnya'
        ]
    ],
    [
        'type' => 'section_with_image',
        'data' => [
            'block_id' => 'layanan-home',
            'title' => 'Solusi Komprehensif untuk Kebutuhan Industri',
            'subtitle' => 'layanan kami',
            'description' => 'Kami menyediakan berbagai layanan lengkap untuk mendukung operasional industri Anda dengan standar kualitas terbaik.'
        ]
    ],
    [
        'type' => 'simple',
        'data' => [
            'block_id' => 'keunggulan-home',
            'title' => 'Alasan Memilih KIW?',
            'subtitle' => 'Keunggulan',
            'description' => 'Berbagai keunggulan yang menjadikan KIW pilihan terbaik untuk investasi industri Anda.'
        ]
    ],
    [
        'type' => 'simple',
        'data' => [
            'block_id' => 'sektor-industri',
            'title' => 'Sektor Industri Unggulan',
            'subtitle' => 'Industri Terfokus',
            'description' => 'Berbagai sektor industri yang dapat berkembang optimal di kawasan KIW.'
        ]
    ],
    [
        'type' => 'simple',
        'data' => [
            'block_id' => 'fasilitas-home',
            'title' => 'Lingkungan Industri yang Lengkap',
            'subtitle' => 'fasilitas Penunjang',
            'description' => 'Fasilitas penunjang lengkap untuk mendukung operasional industri yang efisien.'
        ]
    ],
    [
        'type' => 'video',
        'data' => [
            'block_id' => 'video-home',
            'title' => 'Profile Kawasan Industri Wijayakusuma',
            'subtitle' => 'Company Profile',
            'description' => 'Lihat profil lengkap Kawasan Industri Wijayakusuma dalam video berikut.',
            'video_url' => 'https://www.youtube.com/embed/-jK-qj3ZNLI?autoplay=1&rel=0'
        ]
    ],
    [
        'type' => 'simple',
        'data' => [
            'block_id' => 'tenant-home',
            'title' => 'Tenant dari Berbagai Sektor Industri',
            'subtitle' => 'Tenant kami',
            'description' => 'Bergabunglah dengan tenant-tenant terpercaya yang telah memilih KIW sebagai lokasi strategis bisnis mereka.'
        ]
    ],
    [
        'type' => 'section_with_link',
        'data' => [
            'block_id' => 'artikel-berita-home',
            'title' => 'Dapatkan Informasi Terbaru',
            'subtitle' => 'Artikel & Berita',
            'description' => 'Ikuti perkembangan terkini seputar industri dan aktivitas di Kawasan Industri Wijayakusuma.',
            'url' => '/posts',
            'button_label' => 'Berita Lainnya'
        ]
    ],
    [
        'type' => 'simple',
        'data' => [
            'block_id' => 'hubungan-investor-home',
            'title' => 'Laporan Tahunan & Audit Perusahaan',
            'subtitle' => 'Hubungan Investor',
            'description' => 'Akses informasi keuangan dan laporan transparansi perusahaan untuk investor.'
        ]
    ]
];

// Update the page with blocks data
$page->section = $blocks;
$page->save();

echo "Successfully updated page with " . count($blocks) . " content blocks.\n";

// Display the blocks that were added
echo "\nBlocks added:\n";
foreach ($blocks as $index => $block) {
    echo ($index + 1) . ". " . $block['data']['block_id'] . " (" . $block['type'] . "): " . $block['data']['title'] . "\n";
}

echo "\nDone!\n";