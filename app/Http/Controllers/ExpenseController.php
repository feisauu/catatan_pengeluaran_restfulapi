<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveExpenseRequest;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DeleteExpenseRequest;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            // Jika request berupa JSON (API)
            try {
                $expenses = Expense::latest()->get();
                return response()->json($expenses, Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to fetch expenses', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            // Jika request bukan JSON (tampilan web)
            $expenses = Expense::all();
            return view('expenses.index', compact('expenses'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
        ]);

        $expense = new Expense();
        $expense->type = $validatedData['type'];
        $expense->description = $validatedData['description'];
        $expense->amount = $validatedData['amount'];
        $expense->expense_date = $validatedData['expense_date'];
        $expense->save();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Expense added successfully', 'expense' => $expense], 201);
        }

        return redirect()->route('expenses.index')->with('success', 'Data telah ditambahkan');
    }



    public function create()
    {
        return view('expenses.create');
    }

    public function getUserOfExpense($expenseId)
    {
        // Temukan pengeluaran berdasarkan ID yang diberikan
        $expense = Expense::find($expenseId);

        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], 404);
        }

        // Akses data pengguna terkait dengan pengeluaran
        $user = $expense->user;

        // Lakukan sesuatu dengan data user
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);

        return response()->json($expense, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(SaveExpenseRequest $request, Expense $expense)
    {
        try {
            $expense->update($request->validated());

            // Jika request datang dari browser, kembalikan tampilan HTML
            if ($request->wantsJson()) {
                return response()->json($expense, 200);
            } else {
                return redirect()->route('expenses.index')->with('success', 'Expense updated successfully');
            }
        } catch (ModelNotFoundException $e) {
            // Jika request datang dari browser, kembalikan tampilan HTML
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Expense not found'], 404);
            } else {
                return redirect()->route('expenses.index')->with('error', 'Expense not found');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();

            if (request()->expectsJson()) {
                return response()->json(['data' => true]);
            } else {
                return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully');
            }
        } catch (ModelNotFoundException $e) {
            if (request()->expectsJson()) {
                return response()->json(['message' => 'Expense not found'], 404);
            } else {
                return redirect()->route('expenses.index')->with('error', 'Expense not found');
            }
        }
    }


    public function filterByDateRange(Request $request): JsonResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])->get();

        return response()->json($expenses, Response::HTTP_OK);
    }

    public function home()
    {
        $user = Auth::user();

        // Hitung total pengeluaran
        $totalExpenses = Expense::sum('amount');

        // Hitung total pemasukan
        $totalIncomes = Income::sum('amount');

        // Hitung selisih antara pemasukan dan pengeluaran
        $incomeExpenseDifference = $totalIncomes - $totalExpenses;

        return view('home', [
            'user' => $user,
            'totalExpenses' => $totalExpenses,
            'totalIncomes' => $totalIncomes,
            'incomeExpenseDifference' => $incomeExpenseDifference,
        ]);
    }


    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }
}
