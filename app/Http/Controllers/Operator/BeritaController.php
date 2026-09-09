<?php

namespace App\Http\Controllers\Operator;

class BeritaController extends InformasiCategoryController
{
    protected string $category = 'Berita';
    protected string $viewPrefix = 'operator.berita';
    protected string $routeName = 'operator.berita';
    protected string $label = 'Berita';
}
