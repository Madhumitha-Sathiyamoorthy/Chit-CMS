<?php

namespace App\Http\Controllers;

use App\Models\ChitBlogs;
use Illuminate\Http\Request;
use App\Models\ChitCustomer;
use App\Models\ChitPlans;
use App\Models\SocialMediaShare;
use App\Models\HowItWorks;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


use Illuminate\Routing\Controller as BaseController;

class ChitController extends BaseController
{
    public function index(Request $request)
    {
        return $this->sendRequest($request);
    }

    public function sendRequest(Request $request)
    {
        try {
            $search = 0;
            $search = ($request->has('searchDat') || $request->has('dropdownDat') || $request->has('rangeDat')) ? 1 : 0;
            if ($request->has('searchDat') || $request->has('rangeDat')) {
                $chitsDetails = ChitCustomer::select('name', 'email', 'mobile', 'kycNumber', 'salary', 'chits')
                    ->where('isActive', 1)
                    ->when($request->has('rangeDat'), function ($query) use ($request) {
                        $query->whereBetween('salary', [(int)$request->rangeDat['fromAmount'], (int)$request->rangeDat['toAmount']]);
                    })
                    // grouping multiple WHERE conditions inside one WHEN condition.
                    ->when(($request->has('searchDat') && $request->searchDat['search'] != null), function ($query) use ($request) {
                        $searchTerm = $request->searchDat['search'];
                        $query->where(function ($query) use ($searchTerm) {
                            $query->Where('name', 'LIKE', "%{$searchTerm}%")
                                ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                                ->orWhere('mobile', 'LIKE', "%{$searchTerm}%");
                        });
                    })

                    ->get();
                $search = 1;
            } else {
                $chitsDetails = ChitCustomer::select('name', 'email', 'mobile', 'kycNumber', 'salary', 'chits')->where('isActive', 1)->get();
                $salary['min'] = ChitCustomer::min('salary');
                $salary['max'] = ChitCustomer::max('salary');
            }
            $chitsOptions = ChitPlans::select('chitName')->get();
            foreach ($chitsDetails as $key => $data) {
                $plans = [];
                if ($data->chits) {
                    foreach ($data->chits as $plan) {
                        $getPlan = ChitPlans::select('chitName')->where('_id', $plan)->first();
                        if (!in_array($getPlan->chitName, $plans)) {
                            array_push($plans, $getPlan->chitName);
                        }
                    }
                    $data->plans = implode(',', $plans);
                    if (isset($request->dropdownDat['selectedChit'])) {
                        if (count($plans) === 0 || !in_array($request->dropdownDat['selectedChit'], $plans)) {
                            unset($chitsDetails[$key]);
                        }
                    }
                } else {
                    $data->plans = '-';
                    if (isset($request->dropdownDat['selectedChit'])) {
                        unset($chitsDetails[$key]);
                    }
                }
            }

            if (isset($request->dropdownDat['selectedChit'])) {
                $chitsDetails = array_values($chitsDetails->toArray());
            }
            // Log::info("chits --->" . $chitsOptions);
            return ($search === 1) ? response()->json(['searchResult' => $chitsDetails, 'status' => 200]) :  view('chits.index', ['chitsDetails' => $chitsDetails, 'chitOptions' => $chitsOptions, 'salary' => $salary]);
        } catch (\Throwable $e) {
            Log::error("sendRequest Failed --->" . $e->getMessage());
        }
    }

    public function createChit(Request $request)
    {
        $chitsPlans = ChitPlans::select('chitName')->get();
        return view('chits.create', ['chitsPlans' => $chitsPlans]);
    }

    public function storeChitCustomer(Request $request)
    {
        try {
            $splitGallery = explode(",", $request->gallery);
            $validated = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required|min:10',
                'kycNumber' => 'required',
                'salary' => 'required',
            ]);
            if ($validated->fails()) {
                return back()->withErrors($validated)->withInput();
            }
            $customer = new ChitCustomer();
            if ($request->has('chitPlan')) {
                foreach ($request->chitPlan as $chit) {
                    $memberJoied = ChitPlans::where('_id', $chit)->first();
                    ($memberJoied->membersJoined) ? $memberJoied->increment('membersJoined') : $memberJoied->membersJoined = 1;
                    $memberJoied->save();
                }
            }
            $customerDat = [];
            $customerDat['cutomerId'] = 'CUS_' . Str::random(20);
            $customerDat['chits'] = $request->chitPlan;
            $customerDat['eligibility'] = 1;
            $customerDat['isActive'] = 1;
            $customerDat['chitImage'] = $request->image;
            $customerDat['galleryImages'] = $splitGallery;

