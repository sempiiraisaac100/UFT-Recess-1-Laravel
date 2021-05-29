<?php

namespace App\Http\Controllers;

use App\DataTables\TreasuryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTreasuryRequest;
use App\Http\Requests\UpdateTreasuryRequest;
use App\Repositories\TreasuryRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TreasuryController extends AppBaseController
{
    /** @var  TreasuryRepository */
    private $treasuryRepository;

    public function __construct(TreasuryRepository $treasuryRepo)
    {
        $this->treasuryRepository = $treasuryRepo;
    }

    /**
     * Display a listing of the Treasury.
     *
     * @param TreasuryDataTable $treasuryDataTable
     * @return Response
     */
    public function index(TreasuryDataTable $treasuryDataTable)
    {
        return $treasuryDataTable->render('treasuries.index');
    }

    /**
     * Show the form for creating a new Treasury.
     *
     * @return Response
     */
    public function create()
    {
        return view('treasuries.create');
    }

    /**
     * Store a newly created Treasury in storage.
     *
     * @param CreateTreasuryRequest $request
     *
     * @return Response
     */
    public function store(CreateTreasuryRequest $request)
    {
        $input = $request->all();

        $treasury = $this->treasuryRepository->create($input);

        Flash::success('Treasury saved successfully.');

        return redirect(route('treasuries.index'));
    }

    /**
     * Display the specified Treasury.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $treasury = $this->treasuryRepository->find($id);

        if (empty($treasury)) {
            Flash::error('Treasury not found');

            return redirect(route('treasuries.index'));
        }

        return view('treasuries.show')->with('treasury', $treasury);
    }

    /**
     * Show the form for editing the specified Treasury.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $treasury = $this->treasuryRepository->find($id);

        if (empty($treasury)) {
            Flash::error('Treasury not found');

            return redirect(route('treasuries.index'));
        }

        return view('treasuries.edit')->with('treasury', $treasury);
    }

    /**
     * Update the specified Treasury in storage.
     *
     * @param  int              $id
     * @param UpdateTreasuryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTreasuryRequest $request)
    {
        $treasury = $this->treasuryRepository->find($id);

        if (empty($treasury)) {
            Flash::error('Treasury not found');

            return redirect(route('treasuries.index'));
        }

        $treasury = $this->treasuryRepository->update($request->all(), $id);

        Flash::success('Treasury updated successfully.');

        return redirect(route('treasuries.index'));
    }

    /**
     * Remove the specified Treasury from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $treasury = $this->treasuryRepository->find($id);

        if (empty($treasury)) {
            Flash::error('Treasury not found');

            return redirect(route('treasuries.index'));
        }

        $this->treasuryRepository->delete($id);

        Flash::success('Treasury deleted successfully.');

        return redirect(route('treasuries.index'));
    }
}
