<?php

namespace App\Http\Controllers\Operator;

class InfografisController extends InformasiCategoryController
{
    protected string $category = 'Infografis';
    protected string $viewPrefix = 'operator.infografis';
    protected string $routeName = 'operator.infografis';
    protected string $label = 'Infografis';
}
