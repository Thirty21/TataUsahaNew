<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use App\Models\Config;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('pages.datas.student.index', [
            'data' => Student::render($request->search),
            'search' => $request->search,
        ]);
    }

    public function print(Request $request): View
    {
        $datas = __('menu.datas.menu');
        $student = __('menu.datas.student');
        $title = App::getLocale() == 'id' ? "$datas $student" : "$student $datas";
        return view('pages.datas.student.printStudent', [
            'data' => Student::all(),
            'config' => Config::pluck('value', 'code')->toArray(),
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        try {
         // Validasi dan simpan data
        $data = $request->validated();

        // Pastikan bahwa gender yang dikirimkan adalah salah satu dari opsi yang valid
        if (!in_array($data['gender'], ['Laki-laki', 'Perempuan'])) {
            return back()->with('error', 'Invalid jenis kelamin value.');
        }
            Student::create($request->validated());
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        try {
            $student->update($request->validated());
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Classification $classification
     * @return RedirectResponse
     */
    public function destroy(Student $student): RedirectResponse
    {
        try {
            $student->delete();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
