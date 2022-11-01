<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'status',
        'type',
        'detail',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /**
     * 一覧画面表示用にitemsテーブルから全てのデータを取得
     */
    public function findAllItems()
    {
        return Item::all();
    }

    /**
     * リクエストされたIDをもとにitemsテーブルのレコードを1件取得
     */
    public function findItemById($id)
    {
        return Item::find($id);
    }

    /**
     * 削除処理
     */
    public function deleteItemById($id)
    {
        return $this->destroy($id);
    }
}
