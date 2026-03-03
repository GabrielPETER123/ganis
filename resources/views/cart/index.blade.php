@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Cart</h1>

    @if (session('success'))
        <div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if($carts->isEmpty())
        <div class="rounded border border-gray-200 bg-white p-6 text-gray-600">
            Votre panier est vide.
        </div>
    @else
        <div class="overflow-x-auto rounded border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Article</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Price</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Quantité</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Total</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($carts as $cart)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $cart->article->name ?? 'Article supprimé' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $cart->article->category ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ isset($cart->article->price) ? number_format($cart->article->price, 2) . ' €' : '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                <div class="inline-flex items-center gap-2">
                                    <form action="{{ route('cart.decrement', $cart) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded border border-gray-300 px-2 py-1 text-sm">-</button>
                                    </form>

                                    <span class="min-w-8 text-center">{{ $cart->quantity ?? 1 }}</span>

                                    <form action="{{ route('cart.increment', $cart) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded border border-gray-300 px-2 py-1 text-sm">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @if(isset($cart->article->price))
                                    {{ number_format(($cart->article->price * ($cart->quantity ?? 1)), 2) }} €
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-700">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
