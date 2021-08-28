<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['address','talk','sales_email'];
    public function storeContactInfor($request){
            $contact = new Contact();
            $contact->fill($request->all());
            $contact->save();
    }
}
