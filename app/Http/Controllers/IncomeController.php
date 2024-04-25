<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveIncomeRequest;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeleteIncomeRequest;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            // Jika request berupa JSON (API)
            try {
                $incomes = Income::latest()->get();
                return response()->json($incomes, Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to fetch incomes', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            // Jika request bukan JSON (tampilan web)
            $incomes = Income::all();
            return view('incomes.index', compact('incomes'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'source' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'income_date' => 'required|date',
        ]);

        $income = new Income();
        $income->source = $validatedData['source'];
        $income->description = $validatedData['description'];
        $income->amount = $validatedData['amount'];
        $income->income_date = $validatedData['income_date'];
        $income->save();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Income added successfully', 'income' => $income], 201);
        }

        return redirect()->route('incomes.index')->with('success', 'Data telah ditambahkan');
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function show(string $id): JsonResponse
    {
        $income = Income::findOrFail($id);
        return response()->json($income, Response::HTTP_OK);
    }

    public function update(SaveIncomeRequest $request, Income $income)
    {
        try {
            $income->update($request->validated());

            // Jika request datang dari browser, kembalikan tampilan HTML
            if ($request->wantsJson()) {
                return response()->json($income, 200);
            } else {
                return redirect()->route('incomes.index')->with('success', 'Income updated successfully');
            }
        } catch (ModelNotFoundException $e) {
            // Jika request datang dari browser, kembalikan tampilan HTML
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Income not found'], 404);
            } else {
                return redirect()->route('incomes.index')->with('error', 'Income not found');
            }
        }
    }

    public function destroy($id)
    {
        try {
            $income = Income::findOrFail($id);
            $income->delete();

            if (request()->expectsJson()) {
                return response()->json(['data' => true]);
            } else {
                return redirect()->route('incomes.index')->with('success', 'Income deleted successfully');
            }
        } catch (ModelNotFoundException $e) {
            if (request()->expectsJson()) {
                return response()->json(['message' => 'Income not found'], 404);
            } else {
                return redirect()->route('incomes.index')->with('error', 'Income not found');
            }
        }
    }

    public function filterByDateRange(Request $request): JsonResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $incomes = Income::whereBetween('income_date', [$startDate, $endDate])->get();

        return response()->json($incomes, Response::HTTP_OK);
    }

    public function home()
    {
        $user = Auth::user();

        // Hitung total pemasukan
        $totalIncomes = Income::sum('amount');

        // Hitung total pengeluaran
        $totalExpenses = Expense::sum('amount');

        // Hitung selisih antara total pemasukan dan total pengeluaran
        $incomeExpenseDifference = $totalIncomes - $totalExpenses;

        return view('home', [
            'user' => $user,
            'totalIncomes' => $totalIncomes,
            'totalExpenses' => $totalExpenses,
            'incomeExpenseDifference' => $incomeExpenseDifference,
        ]);
    }



    public function edit(Income $income)
    {
        return view('incomes.edit', compact('income'));
    }
}
