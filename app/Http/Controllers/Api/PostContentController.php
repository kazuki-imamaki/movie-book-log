<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WantMovie;
use App\Models\Image;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostContentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
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
            $destinationPath = 'movies/' . $fileName; // S3に保存するパス
            $disk->put($destinationPath, file_get_contents($tempFilePath));

            // 一時ファイルの削除
            unlink($tempFilePath);

            // アップロードされた画像のURL
            $imageUrl = $disk->url($fileName);
            // Log::debug("imageUrl", [$imageUrl]);

            $image = new Image;
            $image->name = $imageUrl;
            $image->save();
        }

        // 画像保存後に$image->idを設定
        $movie = new WantMovie;
        $movie->title = $request->title;
        $movie->memo = $request->memo;
        $movie->user_id = $request->userId;
        if (isset($image->id)) {
            $movie->images_id = $image->id;
        }
        $movie->is_done = $request->is_done;
        if ($movie->is_done == true) {
            $movie->date = $request->date;
            $movie->star = $request->star;
        }
        $movie->save();
    }
}
