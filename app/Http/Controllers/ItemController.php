<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
    /**
        * 削除処理
        *
        * @param Request $request
        * @param Item $item
        * @return Response
        */
    public function destroy($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $item = Item::find($id);
        // レコードを削除
        $item->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('item.index');
    }

    /**
     * 詳細画面の表示
     */
    public function show($id)
    {
        $item = Item::find($id);

        return view('item.show', compact('item'));
    }

    /**
     * 編集画面の表示
     */
    public function edit($id)
    {
        $item = Item::find($id);

        return view('item.edit', compact('item'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $updateBook = $this->item->updateBook($request, $item);

        return redirect()->route('item.index');
    }


}
