<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NguoiTimViec;
use App\NhaTuyenDung;
use App\TinTuyenDung;
use App\HoSoXinViec;
use PDF;

class PDFController extends Controller
{	
    //PDF có các loại:
    // loadView($path,$data) => load từ 1 view gần giống return view('',compact())
    // loadFile($path) => load giao diện từ 1 file html
    // loadHTML($str) => chấp nhận chuỗi chứa thẻ tag html
    // stream($file_name) => hiện pdf với default name: document.pdf (có thể đổi tên trong stream('abc.pdf'))
    // download($defaut_file_name) => hỏi ng` dùng save ở đâu?
    // save($path) => tự động save theo path chỉ định
    public function pdfProfile($profile_id){
        $profile = NguoiTimViec::find($profile_id);
        if(!$profile) return redirect('error')->with(['error' => 'Ko tìm thấy hồ sơ!']);
        // dd($profile);      
        // $pdf = \App::make('dompdf.wrapper');
        return PDF::loadView('pdf.pdf-profile',compact('profile'))->stream();  

        // download với tên file list_book với folder chỉ định
        // return $pdf->download('list_book.pdf');

        // PDF::loadView('nguoitimviec.pdf-profile',compact('profile'))->setPaper('a2', 'landscape')->setWarnings(false)->save('C:/Users/Phat/Downloads/Compressed/myfile.pdf');
        // $pdf = PDF::setOptions([
        //     'logOutputFile' => Storage_path('log/log.htm'),
        //     'temDir' => Storage_path('log/')
        // ]);

        // $pdf=PDF::setOptions ([
        //      'logOutputFile' => Storage_path ( 'log / log.htm' ),
        //      'tempDir' => Storage_path ( 'log /' )
        // ])->loadHTML($html)->save('order.pdf');
    }

    public function viewPDFJob($job_id){
    	$job = TinTuyenDung::find($job_id);    	
              
    	return PDF::loadView('pdf.pdf-job',compact('job'))->setWarnings(false)->stream('ttd_'.$job_id.'.pdf');
    }

    public function exportPDFJob($job_id)
    {
    	// $path = public_path().'/html/service-single.html';
    	// return PDF::loadFile($path)->stream();

    	$job = TinTuyenDung::find($job_id);
              
    	return PDF::loadView('pdf.pdf-job',compact('job'))->download('ttd_'.$job_id.'.pdf');
    }

    public function exportAll(Request $rq){
    	if(!is_dir($rq->path)) return redirect()->back()->with(['error' => 'Đường dẫn lưu file không hợp lệ!']);
    	$jobs = TinTuyenDung::where('congkhai','0')->get();
    	// dd($jobs);    	
    	//Tự động download file với folder trong hàm save() và chuyển trang pdf với tên là download
    	foreach ($jobs as $job) {    	
    		$path = $rq->path.'/ttd_'.$job->id.'.pdf';

    		PDF::loadView('pdf.pdf-job',compact('job'))->setWarnings(false)->save($path);
    	}   
    	return redirect()->back()->with(['success' => 'Export All Job Success!']);        
    }

    public function viewPDFApplied($user_id,$job_id){
        $profile = HoSoXinViec::where('idUser',$user_id)
                        ->where('idTTD',$job_id)->get()->first();       
        // dd($profile);
        // return response()->json($profile);
        return PDF::loadView('pdf.pdf-profile',compact('profile'))->stream();
    }
}