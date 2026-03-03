{{-- filepath: c:\wamp64\www\ganis\resources\views\articles\index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Articles</h1>
        @auth
            <a href="{{ route('articles.create') }}" class="btn btn-primary">Créer un article</a>
        @endauth
    </div>

    <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
        <span class="text-muted">Catégories :</span>
        <a href="{{ route('articles.index') }}" class="btn btn-sm {{ request('category') ? 'btn-outline-secondary' : 'btn-secondary' }}">Toutes</a>
        @foreach($categories as $cat)
            <a href="{{ route('articles.index', ['category' => $cat]) }}" class="btn btn-sm {{ request('category') === $cat ? 'btn-secondary' : 'btn-outline-secondary' }}">
                {{ ucfirst(str_replace('-', ' ', $cat)) }}
            </a>
        @endforeach
    </div>

    <div class="mb-3 text-muted">
        @if(request('category'))
            Filtre actif : <strong>{{ ucfirst(str_replace('-', ' ', request('category'))) }}</strong> — {{ $articles->total() }} résultat(s)
        @else
            {{ $articles->total() }} résultat(s)
        @endif
    </div>

    {{-- Filtre par catégorie --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('articles.index') }}" class="row g-3" id="category-filter-form">
                <div class="col-md-4">
                    <label for="category" class="form-label">Filtrer par catégorie</label>
                    <select name="category" id="category" class="form-select" onchange="document.getElementById('category-filter-form').submit()">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('-', ' ', $cat)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
                @if(request('category'))
                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary w-100">Réinitialiser</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Liste des articles --}}
    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($article->image_path)
                        <img src="{{ $article->image_path }}" class="card-img-top" alt="{{ $article->name }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">{{ ucfirst(str_replace('-', ' ', $article->category)) }}</span>
                        <h5 class="card-title">{{ $article->name }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        <p class="fw-bold text-primary">{{ number_format($article->price, 2) }} €</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary">Voir détails</a>
                            @auth
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary">Ajouter au panier</button>
                                </form>
                            @else
                                @if(Route::has('login'))
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Se connecter</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Aucun article trouvé.</div>
            </div>
        @endforelse
    </div>

    {{ $articles->links() }}
</div>
@endsection