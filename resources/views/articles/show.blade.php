<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; max-width: 800px; }
        h1 { margin-bottom: 10px; }
        .meta { color: #666; font-size: 0.9em; margin-bottom: 20px; }
        a { color: #0066cc; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>{{ $article->name }}</h1>
    <div class="meta">Published: {{ $article->created_at->format('M d, Y') }}</div>
    <div class="content">
        {{ $article->content }}
    </div>
    <p><a href="/articles">← Back to Articles</a></p>
</body>
</html>
