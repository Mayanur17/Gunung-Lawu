@extends('layout.app')

@section('title', 'Beranda–Website Gunung Lawu')

@section('content')
<h1>Selamat Datang di Website Gunung Lawu</h1>
 <div class="video-text-container">
    <div class="video-box">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/hjPaQvd15_U" frameborder="0" allowfullscreen></iframe>
    </div>
  <div class="text-box">
    <h2>"Gunung Lawu bukan hanya tentang puncaknya, tapi tentang proses memahami diri sendiri di tengah keheningan hutan dan embun."</h2>
  </div>
</div>

<div class="container-pesona">
    <h2 class="judul">Pesona Gunung Lawu</h2>
    <div class="gambar-slider">
        <img src="{{ secure_asset('images/lawu1.jpeg') }}" alt="Gunung Lawu 1">
        <img src="{{ secure_asset('images/lawu2.jpg') }}" alt="Gunung Lawu 2">
        <img src="{{ secure_asset('images/gambar11.jpg') }}" alt="Gunung Lawu 3">
        <img src="{{ secure_asset('images/gambar12.jpg') }}" alt="Gunung Lawu 4">
        <img src="{{ secure_asset('images/gambar13.jpg') }}" alt="Gunung Lawu 5">
        <img src="{{ secure_asset('images/lawu7.jpg') }}" alt="Gunung Lawu 6">
        <img src="{{ secure_asset('images/lawu3.jpg') }}" alt="Gunung Lawu 7">
        <img src="{{ secure_asset('images/lawu4.jpg') }}" alt="Gunung Lawu 8">
        <img src="{{ secure_asset('images/lawu5.jpg') }}" alt="Gunung Lawu 9">
        <img src="{{ secure_asset('images/lawu8.jpg') }}" alt="Gunung Lawu 10">
        <img src="{{ secure_asset('images/lawu9.jpg') }}" alt="Gunung Lawu 11">

    </div>
    <div class="deskripsi">
        <p>
            Gunung Lawu menawarkan pesona alam dan budaya yang memikat. 
            Dari puncaknya, Hargo Dumilah, pendaki disuguhi panorama megah yang membentang luas. 
            Di lerengnya terbentang sabana hijau yang sejuk dan memesona, menjadi tempat sempurna 
            untuk beristirahat sejenak. Tak jauh dari puncak terdapat Pasar Dieng, pasar gaib yang 
            sarat mitos dan dipercaya menjadi tempat bertemunya dua dunia. Di jalur pendakian, kita 
            juga bisa menjumpai peninggalan sejarah berupa candi-candi kuno, menambah nuansa spiritual 
            perjalanan. Kawah Candradimuka, dengan uap panasnya, menghadirkan kesan mistis dan menjadi 
            bagian dari legenda pewayangan. Dan sebelum mencapai puncak, pendaki biasanya singgah di warung 
            legendaris Mbok Yem, satu-satunya warung di atas 3.000 meter yang menjadi tempat melepas lelah 
            dan menikmati teh hangat di tengah dinginnya udara Lawu.
        </p>
        @auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('pesona.index') }}" class="btn-learn-more">Learn More</a>
    @elseif(Auth::user()->role === 'pendaki')
        <a href="{{ route('pendaki.pesona') }}" class="btn-learn-more">Learn More</a>
    @endif
@else
    <a href="#" class="btn-learn-more">Learn More</a>
@endauth

    </div>
</div>
<div class="container-peralatan">
    <h2 class="judul">Peralatan Pendakian</h2>
    <div class="peralatan-gambar">
        <div class="item">
            <img src="{{ secure_asset('images/tektok.jpeg') }}" alt="Peralatan Tektok">
            <p class="nama">Peralatan Tektok</p>
            <p class="deskripsi">
                Peralatan tektok adalah perlengkapan ringan dan praktis yang digunakan untuk pendakian tanpa 
                menginap, biasanya dilakukan dalam satu hari. Peralatan ini meliputi daypack kecil, botol minum, 
                jas hujan, senter, makanan ringan, dan sepatu yang nyaman, sehingga memungkinkan pendaki bergerak 
                cepat dan efisien tanpa membawa beban berat.
            </p>
@auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('peralatantektok.index') }}" class="btn-learn-more">Learn More</a>
    @elseif(Auth::user()->role === 'pendaki')
        <a href="{{ route('pendaki.peralatantektok') }}" class="btn-learn-more">Learn More</a>
    @endif
@else
    <a href="#" class="btn-learn-more">Learn More</a>
@endauth
        </div>
        <div class="item">
            <img src="{{ secure_asset('images/camp.jpg') }}" alt="Peralatan Camping">
            <p class="nama">Peralatan Camping</p>
            <p class="deskripsi">
            Peralatan camp dalam pendakian adalah perlengkapan yang digunakan untuk mendirikan dan menunjang 
            kegiatan berkemah di gunung, seperti tenda, sleeping bag, matras, alat masak, dan penerangan. 
            Peralatan ini berfungsi untuk memberikan kenyamanan, perlindungan dari cuaca, serta mendukung 
            kebutuhan hidup dasar selama bermalam di alam terbuka.
            </p>
            @auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('peralatancamp.index') }}" class="btn-learn-more">Learn More</a>
    @elseif(Auth::user()->role === 'pendaki')
        <a href="{{ route('pendaki.peralatancamp') }}" class="btn-learn-more">Learn More</a>
    @endif
@else
    <a href="#" class="btn-learn-more">Learn More</a>
@endauth

        </div>
    </div>
</div>
<div class="container-persiapan">
    <div class="persiapan-content">
        <div class="persiapan-text">
            <h2 class="judul">Persiapan Pendakian</h2>
            <p>
            Persiapan pendakian adalah langkah awal yang sangat penting untuk memastikan keselamatan dan 
            kenyamanan selama perjalanan di gunung. Persiapan pendakian meliputi latihan fisik yang rutin 
            untuk meningkatkan daya tahan dan kekuatan tubuh, serta memahami langkah pencegahan saat di gunung. 
            Penting juga mengetahui cara menangani hipotermia dengan menjaga suhu tubuh tetap hangat, serta 
            penanganan cedera seperti keseleo atau patah tulang secara tepat. Selain itu, persiapan termasuk 
            cara merawat luka agar tidak infeksi, sehingga keselamatan dan kenyamanan pendaki tetap terjaga 
            sepanjang perjalanan.


            </p>
           @auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('persiapan.index') }}" class="btn-learn-more">Learn More</a>
    @elseif(Auth::user()->role === 'pendaki')
        <a href="{{ route('pendaki.persiapan') }}" class="btn-learn-more">Learn More</a>
    @endif
@else
    <a href="#" class="btn-learn-more">Learn More</a>
@endauth        </div>
        <div class="persiapan-img">
            <img src="{{ secure_asset('images/persiapan.jpg') }}" alt="Persiapan Pendakian">
        </div>
    </div>
</div>
@endsection
