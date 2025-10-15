@extends('layouts.app')

@section('title', 'Tambah Supplier Baru')
@section('page-title', 'Tambah Supplier Baru')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Tambah Supplier Baru</h5>
        </div>
            <a href="{{ route('suppliers.index') }}" class="btn btn-app-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
    </div>

    <form id="supplierForm" action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                {{-- Kolom Kiri: Input Utama --}}
                <div class="mb-3">
                    <label for="supplier_name" class="form-label fw-semibold">NAMA SUPPLIER</label>
                    <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" id="supplier_name" name="supplier_name" value="{{ old('supplier_name') }}" placeholder="e.g., Kopi Jaya Abadi">
                    @error('supplier_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact_name" class="form-label fw-semibold">NAMA KONTAK (PIC)</label>
                        <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" placeholder="e.g., Budi Santoso">
                        @error('contact_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-semibold">TELEPON</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="e.g., 08123456789">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">ALAMAT</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Masukkan Alamat Lengkap Supplier">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                {{-- Kolom Kanan: Status --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">STATUS</label>
                    <div class="btn-group w-100" role="group" aria-label="Status selection">
                        {{-- Tombol untuk status Active --}}
                        <input type="radio" class="btn-check" name="status" id="status_active" value="Active" autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="status_active">Active</label>

                        {{-- Tombol untuk status Idle --}}
                        <input type="radio" class="btn-check" name="status" id="status_idle" value="Idle" autocomplete="off">
                        <label class="btn btn-outline-warning" for="status_idle">Idle</label>

                        {{-- Tombol untuk status Inactive --}}
                        <input type="radio" class="btn-check" name="status" id="status_inactive" value="Inactive" autocomplete="off">
                        <label class="btn btn-outline-danger" for="status_inactive">Inactive</label>
                    </div>
                </div>
                 <div class="mb-3">
                    <label for="notes" class="form-label fw-semibold">CATATAN</label>
                    <textarea class="form-control" name="notes" id="notes" rows="4" placeholder="Catatan tambahan seperti jadwal pengiriman, item khusus, dll.">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="mt-4 border-top pt-4 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Simpan Supplier</button>
        </div>
    </form>
</div>
@endsection