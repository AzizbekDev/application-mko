<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\CardRestoreApplication as CardRestore;

class CardRestoreController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('card_restore_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CardRestore::select(sprintf('%s.*', (new CardRestore)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'card_restore_show';
                $editGate      = 'card_restore_edit';
                $deleteGate    = 'card_restore_delete';
                $crudRoutePart = 'card-restore';
                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->diffForHumans() : "";
            });
            $table->rawColumns(['actions', 'placeholder']);
            return $table->make(true);
        }

        return view('admin.application-restore.index');
    }

    public function show(CardRestore $card_restore)
    {
        abort_if(Gate::denies('card_restore_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.application-restore.show', compact('card_restore'));
    }

    public function edit(CardRestore $card_restore)
    {
        abort_if(Gate::denies('card_restore_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        dd($card_restore);
        return view('admin.application-restore.edit', compact('card_restore'));
    }

    public function update(Request $request, CardRestore $card_restore)
    {
        dd($card_restore);
        $card_restore->update($request->all());
        return redirect()->route('admin.application-restore.index');
    }


}
