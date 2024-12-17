<?php

namespace App\Http\Controllers;

use App\Events\NewsHidden;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function createTest(): string
    {
        $news = new News();
        $news->title = 'test title';
        $news->body = 'test body';
        $news->save();
        return 'created news with id:'. $news->id;
    }

    public function hiddenNews(Request $request, $id): string
    {
        $news = News::findOrFail($id);
        $news->update(['hidden' => true]);
        NewsHidden::dispatch($news);
        return 'updated news with id:' . $news->id;
    }
}
