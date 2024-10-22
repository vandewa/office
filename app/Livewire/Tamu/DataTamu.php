<?php

namespace App\Livewire\Tamu;

use App\Models\Tamu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DataTamu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $form = 'display-none', $order = "DESC", $limit = 10, $idNya;
    public $name, $tanggal, $instansi, $kontak, $keperluan, $jumlah_tamu;
    protected $listeners = ['add'];

    public function add($id = '')
    {
        $this->form = null;
        if ($id) {
            $data = Tamu::find(Crypt::decrypt($id));
            $this->idNya = $data->id;
            $this->name = $data->name;
            $this->tanggal = $data->tanggal;
            $this->kontak = $data->kontak;
            $this->instansi = $data->instansi;
            $this->keperluan = $data->keperluan;
            $this->jumlah_tamu = $data->jumlah_tamu;
        } else {
            $this->clear();
        }
    }
    public function getKontak($value)
    {
        if ($value == null) {
            return "62";
        } else if (substr($value, 0, 1) == '0') {
            return "62" . substr($value, 1);
        } else {
            return $value;
        }
    }
    public function save()
    {
        $rules = [
            'tanggal' => 'required',
            'name' => 'required|max:255',
            'instansi' => 'required|max:255',
            'kontak' => 'required|numeric|digits_between:10,15',
            'keperluan' => 'required|max:255',
            'jumlah_tamu' => 'required|max:255',
        ];
        $messages = [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'instansi.required' => 'Instansi wajib diisi.',
            'instansi.max' => 'Instansi tidak boleh lebih dari 255 karakter.',
            'keperluan.required' => 'Keperluan wajib diisi.',
            'keperluan.max' => 'Keperluan tidak boleh lebih dari 255 karakter.',
            'jumlah_tamu.required' => 'Jumlah tamu wajib diisi.',
            'jumlah_tamu.max' => 'Jumlah tamu tidak boleh lebih dari 255 karakter.',
            'kontak.required' => 'Nomor telepon wajib diisi.',
            'kontak.numeric' => 'Nomor telepon harus berupa angka.',
            'kontak.digits_between' => 'Nomor telepon harus antara 10 hingga 15 digit.',
        ];
        $this->validate($rules, $messages);
        if ($this->idNya) {
            $data = Tamu::find($this->idNya);
            $data->kd_id = Auth::user()->kdunit;
            $data->name = $this->name;
            $data->tanggal = $this->tanggal;
            $data->instansi = $this->instansi;
            $data->kontak = $this->getKontak($this->kontak);
            $data->keperluan = $this->keperluan;
            $data->jumlah_tamu = $this->jumlah_tamu;
            $data->save();
            $this->dispatch('UpdateSuccess');
        } else {
            Tamu::create([
                'kd_id' => Auth::user()->kdunit,
                'name' => $this->name,
                'tanggal' => $this->tanggal,
                'instansi' => $this->instansi,
                'kontak' => $this->getKontak($this->kontak),
                'keperluan' => $this->keperluan,
                'jumlah_tamu' => $this->jumlah_tamu,
            ]);
            $this->dispatch('NotifSuccess');
        }
        $this->batal();
    }
    public function batal()
    {
        $this->form = 'display-none';
        $this->clear();
    }
    public function clear()
    {
        $this->idNya = null;
        $this->name = null;
        $this->kontak = null;
        $this->tanggal = null;
        $this->instansi = null;
        $this->keperluan = null;
        $this->jumlah_tamu = null;
    }
    public function render()
    {
        $data = Tamu::query();
        if ($this->search) {
            $data->where(DB::raw('LOWER(name)'), 'like', '%' .  strtolower($this->search) . '%');
        }
        if ($this->order) {
            $data->orderBy('id', $this->order);
        }
        $data = $data->paginate($this->limit);
        return view('livewire.tamu.data-tamu', ['data' => $data]);
    }
}
