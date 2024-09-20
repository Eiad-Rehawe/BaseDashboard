<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ContactsDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends BackendController
{
    

    public function __construct(ContactsDataTable $dataTable,Contact $data)
    {
        // $this->middleware(['permission:Display Contacts|عرض الرسائل'], ['only' => ['index', 'show']]);


        parent::__construct($dataTable,$data);
    }
}
