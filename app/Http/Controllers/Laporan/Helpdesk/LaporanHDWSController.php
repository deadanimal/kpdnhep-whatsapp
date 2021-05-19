<?php

namespace App\Http\Controllers\Laporan\Helpdesk;

use App\Http\Controllers\Controller;
use App\Models\Cases\CaseInfo;
use App\Models\Feedback\FeedTemplate;
use App\Models\Feedback\FeedWhatsappDetail;
use App\Models\Helpdesk\LaporanhdwsModel;
use App\Pertanyaan\PertanyaanAdminDoc;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Excel;
use App\Ref;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use PDF;

/**
 * Laporan Statistik Feedback Melalui Aplikasi Whatsapp
 *
 * Class R1Controller
 * @package App\Http\Controllers\Laporan\Feedback
 */
class LaporanHDWSController extends Controller
{
    /**
     * R101Controller constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = 'Laporan Statistik Bulanan Maklumbalas Melalui Aplikasi Whatsapp';
        $data = $request->all();
        // $mRefInvsts = Ref::where(['cat' => '292', 'status' => '1'])
        //     ->whereIn('code', ['0','1','2'])
        //     ->orderBy('sort', 'asc')
        //     ->orderBy('descr', 'asc')
        //     ->pluck('descr', 'code');
        //$lhw = LaporanhdwsModel::All();
        return view('laporan.helpdesk.index');
    }

    public function datatable2(Request $request){
        $TempohPertama = \App\Ref::find(1244);
        $TempohKedua = \App\Ref::find(1245);
        $TempohKetiga = \App\Ref::find(1246);

        if ($request->CA_RCVDT == ""){
                $modelLa = LaporanhdwsModel::all();
                $datatables = Datatables::of($modelLa)
                ->addIndexColumn()
                // ->addColumn('check', '<input type="checkbox" class="i-checks" name="CASEID[]" value="{{ $CA_CASEID }}" onclick="anyCheck()">')
                ->editColumn('CA_SUMMARY', function(LaporanhdwsModel $LaporanhdwsModel) {
                    if ($LaporanhdwsModel->AS_SUMMARY != '')
                        return implode(' ', array_slice(explode(' ', $LaporanhdwsModel->AS_SUMMARY), 0, 7)) . ' ...';
                    else
                        return '';
//                return '<div style="max-height:80px; overflow:auto">'.$LaporanhdwsModel->CA_SUMMARY.'</div>';
                })
                ->editColumn('CA_INVSTS', function(LaporanhdwsModel $LaporanhdwsModel) {
                    if ($LaporanhdwsModel->AS_STATUS != '')
                        return 'Selesai';
                    else
                        return 'Belum Selesai';
                })
                ->editColumn('CA_CASEID', function (LaporanhdwsModel $LaporanhdwsModel) {
                     //return view('aduan.tugas.show_summary_link', compact('penugasan'))->render();
                    return '<a href="' . url("laporan/helpdesk/view/" . $LaporanhdwsModel->id) . '"' . ">" . $LaporanhdwsModel->id . "</a>";
                })
                ->editColumn('CA_RCVDT', function(LaporanhdwsModel $LaporanhdwsModel) {
                    return $LaporanhdwsModel->AS_CREDT ? with(new Carbon($LaporanhdwsModel->AS_CREDT))->format('d-m-Y h:i A') : '';
                })->editColumn('CA_AGAINSTNM', function(LaporanhdwsModel $LaporanhdwsModel){
                    $u = DB::table('sys_users')->where('id', $LaporanhdwsModel->AS_CREBY)->first();
                    return $u->name;
                })
                ->addColumn('tempoh', function(LaporanhdwsModel $LaporanhdwsModel) use ($TempohPertama,$TempohKedua,$TempohKetiga) {
                    // $mPindahCaseDetail = LaporanhdwsModel::where('CD_CASEID', $LaporanhdwsModel->id)
                    //     ->where('AS_STATUS', '')
                    //     ->orderBy('CD_CREDT', 'desc')
                    //     ->first();
                    // if($mPindahCaseDetail){
                    //     $totalDuration = $LaporanhdwsModel->getduration($mPindahCaseDetail->CD_CREDT, $LaporanhdwsModel->id);
                    // }else {
                    //     $totalDuration = $LaporanhdwsModel->getduration($LaporanhdwsModel->CA_RCVDT, $LaporanhdwsModel->CA_CASEID);
                    // }
                    $totalDuration = $LaporanhdwsModel->getduration($LaporanhdwsModel->AS_CREDT, $LaporanhdwsModel->id, "");

                    if ($totalDuration >= 0 && $totalDuration <= $TempohPertama->code)
                            return '<div style="background-color:#3F6; color: white;" align="center"><strong>'.$totalDuration.'</strong></div>';
                        else if ($totalDuration > $TempohPertama->code && $totalDuration <= $TempohKedua->code)
                            return '<div style="background-color:#FF3;" align="center"><strong>'.$totalDuration.'</strong></div>';
                        else if ($totalDuration > $TempohKedua->code && $totalDuration <= $TempohKetiga->code)
                            return '<div style="background-color:#F0F; color: white;" align="center"><strong>'.$totalDuration.'</strong></div>';
                        else if ($totalDuration > $TempohKetiga->code)
                            return '<div style="background-color:#F00; color: white;" align="center"><strong>'.$totalDuration.'</strong></div>';
                })
                ->addColumn('action', function(LaporanhdwsModel $LaporanhdwsModel){
                    return '<a href="' . url("laporan/helpdesk/editFirst/" . $LaporanhdwsModel->id) . '" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="right" title="Kemaskini"><i class="fa fa-pencil"></i></a>';
                })
                ->rawColumns(['check', 'CA_CASEID', 'CA_SUMMARY', 'tempoh', 'action'])
                ->filter(function ($query) use ($request) {
                    // if ($request->has('CA_CASEID')) {
                    //     $query->where('CA_CASEID', 'like', "%{$request->get('CA_CASEID')}%");
                    // }
                    // if ($request->has('CA_SUMMARY')) {
                    //     $query->where('CA_SUMMARY', 'like', "%{$request->get('CA_SUMMARY')}%");
                    // }
                    // if ($request->has('CA_AGAINSTNM')) {
                    //     $query->where('CA_AGAINSTNM', 'like', "%{$request->get('CA_AGAINSTNM')}%");
                    // }
                    // if ($request->has('CA_RCVDT')) {
                    //     $query->whereDate('CA_RCVDT', Carbon::parse($request->get('CA_RCVDT'))->format('Y-m-d'));
                    // }
                    // if ($request->has('CA_INVSTS')) {
                    //     $query->where('CA_INVSTS', $request->get('CA_INVSTS'));
                    // }
                });
//        if ($CA_CASEID = $datatables->request->get('CA_CASEID')) {
//            $datatables->where('CA_CASEID', 'LIKE', "%$CA_CASEID%");
//        }
//        if ($CA_SUMMARY = $datatables->request->get('CA_SUMMARY')) {
//            $datatables->where('CA_SUMMARY', 'LIKE', "%$CA_SUMMARY%");
//        }
//        if ($CA_AGAINSTNM = $datatables->request->get('CA_AGAINSTNM')) {
//            $datatables->where('CA_AGAINSTNM', 'LIKE', "%$CA_AGAINSTNM%");
//        }
//        if ($CA_RCVDT = $datatables->request->get('CA_RCVDT')) {
//            $datatables->whereDate('CA_RCVDT', Carbon::parse($CA_RCVDT)->format('Y-m-d'));
//        }
//        if ($CA_INVSTS = $datatables->request->get('CA_INVSTS')) {
//            $datatables->where('CA_INVSTS', '=', $CA_INVSTS);
//        }
        return $datatables->make(true);
        }else{
            $modelLa = LaporanhdwsModel::whereBetween('AS_CREDT',[date_format(date_create($request->CA_RCVDT),"Y-m-d") . ' 00:00:00',date_format(date_create($request->CA_RCVDT),"Y-m-d") . ' 23:59:59'])->get();
            //$modelLa = LaporanhdwsModel::where('AS_CREDT',$request->CA_RCVDT)->get();
            $datatables = Datatables::of($modelLa)
            ->addIndexColumn()
            // ->addColumn('check', '<input type="checkbox" class="i-checks" name="CASEID[]" value="{{ $CA_CASEID }}" onclick="anyCheck()">')
            ->editColumn('CA_SUMMARY', function(LaporanhdwsModel $LaporanhdwsModel) {
                if ($LaporanhdwsModel->AS_SUMMARY != '')
                    return implode(' ', array_slice(explode(' ', $LaporanhdwsModel->AS_SUMMARY), 0, 7)) . ' ...';
                else
                    return '';
//                return '<div style="max-height:80px; overflow:auto">'.$LaporanhdwsModel->CA_SUMMARY.'</div>';
            })
            ->editColumn('CA_INVSTS', function(LaporanhdwsModel $LaporanhdwsModel) {
                if ($LaporanhdwsModel->AS_STATUS != '')
                    return 'Selesai';
                else
                    return 'Belum Selesai';
            })
            ->editColumn('CA_CASEID', function (LaporanhdwsModel $LaporanhdwsModel) {
                 //return view('aduan.tugas.show_summary_link', compact('penugasan'))->render();
                return '<a href="' . url("laporan/helpdesk/view/" . $LaporanhdwsModel->id) . '"' . ">" . $LaporanhdwsModel->id . "</a>";
            })
            ->editColumn('CA_RCVDT', function(LaporanhdwsModel $LaporanhdwsModel) {
                return $LaporanhdwsModel->AS_CREDT ? with(new Carbon($LaporanhdwsModel->AS_CREDT))->format('d-m-Y h:i A') : '';
            })->editColumn('CA_AGAINSTNM', function(LaporanhdwsModel $LaporanhdwsModel){
                $u = DB::table('sys_users')->where('id', $LaporanhdwsModel->AS_CREBY)->first();
                return $u->name;
            })
            ->addColumn('tempoh', function(LaporanhdwsModel $LaporanhdwsModel) use ($TempohPertama,$TempohKedua,$TempohKetiga) {
                // $mPindahCaseDetail = LaporanhdwsModel::where('CD_CASEID', $LaporanhdwsModel->id)
                //     ->where('AS_STATUS', '')
                //     ->orderBy('CD_CREDT', 'desc')
                //     ->first();
                // if($mPindahCaseDetail){
                //     $totalDuration = $LaporanhdwsModel->getduration($mPindahCaseDetail->CD_CREDT, $LaporanhdwsModel->id);
                // }else {
                //     $totalDuration = $LaporanhdwsModel->getduration($LaporanhdwsModel->CA_RCVDT, $LaporanhdwsModel->CA_CASEID);
                // }
                $totalDuration = $LaporanhdwsModel->getduration($LaporanhdwsModel->AS_CREDT, $LaporanhdwsModel->id, "");

                if ($totalDuration >= 0 && $totalDuration <= $TempohPertama->code)
                        return '<div style="background-color:#3F6; color: white;" align="center"><strong>'.$totalDuration.'</strong></div>';
                    else if ($totalDuration > $TempohPertama->code && $totalDuration <= $TempohKedua->code)
                        return '<div style="background-color:#FF3;" align="center"><strong>'.$totalDuration.'</strong></div>';
                    else if ($totalDuration > $TempohKedua->code && $totalDuration <= $TempohKetiga->code)
                        return '<div style="background-color:#F0F; color: white;" align="center"><strong>'.$totalDuration.'</strong></div>';
                    else if ($totalDuration > $TempohKetiga->code)
                        return '<div style="background-color:#F00; color: white;" align="center"><strong>'.$totalDuration.'</strong></div>';
            })
            ->addColumn('action', function(LaporanhdwsModel $LaporanhdwsModel){
                return '<a href="' . url("laporan/helpdesk/editFirst/" . $LaporanhdwsModel->id) . '" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="right" title="Kemaskini"><i class="fa fa-pencil"></i></a>';
            })
            ->rawColumns(['check', 'CA_CASEID', 'CA_SUMMARY', 'tempoh', 'action'])
            ->filter(function ($query) use ($request) {
                // if ($request->has('CA_CASEID')) {
                //     $query->where('CA_CASEID', 'like', "%{$request->get('CA_CASEID')}%");
                // }
                // if ($request->has('CA_SUMMARY')) {
                //     $query->where('CA_SUMMARY', 'like', "%{$request->get('CA_SUMMARY')}%");
                // }
                // if ($request->has('CA_AGAINSTNM')) {
                //     $query->where('CA_AGAINSTNM', 'like', "%{$request->get('CA_AGAINSTNM')}%");
                // }
                // if ($request->has('CA_RCVDT')) {
                //     $query->whereDate('CA_RCVDT', Carbon::parse($request->get('CA_RCVDT'))->format('Y-m-d'));
                // }
                // if ($request->has('CA_INVSTS')) {
                //     $query->where('CA_INVSTS', $request->get('CA_INVSTS'));
                // }
            });
//        if ($CA_CASEID = $datatables->request->get('CA_CASEID')) {
//            $datatables->where('CA_CASEID', 'LIKE', "%$CA_CASEID%");
//        }
//        if ($CA_SUMMARY = $datatables->request->get('CA_SUMMARY')) {
//            $datatables->where('CA_SUMMARY', 'LIKE', "%$CA_SUMMARY%");
//        }
//        if ($CA_AGAINSTNM = $datatables->request->get('CA_AGAINSTNM')) {
//            $datatables->where('CA_AGAINSTNM', 'LIKE', "%$CA_AGAINSTNM%");
//        }
//        if ($CA_RCVDT = $datatables->request->get('CA_RCVDT')) {
//            $datatables->whereDate('CA_RCVDT', Carbon::parse($CA_RCVDT)->format('Y-m-d'));
//        }
//        if ($CA_INVSTS = $datatables->request->get('CA_INVSTS')) {
//            $datatables->where('CA_INVSTS', '=', $CA_INVSTS);
//        }
    return $datatables->make(true);
        }   
    }

    public function create()
    {
        return view('laporan.helpdesk.create');
    }

    public function view($id){
        $model = LaporanhdwsModel::find($id);
        return view('laporan.helpdesk.view',compact('model'));
    }

    /**
     * query to get data from feedback whatsapp
     *
     * @param $year
     * @return mixed
     */
    public function query($year)
    {
        $date = Carbon::createFromFormat('Y', $year);
        return FeedWhatsappDetail::select(DB::raw('count(id) as total'), DB::raw('month(created_at) as month'), 'template_id')
            ->whereNotNull('template_id')
            ->whereBetween('created_at', [$date->startOfYear()->toDateTimeString(), $date->endOfYear()->toDateTimeString()])
            ->groupBy('template_id', DB::raw('month(created_at)'))
            ->get();
    }

   
    public function editFirst($id)
    {
        $model = LaporanhdwsModel::find($id);
        
        return view('laporan.helpdesk.editfirst', compact('model'));
    }

