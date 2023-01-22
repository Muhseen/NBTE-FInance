<?php

use App\Http\Controllers\ApprovedPaymentController;
use App\Http\Controllers\AuditVoucherController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\NCOAController;
use App\Http\Controllers\VoucherApprovalController;
use App\Http\Controllers\VoucherCheckController;
use App\Models\Voucher;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherMinutesController;
use App\Models\Budget;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\CashOfficeController;
use App\Http\Controllers\FundingAccountsController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\NPAController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentReport;

use App\Http\Controllers\StaffDebtorController;
use App\Http\Controllers\TrialBalanceController;
use App\Http\Controllers\IncomeExpenditureController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\SJVController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    //expenditure control routes
    Route::prefix('')->group(function () {
        Route::resource('/voucher', VoucherController::class);
        Route::resource('/checkVoucher', VoucherCheckController::class);
        Route::resource('/payments', ApprovedPaymentController::class);
        //Voucher approval after checking routes
        Route::get('/approveVouchers', [VoucherApprovalController::class, 'index']);
        Route::get('/approveVoucherPreview/{id}', [VoucherApprovalController::class, 'preview']);
        Route::post('/approveVoucher', [VoucherApprovalController::class, 'approve']);
        //Voucher preparaton assignment routes
        Route::post('/assignTo', [ApprovedPaymentController::class, 'assign']);
        Route::get('/assigned', [ApprovedPaymentController::class, 'assigned'])->name('payments.assigned');

        Route::get('recheck/{id}', [VoucherApprovalController::class, 'recheck']);
        Route::get('reprepare/{id}', [VoucherCheckController::class, 'reprepare']);
    });

    //Audit Routes
    Route::prefix('')->group(function () {
        Route::get('/viewAuditableVouchers', [AuditVoucherController::class, 'index']);
        Route::get('/auditPreview/{id}', [AuditVoucherController::class, 'preview']);
    });

    //Budget Routes
    Route::prefix('')->group(function () {

        Route::resource('/budget', BudgetController::class);
        Route::get('/budgetDashboard', [BudgetController::class, 'dashboard'])->name('budget.dashboard');
        Route::get('uplaodRelease', [BudgetController::class, 'uploadRelease']);

        Route::get('getCodeBudgetDetails', function (Request $request) {
            $budget = Budget::where('account_code', $request->code)->where('year', Carbon::now()->year)->first();
            return "Available : " . Str::currency($budget->approved - $budget->committed);
        });
    });
    Route::prefix('')->group(function () {
        Route::get('/pendingPVLiabilities', [CashOfficeController::class, 'pendingPVLiabilities']);
        Route::resource('/payment', PaymentController::class);
        Route::get('/coReports', [CashOfficeController::class, 'selectReports']);
        Route::get('/ledger', [LedgerController::class, 'ledger']);
        Route::post('/generalLedger', [LedgerController::class, 'generalLedger']);
        Route::post('/sjv', [SJVController::class, 'process']);
        Route::post('/paymentReports', [PaymentReport::class, 'generate']);
    });

    Route::prefix('')->group(function () {
        Route::post('voucherMinutes', [VoucherMinutesController::class, 'store'])->name('voucherMinutes.store');
    });


    //
    Route::post('/forwardToCashOffice', [AuditVoucherController::class, 'forward']);
    Route::post('/returnToEC', [AuditVoucherController::class, 'return']);
    //banks
    Route::resource('banks', BankController::class);
    Route::resource('/ncoa', NCOAController::class);


    Route::prefix('')->group(function () {
        Route::resource('payVoucher', PaymentController::class);
        Route::resource('fundingAccount', FundingAccountsController::class);
    });

    Route::prefix('')->group(function () {
        Route::get('/npa', [NPAController::class, 'issueView']);
        Route::post('/npa', [NPAController::class, 'issue']);
        Route::post('/retireNPA', [NPAController::class, 'retire']);
        Route::get('/retireNPA', [NPAController::class, 'retireView']);
        Route::get('/userNPA', [NPAController::class, 'userNPA']);
        Route::get('/adjustment', [AdjustmentController::class, 'index']);
        Route::post('/adjustment', [AdjustmentController::class, 'process']);
        Route::resource('/staffDebtor', StaffDebtorController::class);
    });

    Route::prefix('')->group(function () {
        Route::get('/trialbalance', [TrialBalanceController::class, 'process'])->name('trialbalance');
    });

    ROute::prefix('')->group(function () {
        Route::get('/income', [IncomeController::class, 'index']);
        Route::post('/income', [IncomeController::class, 'process']);
        Route::get('/incomeExpenditure', [IncomeExpenditureController::class, 'incomeExpenditureReport']);
        Route::get('/incomeReports', [IncomeExpenditureController::class, 'report']);
    });

    //Journal Routes
    Route::prefix('')->group(function () {
        Route::get('journal', [JournalController::class, 'index']);
        Route::post('journal', [JournalController::class, 'process']);
    });
});