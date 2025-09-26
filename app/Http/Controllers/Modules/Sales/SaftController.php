<?php

namespace App\Http\Controllers\Modules\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales\Customer;
use App\Models\Sales\Invoice;
use App\Models\Sales\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class SaftController extends Controller
{
    //
    public function generate(Request $request){
        $data = [];
        
        $invoice = Invoice::find(9);

    // return response($this->customer($invoice->order->customer),200)

    //dd($invoice->order->items->first()->item);

    return response($this->product($invoice->order->items->first()->item),200) 
         ->header('Content-Type', 'application/xml');
    } 

    public function header($data){
        $data['AuditFileVersion'] = '1.01_01';
        $data['CompanyID'] = '';
        $data['TaxRegistrationNumber'] = '';
        $data['TaxAccountingBasis']    = '';
        $data['CompanyName']  = '';
        $data['BusinessName'] = '';
        $data['CompanyAddress']['AddressDetail'] = '';
        $data['CompanyAddress']['City']          = '';
        $data['CompanyAddress']['Country']       = '';
        $data['FiscalYear'] = '';
        $data['StartDate'] = '';
        $data['EndDate'] = '';
        $data['CurrencyCode'] = '';
        $data['DateCreated'] = '';
        $data['TaxEntity'] = '';
        $data['ProductCompanyTaxID'] = '';
        $data['SoftwareValidationNumber'] = '';
        $data['ProductID'] = '';
        $data['ProductVersion'] = '';
        $data['Telephone'] = '';
        $data['Email'] = '';
        $data['Website'] = '';
        return view('modules.sales.saft.header', $data)->render();
    }

     public function customer(Customer $customer){

        $data['CustomerID']    = $customer->id;
        $data['AccountID']     = 'Desconhecido';
        $data['CustomerTaxID'] = $customer->tax_number ?? 'Consumidor final';
        $data['CompanyName']   = 'Consumidor final';
        $data['BillingAddress']['AddressDetail'] = Str ::limit($customer->address, 250, '') ?? 'Desconhecido';
        $data['BillingAddress']['City']          = 'Desconhecido';
        $data['BillingAddress']['Province']      = 'Desconhecido';
        $data['BillingAddress']['Country']       = 'Desconhecido';
        $data['SelfBillingIndicator']            = 0;
       
       
        return view('modules.sales.saft.customer', $data)->render();
    }

    public function invoice($data){

        $data['InvoiceNo']    = '';
        $data['DocumentStatus']['InvoiceStatus']     = '';
        $data['DocumentStatus']['InvoiceStatusDate'] = '';
        $data['DocumentStatus']['SourceID']          = '';
        $data['DocumentStatus']['SourceBilling']     = '';
        $data['Hash']    = '';
        $data['HashControl']    = '';
        $data['Period']    = '';
        $data['InvoiceDate']    = '';
        $data['InvoiceType']    = '';
        $data['SpecialRegimes']['SelfBillingIndicator']        = '';
        $data['SpecialRegimes']['CashVATSchemeIndicator']      = '';
        $data['SpecialRegimes']['ThirdPartiesBillingIndicator']= '';
        $data['SourceID']    = '';
        $data['SystemEntryDate']    = '';
        $data['CustomerID']    = '';
        $data['DocumentTotals']['TaxPayable']  = '';
        $data['DocumentTotals']['NetTotal']    = '';
        $data['DocumentTotals']['GrossTotal']  = '';
       
        return view('modules.sales.saft.invoice', $data)->render();
    }

    public function invoice_line($data){

        $data['LineNumber']    = '';
        $data['ProductCode']    = '';
        $data['ProductDescription']    = '';
        $data['Quantity']    = '';
        $data['UnitOfMeasure']    = '';
        $data['UnitPrice']    = '';
        $data['TaxPointDate']    = '';
        $data['References']['Reference']    = '';
        $data['References']['Reason']    = '';
        $data['Description']    = '';
        $data['DebitAmount']    = '';
        $data['CreditAmount']    = '';
        $data['Tax']['TaxType']    = '';
        $data['Tax']['TaxCountryRegion']    = '';
        $data['Tax']['TaxCode']    = '';
        $data['Tax']['TaxPercentage']    = '';
        $data['TaxExemptionReason']    = '';
        $data['TaxExemptionCode']    = '';

        return view('modules.sales.saft.invoice_line', $data)->render();
    }

    public function product(Item $item){

        if ($item->item_type == 'PRODUCT') 
            $data['ProductType']       = 'P'; 
        if ($item->item_type == 'SERVICE')
            $data['ProductType']       = 'S'; 
        

        $data['ProductCode']       = $item->id;
        $data['ProductGroup']      = '';
        $data['ProductDescription']= strip_tags($item->description);
        $data['ProductNumberCode'] = $item->id;
      
        return view('modules.sales.saft.product', $data)->render();
    }
    
    public function tax_table_entry($data){

        $data['TaxType'] = '';
        $data['TaxCode'] = '';
        $data['Description'] = '';
        $data['TaxPercentage'] = '';
        $data['TaxAmount'] = '';
             
        return view('modules.sales.saft.tax_table_entry', $data)->render();
    }

    
}
