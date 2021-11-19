<?php
//phpcs:disable
namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Task;

class HomeController extends Controller
{
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index(): Response
    {
        $tasks = $this->task
            ->with('type:id,type_name')
            ->with('owner:id,full_name')
            ->get();

        return Inertia::render('Home/Index', compact(
            'tasks'
        ));
    }
}
