@extends('layouts.app')

@section('title', 'Detail Supplier - ' . $supplier->supplier_name)
@section('page-title', 'Detail Supplier')

@section('content')
<div class="content-card">
    {{-- Header Halaman --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h5 class="fw-bold mb-1">Detail Supplier</h5>
            <p class="text-muted mb-0">Melihat detail untuk: {{ $supplier->supplier_name }}</p>
        </div>
        <div>
            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-app-primary">
                <i class="fas fa-pencil-alt me-1"></i> Edit
            </a>
            <a href="{{ route('suppliers.index') }}" class="btn btn-app-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Detail Konten --}}
    <div class="row">
        <div class="col-md-6">
            <div class="mb-4">
                <label class="form-label text-muted small text-uppercase">Nama Supplier</label>
                <p class="fs-5 fw-semibold">{{ $supplier->supplier_name }}</p>
            </div>
            <div class="mb-4">
                <label class="form-label text-muted small text-uppercase">Nama Kontak (PIC)</label>
                <p class="fs-5">{{ $supplier->contact_name ?: '-' }}</p>
            </div>
             <div class="mb-4">
                <label class="form-label text-muted small text-uppercase">Telepon</label>
                <p class="fs-5">{{ $supplier->phone }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-4">
                <label class="form-label text-muted small text-uppercase">Status</label>
                <p class="fs-5">
                    @if($supplier->status == 'Active')
                        <span class="badge bg-success-subtle text-success-emphasis rounded-pill fs-6">{{ $supplier->status }}</span>
                    @elseif($supplier->status == 'Idle')
                        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill fs-6">{{ $supplier->status }}</span>
                    @else
                        <span class="badge bg-danger-subtle text-danger-emphasis rounded-pill fs-6">{{ $supplier->status }}</span>
                    @endif
                </p>
            </div>
            <div class="mb-4">
                <label class="form-label text-muted small text-uppercase">Alamat</label>
                <p class="fs-5">{{ $supplier->address ?: '-' }}</p>
            </div>
        </div>
    </div>
    
    <hr class="my-3">
    
    <div>
        <label class="form-label text-muted small text-uppercase">Catatan</label>
        <div class="bg-light p-3 rounded border">
            {!! $supplier->notes ?: '<em>No notes provided.</em>' !!}
        </div>
    </div>
</div>
@endsection