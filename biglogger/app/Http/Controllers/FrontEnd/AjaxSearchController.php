<?php
namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AjaxSearchController extends Controller
{
    public function Index(Request $request){
        $keyword = $request->get('keyword');
        $objUser = new User();
//        echo '<pre>'.__FILE__.'::'.__METHOD__.'('.__LINE__.')';
//            var_dump($request->all());
//        echo '</pre>';

        if (empty($keyword)){
            $data['account-list']=$objUser->search($keyword);
            echo "<table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
        <thead>
          <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>UserName</th>
            <th>E-mail</th>
            <th>Name Of Privilege</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id='tableList'>";
            foreach ($data['account-list'] as $row) {
                echo "<tr>
              <td>{$row->firstname}</td>
              <td>{$row->lastname}</td>
              <td>{$row->username}</td>
              <td>{$row->email}</td>
              <td>{$row->name_privilege}</td>
              <td style='width: 200px;'>
                <a href='" . route('AccountList') . "' data-toggle='popover' data-trigger='hover' data-content='View Accounts' data-placement='top' class='btn btn-primary btn-xs'><i class='fa fa-folder'></i> View </a>
                <a href='" . route('AccountEdit', [$row->id_user]) . "' data-toggle='popover' data-trigger='hover' data-content='Edit Accounts' data-placement='top' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit </a>
                <a href='" . route('AccountList') . "' data-toggle='popover' data-trigger='hover' data-content='Delete Accounts' data-placement='top' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Delete </a>
              </td>
            </tr>";
            }
            echo "
            </tbody>
      </table>".$data['account-list']->links();
        }else {
            $data['account-list']=$objUser->search($keyword);
            echo "<table id='datatable-responsive' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>
        <thead>
          <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>UserName</th>
            <th>E-mail</th>
            <th>Name Of Privilege</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id='tableList'>";
            foreach ($data['account-list'] as $row) {
                echo "<tr>
              <td>{$row->firstname}</td>
              <td>{$row->lastname}</td>
              <td>{$row->username}</td>
              <td>{$row->email}</td>
              <td>{$row->name_privilege}</td>
              <td style='width: 200px;'>
                <a href='" . route('AccountList') . "' data-toggle='popover' data-trigger='hover' data-content='View Accounts' data-placement='top' class='btn btn-primary btn-xs'><i class='fa fa-folder'></i> View </a>
                <a href='" . route('AccountEdit', [$row->id_user]) . "' data-toggle='popover' data-trigger='hover' data-content='Edit Accounts' data-placement='top' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Edit </a>
                <a href='" . route('AccountList') . "' data-toggle='popover' data-trigger='hover' data-content='Delete Accounts' data-placement='top' class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i> Delete </a>
              </td>
            </tr>";
            }
            echo "
            </tbody>
      </table>".$data['account-list']->links();
        }
        //return view('demo',['data'=>$request->all()]);
    }
}