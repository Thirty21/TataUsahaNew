<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Enums\Config as ConfigEnum;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Config;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use TheSeer\Tokenizer\Exception;
use Illuminate\Http\Request;

class AbsenSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        return view('pages.absen.siswa', [
            'data' => Absen::render($request->search),
            'search' => $request->search,
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param StoreSiswaRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        try {
            $newAbsen = $request->validated();
            Absen::create($newAbsen);
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSiswaRequest $request
     * @param User $absen
     * @return RedirectResponse
     */
    public function update(UpdateSiswaRequest $request, Absen $absen): RedirectResponse
    {
        try {
            $newAbsen = $request->validated();
            $absen->update($newAbsen);
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Absen $absen
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Absen $absen): RedirectResponse
    {
        try {
            $absen->delete();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {   
            return back()->with('error', $exception->getMessage());
        }
    }
}
