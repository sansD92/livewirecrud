<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Mahasiswa as ModelsMahasiswa;

class Mahasiswa extends Component
{
   use WithPagination ;
   protected $paginationTheme = 'bootstrap';
   public $nip;
   public $nama;
   public $alamat;
   public $email;
   public $nohp;
   public $updateData = false;
   public $mahasiswa_id;
   public $perPage = 3;
   public $katakunci;

   public function store() {
        
    $rules = [
        'nip' => 'required',
        'nama' => 'required',
        'email' => 'required|email',
        'nohp' => 'required',
        'alamat' => 'required',
    ];

    $pesan = [
        'nip.required'=>'NIP Wajib Diisi',
        'nama.required'=>'Nama Wajib Diisi',
        'email.required'=>'Email Wajib Diisi',
        'email.email'=>'Format Email tidak sesuai',
        'nohp.required'=>'No HP Wajib Diisi',
        'alamat.required'=>'Alamat Wajib Diisi',
    ];

    $validated = $this->validate($rules, $pesan);

    ModelsMahasiswa::create($validated);
    session()->flash('message', 'Data atas nama '.$this->nama.' Berhasil Ditambahkan');
    $this->clear();
}

    public function clear()
    {
    $this->nip = '';
    $this->nama = '';
    $this->email = '';
    $this->nohp = '';
    $this->alamat = '';

    $this->updateData = false;
    $this->mahasiswa_id = '';
    }
    
    public function edit($id) {
        $dataMahasiswa = ModelsMahasiswa::find($id);
        $this->nip = $dataMahasiswa->nip;
        $this->nama = $dataMahasiswa->nama;
        $this->email = $dataMahasiswa->email;
        $this->nohp = $dataMahasiswa->nohp;
        $this->alamat = $dataMahasiswa->alamat;

        $this->updateData = true;
        $this->mahasiswa_id = $id;
    }

    public function update() {
        $rules = [
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'nohp' => 'required',
            'alamat' => 'required',
        ];
    
        $pesan = [
            'nip.required'=>'NIP Wajib Diisi',
            'nama.required'=>'Nama Wajib Diisi',
            'email.required'=>'Email Wajib Diisi',
            'email.email'=>'Format Email tidak sesuai',
            'nohp.required'=>'No HP Wajib Diisi',
            'alamat.required'=>'Alamat Wajib Diisi',
        ];
    
        $validated = $this->validate($rules, $pesan);
    
        $dataMahasiswa = ModelsMahasiswa::find($this->mahasiswa_id);
        $dataMahasiswa->update($validated);
        session()->flash('message', 'Data '.$this->nama.' Berhasil Diperbarui');
        $this->clear();
    }

    public function delete()
    {
        $id = $this->mahasiswa_id;
        ModelsMahasiswa::find($id)->delete();
        $this->clear();
        session()->flash('message', 'Data Berhasil Didelete');
    }

    public function delete_confrimation($id)
    {
        $this->mahasiswa_id = $id;
        $dataMahasiswa = ModelsMahasiswa::find($id);
        $nama = $dataMahasiswa->nama;
        session()->flash('message2', ' yakin delete atas  nama '. $nama.'');
    }

    public function render()
    {

        if ($this->katakunci != null) {
            $dataMahasiswa = ModelsMahasiswa::where('nama','like','%'.$this->katakunci.'%')
            ->orwhere('email','like','%'.$this->katakunci.'%')->
            orwhere('nohp','like','%'.$this->katakunci.'%')->
            orwhere('alamat','like','%'.$this->katakunci.'%')->
            orwhere('nip','like','%'.$this->katakunci.'%')->
            orderBy('nama','asc')->paginate($this->perPage);
        } else {
            $dataMahasiswa = ModelsMahasiswa::orderBy('id','desc')->paginate($this->perPage);
        }
        
        return view('livewire.mahasiswa',compact('dataMahasiswa'));
    }

  
}
