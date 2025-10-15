@extends('layouts.app')

@section('title', 'Supplier Management - Mofu Cafe')
@section('page-title', 'Supplier Management')

@push('styles')
<style>
    .summary-card {
        background-color: #fff;
        border: 2px solid var(--mofu-light-border);
        border-radius: 0.75rem;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .summary-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.75rem;
    }

    .summary-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
    }

    .summary-title {
        font-size: 0.9rem;
        color: var(--mofu-text-muted);
    }

    /* Varian Warna */
    .summary-card--total .summary-icon { background-color: #e0f3ff; border: 3px solid #bde6ff; color: #007bff; }
    .summary-card--total .summary-value { color: #007bff; }

    .summary-card--active .summary-icon { background-color: #e6fffa; border: 3px solid #b3f5e9; color: #1abc9c; }
    .summary-card--active .summary-value { color: #1abc9c; }

    .summary-card--idle .summary-icon { background-color: #fff8e1; border: 3px solid #ffecb3; color: #f39c12; }
    .summary-card--idle .summary-value { color: #f39c12; }

    .summary-card--inactive .summary-icon { background-color: #f1f2f6; border: 3px solid #dfe4ea; color: #576574; }
    .summary-card--inactive .summary-value { color: #576574; }
</style>
@endpush

@section('content')
<div class="content-card">
    {{-- Bagian 1: Ringkasan Status (KPI Cards) --}}
    <div class="row mb-5">
