<?php

namespace App\Livewire\Tamu;

use App\Models\Tamu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MandiriTamu extends Component
{
    public $name, $tanggal, $instansi, $kontak, $keperluan, $jumlah_tamu;
    public $search, $form, $order = "DESC", $limit = 10, $idNya;
    public function tambah()
    {
        $this->form = true;
    }
    public function batal()
    {
        $this->form = false;
        $this->clear();
    }
    public function clear()
    {
        $this->name = null;
        $this->tanggal = null;
        $this->instansi = null;
        $this->kontak = null;
        $this->keperluan = null;
        $this->jumlah_tamu = null;
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
        return $this->redirect('data-tamu', navigate: true);
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
    public function render()
    {
        $data = Tamu::query();
        if ($this->order) {
            $data->orderBy('id', $this->order);
        }
        $data = $data->paginate($this->limit);
        return view('livewire.tamu.mandiri-tamu', ['data' => $data]);
    }
}
