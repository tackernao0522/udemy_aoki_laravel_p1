<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\ContactForm;
use App\Services\CheckFormService;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $contacts = ContactForm::select('id', 'name', 'title', 'created_at')->get();

        $search = $request->search;
        $query = ContactForm::search($search); // クエリのローカルスコープ

        $contacts = $query->select('id', 'name', 'title', 'created_at')->paginate(20);
        // $contacts = ContactForm::select('id', 'name', 'title', 'created_at')->paginate(20);
        // $contacts = ContactForm::all();
        // dd($contacts);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        ContactForm::create([
            'name' => $request->name,
            'title' => $request->title,
            'email' => $request->email,
            'url' => $request->url,
            'gender' => $request->gender,
            'age' => $request->age,
            'contact' => $request->contact,
        ]);

        // $contacts = new ContactForm();
        // $contacts->name = $request->name;
        // $contacts->title = $request->title;
        // $contacts->email = $request->email;
        // $contacts->url = $request->url;
        // $contacts->gender = $request->gender;
        // $contacts->age = $request->age;
        // $contacts->contact = $request->contact;
        // $contacts->save();

        return to_route('contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = ContactForm::findOrFail($id);

        // if ($contact->gender === 0) {
        //     $gender = '男性';
        // } else {
        //     $gender = '女性';
        // }

        $gender = CheckFormService::checkGender($contact);

        // if ($contact->age === 1) {
        //     $age = '〜19歳';
        // }
        // if ($contact->age === 2) {
        //     $age = '20歳〜29歳';
        // }
        // if ($contact->age === 3) {
        //     $age = '30歳〜39歳';
        // }
        // if ($contact->age === 4) {
        //     $age = '40歳〜49歳';
        // }
        // if ($contact->age === 5) {
        //     $age = '50歳〜59歳';
        // }
        // if ($contact->age === 6) {
        //     $age = '60歳〜';
        // }

        $age = CheckFormService::checkAge($contact);

        return view('contacts.show', compact('contact', 'gender', 'age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = ContactForm::findOrFail($id);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, $id)
    {
        $contact = ContactForm::findOrFail($id);
        $contact->name = $request->name;
        $contact->title = $request->title;
        $contact->email = $request->email;
        $contact->url = $request->url;
        $contact->gender = $request->gender;
        $contact->age = $request->age;
        $contact->contact = $request->contact;
        // dd($contact->name);

        // if ($contact->gender == 0) {
        //     $gender = '男性';
        // } else {
        //     $gender = '女性';
        // }

        // if ($contact->age == 1) {
        //     $age = '〜19歳';
        // }
        // if ($contact->age == 2) {
        //     $age = '20歳〜29歳';
        // }
        // if ($contact->age == 3) {
        //     $age = '30歳〜39歳';
        // }
        // if ($contact->age == 4) {
        //     $age = '40歳〜49歳';
        // }
        // if ($contact->age == 5) {
        //     $age = '50歳〜59歳';
        // }
        // if ($contact->age == 6) {
        //     $age = '60歳〜';
        // }

        $contact->save();

        // return view('contacts.show', compact('contact', 'gender', 'age'));
        return to_route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = ContactForm::findOrFail($id);
        $contact->delete();

        return to_route('contacts.index');
    }
}
