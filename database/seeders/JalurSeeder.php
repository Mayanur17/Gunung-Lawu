<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JalurSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jalur')->insert([
            [
                'jalur_pendakian' => 'Cemoro Kandang',
                'gambar' => 'cemorokandang.jpg',
                'alamat_jalur' => 'Desa Gondosuli, Kecamatan Tawangmangu, Kabupaten Karanganyar, Jawa Tengah.',
                'deskripsi' => 'Pendakian Gunung Lawu via Cemoro Kandang menawarkan kombinasi tantangan dan keindahan alam yang seimbang. Rute dimulai dari basecamp di ketinggian sekitar 1.950 m dan memerlukan waktu sekitar 7–8 jam untuk mencapai puncak Hargo Dumilah (3.265 m). Jalur ini cukup bervariasi: melewati hutan pinus, lahan terbuka, serta padang sabana sebelum tiba di Hargo Dalem—area camp yang strategis untuk pendakian dua hari atau summit dini hari.
Jam Operasional via Cemoro Kandang:
CAMP: Buka pukul 03.00 WIB, Tutup pukul 17.00 WIB
TEKTOK PUNCAK: Buka pukul 02.00 WIB, Tutup pukul 08.00 WIB
TEKROK KAWAH: Buka pukul 05.00 WIB, Tutup pukul 13.00 WIB
Rute & estimasi waktu antar pos:
Cemoro Kandang → Pos 1: ~70 menit
Pos 1 → Pos 2: ~80 menit
Pos 2 → Pos 3: ~110 menit
Pos 3 → Pos 4: ~90 menit
Pos 4 → Pos 5: ~40 menit
Pos 5 → Hargo Dalem (basecamp camp): ~15–20 menit
Hargo Dalem → Puncak Hargo Dumilah: ~30 menit
Total durasi: sekitar 435 menit (~7–8 jam)
Fasilitas di basecamp antara lain parkir, mushola, toilet, pendopo/rest area, serta area cuci tangan.',
                'gambar_peta' => 'petalawu.jpg',
            ],
            [
                'jalur_pendakian' => 'Cemoro Sewu',
                'gambar' => 'cemorosewu.jpg',
                'alamat_jalur' => 'Jalan Raya Sarangan, Sampe, Ngancar, Kecamatan Plaosan, Kabupaten Magetan, Jawa Timur',
                'deskripsi' => 'Jalur Cemoro Sewu adalah salah satu jalur resmi pendakian Gunung Lawu yang dikenal dengan medan yang curam, terjal, dan menantang sejak awal hingga puncak, sedikit bagian landai, sehingga menguji kekuatan fisik dan mental pendaki. Jalur ini didominasi batuan besar, anak tangga alami, dan tanjakan panjang yang konsisten, menjadikannya pilihan favorit bagi pendaki yang menyukai tantangan teknis.
Jam Operasional via Cemoro Sewu:
CAMP: 24 Jam
TEKTOK: Buka pukul 01.00 WIB, Tutup pukul 09.00 WIB
Pendaki Tektok sampai manapun pukul 13.00 WAJIB TURUN
Pengambilan identitas Tektok maksimal pukul 21.00 WIB
Rute & estimasi waktu antar pos:
Basecamp – Pos 1: Waktu tempuh 1 – 1,5 dan jam Jarak: ± 1,8 km
Pos 1 – Pos 2: Waktu tempuh ± 2 jam dan Jarak: ± 1,4 km
Pos 2 – Pos 3: Waktu tempuh ± 1 jam dan Jarak: ± 0,4 km
Pos 3 – Pos 4: Waktu tempuh 1 – 1,5 jam dan Jarak: ± 0,5 km
Pos 4 – Pos 5: Waktu tempuh 40 – 60 menit dan Jarak: ± 0,5 km
Pos 5 – Sendang Drajat: Waktu tempuh ± 30 menit
Sendang Drajat – Puncak Hargo Dumilah: Waktu tempuh ± 30 menit
Tiket masuk ke basecamp: Rp 25.000/orang + Parkir motor: Rp 10.000.
Fasilitas: warung, shelter, mushala, toilet, sumber air alami (Sendang Drajat).',
                'gambar_peta' => 'petasewu.jpg',
            ],
            [
                'jalur_pendakian' => 'Cetho',
                'gambar' => 'cetho.jpg',
                'alamat_jalur' => 'Dusun Ceto, Desa Gumeng, Kecamatan Jenawi, Kabupaten Karanganyar, Jawa Tengah.',
                'deskripsi' => 'Jalur pendakian Gunung Lawu via Candi Cetho merupakan rute panjang dan sakral dengan pemandangan beragam—mulai dari candi kuno, hutan lebat, hingga hamparan sabana. Basecamp terletak dekat Candi Cetho (±1.500 mdpl).
Jam Operasional via Cetho:
CAMP: Buka pukul 07.00 WIB, Tutup pukul 17.00 WIB
TEKTOK: Buka pukul 04.00 WIB, Tutup pukul 08.30 WIB
Pendaki Tektok sampai manapun pukul 13.00 WAJIB TURUN
Pengambilan identitas Tektok maksimal pukul 20.00 WIB
Rute & estimasi waktu antar pos:
Basecamp – Pos 1 Mbah Branti: ±70 menit
Pos 1 – Pos 2 Brak Seng: 60–70 menit
Pos 2 – Pos 3 Cemoro Dowo: 80–90 menit (ada sumber air)
Pos 3 – Pos 4 Penggik: 80–90 menit
Pos 4 – Pos 5 Bulak Peperangan: 70–75 menit
Pos 5 – Hargo Dalem: ±90 menit
Hargo Dalem – Puncak Hargo Dumilah: ±30 menit
Tiket masuk: Rp 20.000/orang.
Fasilitas: parkir, toilet, mushola, kantin, dan warung seperti Warung Mbok Yem. Shelter disediakan di setiap pos.',
                'gambar_peta' => 'petacetho.jpg',
            ],
        ]);
    }
}
