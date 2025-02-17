<?php

namespace App\Admin\Widgets;

use App\Models\Product;
use Arrilot\Widgets\AbstractWidget;

class ProductsWidget extends AbstractWidget
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
        $count = Product::count();

        return view('voyager::dimmer', array_merge($this->config, [
            'icon' => 'voyager-basket',
            'title' => 'Счётчик продуктов',
            'text' => "Количество продуктов: {$count}",
            'button' => [
                'text' => 'Список',
                'link' => url('http://localhost:8000/admin/products'),
            ],
            'image' => 'storage/widgets/products.png'
        ]));
    }
}
