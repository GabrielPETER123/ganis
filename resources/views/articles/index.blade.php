<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .article { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px; }
        .article h2 { margin-top: 0; }
        a { color: #0066cc; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Articles</h1>
    @forelse($articles as $article)
        <div class="article">
            <h2>{{ $article->name }}</h2>
            <p>{{ Str::limit($article->content, 150) }}</p>
            <img src={{ $article->image_path }} alt="image inshallah">
            <a href="/articles/{{ $article->id }}">Read More</a>
        </div>
    @empty
        <p>No articles found.</p>
    @endforelse
</body>
</html>
