<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'title' => 'Akupunktur Pengobatan',
                'description' => 'Akupunktur Pengobatan adalah teknik pengobatan yang telah berusia ribuan tahun yang telah
                dipadukan ke dalam ilmu kedokteran modern, menggunakan jarum akupunktur yang kecil dan
                halus yang ditusukkan pada titik-titik akupunktur tubuh. Akupunktur dapat membantu
                mempercepat pemulihan Stroke, mengatasi nyeri pinggang, meredakan sakit kepala, pengobatan
                Maag dan gangguan organ tubuh lainnya.',
            ],
            [
                'title' => 'Akupunktur Estetika',
                'description' => 'Akupunktur Estetika adalah sebuah metode kecantikan yang telah digunakan oleh para ratu,
                permaisuri dan gadis-gadis China yang kecantikanya terkenal pada masanya dan telah teruji
                manfaatnya hingga kini sejak ribuat tahun yang lalu. Metode ini dapat membantu meremajakan
                dan memelihara kulit dan menambah produksi kolagen untuk membantu mengurangi tanda
                penuaan seperti garis-garis halus, kerut, kendur dan kulit kasar dan mengembalikan sinar
                muda wajah Anda, serta membantu mengatasi Kegemukan.',
            ],
            [
                'title' => 'Bekam',
                'description' => 'Bekam adalah metode pengobatan dengan cara pemvakuman di kulit menggunakan alat khusus
                dan steril dan terbukti ilmiah dapat mengeluarkan darah rusak dan darah statis (kental) yang
                mengandung toksin dari dalam tubuh, meningkatkan kekebalan tubuh, meringankan otot yang
                kaku dan mempertajam pandangan mata, penetral ketegangan emosi, serta merupakan
                pengobatan yang sangat dianjurkan dalam Islam.',
            ],
            [
                'title' => 'Fisioterapi',
                'description' => 'Fisioterapi adalah metode rehabilitasi dengan penanganan manual, peningkatan gerak, peralatan
                (fisik, elektroterapeutis dan mekanis), pelatihan fungsi untuk meminimalisir keterbatasan fisik,
                menstabilkan atau memperbaiki gangguan gerak tubuh pada pasien cidera fisik ataupun
                rehabilitasi post stroke.',
            ],
            [
                'title' => 'Fisioterapi Anak',
                'description' => 'Fisioterapi Anak adalah metode fisioterapi yang menangani anak-anak dengan keterlambatan
                tumbuh kembang, gangguan dan kelainan fungsi gerak motorik kasar, motorik halus, perilaku
                sosial, dan bahasa yang disesuaikan dengan usianya.',
            ],
            [
                'title' => 'Pijat Bayi',
                'description' => 'Pijat Bayi merupakan sentuhan cinta sebagai salah satu stimulasi multisensory yang dapat
                membantu mendorong perkembangan dan pertumbuhan bayi secara optimal, memperlancar
                peredaran darah, memperkuat kekebalan tubuh, menambah napsu makan, tidur lebih nyenyak,
                memperkuat masa tulang, meningkatkan produksi hormon oksitosin yang membuat merasa
                nyaman dan dicintai.',
            ],
            [
                'title' => 'Totok Wajah & Aura',
                'description' => 'Totok Wajah atau Totok Aura adalah metode perawatan kecantikan yang dilakukan dengan
                pemijatan dan penekanan di titik-titik tertentu pada wajah menggunakan ujung jari atau alat
                khusus yang dapat membantu membuat wajah lebih segar cerah merona, mencegah penuaan,
                meningkatkan kolagen, mengurangi mata panda, mengusir stress, dan meredakan sakit kepala.',
            ],
            [
                'title' => 'Massage',
                'description' => 'Massage (Khusus Wanita) adalah metode pemijatan dan pengurutan nyaman pada bagian tangan,
                kaki, dan punggung untuk melancarkan peredaran darah dan meningkatkan kebugaran serta
                imunitas sebagai cara pengobatan atau untuk menghilangkan rasa lelah.',
            ],
            [
                'title' => 'Ortotik Prostetik',
                'description' => 'Ortotik Prostetik (Jasa Konsultasi Ortotik Prostetik) adalah jasa konsultasi untuk pembuatan
                dan pemasangan alat bantu pada pasien yang membutuhkan alat bantu gerak atau pasien yang
                kehilangan anggota gerak tubuh dan dilakukan oleh tenaga ahli profesional yang disebut dengan
                Ortotis Prostetis.',
            ],
            [
                'title' => 'Terapi Okupasi',
                'description' => 'Terapi Okupasi merupakan perawatan khusus untuk seseorang yang mengalami gangguan
                kesehatan tertentu agar bisa mendapatkan harapan positif. Misalnya, mampu melakukan aktivitas
                sehari-hari yang sebelumnya tak bisa dilakukannya seorang diri. Entah itu untuk melakukan
                perawatan diri (makan, mandi, dan berpakaian), pengembangan diri (membaca, berhitung,
                maupun bersosialisasi), latihan fisik (melatih gerakan sendi, kekuatan otot, dan kelenturan), serta
                kegiatan lainnya. Melalui terapi ini, pengidap dapat menjalani kesehariannya dengan mandiri.',
            ],
            [
                'title' => 'Terapi Wicara',
                'description' => 'Terapi Wicara merupakan terapi yang digunakan untuk mengatasi masalah bicara dengan cara
                mengoptimalkan koordinasi mulut agar dapat menghasilkan suara untuk membentuk kata-kata.
                Metode ini dibutuhkan oleh orang dewasa ataupun anak-anak yang mengalami gangguan bicara.',
            ],
            [
                'title' => 'Perawatan Luka',
                'description' => 'Perawatan Luka adalah tindakan merawat luka dengan upaya untuk mencegah infeksi,
                membunuh atau menghambat pertumbuhan kuman atau bakteri pada kulit dan jaringan tubuh lainnya.
                Perawatan luka sangat dibutuhkan oleh bagi pengidap diabetes dan luka bakar, karena luka pada
                kasus ini membutuhkan perawatan dengan proses yang benar dan telaten.',
            ],
        ]);
    }
}
