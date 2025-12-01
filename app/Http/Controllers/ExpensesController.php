<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;

class ExpensesController extends Controller
{
    private $viewName = "expenses";

    public function index()
    {
        $branches = \BranchOfficesQuery::create()
            ->find();

       $concepts = \ExpenseConceptsQuery::create()
           ->find();

        return view('app.expenses.main')
            ->with('concepts', $concepts->toArray())
            ->with('branches', $branches->toArray())
            ->with('modules', $this->getAllowedModules($this->viewName));
    }

    public function searchExpenses(Request $request){
        $filterBranchOffice = $request->get('filterBranchOffice');
        $filterStartDay = $request->get('filterStartDay');
        $filterEndDay = $request->get('filterEndDay');

        $expenses = \ExpenseReportsQuery::create()
            ->useExpenseConceptsQuery('Concept')
                ->withColumn('Concept.Description', 'DescriptionConcept')
            ->endUse()
            ->useUsersQuery('User')
                ->withColumn('User.Name', 'NameUser')
            ->endUse()
            ->useBranchOfficesQuery('Branch')
                ->withColumn('Branch.Name', 'NameBranch')
            ->endUse()
            ->filterByDateExpense(array(
                'min' => $filterStartDay,
                'max' => $filterEndDay
            ))
            ->orderByDateExpense('DESC');

        if($filterBranchOffice != 0){
            $expenses->filterByIdBranchOffice($filterBranchOffice);
        }

        $expenses = $expenses->find();

        Log::info($expenses->toArray());

        return view('app.expenses.table')
            ->with('expenses', $expenses->toArray());
    }

    public function edit(Request $request){
        $cve = $request->get('cve');

        $expense = \ExpenseReportsQuery::create()
            ->findOneById($cve);

        return json_encode(array(
            'success' => true,
            'data' => $expense->toArray()
        ));
    }


    public function save(Request $request){
        $arrayErrores = $this->valdateFormExpense($request);
        if ( empty($arrayErrores) ) {
            $Id = $request->get('Id');
            $IdBranchOffice = $request->get('IdBranchOffice');
            $IdExpenseConcept = $request->get('IdExpenseConcept');
            $DateExpense = $request->get('DateExpense');
            $Amount = $request->get('Amount');
            $Description = $request->get('Description');


            $now = Carbon::now();
            if($Id == 0){
                $expense = new \ExpenseReports();
                $expense->setCreatedAt($now)
                    ->setUpdatedAt($now);
            }else{
                $expense = \ExpenseReportsQuery::create()
                    ->findOneById($Id);
                $expense->setUpdatedAt($now);
            }

            $expense->setIdBranchOffice($IdBranchOffice)
                ->setIdExpenseConcept($IdExpenseConcept)
                ->setDateExpense($DateExpense)
                ->setAmount($Amount)
                ->setDescription($Description)
                ->setIdUser(Auth::user()->id)
                ->save();

            return ['success' => true, 'errorMsg' => 'Gasto guardado correctamente'];
        }else{
            return ["success" => false, "errorMsg" => $arrayErrores[0]];
        }
    }

    public function valdateFormExpense(Request $request){
        $reglas = [
            'IdBranchOffice' => 'required|numeric|min:1',
            'IdExpenseConcept' => 'required|numeric|min:1',
            'DateExpense' => 'required',
            'Amount' => 'required|numeric|min:1',
            'Description' => 'required',
        ];

        $mensajes = [
            'IdBranchOffice.required' => 'Selecciona la sucursal',
            'IdBranchOffice.numeric' => 'Selecciona la sucursal',
            'IdBranchOffice.min' => 'Selecciona la sucursal',
            'IdExpenseConcept.required' => 'Selecciona el concepto del gasto',
            'IdExpenseConcept.numeric' => 'Selecciona el concepto del gasto',
            'IdExpenseConcept.min' => 'Selecciona el concepto del gasto',
            'DateExpense.required' => 'Selecciona la fecha del gasto',
            'Amount.required' => 'Ingresa el monto',
            'Amount.numeric' => 'Ingresa el monto',
            'Amount.min' => 'Ingresa el monto',
            'Description.required' => 'Ingresa el monto',
        ];

        $validador = Validator::make($request->toArray(), $reglas, $mensajes);

        return $validador->errors()->all();
    }
}
