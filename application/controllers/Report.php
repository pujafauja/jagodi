    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Report
 * By : M Ridwan
 */
class Report extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
        // $this->load->model('Report_model');
        isloggedin();
    }
    function employee_join()
    {
        cekoto('report/employee_join', 'view', true, true);
           if($_POST):
               $requestData    = $_REQUEST;
               $where = '';
               $status = $this->input->post('status');
               if ($status != 'all') {
                   $where = "AND a.status = '$status'";
               }

               $fetch = $this->global_model->_retrieve(
                   $table = 'tb_employee a
                                LEFT JOIN `pp_otority` AS c ON a.`position` = c.`id`
                               , (SELECT @no := 0) r',
                   $select = '(@no := @no + 1) nomor, a.*, c.nama as posisi',
                   $colOrder     = array('nomor', 'a.nama', 'c.nama', 'a.registredday', 'a.delete'),
                   $filter       = array(),
                   $where        = " $where",
                   $like_value   = $requestData['search']['value'], 
                   $column_order = $requestData['order'][0]['column'], 
                   $column_dir   = $requestData['order'][0]['dir'], 
                   $limit_start  = $requestData['start'], 
                   $limit_length = $requestData['length']
               );

               $totalData      = $fetch['totalData'];
               $totalFiltered  = $fetch['totalFiltered'];
               $query          = $fetch['query'];

               $data = array();
               $no   = 1;
               foreach($query->result() as $row)
               { 
                    // print_ar($this->db->last_query());
                   $nestedData = array(); 

                   $nestedData[] = $row->nomor;
                   $nestedData[] = $row->nama;
                   $nestedData[] = $row->posisi;
                   $nestedData[] = tgl($row->registeredday);
                   $status = '';
                   if ($row->status) {
                       $status = '<span class="badge badge-primary">Active</span>';
                   }else{
                        $status = '<span class="badge badge-danger">Non Active</span>';
                   }
                   $nestedData[] = $status;
                   $data[] = $nestedData;
                   $no++;
               }

               $json_data = array(
                   "draw"            => intval( $requestData['draw'] ),  
                   "recordsTotal"    => intval( $totalData ),  
                   "recordsFiltered" => intval( $totalFiltered ), 
                   "data"            => $data
                   );

               echo json_encode($json_data);
           else:
               $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
               $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
               $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
               $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

               $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
               $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
               $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
               $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

               $this->data['js'][] = base_url('assets/custom/js/report/hrd.js');

               $this->load->templateAdmin('report/hrd/employee/join');
           endif;
    }
    function payroll()
    {
        cekoto('report/payroll', 'view', true, true);
       if($_POST):
           $requestData    = $_REQUEST;
           $where = '';
           $status = $this->input->post('status');
           if ($status != '') {
               $where = "AND a.month = '$status'";
           }

           $fetch = $this->global_model->_retrieve(
               $table = 'tb_employee_payroll a
                           , (SELECT @no := 0) r',
               $select = '(@no := @no + 1) nomor, month,
                            sum(gaji_bruto) as total_fee, 
                            sum(amount) as potongan,
                            sum(subtotal) thp, 
                            (sum(kes_total) + sum(naker_total)) as bpjs',
               $colOrder     = array('nomor'),
               $filter       = array(),
               $where        = " $where",
               $like_value   = $requestData['search']['value'], 
               $column_order = $requestData['order'][0]['column'], 
               $column_dir   = $requestData['order'][0]['dir'], 
               $limit_start  = $requestData['start'], 
               $limit_length = $requestData['length'],
              $group_by     = 'a.month'
           );

           $totalData      = $fetch['totalData'];
           $totalFiltered  = $fetch['totalFiltered'];
           $query          = $fetch['query'];

           $data = array();
           $no   = 1;
           foreach($query->result() as $row)
           { 
                // print_ar($this->db->last_query());
               $nestedData = array(); 
               $status = '<span class="badge badge-primary">Success</span>';

               $nestedData[] = $row->nomor;
               $nestedData[] = $row->month;
               $nestedData[] = rupiah($row->total_fee, 2);
               $nestedData[] = rupiah($row->potongan, 2);
               $nestedData[] = rupiah($row->thp, 2);
               $nestedData[] = $status;
               $nestedData[] = rupiah($row->bpjs, 2);
               $nestedData[] = $status;
               $data[] = $nestedData;
               $no++;
           }

           $json_data = array(
               "draw"            => intval( $requestData['draw'] ),  
               "recordsTotal"    => intval( $totalData ),  
               "recordsFiltered" => intval( $totalFiltered ), 
               "data"            => $data
               );

           echo json_encode($json_data);
       else:
            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

           $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
           $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
           $this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');
           $this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
           $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
           $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

           $this->data['js'][] = base_url('assets/custom/js/report/hrd.js');

           $this->load->templateAdmin('report/hrd/payroll');
       endif;
    }
    function insentif()
    {
        cekoto('report/insentif', 'view', true, true);
       if($_POST):
           $requestData    = $_REQUEST;
           $where = '';
           $status = substr($this->input->post('status'), 0, 6);
           if ($status != '') {
               $where = "AND a.month = '$status'";
           }
           $fetch = $this->global_model->_retrieve(
               $table = 'tb_insentif_transaction a
                           , (SELECT @no := 0) r',
               $select = '(@no := @no + 1) nomor, a.*',
               $colOrder     = array('nomor', 'a.month'),
               $filter       = array(),
               $where        = " $where",
               $like_value   = $requestData['search']['value'], 
               $column_order = $requestData['order'][0]['column'], 
               $column_dir   = $requestData['order'][0]['dir'], 
               $limit_start  = $requestData['start'], 
               $limit_length = $requestData['length']
           );

           $totalData      = $fetch['totalData'];
           $totalFiltered  = $fetch['totalFiltered'];
           $query          = $fetch['query'];

           $data = array();
           $no   = 1;
           foreach($query->result() as $row)
           { 
               $nestedData = array(); 

               $nestedData[] = $row->nomor;
               $nestedData[] = my($row->month, true);
               $nestedData[] = rupiah($row->jml_insentif, 2);
               $status = '<span class="badge badge-primary">Success</span>';
               $nestedData[] = $status;
               $nestedData[] = '';
               $nestedData[] = $status;
               $data[] = $nestedData;
               $no++;
           }

           $json_data = array(
               "draw"            => intval( $requestData['draw'] ),  
               "recordsTotal"    => intval( $totalData ),  
               "recordsFiltered" => intval( $totalFiltered ), 
               "data"            => $data
               );

           echo json_encode($json_data);
       else:
            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

           $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
           $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
           $this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');
           $this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
           $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
           $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

           $this->data['js'][] = base_url('assets/custom/js/report/hrd.js');

           $this->load->templateAdmin('report/hrd/insentif');
       endif;
    }
    function thr()
    {
        cekoto('report/thr', 'view', true, true);
       if($_POST):
           $requestData    = $_REQUEST;
           $where = '';
           $status = substr($this->input->post('status'), 6);
           if ($status != '') {
               $where = "AND a.year = '$status'";
           }

           $fetch = $this->global_model->_retrieve(
               $table = 'tb_thr a
                           , (SELECT @no := 0) r',
               $select = '(@no := @no + 1) nomor, a.*',
               $colOrder     = array('a.year', 'a.total'),
               $filter       = array(),
               $where        = " $where",
               $like_value   = $requestData['search']['value'], 
               $column_order = $requestData['order'][0]['column'], 
               $column_dir   = $requestData['order'][0]['dir'], 
               $limit_start  = $requestData['start'], 
               $limit_length = $requestData['length']
           );

           $totalData      = $fetch['totalData'];
           $totalFiltered  = $fetch['totalFiltered'];
           $query          = $fetch['query'];

           $data = array();
           $no   = 1;
           foreach($query->result() as $row)
           { 
               $nestedData = array(); 

               $nestedData[] = $row->nomor;
               $nestedData[] = $row->year;
               $nestedData[] = rupiah($row->total, 2);
               $nestedData[] = "<span class='badge badge-primary'>Success</span>";
               $data[] = $nestedData;
               $no++;
               // print_ar($row);
           }
             // print_ar($this->db->last_query());

           $json_data = array(
               "draw"            => intval( $requestData['draw'] ),  
               "recordsTotal"    => intval( $totalData ),  
               "recordsFiltered" => intval( $totalFiltered ), 
               "data"            => $data
               );

           echo json_encode($json_data);
       else:
            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
           $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

           $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
           $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
           $this->data['css'][] = base_url('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
           $this->data['js'][] = base_url('assets/js/pages/form-masks.init.js');
           $this->data['js'][] = base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');
           $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
           $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

           $this->data['js'][] = base_url('assets/custom/js/report/hrd.js');

           $this->load->templateAdmin('report/hrd/thr');
       endif;
     }
    

    function print_item()
    {
        $rows = [];
        switch ($this->input->get('type')) {
            case 'item':
                if ($this->input->get('partCode')) {
                    for ($i= 0; $i < count($this->input->get('partCode')); $i++) { 
                        $rows[$i]['partCode'] = $this->input->get('partCode')[$i];
                        $rows[$i]['partName'] = $this->input->get('partName')[$i];
                        $rows[$i]['partCat'] = $this->input->get('partCat')[$i];
                        $rows[$i]['abcCat'] = $this->input->get('abcCat')[$i];
                        $rows[$i]['salesQty'] = $this->input->get('salesQty')[$i];
                        $rows[$i]['salesAmount'] = $this->input->get('salesAmount')[$i];
                        $rows[$i]['lastStock'] = $this->input->get('lastStock')[$i];
                        $rows[$i]['ratio'] = $this->input->get('ratio')[$i];
                    }
                }else{
                    $rows = false;
                }
                break;
            case 'daily':
                if ($this->input->get('no')) {
                    for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                        $rows[$i]['no'] = $this->input->get('no')[$i];
                        $rows[$i]['partCode'] = $this->input->get('partCode')[$i];
                        $rows[$i]['partName'] = $this->input->get('partName')[$i];
                        $rows[$i]['partCat'] = $this->input->get('partCat')[$i];
                        $rows[$i]['partLoc'] = $this->input->get('partLoc')[$i];
                        $rows[$i]['partQty'] = $this->input->get('partQty')[$i];
                    }
                }else{
                    $rows = false;
                }
                break;
            case 'recommended':
                if ($this->input->get('no')) {
                    for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                        $rows[$i]['no'] = $this->input->get('no')[$i];
                        $rows[$i]['partCode'] = $this->input->get('partCode')[$i];
                        $rows[$i]['partName'] = $this->input->get('partName')[$i];
                        $rows[$i]['partCat'] = $this->input->get('partCat')[$i];
                        $rows[$i]['abcCat'] = $this->input->get('abcCat')[$i];
                        $rows[$i]['recomd'] = $this->input->get('recomd')[$i];
                    }
                }else{
                    $rows = false;
                }

                break;
            case 'join':
                if ($this->input->get('no')) {
                    for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                        $rows[$i]['no'] = $this->input->get('no')[$i];
                        $rows[$i]['name'] = $this->input->get('name')[$i];
                        $rows[$i]['position'] = $this->input->get('position')[$i];
                        $rows[$i]['date'] = $this->input->get('date')[$i];
                        $rows[$i]['status'] = $this->input->get('status')[$i];
                    }
                }else{
                    $rows = false;
                }
            case 'thr':
                if ($this->input->get('no')) {
                    for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                        $rows[$i]['no'] = $this->input->get('no')[$i];
                        $rows[$i]['year'] = $this->input->get('year')[$i];
                        $rows[$i]['total'] = $this->input->get('total')[$i];
                        $rows[$i]['status'] = $this->input->get('status')[$i];
                    }
                }else{
                    $rows = false;
                }

                break;
              case 'payroll':
                  if ($this->input->get('no')) {
                      for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                          $rows[$i]['no'] = $this->input->get('no')[$i];
                          $rows[$i]['month'] = $this->input->get('month')[$i];
                          $rows[$i]['fee'] = $this->input->get('fee')[$i];
                          $rows[$i]['potongan'] = $this->input->get('potongan')[$i];
                          $rows[$i]['thp'] = $this->input->get('thp')[$i];
                          $rows[$i]['statusThp'] = $this->input->get('statusThp')[$i];
                          $rows[$i]['bpjs'] = $this->input->get('bpjs')[$i];
                          $rows[$i]['statusBpjs'] = $this->input->get('statusBpjs')[$i];
                      }
                  }else{
                      $rows = false;
                  }

                  break;
                case 'insentif':
                    if ($this->input->get('no')) {
                        for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                            $rows[$i]['no'] = $this->input->get('no')[$i];
                            $rows[$i]['month'] = $this->input->get('month')[$i];
                            $rows[$i]['total'] = $this->input->get('total')[$i];
                            $rows[$i]['statusTotal'] = $this->input->get('statusTotal')[$i];
                            $rows[$i]['reward'] = $this->input->get('reward')[$i];
                            $rows[$i]['statusReward'] = $this->input->get('statusReward')[$i];
                        }
                    }else{
                        $rows = false;
                    }

                    break;
                case 'daily-report':
                    if ($this->input->get('no')) {
                        for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                            $rows[$i]['no'] = $this->input->get('no')[$i];
                            $rows[$i]['invoice'] = $this->input->get('invoice')[$i];
                            $rows[$i]['customer'] = $this->input->get('customer')[$i];
                            $rows[$i]['plat'] = $this->input->get('plat')[$i];
                            $rows[$i]['unit'] = $this->input->get('unit')[$i];
                            $rows[$i]['noTelp'] = $this->input->get('noTelp')[$i];
                            $rows[$i]['serviceCat'] = $this->input->get('serviceCat')[$i];
                            $rows[$i]['partsNo'] = $this->input->get('partsNo')[$i];
                            $rows[$i]['partsName'] = $this->input->get('partsName')[$i];
                            $rows[$i]['partsQty'] = $this->input->get('partsQty')[$i];
                            $rows[$i]['partsPrice'] = $this->input->get('partsPrice')[$i];
                            $rows[$i]['totalLabor'] = $this->input->get('totalLabor')[$i];
                            $rows[$i]['totalParts'] = $this->input->get('totalParts')[$i];
                        }
                    }else{
                        $rows = false;
                    }

                    break;
                case 'insentif':
                    if ($this->input->get('no')) {
                        for ($i= 0; $i < count($this->input->get('no')); $i++) { 
                            $rows[$i]['no'] = $this->input->get('no')[$i];
                            $rows[$i]['month'] = $this->input->get('month')[$i];
                            $rows[$i]['total'] = $this->input->get('total')[$i];
                            $rows[$i]['statusTotal'] = $this->input->get('statusTotal')[$i];
                            $rows[$i]['reward'] = $this->input->get('reward')[$i];
                            $rows[$i]['statusReward'] = $this->input->get('statusReward')[$i];
                        }
                    }else{
                        $rows = false;
                    }

                    break;
        }
        // print_ar($rows);die;
        $data['type'] = $this->input->get('type');
        $data['rows'] = $rows;
        $data['company'] = $this->global_model->_get('pp_settings')->row_array();
        $type = $this->input->get('type');
        if (isset($_GET['pdf'])) {
            $title = '';
            if ($type == 'item'):
                $title = 'Parts Sales By Item';
            elseif($type == 'daily'):
                $title = 'Parts Daily Stock';
            elseif($type == 'recommended'):
                $title = 'Parts Recommended Order';
            endif;
            $this->load->library('pdf');
            
            $data['title_pdf'] = '';
            
            $file_pdf = $title;
            $paper = 'A4';
            if ($type == 'item') {
                $orientation = "lanscapre";
            }else{
                $orientation = "portrait";
            }
            
            $html = $this->load->templateAdmin('report/sparepart/print-item', $data);
            
            $this->pdf->generate($html, $file_pdf,$paper,$orientation);
        }else if(isset($_GET['excel'])){

        }else{
            $this->load->templateAdmin('report/sparepart/print-item', $data);
        }
    }

    function service()
    {
        cekoto('report/service', 'view', true, true);
        if($_POST):
            $requestData    = $_REQUEST;

            $firstdate = $this->input->post('firstdate');
            $enddate   = $this->input->post('enddate');

            $fetch = $this->global_model->_retrieve(
                $table = 'tb_service a
                            LEFT JOIN tb_customer b ON a.customer_id = b.id
                            LEFT JOIN tb_customer_vehicles c ON a.vehicle_id = c.id
                            LEFT JOIN tb_customer_unit d ON c.unit_id = d.id
                            LEFT JOIN tb_employee e ON a.employee_id = e.id
                            LEFT JOIN tb_customer_category_unit f ON a.service_categoryid = f.id
                            lEFT JOIN tb_service_parts g ON a.id = g.service_id
                            LEFT JOIN tb_job_detail h ON a.id = h.service_id
                            LEFT JOIN tb_user user ON a.userid = user.USE_ID
                            , (SELECT @no := 0) r',
                $select = '(@no := @no + 1) nomor,
                            a.id,
                            a.no wo,
                            b.nama customer,
                            c.plat,
                            d.nama unit,
                            b.no,
                            e.nama technician,
                            f.nama service_category,
                            CONCAT(\'[\', GROUP_CONCAT(DISTINCT CONCAT(\'{"partid":"\', g.sparepart_id, \'", "het":"\', g.het, \'", "qty":"\', g.qty, \'", "disc":"\', g.disc, \'", "picking":"\', g.pickingqty, \'"}\')), \']\') parts,
                            CONCAT(\'[\', GROUP_CONCAT(DISTINCT h.jasaharga), \']\') jobs,
                            user.USE_NAMA user',
                $colOrder     = array('nomor', '', 'b.nama', '', '', '', 'f.nama'),
                $filter       = array(),
                $where        = ' AND a.type=\'service\' AND (LEFT(a.`date`, 10) >= \''.$firstdate.'\' AND LEFT(a.`date`, 10) <= \''.$enddate.'\') AND (a.status = \'2\' OR a.status = \'4\') ',
                $like_value   = $requestData['search']['value'], 
                $column_order = $requestData['order'][0]['column'], 
                $column_dir   = $requestData['order'][0]['dir'], 
                $limit_start  = $requestData['start'], 
                $limit_length = $requestData['length'],
                $group_by     = 'a.id'
            );

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data = array();
            $no   = 1;
            foreach($query->result() as $row)
            { 
                $nestedData = array(); 

                $nestedData[] = $no;
                $nestedData[] = $row->wo;
                $nestedData[] = $row->customer;
                $nestedData[] = $row->plat;
                $nestedData[] = $row->unit;
                $nestedData[] = $row->no;
                $nestedData[] = $row->service_category;

                $parts    = array();
                $partNo   = 1;
                $jmlPart  = 0;
                $jmlLabor = 0;
                $jumlah   = 0;

                if($row->parts):
                    foreach(json_decode($row->parts) as $p):
                        $sparepart = $this->global_model->_row('tb_sparepart', ['id' => $p->partid])->row();
                        $parts['no'][] = $partNo;
                        $parts['name'][] = $sparepart->nama;
                        $parts['qty'][] = $p->picking;
                        $parts['het'][] = 'Rp ' . rupiah($p->het, 2);

                        $jmlPart += ($p->picking * $p->het) - (($p->disc / 100) * ($p->picking * $p->het));

                        $partNo++;
                    endforeach;
                endif;

                if($row->jobs):
                    foreach(json_decode($row->jobs) as $job):
                        $qty           = ($job->qty) ? $job->qty : 0;
                        $selling_price = ($job->selling_price) ? $job->selling_price : 0;
                        $disc          = ($job->disc) ? $job->disc : 0;

                        $jmlLabor += $selling_price;
                    endforeach;
                endif;

                $nestedData[] = ($row->parts) ? implode('<br>', $parts['no']) : '';
                $nestedData[] = ($row->parts) ? implode('<br>', $parts['name']) : '';
                $nestedData[] = ($row->parts) ? implode('<br>', $parts['qty']) : '';
                $nestedData[] = ($row->parts) ? implode('<br>', $parts['het']) : '';
                $nestedData[] = 'Rp ' . rupiah($jmlLabor, 2);
                $nestedData[] = 'Rp ' . rupiah($jmlPart, 2);
                $nestedData[] = 'Rp ' . rupiah($jmlLabor + $jmlPart, 2);
                $nestedData[] = $row->technician;
                $nestedData[] = $row->user;

                $data[] = $nestedData;
                $no++;
            }

            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),  
                "recordsTotal"    => intval( $totalData ),  
                "recordsFiltered" => intval( $totalFiltered ), 
                "data"            => $data
                );

            echo json_encode($json_data);
        else:
            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

            $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

            $this->data['js'][] = base_url('assets/custom/js/report/service.js');

            $this->load->templateAdmin('report/service/service-report');
        endif;
    }

    function performa_teknisi()
    {
        if($this->input->is_ajax_request()):
            $requestData    = $_REQUEST;

            $firstdate = $this->input->post('firstdate');
            $enddate   = $this->input->post('enddate');

            $partCat = $this->global_model->_get('tb_sparepart_category', [], [], ['nama LIKE ' => '\'%oil%\'', 'nama LIKE ' => '\'%oli%\'']);
            $oil = array();
            if($partCat->num_rows()):
                foreach($partCat->result() as $cat):
                    $oil[] = $cat->id;
                endforeach;
            endif;

            $fetch = $this->global_model->_retrieve(
                $table = 'tb_employee a
                            LEFT JOIN pp_otority b ON a.position = b.id
                            LEFT JOIN tb_service c ON a.id = c.employee_id
                            LEFT JOIN tb_job_detail d ON d.service_id = c.id
                            LEFT JOIN tb_service_parts g ON g.service_id = c.id
                            , (SELECT @no := 0) r',
                $select = '(@no := @no + 1) nomor,
                            a.nama,
                            COUNT(DISTINCT c.`date`) work,
                            COUNT(c.id) totalservice,
                            CONCAT(\'[\', GROUP_CONCAT(DISTINCT CONCAT(\'{"partid":"\', g.sparepart_id, \'", "het":"\', g.het, \'", "qty":"\', g.qty, \'", "disc":"\', g.disc, \'", "picking":"\', g.pickingqty, \'"}\')), \']\') parts,
                            CONCAT(\'[\', GROUP_CONCAT(DISTINCT d.jasaharga), \']\') jobs',
                $colOrder     = array('nomor', 'a.nama', 'work', 'totalservice'),
                $filter       = array(),
                $where        = ' AND b.nama LIKE \'%mekanik%\' AND a.status = \'1\' AND a.`delete` = \'0\' AND c.type=\'service\' AND (LEFT(c.`date`, 10) >= \''.$firstdate.'\' AND LEFT(c.`date`, 10) <= \''.$enddate.'\') AND c.status = \'2\'',
                $like_value   = $requestData['search']['value'], 
                $column_order = $requestData['order'][0]['column'], 
                $column_dir   = $requestData['order'][0]['dir'], 
                $limit_start  = $requestData['start'], 
                $limit_length = $requestData['length'],
                $group_by     = 'a.id'
            );

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data = array();
            $no   = 1;
            foreach($query->result() as $row)
            { 
                $nestedData = array(); 

                $parts    = array();
                $partNo   = 1;
                $jmlPart  = 0;
                $jmlOil   = 0;
                $jmlLabor = 0;
                $jumlah   = 0;

                if($row->parts):
                    foreach(json_decode($row->parts) as $p):
                        $sparepart = $this->global_model->_row('tb_sparepart', ['id' => $p->partid])->row();

                        if(in_array($sparepart->catid, $oil)):
                            $jmlOil += ($p->picking * $p->het) - (($p->disc / 100) * ($p->picking * $p->het));
                        else:
                            $jmlPart += ($p->picking * $p->het) - (($p->disc / 100) * ($p->picking * $p->het));
                        endif;

                        $partNo++;
                    endforeach;
                endif;

                if($row->jobs):
                    foreach(json_decode($row->jobs) as $job):
                        $qty           = ($job->qty) ? $job->qty : 0;
                        $selling_price = ($job->selling_price) ? $job->selling_price : 0;
                        $disc          = ($job->disc) ? $job->disc : 0;

                        $jmlLabor += $selling_price;
                    endforeach;
                endif;

                $nestedData[] = $no;
                $nestedData[] = $row->nama;
                $nestedData[] = $row->work;
                $nestedData[] = $row->totalservice;
                $nestedData[] = 'Rp ' . rupiah($jmlLabor, 2);
                $nestedData[] = 'Rp ' . rupiah($jmlPart, 2);
                $nestedData[] = 'Rp ' . rupiah($jmlOil, 2);
                $nestedData[] = 'Rp ' . rupiah($jmlLabor + $jmlPart + $jmlOil, 2);

                $data[] = $nestedData;
                $no++;
            }

            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),  
                "recordsTotal"    => intval( $totalData ),  
                "recordsFiltered" => intval( $totalFiltered ), 
                "data"            => $data
                );

            echo json_encode($json_data);
        endif;
    }

    function sparepart($kategori)
    {
        if($kategori == 'item')
        {
            cekoto('report/sparepart/item', 'view', true, true);
        }
        elseif($kategori == 'daily-stock')
        {
            cekoto('report/sparepart/daily-stock', 'view', true, true);
        }
        else{
            cekoto('report/sparepart/recommended-order', 'view', true, true);
        }
        if($_POST):
            $requestData    = $_REQUEST;

            $firstdate = $this->input->post('firstdate');
            $enddate   = $this->input->post('enddate');

            $partCat = $this->global_model->_get('tb_sparepart_category', [], [], ['nama LIKE ' => '\'%oil%\'', 'nama LIKE ' => '\'%oli%\'']);
            $oil = array();
            if($partCat->num_rows()):
                foreach($partCat->result() as $cat):
                    $oil[] = $cat->id;
                endforeach;
            endif;

            $fetch = $this->global_model->_retrieve(
                $table = 'tb_sparepart_mutasi a
                            LEFT JOIN tb_sparepart b ON a.sparepartid = b.id
                            LEFT JOIN tb_sparepart_category c ON b.catid = c.id
                            LEFT JOIN tb_abc d ON b.abcid = d.id
                            , (SELECT @no := 0) r',
                $select = '(@no := @no + 1) nomor,
                            IFNULL((SELECT SUM(CASE WHEN type=\'out\' THEN qty ELSE 0 END) FROM tb_sparepart_mutasi WHERE waktu < \''.$firstdate.'\' and sparepartid = a.sparepartid), 0) `outSblm`,
                            IFNULL((SELECT SUM(CASE WHEN type=\'in\' THEN qty ELSE 0 END) FROM tb_sparepart_mutasi WHERE waktu < \''.$firstdate.'\'  and sparepartid = a.sparepartid), 0) `inSblm`,
                            b.id,
                            b.kode,
                            b.nama,
                            c.nama cat,
                            d.code abc,
                            CONCAT(\'[\', GROUP_CONCAT(a.source), \']\') source',
                $colOrder     = array('nomor', 'b.kode', 'b.nama', 'c.nama', 'd.code'),
                $filter       = array(),
                $where        = ' AND (a.source LIKE \'%tb_service_parts%\' OR a.source LIKE \'%tb_actual_stock%\')
                                AND (a.waktu >= \''.$firstdate.'\' AND a.waktu <= \''.$enddate.'\')',
                $like_value   = $requestData['search']['value'], 
                $column_order = $requestData['order'][0]['column'], 
                $column_dir   = $requestData['order'][0]['dir'], 
                $limit_start  = $requestData['start'], 
                $limit_length = $requestData['length'],
                $group_by     = 'a.sparepartid'
            );

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data = array();
            $no   = 1;
            foreach($query->result() as $row)
            { 
                $nestedData = array();

                $qty   = 0;
                $sales = 0;

                if($row->source):
                    foreach(json_decode($row->source) as $tablelain):
                        foreach($tablelain as $table => $valuePrimary):
                            $dukungan = $this->global_model->_row($table, ['id' => $valuePrimary])->row();
                            if($dukungan):
                                switch ($table) {
                                    case 'tb_service_parts':
                                        $qty   += $dukungan->pickingqty;
                                        $sales += ($dukungan->pickingqty * $dukungan->het) - (($dukungan->disc / 100) * ($dukungan->pickingqty * $dukungan->het));
                                        break;
                                    case 'tb_actual_stock':
                                        $actual = $dukungan->qty - $dukungan->actualQty;
                                        $qty   += $actual;
                                        $sales += $actual * $dukungan->het;
                                        break;
                                }
                            endif;
                        endforeach;
                    endforeach;
                endif;

                $stockawal = $row->inSblm - $row->outSblm;
                $ratio = $sales / (($stockawal + ($stockawal - $qty)) / 2);

                $nestedData[] = $row->nomor;
                $nestedData[] = $row->kode;
                $nestedData[] = $row->nama;
                $nestedData[] = $row->cat;
                $nestedData[] = $row->abc;
                $nestedData[] = rupiah($qty);
                $nestedData[] = 'Rp ' . rupiah($sales, 2);
                $nestedData[] = rupiah($stockawal - $qty);
                $nestedData[] = $ratio;

                $data[] = $nestedData;
                $no++;
            }

            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),  
                "recordsTotal"    => intval( $totalData ),  
                "recordsFiltered" => intval( $totalFiltered ), 
                "data"            => $data
                );

            echo json_encode($json_data);
        else:
            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

            $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

            $this->data['js'][] = base_url('assets/custom/js/report/sparepart.js');

            $this->load->templateAdmin('report/sparepart/'.$kategori);
        endif;
    }

    function daily_stock_json()
    {
        if($_POST):
            $requestData    = $_REQUEST;

            $firstdate = $this->input->post('firstdate');
            $enddate   = $this->input->post('enddate');
            $where = '';

            if ($firstdate != 'all') {
               $where = "AND d.id = $firstdate";
            }
            if ($enddate != 'all') {
               $where = "AND c.id = $enddate";
            }

            $fetch = $this->global_model->_retrieve(
                $table =   'tb_sparepart_location a
                            LEFT JOIN tb_sparepart b ON a.sparepartid = b.id
                            LEFT JOIN tb_location c ON a.locationid = c.id
                            LEFT JOIN tb_sparepart_category d ON b.catid = d.id
                            , (SELECT @no := 0) r',
                $select = '(@no := @no + 1 ) nomor,
                            b.*, IFNULL(SUM(a.qty), 0) stock, c.nama as location, d.nama as category',
                $colOrder     = array('nomor', 'b.kode', 'b.nama', 'd.nama', 'c.nama'),
                $filter       = array(),
                $where        ="AND b.status = '1' ".$where,
                $like_value   = $requestData['search']['value'], 
                $column_order = $requestData['order'][0]['column'], 
                $column_dir   = $requestData['order'][0]['dir'], 
                $limit_start  = $requestData['start'], 
                $limit_length = $requestData['length'],
                $group_by     = 'a.id HAVING stock > 0'
            );

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data = array();
            $no   = 1;
            foreach($query->result() as $row)
            { 
                $nestedData = array();

                $nestedData[] = $row->nomor;
                $nestedData[] = $row->kode;
                $nestedData[] = $row->nama;
                $nestedData[] = $row->category;
                $nestedData[] = $row->location;
                $nestedData[] = $row->stock;

                $no++;
                $data[] = $nestedData;

            }
            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),  
                "recordsTotal"    => intval( $totalData ),  
                "recordsFiltered" => intval( $totalFiltered ), 
                "data"            => $data
                );

            echo json_encode($json_data);
        endif;
    }

    function recommended_order_json()
    {
        if($_POST):
            $requestData    = $_REQUEST;
            $firstdate = $this->input->post('firstdate');
            $enddate   = $this->input->post('enddate');

            $fetch = $this->global_model->_retrieve(
                $table =   'tb_sparepart a 
                            LEFT JOIN tb_sparepart_mutasi b ON b.sparepartid = a.id AND b.waktu >= DATE_SUB(NOW(), INTERVAL 90 DAY)
                            LEFT JOIN tb_sparepart_category d ON a.catid = d.id
                            LEFT JOIN tb_abc e ON a.abcid = e.id,
                            (SELECT @no := 0) r ',
                $select = '(@no := @no + 1) nomor, 
                            a.id, 
                            a.kode, 
                            d.nama as category, 
                            a.nama as sparepart, 
                            IFNULL(e.code, \'-\') as abc,
                            IFNULL(SUM(CASE WHEN b.type = \'out\' THEN b.qty ELSE 0 END), 0) average,
                            IFNULL(e.roq, 0) roq',
                $colOrder     = array('nomor', 'a.kode', 'a.nama', 'd.nama', 'e.code'),
                $filter       = array('a.kode', 'a.nama', 'e.code'),
                $where        = '',
                $like_value   = $requestData['search']['value'], 
                $column_order = $requestData['order'][0]['column'], 
                $column_dir   = $requestData['order'][0]['dir'], 
                $limit_start  = $requestData['start'], 
                $limit_length = $requestData['length'],
                $group_by     = 'a.id having ((average/3)*roq) > 0'
            );

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data = array();
            $no   = 1;
            foreach($query->result() as $row)
            { 
                $nestedData = array();
                if (($row->average / 3) * $row->roq) {
                  $nestedData[] = $row->nomor;
                  $nestedData[] = $row->kode;
                  $nestedData[] = $row->sparepart;
                  $nestedData[] = $row->category;
                  $nestedData[] = $row->abc;
                  $nestedData[] = rupiah(($row->average / 3) * $row->roq);

                  $no++;
                  $data[] = $nestedData;
                }

            }
            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),  
                "recordsTotal"    => intval( $totalData ),  
                "recordsFiltered" => intval( $totalFiltered ), 
                "data"            => $data
                );

            echo json_encode($json_data);
        endif;
    }

    function parts_daily_stock()
    {
        $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

        $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
        $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
        $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

        $this->data['js'][] = base_url('assets/custom/js/report.js');

        $this->load->templateAdmin('report/parts_daily_stock');
    }

    function recomd_order()
    {
        $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
        $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

        $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
        $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
        $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
        $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

        $this->data['js'][] = base_url('assets/custom/js/report.js');

        $this->load->templateAdmin('report/recomd-order');
    }

    function finance()
    {
        $this->ledger();
    }

    function ledger()
    {
        if($_POST):
            $requestData    = $_REQUEST;

            $where = '';
            // $where = 'AND a.status = \'1\'';
            $where .= 'AND a.coaid = \''.$this->input->post('coaid').'\'';
            $where .= ' AND a.tanggal BETWEEN \''.$this->input->post('firstday').'\' AND \''.$this->input->post('lastday').'\'';

            $fetch = $this->global_model->_retrieve(
                $table = 'tb_jurnal a
                             LEFT JOIN `tb_coa` AS b ON a.`coaid` = b.`id`',
                $select = 'a.tanggal, a.keterangan, (CASE WHEN a.type = \'dr\' THEN a.nominal ELSE \'-\' END) debit, (CASE WHEN a.type = \'cr\' THEN a.nominal ELSE \'-\' END) credit',
                $colOrder     = array('a.tanggal'),
                $filter       = array(),
                $where        = " $where",
                $like_value   = $requestData['search']['value'], 
                $column_order = $requestData['order'][0]['column'], 
                $column_dir   = $requestData['order'][0]['dir'], 
                $limit_start  = $requestData['start'], 
                $limit_length = $requestData['length']
            );

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data = array();
            $no   = 1;
            foreach($query->result() as $row)
            { 
                 // print_ar($this->db->last_query());
                $nestedData = array(); 

                $nestedData[] = tgl($row->tanggal);
                $nestedData[] = $row->keterangan;
                $nestedData[] = ($row->debit == '-') ? '-' : rupiah($row->debit, 2);
                $nestedData[] = ($row->credit == '-') ? '-' : rupiah($row->credit, 2);

                $data[] = $nestedData;
                $no++;
            }

            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),  
                "recordsTotal"    => intval( $totalData ),  
                "recordsFiltered" => intval( $totalFiltered ), 
                "data"            => $data
                );

            echo json_encode($json_data);
        else:
            $this->data['css'][] = base_url('assets/libs/nestable2/jquery.nestable.min.css');

            $this->data['js'][] = base_url('assets/libs/nestable2/jquery.nestable.min.js');
            $this->data['js'][] = base_url('assets/custom/js/report/finance.js');

            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

            $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

            $data = array(
                'coa' => $this->global_model->_get(
                    'tb_coa_group a', 
                    ['b.status' => '1'], 
                    [], 
                    [], 
                    'a.id, a.kode, a.nama, CONCAT(\'[\', GROUP_CONCAT(CONCAT(\'{"id":"\', b.id, \'","kode":"\', b.kode, \'","nama":"\', b.nama, \'","parentid":"\', IFNULL(b.parentid, 0), \'"}\')), \']\') coa',
                    [
                        ['tb_coa b', 'a.id = b.groupid', 'left']
                    ],
                    false,
                    false,
                    'a.id'
                ),
            );

            $this->load->templateAdmin('report/finance/ledger', $data);
        endif;
    }

    function coa_detail($coaid)
    {
        if($this->input->is_ajax_request()):
            $coa = $this->global_model->_get('tb_coa', ['id' => $coaid])->row();

            echo json_encode($coa);
        endif;
    }

    function cash_flow()
    {
        if($_POST):
            $requestData    = $_REQUEST;

            $kasbesarlist = $this->global_model->_get(
                    'tb_limit a', 
                    ['a.mod' => 'kas-besar'], 
                    [], 
                    [],
                    'a.id, a.coaid, concat(b.kode, \' \', b.nama) coa',
                    [
                        ['tb_coa b', 'a.coaid = b.id', 'left']
                    ],
                    false,
                    false
                );

            $kaskecillist = $this->global_model->_get(
                    'tb_limit a', 
                    ['a.mod' => 'kas-kecil'], 
                    [], 
                    [],
                    'a.id, a.coaid, concat(b.kode, \' \', b.nama) coa',
                    [
                        ['tb_coa b', 'a.coaid = b.id', 'left']
                    ],
                    false,
                    false
                );

            $list = array();
            foreach($kasbesarlist->result() as $coaList):
                $list[] = $coaList->coaid;
            endforeach;
            foreach($kaskecillist->result() as $coaList):
                $list[] = $coaList->coaid;
            endforeach;

            $where = '';
            // $where = 'AND a.status = \'1\'';
            // $where .= 'AND a.coaid = \''.$this->input->post('coaid').'\'';
            // $where .= ' AND a.tanggal BETWEEN \''.$this->input->post('firstday').'\' AND \''.$this->input->post('lastday').'\'';

            $where .= ' AND a.coaid IN ('.implode(',', $list).')';

            $fetch = $this->global_model->_retrieve(
                $table = 'tb_jurnal a
                             LEFT JOIN `tb_coa` AS b ON a.`coaid` = b.`id`
                             , (SELECT @balance := 0) b',
                $select = 'CONCAT(b.kode, \' \', b.nama) coa, a.tanggal, a.keterangan, (CASE WHEN a.type = \'dr\' THEN a.nominal ELSE \'-\' END) debit, (CASE WHEN a.type = \'cr\' THEN a.nominal ELSE \'-\' END) credit, @balance := @balance + ((CASE WHEN a.type = \'dr\' THEN a.nominal ELSE 0 END) - (CASE WHEN a.type = \'cr\' THEN a.nominal ELSE 0 END)) balance',
                $colOrder     = array('a.tanggal'),
                $filter       = array(),
                $where        = " $where",
                $like_value   = $requestData['search']['value'], 
                $column_order = $requestData['order'][0]['column'], 
                $column_dir   = $requestData['order'][0]['dir'], 
                $limit_start  = $requestData['start'], 
                $limit_length = $requestData['length'],
                'a.coaid'
            );

            $totalData      = $fetch['totalData'];
            $totalFiltered  = $fetch['totalFiltered'];
            $query          = $fetch['query'];

            $data = array();
            $no   = 1;
            foreach($query->result() as $row)
            { 
                 // print_ar($this->db->last_query());
                $nestedData = array(); 

                $nestedData[] = tgl($row->tanggal);
                $nestedData[] = $row->coa;
                $nestedData[] = $row->keterangan;
                $nestedData[] = ($row->debit == '-') ? '-' : rupiah($row->debit, 2);
                $nestedData[] = ($row->credit == '-') ? '-' : rupiah($row->credit, 2);
                $nestedData[] = rupiah($row->balance, 2);

                $data[] = $nestedData;
                $no++;
            }

            $json_data = array(
                "draw"            => intval( $requestData['draw'] ),  
                "recordsTotal"    => intval( $totalData ),  
                "recordsFiltered" => intval( $totalFiltered ), 
                "data"            => $data
                );

            echo json_encode($json_data);
        else:
            $this->data['css'][] = base_url('assets/libs/nestable2/jquery.nestable.min.css');

            $this->data['js'][] = base_url('assets/libs/nestable2/jquery.nestable.min.js');

            $this->data['css'][] = base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css');
            $this->data['css'][] = base_url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css');

            $this->data['js'][] = base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js');
            $this->data['js'][] = base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/pdfmake.min.js');
            $this->data['js'][] = base_url('assets/libs/pdfmake/build/vfs_fonts.js');

            $this->data['js'][] = base_url('assets/custom/js/report/finance.js');

            $data = array(
                'coa' => $this->global_model->_get(
                    'tb_limit a', 
                    [], 
                    [], 
                    ['a.mod' => 'kas-besar', 'a.mod' => 'kas-kecil'], 
                    'a.id, a.coaid, concat(b.kode, \' \', b.nama) coa',
                    [
                        ['tb_coa b', 'a.coaid = b.id', 'left']
                    ],
                    false,
                    false
                ),
            );

            $this->load->templateAdmin('report/finance/cash-flow', $data);
        endif;
    }
}
  