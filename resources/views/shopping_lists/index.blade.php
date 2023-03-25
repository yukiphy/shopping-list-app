<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>買い物帳</title>

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-[100vh]">
    <header class="bg-amber-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-6">
                <p class="text-white text-xl">買い物帳アプリ</p>
            </div>
        </div>
    </header>

    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <p class="text-2xl font-bold text-center">何を買う？</p>
                <form action="/shopping_lists" method="post" class="mt-10">
                    @csrf <!-- CSRF攻撃対策 -->

                    <div class="flex flex-col items-center">
                        <label class="w-full max-w-3xl mx-auto">
                            <input
                                class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                placeholder="醤油を買う..." type="text" name="shopping_name" />

                            @error('shopping_name')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                            @enderror
                        </label>

                        <button type="submit"
                            class="mt-8 p-4 bg-amber-500 text-white w-full max-w-xs rounded-md hover:bg-amber-600 transition-colors">
                            追加する
                        </button>
                    </div>

                </form>

                @if ($shopping_lists->isNotEmpty())
                    <div class="max-w-7xl mx-auto mt-20">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                買う物</th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                <span class="sr-only">shoppinglists</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($shopping_lists as $item)
                                            <tr>
                                                <td class="px-3 py-4 text-sm text-gray-500">
                                                    <div class="inline-block">
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                                <td class="p-0 text-right text-sm font-medium">
                                                    <div class="flex justify-end">
                                                        <div class="px-3 py-4 text-sm text-gray-500 inline-block text-right">
                                                            {{ $item->price }}円
                                                        </div>
                                                        <div>
                                                            <form action="/shopping_lists/{{ $item->id }}" method="post"
                                                                class="inline-block text-gray-500 font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- updateメソッドで判別をするためにステータスを送る -->
                                                                <input type="hidden" name="status" value="{{ $item->status }}">
                                                                <button type="submit"
                                                                    class="bg-blue-500 py-4 w-20 text-white md:hover:bg-blue-600 transition-colors">買った</button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <a href="/shopping_lists/{{ $item->id }}/edit/"
                                                                class="inline-block text-center py-4 w-20 no-underline bg-green-500 text-white md:hover:bg-green-600 transition-colors">編集</a>
                                                        </div>
                                                        <div>
                                                            <form onsubmit="return deleteShoppingList()" action="/shopping_lists/{{ $item->id }}" method="post"
                                                                class="inline-block text-white font-medium"
                                                                role="menuitem" tabindex="-1">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="py-4 w-20 bg-red-500 md:hover:bg-red-600 transition-colors">削除</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
    <footer class="bg-amber-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-4 text-center">
                <p class="text-white text-sm">買い物張アプリ</p>
            </div>
        </div>
    </footer>
    <script>
        //削除の確認を表示する
        function deleteShoppingList() {
            if (confirm('本当に削除しますか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>
