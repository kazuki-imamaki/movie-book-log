<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WantMovie;
use App\Models\Image;
use Illuminate\Http\Request;

class PutContentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $movie = WantMovie::where('id', $request->id)->firstOrFail();
        $image = Image::where('id', $movie->images_id)->firstOrFail();

        // 画像の取得
        if ($request->poster_path != null) {
            $image_url = $request->poster_path;

            $response = Http::get($image_url);
            // 一時ファイルの保存
            $fileName = uniqid() . '.jpg'; // ファイル名の生成（一意の値を使用する例）
            $tempFilePath = storage_path('app/public/temp/' . $fileName); // 一時ファイルの保存先パス
            file_put_contents($tempFilePath, $response->getBody());


            // S3へのアップロード
            $disk = Storage::disk('s3');
            $disk->put($fileName, file_get_contents($tempFilePath));

            // 一時ファイルの削除
            unlink($tempFilePath);

            // アップロードされた画像のURL
            $imageUrl = $disk->url($fileName);

            // $image = new Image;
            $image->name = $imageUrl;
            $image->save();
        } else {
            $movie->images_id = null;
        }

        $movie->title = $request->title;
        $movie->memo = $request->memo;
        // $movie->poster_path = $request->poster_path;
        // $movie->poster_path = str_replace("154", "342", $movie->poster_path);
        $movie->is_done = $request->is_done;
        $movie->date = $request->date;
        $movie->star = $request->star;
        $movie->save();
    }
}
