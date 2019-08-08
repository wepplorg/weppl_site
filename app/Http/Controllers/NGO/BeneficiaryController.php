<?php
namespace App\Http\Controllers\NGO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Beneficiary;
use App\Models\BeneficiaryMedia;
use Auth;
use Session;
use App\Models\NgoUser;
use Mail;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Str;
class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending_beneficiaries = Beneficiary::where('status', '=', 1)->where('ngo_id', '=', Auth::user()
            ->id)
            ->get();
        $approved_beneficiaries = Beneficiary::where('status', '=', 2)->where('ngo_id', '=', Auth::user()
            ->id)
            ->get();
        $rejected_beneficiaries = Beneficiary::where('status', '=', 3)->where('ngo_id', '=', Auth::user()
            ->id)
            ->get();
        return view('ngo.beneficiary.index', compact('pending_beneficiaries', 'approved_beneficiaries', 'rejected_beneficiaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //return $id;
        $categories = Category::where('status', '=', 1)->get();
        $features = Feature::where('status', '=', 1)->get();
        $ngo_user = NgoUser::where('id', '=', $id)->first();
        $ngo_user['age'] = Carbon::parse($ngo_user->date_of_birth)->age;

        return view('ngo.beneficiary.create', compact('categories', 'features', 'ngo_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array_except($request->all() , ['_token', 'image','display_main_image','document','campaign_duration']);
        $data['ngo_id'] = Auth::user()->id;
        $duration = $request->get('campaign_duration');
        $data['start_date'] = date('Y-m-d');
        $data['end_date']=date('Y-m-d',strtotime("+ $duration days"));
          //return $data['end_date'];
       // $beneficiary = Beneficiary::create($data);
        return $request->file('image');
        if($request->file('display_main_image'))
        {
            //return "hi";
            $files = $request->file('display_main_image');
            return $files;
            $i = 1;
            foreach ($files as $file)
            {
                $imageName =  time().'.'.$file->getClientOriginalExtension();
                $image =$file;
                $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/images/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/images/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                //$profile_logo['logo']=$imageName;
              //  $filename = $file->store('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/images');
               // $filename = str_replace('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/images/', '', $filename);
                $photo['display_main_image'] = $imageName;
               // $photo['beneficiary_id'] = $beneficiary->id;
                $i++;
                Beneficiary::where('id','=',$beneficiary->id)->update($photo);
            }
        }
        if($request->file('image'))
        {
            //return "hi";
            $files = $request->file('image');

            $i = 1;
            foreach ($files as $file)
            {
                $imageName =  time().'.'.$file->getClientOriginalExtension();
                $image =$file;
                $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/images/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/images/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                //$profile_logo['logo']=$imageName;
              //  $filename = $file->store('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/images');
               // $filename = str_replace('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/images/', '', $filename);
                $photo['image'] = $imageName;
                $photo['beneficiary_id'] = $beneficiary->id;
                $i++;
                BeneficiaryMedia::create($photo);
            }
        }
        if ($request->file('document'))
        {
            $files = $request->file('document');
            //return $files;
            $i = 1;
            foreach ($files as $file)
            {
                $imageName =  time().'.'.$file->getClientOriginalExtension();
                $image =$file;
                $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/document/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/document/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
              //$filename = $file->store('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/document');
              //$filename = str_replace('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/document/', '', $filename);
                $document['document'] = $imageName;
                $i++;
                Beneficiary::where('id', '=', $beneficiary->id)
                    ->update($document);
            }
        }
        $user = Auth::user();
        $mail = Mail::send('email.beneficiary_add', ['name' => $user->name, 'beneficiary_name' => $beneficiary
            ->ngo_users
            ->name], function ($message) use ($user)
        {
            $message->to($user->email, $user->name)
                ->subject('weppl beneficiary addition');
        });
        if ($beneficiary)
        {
            Session::flash('message', 'Successfully sent for approval!');
            return redirect('ngo/beneficiary');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::where('status', '=', 1)->get();
        $features = Feature::where('status', '=', 1)->get();
        $beneficiary = Beneficiary::find($id);
        $ngo_user = NgoUser::where('id', '=', $beneficiary->ngo_user_id)->first();
        $ngo_user['age'] = Carbon::parse($ngo_user->date_of_birth)->age;
        $date1_ts = strtotime($beneficiary->start_date);
        $date2_ts = strtotime($beneficiary->end_date);
        $diff = $date2_ts - $date1_ts;
        $no_of_days = round($diff / 86400);
        return view('ngo.beneficiary.show', compact('beneficiary', 'categories', 'features','ngo_user','no_of_days'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('status', '=', 1)->get();
        $features = Feature::where('status', '=', 1)->get();
        $beneficiary = Beneficiary::find($id);
        $ngo_user = NgoUser::where('id', '=', $beneficiary->ngo_user_id)->first();
        $ngo_user['age'] = Carbon::parse($ngo_user->date_of_birth)->age;
        $date1_ts = strtotime($beneficiary->start_date);
        $date2_ts = strtotime($beneficiary->end_date);
        $diff = $date2_ts - $date1_ts;
        $no_of_days = round($diff / 86400);
        return view('ngo.beneficiary.edit', compact('beneficiary', 'categories', 'features','ngo_user','no_of_days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_except($request->all() , ['_token', '_method', 'image', 'document', 'change_image_boolean', 'change_document_boolean','campaign_duration']);
        $data['slug']=Str::slug($request->get('title'), '-');
        $data['ngo_id'] = Auth::user()->id;
        $duration = $request->get('campaign_duration');
        $data['start_date'] = date('Y-m-d');
        $data['end_date']=date('Y-m-d',strtotime("+ $duration days"));
        $beneficiary = Beneficiary::where('id', '=', $id)->update($data);
        $beneficiary_detail = Beneficiary::find($id);
        if ($request->file('image'))
        {
            //return "hi";
            $files = $request->file('image');

            $i = 1;
            foreach ($files as $file)
            {
                //return $file;
                $imageName =  time().'.'.$file->getClientOriginalExtension();
                $image =$file;
                $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/images/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/images/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
                //$profile_logo['logo']=$imageName;
              //  $filename = $file->store('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/images');
               // $filename = str_replace('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/images/', '', $filename);
                $photo['image'] = $imageName;
                $photo['beneficiary_id'] = $beneficiary->id;
                $i++;
                BeneficiaryMedia::where('beneficiary_id', '=', $beneficiary_detail->id)
                    ->update($photo);
            }
        }
        if ($request->file('document'))
        {
            $files = $request->file('document');
            //return $files;
            $i = 1;
            foreach ($files as $file)
            {
                //return $file;          
                $imageName =  time().'.'.$file->getClientOriginalExtension();
                $image =$file;
                $t = Storage::disk('s3')->put('ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/document/'.$imageName, file_get_contents($image), 'Gallery');
                $url='ngo/'.Auth::user()->id.'/beneficiary/'.$beneficiary->id.'/document/'.$imageName;
                $imageName = Storage::disk('s3')->url($url);
              //$filename = $file->store('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/document');
              //$filename = str_replace('public/ngo/' . Auth::user()->id . '/beneficiary/' . $beneficiary->id . '/document/', '', $filename);
                $document['document'] = $imageName;

                $i++;
                Beneficiary::where('id', '=', $beneficiary_detail->id)
                    ->update($document);
            }
        }
        $user = Auth::user();
        $mail = Mail::send('email.beneficiary_add', ['name' => $user->name, 'beneficiary_name' => $beneficiary_detail
               ->ngo_users
               ->name], function ($message) use ($user)
              {
                  $message->to($user->email, $user->name)
                      ->subject('weppl beneficiary re-approval');
              });
          if ($beneficiary)
          {
              Session::flash('message', 'Successfully sent for re-approval!');
              return redirect('ngo/beneficiary');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
    }
}