    public function saveEdit(Request $request){
        $model = LaporanhdwsModel::find($request->laporanid);
        
        $model->fill($request->all());
        if ($model->save()) {
            if (isset($request->AS_STATUS)){
                 $title = 'Laporan Statistik Bulanan Maklumbalas Melalui Aplikasi Whatsapp';
                return view('laporan.helpdesk.index');
            }               
            return redirect()->route('laporan.helpdesk.attachment', ['id' => $model->id]);
        }
    }

    /**
     * query for get data from case_info
     *
     * @param $year
     * @return CaseInfo[]|\Illuminate\Database\Eloquent\Collection
     */
    public function query2($year)
    {
        $date = Carbon::createFromFormat('Y', $year);
        return CaseInfo::select(DB::raw('count(id) as total'), DB::raw('month(CA_RCVDT) as month'))
            ->where('CA_RCVTYP', 'S37')
            ->whereBetween('CA_RCVDT', [$date->startOfYear()->toDateTimeString(), $date->endOfYear()->toDateTimeString()])
            ->groupBy(DB::raw('month(CA_RCVDT)'))
            ->get();
    }

    /**
     * generate report in pdf format
     *
     * @param $title
     * @param $year
     * @param $data_final
     * @param $data_final_total
     * @param $data_final_pct
     * @param $data_final_case_info
     * @param $template_by_title
     * @param $category_name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function generatePdf($title, $year, $data_final, $data_final_total, $data_final_pct, $data_final_case_info, $template_by_title, $category_name)
    {
        $pdf = PDF::loadView('laporan.feedback.r1.pdf', compact('title', 'year_list', 'year'
            , 'gen', 'is_search', 'data_final', 'data_final_total', 'data_final_pct', 'data_final_case_info'
            , 'template_by_title', 'category_name'), [], ['format' => 'A4-L']);
        return $pdf->stream(str_replace(' ', '_', $title) . date("_Ymd_His") . '.pdf');
    }

    /**
     * generate report in excel format
     *
     * @param $type
     * @param $title
     * @param $year
     * @param $data_final
     * @param $data_final_total
     * @param $data_final_pct
     * @param $data_final_case_info
     * @param $template_by_title
     * @param $category_name
     * @return mixed
     */
    public function generateExcel($type, $title, $year, $data_final, $data_final_total, $data_final_pct, $data_final_case_info, $template_by_title, $category_name)
    {
        return Excel::create($title . date("_Ymd_His"), function ($excel) use (
            $title, $year, $data_final, $data_final_total, $data_final_pct, $data_final_case_info, $template_by_title
            , $category_name
        ) {
            $excel->sheet('Report', function ($sheet) use (
                $title, $year, $data_final, $data_final_total
                , $data_final_pct, $data_final_case_info, $template_by_title, $category_name
            ) {
                $sheet->loadView('laporan.feedback.r1.excel')
                    ->with(compact('title', 'year_list', 'year', 'gen', 'is_search', 'data_final'
                        , 'data_final_total', 'data_final_pct', 'data_final_case_info', 'template_by_title', 'category_name'));
            });
        })->export($type);
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'AS_NI' => 'required',
            'AS_SUMMARY' => 'required',
            'AS_RCVTYP' => 'required'
        ],
            [
                'AS_NI.required' => 'Ruangan Nama Isu diperlukan.',
                'AS_SUMMARY.required' => 'Ruangan Keterangan diperlukan.',
                'AS_RCVTYP.required' => 'Ruangan Tahap diperlukan.'
            ]
        );

        // adhoc. kill user from ezadu.
        if(in_array($request->AS_USERID, [12121])) {
            if ($request->expectsJson()) {
                $user = Auth::guard('api')->user();

                if ($user) {
                    $user->api_token = null;
                    $user->save();
                }

                return response()->json(['data' => 'User logged out.'], 200);
            }
        }

        $model = new LaporanhdwsModel();
        $model->fill($request->all());
        if ($model->save()) {
            return redirect()->route('laporan.helpdesk.attachment', ['id' => $model->id]);
        }
        
    }

    public function getdatatable($id)
    {
        $mPertanyaanAdminDoc = PertanyaanAdminDoc::where(['askid' => $id]);
        
        $datatables = DataTables::of($mPertanyaanAdminDoc)
            ->addIndexColumn()
            ->editColumn('img_name', function(PertanyaanAdminDoc $PertanyaanAdminDoc) {
                if($PertanyaanAdminDoc->img_name != '')
                    return '<a href='.Storage::disk('bahanpath')->url($PertanyaanAdminDoc->path.$PertanyaanAdminDoc->img).' target="_blank">'.$PertanyaanAdminDoc->img_name.'</a>';
                else
                    return '';
            })
            ->editColumn('updated_at', function(PertanyaanAdminDoc $adminCaseDoc) {
                if($adminCaseDoc->updated_at != '')
                    return $adminCaseDoc->updated_at ? with(new Carbon($adminCaseDoc->updated_at))->format('d-m-Y h:i A') : '';
                else
                    return '';
            })
            ->addColumn('action', function (PertanyaanAdminDoc $PertanyaanAdminDoc) {
                return view('laporan.helpdesk.actionbutton', compact('PertanyaanAdminDoc'))->render();
            })
            ->rawColumns(['img_name','action']);
        return $datatables->make(true);
    }

    public function updateAttachment(Request $request, $id)
    {
        $model = PertanyaanAdminDoc::find($id);
        $date = date('YmdHis');
        $userid = Auth::user()->id;
        $Year = date('Y');
        $Month = date('m');
        $file = $request->file('file');
        if($file) {
            Storage::delete($model->path.$model->img); // Delete old attachment
            $filename = $userid.'_'.$model->askid.'_'.$date.'.'.$file->getClientOriginalExtension();
            $directory = '/'.$Year.'/'.$Month.'/';
            Storage::disk('bahan')->makeDirectory($directory);
            if($file->getClientSize() > 2000000) // if file size lebih 2mb
            {
                $resize = Image::make($file)->resize(null, 600, function ($constraint) { // returns Intervention\Image\Image
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $hash = md5($resize->__toString()); // calculate md5 hash of encoded image
                $path = "images/{$hash}.{$file->getClientOriginalExtension()}"; // use hash as a name
                $resize->save(public_path($path)); // save it locally to ~/public/images/{$hash}.jpg
                Storage::disk('bahan')->put($directory.$filename, $resize->__toString());
                unlink($path);
            }
            else
            {
                Storage::disk('bahan')->putFileAs('/'.$Year.'/'.$Month.'/', $request->file('file'), $filename);
            }
            $model->path = Storage::disk('bahan')->url($directory);
            $model->img = $filename;
            $model->img_name = $file->getClientOriginalName();
            $model->remarks = $request->remarks;
            if($model->save()) {
                return redirect()->route('laporan.helpdesk.attachment', $model->askid);
            }
        } else {
            $model->remarks = $request->remarks;
            if ($model->save()) {
                return redirect()->route('laporan.helpdesk.attachment', $model->askid);
            }
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
        $model = PertanyaanAdminDoc::find($id);
        Storage::delete($model->path.$model->img);
        if($model->delete()){
            return redirect()->route('laporan.helpdesk.attachment', $model->askid);
        }
    }

    public function createAttachment($id)
    {
        return view('laporan.helpdesk.filecreate', compact('id'));
    }

    public function attachment($id)
    {
        if (str_contains($id,"LW")){
            $id = explode("LW",$id)[1];
        }
        $model = LaporanhdwsModel::find($id); 
        if (!str_contains($id,"LW")){
            $id = "LW" . $id;
        }
        $countDoc = DB::table('ask_doc')
            ->where('askid', $id)
            ->count('askid');
        return view('laporan.helpdesk.attachment', compact('model', 'countDoc'));
    }

    public function editAttachment($id)
    {
        if (str_contains($id,"LW")){
            $id = explode("LW",$id)[1];
        }
        $model = PertanyaanAdminDoc::find($id);
        if (!str_contains($id,"LW")){
            $id = "LW" . $id;
        }
        return view('laporan.helpdesk.editAttachment', compact('model', 'id'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFile(Request $request)
    {
        $date = date('YmdHis');
        if ($request->userid) {
            $userid = $request->userid;
        } else {
            $userid = Auth::user()->id;
        }
        $Year = date('Y');
        $Month = date('m');
        $file = $request->file('file');
        if($file) {
            $filename = $userid.'_'.$request->askid.'_'.$date.'.'.$file->getClientOriginalExtension();
            $directory = '/'.$Year.'/'.$Month.'/';
            if($file->getClientSize() > 2000000) // if file size lebih 2mb
            {
                $resize = Image::make($file)->resize(null, 600, function ($constraint) { // returns Intervention\Image\Image
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $resize->stream();
                Storage::disk('bahan')->put($directory.$filename, $resize);
            }
            else
            {
                Storage::disk('bahan')->putFileAs('/'.$Year.'/'.$Month.'/', $request->file('file'), $filename);
            }
            $mPublicCaseDoc = new PertanyaanAdminDoc();
            $mPublicCaseDoc->askid = $request->askid;
            $mPublicCaseDoc->path = Storage::disk('bahan')->url($directory);
            $mPublicCaseDoc->img = $filename;
            $mPublicCaseDoc->img_name = $file->getClientOriginalName();
            $mPublicCaseDoc->remarks = $request->remarks;
            if($mPublicCaseDoc->save()) {
                if ($request->userid) {
                    return response()->json(['data' => 'ok']);
                }
                return redirect()->route('laporan.helpdesk.attachment',$request->askid);
            }
        }
    }

}