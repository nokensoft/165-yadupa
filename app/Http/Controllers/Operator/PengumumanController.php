<?php

namespace App\Http\Controllers\Operator;

class PengumumanController extends InformasiCategoryController
{
    protected string $category = 'Pengumuman';
    protected string $viewPrefix = 'operator.pengumuman';
    protected string $routeName = 'operator.pengumuman';
    protected string $label = 'Pengumuman';
}
