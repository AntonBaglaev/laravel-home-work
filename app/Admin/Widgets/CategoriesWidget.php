<?php

namespace App\Admin\Widgets;

use App\Models\Category;
use Arrilot\Widgets\AbstractWidget;

class CategoriesWidget extends AbstractWidget
{
    protected $config = [];

    /**
     * Отображение виджета
     * @return true
     */
    public function shouldBeDisplayed()
    {
        return true;
    }

    public function run()
    {
        $count = Category::count();

        return view('voyager::dimmer', array_merge($this->config, [
            'icon' => 'voyager-categories',
            'title' => 'Счётчик категорий',
            'text' => "Количество категорий: {$count}",
            'button' => [
                'text' => 'Список',
                'link' => url('http://localhost:8000/admin/categories'),
            ],
            'image' => 'storage/widgets/categories.png'
        ]));
    }
}
