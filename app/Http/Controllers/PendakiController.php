<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PesonaLawu;
use App\Models\PeralatanTektok;
use App\Models\PeralatanCamp;
use App\Models\Info;
use App\Models\Berita;
use App\Models\Jalur;
use App\Models\Persiapan;

class PendakiController extends Controller
{
    public function pesona()
    {
        $data = PesonaLawu::all();
        return view('pendaki.pesona', compact('data'));
    }

    public function peralatanTektok()
    {
        $peralatantektok = Peralatantektok::all();
        return view('pendaki.peralatantektok', compact('peralatantektok'));
    }
    public function peralatanCamp()
    {
        $peralatancamp = Peralatancamp::all();
        return view('pendaki.peralatancamp', compact('peralatancamp'));
    }
        public function info()
    {
        $info = Info::all();
        return view('pendaki.info', compact('info'));
    }
        public function berita()
    {
        $berita = Berita::all();
        return view('pendaki.berita', compact('berita'));
    }
     public function persiapan()
    {
        $persiapan = Persiapan::all();
        return view('pendaki.persiapan', compact('persiapan'));
    }

    public function cemoroSewu()
    {
        $jalur = Jalur::where('jalur_pendakian', 'Cemoro Sewu')->firstOrFail();
        return view('pendaki.cemorosewu', compact('jalur'));
    }
    public function cemoroKandang()
    {
        $jalur = Jalur::where('jalur_pendakian', 'Cemoro Kandang')->firstOrFail();
        return view('pendaki.cemorosewu', compact('jalur'));
    }
    public function cetho()
    {
        $jalur = Jalur::where('jalur_pendakian', 'Cetho')->firstOrFail();
        return view('pendaki.cemorosewu', compact('jalur'));
    }
}
