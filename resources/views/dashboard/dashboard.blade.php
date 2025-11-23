@extends('layout.body')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="pagetitle">
        <h1>Postest</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Kerjakan Postest</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="page-content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        initest
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
