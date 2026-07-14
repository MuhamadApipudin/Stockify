<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function indexTasks()
{
    // Hanya ambil transaksi yang statusnya 'berhasil' (siap dieksekusi fisik)
    $tasks = Transaction::where('status', 'berhasil')->with('product')->get();
    return view('staff.tasks', compact('tasks'));
}

public function confirmTask($id)
{
    $transaction = Transaction::findOrFail($id);
    // Ubah status menjadi 'selesai' sebagai bukti barang sudah diproses fisik
    $transaction->update(['status' => 'selesai']);
    
    return redirect()->route('staff.tasks')->with('success', 'Konfirmasi fisik berhasil!');
}
}
