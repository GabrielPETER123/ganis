@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        @if($article->image_path)
            <img src="{{ $article->image_path }}" class="card-img-top" alt="{{ $article->name }}" style="max-height: 420px; object-fit: cover;">
        @endif

        <div class="card-body">
            <span class="badge bg-secondary mb-2">{{ ucfirst(str_replace('-', ' ', $article->category)) }}</span>
            <h1 class="h3">{{ $article->name }}</h1>
            <p class="text-muted">Publié le {{ $article->created_at?->format('d/m/Y') }}</p>

            <p>{{ $article->content }}</p>
            <p class="h5 text-primary">{{ number_format($article->price, 2) }} €</p>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">Retour aux articles</a>

                @auth
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                    </form>
                @else
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
