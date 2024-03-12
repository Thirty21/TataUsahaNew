<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use App\Models\Config;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('pages.datas.staff.index', [
            'data' => Staff::render($request->search),
            'search' => $request->search,
        ]);
    }

    public function print(Request $request): View
    {
        $datas = __('menu.datas.menu');
        $staff = __('menu.datas.staff');
        $title = App::getLocale() == 'id' ? "$datas $staff" : "$staff $datas";
        return view('pages.datas.staff.printStaff', [
            'data' => Staff::all(),
            'config' => Config::pluck('value', 'code')->toArray(),
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStaffRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStaffRequest $request): RedirectResponse
    {
        try {

            // Validasi dan simpan data
            $data = $request->validated();

            // Pastikan bahwa gender yang dikirimkan adalah salah satu dari opsi yang valid
            if (!in_array($data['gender'], ['Laki-laki', 'Perempuan'])) {
                return back()->with('error', 'Invalid jenis kelamin value.');
            }
            Staff::create($request->validated());
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStaffRequest $request
     * @param Staff $staff
     * @return RedirectResponse
     */
    public function update(UpdateStaffRequest $request, Staff $staff): RedirectResponse
    {
        try {
            $staff->update($request->validated());
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            $errorMessage = $exception->getMessage();
            return back()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     * @return RedirectResponse
     */
    public function destroy(Staff $staff): RedirectResponse
    {
        try {
            $staff->delete();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
