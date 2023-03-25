<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Validator;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //商品のうち、「買ってない」状態のものだけを一覧に表示する
        $shopping_lists = ShoppingList::where('status', false)->get();
        return view('shopping_lists.index', compact('shopping_lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'shopping_name' => 'required|max:100',
        ];

        $messages = [
            'required' => '入力して下さい', 'max' => '100文字以下にして下さい'
        ];

        validator::make($request->all(), $rules, $messages)->validate();

        //モデルをインスタンス化
        $shopping_list = new ShoppingList;
        //shopping_listインスタンスのnameプロパティに商品名を割り当てる
        $shopping_list->name = $request->input('shopping_name');
        //データベースに保存
        $shopping_list->save();
        //ページをリダイレクト
        return redirect('/shopping_lists');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $shopping_list = ShoppingList::find($id);
        return view('shopping_lists.edit', compact('shopping_list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->status == null) {
            $rules = [
                'shopping_name' => 'required|max:100',
            ];
    
            $messages = [
                'required' => '入力して下さい', 'max' => '100文字以下にして下さい'
            ];
    
            validator::make($request->all(), $rules, $messages)->validate();
    
            //該当する商品を検索
            $shopping_list = ShoppingList::find($id);
            //shopping_listインスタンスのnameプロパティに商品名を割り当てる
            $shopping_list->name = $request->input('shopping_name');
            //shopping_listインスタンスのpriceプロパティに金額を割り当てる
            $shopping_list->price = $request->input('shopping_price');
            //データベースに保存
            $shopping_list->save();
        } else {
            //該当の商品を検索
            $shopping_list = ShoppingList::find($id);
            //商品を「買った」状態に変える
            $shopping_list->status = true;
            //データベースに保存
            $shopping_list->save();
        }
        //ページをリダイレクト
        return redirect('/shopping_lists');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //商品を探して、削除する
        ShoppingList::find($id)->delete();
        //リダイレクト
        return redirect('/shopping_lists');
    }
}
