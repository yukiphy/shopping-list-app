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
                <p class="text-white text-xl">買い物帳-編集画面</p>
            </div>
        </div>
    </header>

    <main class="grow grid place-items-center">
        <div class="w-full mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <form action="/shopping_lists/{{ $shopping_list->id }}" method="post" class="mt-10">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col items-center">
                        <label class="w-full max-w-3xl mx-auto">
                            <input
                                class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                type="text" name="shopping_name" value="{{ $shopping_list->name }}" />
                            @error('shopping_name')
                                <div class="mt-3">
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                </div>
                            @enderror
                            <input
                                class="mt-4 placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                type="text" name="shopping_price" value="{{ $shopping_list->price }}" />
                        </label>

                        <div class="mt-8 w-full flex items-center justify-center gap-10">
                            <a href="/shopping_lists" class="p-4 text-white w-full max-w-[12rem] rounded-md inline-block text-center shrink-0 no-underline bg-gray-500 md:hover:bg-gray-600">
                                戻る
                            </a>
                            <button type="submit"
                                class="p-4 bg-red-500 text-white w-full max-w-[12rem] rounded-md hover:bg-red-600 transition-colors">
                                編集する
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </main>
    <footer class="bg-amber-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-4 text-center">
                <p class="text-white text-sm">買い物帳アプリ</p>
            </div>
        </div>
    </footer>
</body>

</html>
