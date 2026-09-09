<?php

namespace App\Http\Controllers\Operator;

class AgendaController extends InformasiCategoryController
{
    protected string $category = 'Agenda';
    protected string $viewPrefix = 'operator.agenda';
    protected string $routeName = 'operator.agenda';
    protected string $label = 'Agenda';
}
