<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DB;
use View;
class SearchController extends Controller
{
    public function SearchCrypto(Request $request)
    {


   
   

    if($request->ajax())
    {
        $output = '';
        $query = $request->get('query');
        if($query != '') {
            $data = Customer::join('orderline','customers.id','orderline.cus_id')
                ->select('customers.*','orderline.crypto_id','orderline.qty','orderline.date')
                ->where('fname', 'like', '%'.$query.'%')
                ->orWhere('lname', 'like', '%'.$query.'%')
                ->orWhere('addressline', 'like', '%'.$query.'%')
                ->orWhere('town', 'like', '%'.$query.'%')
                ->orWhere('zipcode', 'like', '%'.$query.'%')
                ->orderBy('id', 'desc')
                ->get();
                
        } else {
            $data = Customer::join('orderline','customers.id','orderline.cus_id')
                 ->select('customers.*','orderline.crypto_id','orderline.qty','orderline.date')
                ->orderBy('id', 'desc')
                ->get();
        }
         
        $total_row = $data->count();
        if($total_row > 0){
            foreach($data as $row)
            {
                $output .= '
                <tr>
                <td>'.$row->fname.' '. $row->lname.'</td>
                <td>'.$row->addressline.'</td>
                <td>'.$row->zipcode.'</td>
                <td>'.$row->crypto_id.'</td>
                <td>'.$row->qty.'</td>
                <td>'.$row->date.'</td>
                </tr>
                ';
            }
        } else {
            $output = '
            <tr>
                <td align="center" colspan="5">No Data Found</td>
            </tr>
            ';
        }
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row
        );
        echo json_encode($data);
    }

    }


    public function SearchNft(Request $request)
    {


        // $data = Customer::join('characters','customers.id','characters.owner_id')
        // ->join('characterline','characters.id','characterline.character_id')
        // ->select('customers.*','characterline.character_id','characters.nickname','characterline.date')
        // // ->where('fname', 'like', '%'.$query1.'%')
        // // ->orWhere('lname', 'like', '%'.$query1.'%')
        // // ->orWhere('addressline', 'like', '%'.$query1.'%')
        // // ->orWhere('town', 'like', '%'.$query1.'%')
        // // ->orWhere('zipcode', 'like', '%'.$query1.'%')
        // // ->orderBy('id', 'desc')
        // ->get();


        // dd($data);
   

    if($request->ajax())
    {
        $output = '';
        $query1 = $request->get('query1');
        if($query1 != '') {
            $data = Customer::join('characters','customers.id','characters.owner_id')
                ->join('characterline','characters.id','characterline.character_id')
                ->select('customers.*','characterline.character_id','characters.nickname','characterline.date')
                ->where('fname', 'like', '%'.$query1.'%')
                ->orWhere('lname', 'like', '%'.$query1.'%')
                ->orWhere('addressline', 'like', '%'.$query1.'%')
                ->orWhere('town', 'like', '%'.$query1.'%')
                ->orWhere('zipcode', 'like', '%'.$query1.'%')
                ->orderBy('id', 'desc')
                ->get();
                
        } else {
            $data = Customer::join('characters','customers.id','characters.owner_id')
            ->join('characterline','characters.id','characterline.character_id')
            ->select('customers.*','characterline.character_id','characters.nickname','characterline.date')
                ->orderBy('id', 'desc')
                ->get();
        }
         
        $total_row = $data->count();
        if($total_row > 0){
            foreach($data as $row)
            {
                $output .= '
                <tr>
                <td>'.$row->fname.' '. $row->lname.'</td>
                <td>'.$row->addressline.'</td>
                <td>'.$row->zipcode.'</td>
                <td>'.$row->nickname.'</td>
                <td>'.$row->date.'</td>
                </tr>
                ';
            }
        } else {
            $output = '
            <tr>
                <td align="center" colspan="5">No Data Found</td>
            </tr>
            ';
        }
        $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row
        );
        echo json_encode($data);
    }

    }
}