            $fullArr = array_merge($customerDat, $request->all());
            $customer->create($fullArr);
            return redirect('/chitDetails')->with('success', 'Customer created successfully!');
        } catch (\Throwable $e) {
            Log::error("storeChitCustomer Failed --->" . $e->getMessage());
        }
    }

    public function editChitCustomer($id)
    {
        try {
            $data['customerDetails'] = ChitCustomer::find($id);
            if (isset($data['customerDetails']['galleryImages'])) {
                $data['customerDetails']['galleryImages'] = implode(",", $data['customerDetails']['galleryImages']);
            }
            // $path = storage_path("app/public/image/{$data['customerDetails']['chitImage']}");
            // $data['customerDetails']['chitImage'] = $path;
            $data['allChits'] = ChitPlans::select('chitName')->get();
            return view('chits.edit', compact('data'));
        } catch (\Throwable $e) {
            Log::error("updateChitCustomer Failed --->" . $e->getMessage());
        }
    }

    public function updateChitCustomer(Request $request, $id)
    {
        try {
            $splitGallery = explode(",", $request->gallery);
            Log::info("Updating ChitCustomer--->" . json_encode($request->all()));
            $validated = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required|min:10',
                'kycNumber' => 'required',
                'salary' => 'required',
            ]);
            if ($validated->fails()) {
                return back()->withErrors($validated)->withInput();
            }
            $findCustomer = ChitCustomer::find($id);
            $findCustomer->chits = $request->chitPlan;
            $findCustomer->chitImage = $request->image;
            $findCustomer->galleryImages = $splitGallery;
            $findCustomer->update($request->all());
            return redirect('/chitDetails')->with('success', 'Customer Updated successfully!');
        } catch (\Throwable $e) {
            Log::error("updateChitCustomer Failed --->" . $e->getMessage());
        }
    }

    public function deleteChitCustomer($id)
    {
        try {
            $findCustomer = ChitCustomer::find($id);
            if ($findCustomer->chits != null) {
                foreach ($findCustomer->chits as $chit) {
                    $memberJoied = ChitPlans::where('_id', $chit)->first();
                    $memberJoied->decrement('membersJoined');
                    $memberJoied->save();
                }
            }
            $value = ['isActive' => 0];
            ChitCustomer::where('_id', $id)->update($value);
            return redirect('/chitDetails')->with('success', 'Customer Deactivated successfully!');
        } catch (\Throwable $e) {
            Log::error("deleteChitCustomer Failed --->" . $e->getMessage());
        }
    }

    public function checkMember(Request $request)
    {
        try {
            $getMembers = ChitPlans::where('_id', $request->selectedId)->first();
            if (isset($getMembers->membersJoined) && $getMembers->membersJoined == $getMembers->members) {
                return response()->json(['message' => 'notEligible']);
            }
            return response()->json(['message' => 'eligible']);
        } catch (\Throwable $e) {
            Log::error("checkMember Failed --->" . $e->getMessage());
        }
    }

    public function auctionChit(Request $request)
    {
        try {
            $getChits = ChitPlans::select('chitName', 'chitValue', 'description')->get();
            $i = 0;
            foreach ($getChits as $key => $chit) {
                $chitUserNames = '';
                $chitUserIds = '';
                $chitId = $chit->_id;
                $chitMember = ChitCustomer::select('name', 'chits')->get();
                foreach ($chitMember as $key => $member) {
                    if ($member->chits) {
                        if (in_array($chitId, $member->chits)) {
                            $chitUserNames .= $member->name . ', ';
                            $chitUserIds .= $member->_id . ', ';
                        }
                    }
                }
                $getChits[$i]['user'] =  $chitUserNames;
                $getChits[$i]['userid'] =  $chitUserIds;
                $i++;
            }
            return view('chits.auction', compact('getChits'));
        } catch (\Throwable $e) {
            Log::error("auctionChit Failed --->" . $e->getMessage());
        }
    }

    public function spinChit(Request $request)
    {
        try {
            $data = $request->data;
            $userId = $request->data['userId'];
            $randomUserInd = array_rand($userId, 1);
            $chitPlan = ChitPlans::where('_id', $data['chitId'])->first();
            $chitPlan->auction = 1;
            $chitPlan->save();
            $chitCustomer = ChitCustomer::where('_id', $userId[$randomUserInd])->first();
            $chitCustomer->auctionSpin = 1;
            $chitCustomer->save();
            $response['status'] = 200;
            $response['message'] = 'Congratualtions! ' . $chitCustomer->name;
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
        }
        return $response;
    }

    public function filterChitPlan(Request $request)
    {
        try {
            return $this->sendRequest($request);
        } catch (\Throwable $e) {
            Log::error("searchCustomer Failed --->" . $e->getMessage());
        }
    }

    public function download(Request $request)
    {
        try {
            // print_r($request->all());exit;
        } catch (\Throwable $e) {
            Log::error("download Failed --->" . $e->getMessage());
        }
    }

    public function socialPost(Request $request)
    {
        try {
            return view('chits.socialPost');
        } catch (\Throwable $e) {
            Log::error("socialPost Failed --->" . $e->getMessage());
        }
    }

    public function linkPreview(Request $request)
    {
        try {
            // Another method for getting title and description:

            // $context = stream_context_create(
            //     array(
            //         "http" => array(
            //             "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            //         )
            //     )
            // );
            // $data = file_get_contents($request->link,false,$context);
            // preg_match('/<title>([^<]+)<\/title>/i', $data, $matches);
            // $title = $matches[1];
            // preg_match('/<img[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', $data, $matches);
            // $img = $matches[1];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request->link);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            $output = curl_exec($ch);
            curl_close($ch);
            $doc = new \DOMDocument();
            @$doc->loadHTML($output);
            if ($output) {
                $nodes = $doc->getElementsByTagName('title');
                $title = isset($nodes->item(0)->nodeValue) ? $nodes->item(0)->nodeValue : 0;

                // Getting Image another method:
                // $images = $doc->getElementsByTagName('img');
                // foreach ($images as $image) {
                //     $img = $image->getAttribute('src');
                // }

                $metas = $doc->getElementsByTagName('meta');
                for ($i = 0; $i < $metas->length; $i++) {
                    $meta = $metas->item($i);
                    if ($meta->getAttribute('name') == 'description') {
                        $description = $meta->getAttribute('content');
                    }
                    if ($meta->getAttribute('property') == 'og:image') {
                        $img = $meta->getAttribute('content');
                    }
                }
            }

            $response['title'] = isset($title) ? $title : 0;
            $response['description'] = isset($description) ? $description : 0;
            $response['img'] = isset($img) ? $img : 0;
            return $response;
        } catch (\Throwable $e) {
            Log::error("socialPost Failed --->" . $e->getMessage());
        }
    }

    public function saveSocialPost(Request $request)
    {
        try {
            $socialMedia = new SocialMediaShare();
            $socialMedia->siteUrl = $request->url;
            $socialMedia->title = $request->title;
            $socialMedia->description = $request->description;
            $socialMedia->imageUrl = $request->img;
            $socialMedia->isActive = 1;
            $socialMedia->save();
            return redirect('/socialPost')->with('success', 'You successfully saved a chit post !');
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("saveSocialPost --->" . $e->getMessage());
        }
        return $response;
    }

    public function createChitBlog()
    {
        return view('chits.chitBlog');
    }

    public function storeChitBlog(Request $request)
    {

        try {
            $validated = Validator::make($request->all(), [
                'area' => 'required'
            ]);
            if ($validated->fails()) {
                return back()->withErrors($validated)->withInput();
            }
            $chitBlogs = new ChitBlogs();
            $chitBlogs->blogsContent = $request->area;
            $chitBlogs->save();
            return redirect('createChitBlog')->with('success', 'You successfully saved a chit blog !');
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("storeChitBlog FAILED --->" . $e->getMessage());
        }
    }

    public function getSocialPosts(Request $request)
    {
        try {
            $socialData =  SocialMediaShare::paginate(3);
            $tableview = view('chits.chitPagination', compact('socialData'))->render();
            return response()->json(['tableview' => $tableview]);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("getSocialPosts Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function editSocialPosts(Request $request)
    {
        try {
            if ($request->column === 'description') {
                SocialMediaShare::find($request->id)->update(['description' => $request->value]);
            } else {
                SocialMediaShare::find($request->id)->update(['title' => $request->value]);
            }
            return response()->json(['message' => 'success', 'code' => 200]);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("socialPost Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function imageUpload(Request $request)
    {
        try {
            if ($request->has('file')) {
                $file = $request->file('file');
                $fileName = $request->uniqueId . '_' . $file->getClientOriginalName();
                if (!Storage::exists('public/' . $request->type . '/')) {
                    Log::info("creating directory");
                    Storage::makeDirectory('public/' . $request->type . '/', 0777, true);
                    // $file-> storeAs('images/', $fileName);
                    // Storage::disk('local')->put($fileName,file_get_contents($file));
                    // Storage::makeDirectory('images/', 0777, true);
                }
                // Storage::disk('local')->put($fileName, file_get_contents($file));
                $file->storeAs('public/' . $request->type . '/', $fileName);
                $path =  $fileName;
            }
            return response()->json(['success' => 'File uploaded successfully', 'path' => $path]);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("imageUpload Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function imageRemove(Request $request)
    {
        try {
            if ($request->name) {
                unlink(storage_path('app/public/' . $request->type . '/' . $request->name));
            }
            return response()->json(['message' => 'success']);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("imageRemove Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function searchList(Request $request)
    {
        try {
            $getCustomer = ChitCustomer::select('name', 'email', 'mobile', 'kycNumber', 'salary', 'chits')->where('name', 'like', "%{$request->val}%")->where('isActive', 1)->get();
            return response()->json(['message' => 'success', 'data' => $getCustomer]);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("searchList Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function viewChitCustomer(Request $request)
    {
        try {
            $findCustomer = ChitCustomer::find($request->id);
            return view('chits.view', ['customer' => $findCustomer]);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("viewChitCustomer Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function howItWorks(Request $request)
    {
        try {
            return view('chits.howWorks');
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("howItWorks Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function storeChitAns(Request $request)
    {
        try {
            $removeNull = [];
            for ($i = 0; $i < count($request->textArea); $i++) {
                if ($request->textArea[$i] != '') {
                    array_push($removeNull, $request->textArea[$i]);
                }
            }
            $questions = new HowItWorks();
            $questions->answers = $removeNull;
            $questions->save();
            return redirect('/howItWorks')->with('success', 'Answers posted successfully!');
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("storeChitAns Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function showChitAns(Request $request)
    {
        try {
            $answers = HowItWorks::find($request->id);
            $answers = $answers['answers'];
            return view('chits.showChitAns', ['answers' => $answers, 'id' => $request->id]);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("showChitAns Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function saveAnsOrder(Request $request)
    {
        try {
            $updated = HowItWorks::where('_id', $request->ansId)->update(['answers' => $request->reOrder]);
            if ($updated) {
                return response()->json(['message' => 'Answers reordered successfully.', 'code' => 200]);
            }
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("saveAnsOrder Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function getChartData(Request $request)
    {
        try {
            $chitsDetails = ChitCustomer::select('name', 'email', 'mobile', 'kycNumber', 'salary', 'chits', 'auctionSpin')->where('isActive', 1)->get();
            $chitsOptions = ChitPlans::select('chitName')->get();
            $chitnames = array();
            foreach ($chitsOptions as $key => $value) {
                $chitnames['chitNames'][$chitsOptions[$key]->chitName] = 0;
                $chitnames['auctionSpin'] = 0;
                $chitnames['totalCustomers'] = count($chitsDetails);
            }
            foreach ($chitsDetails as $key => $data) {
                if ($data->chits) {
                    foreach ($data->chits as $plan) {
                        $getPlan = ChitPlans::select('chitName')->where('_id', $plan)->first();
                        $chitnames['chitNames'][$getPlan->chitName] += 1;
                    }
                }
                if ($data->auctionSpin && $data->auctionSpin == 1) {
                    $chitnames['auctionSpin'] += 1;
                }
            }
            $chitnames['remaining'] = count($chitsDetails) - $chitnames['auctionSpin'];
            return response()->json(['code' => 200, 'data' => $chitnames]);
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("getChartData Failed --->" . $e->getMessage());
            return $response;
        }
    }

    public function emailCompose()
    {
        try {
            return view('chits.emailCompose');
        } catch (\Throwable $e) {
            $response['status'] = 500;
            $response['message'] = 'error->' . $e->getMessage();
            Log::error("emailCompose Failed --->" . $e->getMessage());
            return $response;
        }
    }

}
