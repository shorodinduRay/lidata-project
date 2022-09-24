<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\InvoiceHistory as ModelsInvoiceHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'paidBy',
        'amount',
        'pdf',
    ];

    public static $invoice;
    public static $file;
    protected static $fileDirectory;
    protected static $fileName;
    protected static $fileUrl;
    
    public static function saveFileForOne($pdfFile, $request)
    {
        $filepath = 'user/invoice/'.$request->userId.'.'.time().'.'.'invoice.pdf';

        self::$file = Storage::put('user/invoice/'.$request->userId.'.'.time().'.'.'invoice.pdf' , $pdfFile->output());
        if(self::$file)
        {
            self::$fileName = $request->userId.'.'.time().'.'.'invoice.pdf';
            self::$fileDirectory = 'user/invoice/';
            self::$fileUrl = self::$fileDirectory.self::$fileName;
            return self::$fileUrl;
        }
        else{
            return '';
        }
    }


    public static function createInvoice($file, $request, $paidBy)
    {
        self::$invoice = new InvoiceHistory();
        self::$invoice->userId = $request->userId;
        self::$invoice->paidBy = $paidBy;
        self::$invoice->amount = $request->price;
        self::$invoice->pdf = self::saveFileForOne($file, $request);
        self::$invoice->save();

    }
}
