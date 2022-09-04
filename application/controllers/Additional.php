<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class : Additional
 * By : Puzha Fauzha
 */
class Additional extends MY_Controller
{
    function __construct() {
        parent::__construct();
        isloggedin();
        $this->load->model('service_model');
    }

    function index()
    {
        $this->summary();
    }

    function summary($type = false)
    {
        cekoto('additional/summary','view', true, true);
        $this->data['menuName'] = 'Additional Summary';

        if($_POST):
            $where = '';
            $status = $this->input->post('status');
            $start_date = $this->input->post('start_date');
            $last_date = $this->input->post('last_date');
            if ($status != 'all') {
                $where .= "AND d.status = '".$status."'";
            }
            if($start_date != NULL && $last_date != NULL)      
                $where .= " AND LEFT(a.tanggal, 10) BETWEEN '".$start_date."' AND '".$last_date."'";
            else
                $where .= "";

            // if($this->input->is_ajax_request()):
                $requestData    = $_REQUEST;
                $fetch          = $this->global_model->_retrieve(
                    $table = 'tb_'.$type.' a
                                LEFT JOIN tb_customer_vehicles b ON a.vehicleid = b.id
                                LEFT JOIN tb_customer_unit c ON b.unit_id = c.id
                                lEFT JOIN tb_payments d ON a.id = JSON_EXTRACT(d.source, \'$.tb_'.$type.'\')',
                    $select   = 'a.id, a.nota, a.tanggal, a.userid, a.vehicleid, a.detail, a.subtotal, a.discount, a.grandtotal, a.cash, a.status, c.nama kendaraan, d.status paid',
                    $colOrder     = array('a.tanggal'),
                    $filter       = array(),
                    $where        = $where,
                    $requestData['search']['value'], 
                    $requestData['order'][0]['column'], 
                    $requestData['order'][0]['dir'], 
                    $requestData['start'], 
                    $requestData['length']
                );
                
                $totalData      = $fetch['totalData'];
                $totalFiltered  = $fetch['totalFiltered'];
                $query          = $fetch['query'];

                $data   = array();
                foreach($query->result() as $row)
                { 
                    $nestedData = array(); 

                    $nestedData[] = tgl($row->tanggal);
                    $nestedData[] = $row->nota;
                    $nestedData[] = rupiah($row->grandtotal, 2);
                    $nestedData[] = ($row->paid == '1') ? '<span class="badge badge-outline-info">Paid</span>' : '<span class="badge badge-outline-warning">Pending</span>';
                    $print = '<a href="'.base_url('additional/print-wo/'.$type.'/'.encode($row->id).'?cetak=1').'" class="btn btn-success print-wo btn-sm"><i class="fas fa-print mr-1"></i>Print</a>';
                    if($row->paid != '1'):
                        $nestedData[]   = "<div class='btn-group btn-sm'>
                                                <a href='".site_url('additional/edit/'.$type.'/'.encode($row->id))."' id='EditGroup' class='btn btn-sm btn-info waves-effect waves-light'><i class='fas fa-pen-square mr-1'></i> Edit</a>
                                                <a href='".site_url('additional/delete/'.$type.'/'.encode($row->id))."' data-type='$type' class='btn btn-sm btn-danger waves-effect waves-light delete-additional'><i class='fas fa-trash-alt mr-1'></i> Delete</a>".$print."

                                            </div>";
                    else:
                        if($type == 'wash'):
                            $nestedData[] = '<div class="btn btn-group">
                                '.$print.'
                            </div>';
                        else:
                            $nestedData[] = $print;
                        endif;
                    endif;

                    $data[] = $nestedData;
                }

                $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),  
                    "recordsTotal"    => intval( $totalData ),  
                    "recordsFiltered" => intval( $totalFiltered ), 
                    "data"            => $data
                    );
                echo json_encode($json_data);
            // endif;
        else:
            cekoto('additional/summary', 'view', true, true);
            
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

            $this->data['js'][] = base_url('assets/custom/js/additional.js');

            $this->load->templateAdmin('additional/summary');
        endif;
    }

    function edit($type, $id)
    {

        cekoto('additional/summary', 'edit', true ,true);
        $id = decode($id);
        $table = 'tb_'.$type;
        $data['id'] = $id;
        $data['row'] = $this->global_model->_get($table, ['id' => $id])->row();
        // print_ar($data);
        if ($type == 'wash') {
            $join = array(
                ['tb_customer_merk b', 'a.merk_id = b.id', 'left'],
                ['tb_customer_jenis c', 'a.jenis_id = c.id', 'left'],
                ['tb_customer_category_unit d', 'a.kategori_id = d.id', 'left'],
                ['tb_customer_unit e', 'a.unit_id = e.id', 'left'],
                ['tb_customer f', 'a.customer_id = f.id', 'left'],
            );
            $data['row']->data_vehicle = $this->global_model->_get('tb_customer_vehicles a', ['a.id' => $data['row']->vehicleid], array(), array(), 'a.id, a.plat, b.id merkid, b.nama merk, c.id jenisid, c.nama jenis, d.id catid, d.nama cat, e.id unitid, e.nama unit, f.id as customer_id, f.nama, f.last_service, f.total_come, f.desa_id, f.nama, f.no', $join)->row();
            $data['row']->data_vehicle->alamat = $this->service_model->getalamat($data['row']->data_vehicle->desa_id, $data['row']->data_vehicle->customer_id);
        }
        // print_ar($data);die;
        $this->data['js'][] = base_url('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js');
        $this->data['js'][] = base_url('assets/custom/js/'.$type.'.js');
        $this->load->templateAdmin('additional/edit_'.$type, $data);

    }

    function delete($type , $id)
    {
        if ($this->input->is_ajax_request()) {
            if(cekoto('additional/summary', 'delete', false, false)):

                $id = decode($id);
                $this->global_model->_delete('tb_'.$type, ["id" => $id]);
                $this->db->query("delete from tb_payments where JSON_EXTRACT(source, '$.tb_".$type."') = '".$id."'");
                echo json_encode(['status' => 1, 'pesan' => 'Deleted '.$type.' is success']);
            else:
                $this->query_error('Sorry you don\'t have access to delete this data');
            endif;
         } 
    }

    function print_wo($type = false, $id = false)
    {
        $customer = [];
        // echo encode(67);
        $data = array(
            'type' => $type,
            'company' => $this->global_model->_get('pp_settings')->row(),
            'data' => $this->global_model->_get(
                $table = 'tb_'.$type.' a',
                ['a.id' => decode($id)],
                [],
                [],
                'a.*, d.nama kendaraan, b.plat, c.nama as customer, c.no as no_hp, c.id as customer_id, c.desa_id',
                [
                    ['tb_customer_vehicles b', 'a.vehicleid = b.id', 'left'],
                    ['tb_customer c', 'b.customer_id = c.id', 'left'],
                    ['tb_customer_unit d', 'b.unit_id = d.id', 'left'],
                ]
            )->row()
        );
        // print_ar($data);
        $this->load->templateAdmin('additional/print-wo', $data);
    }

    function retail_data($id)
    {
        if($_POST)
        {
            if( ! empty($_POST['kode-barang']))
            {
                $total = COUNT($_POST['kode-barang']);

                if($total > 0)
                {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('nomor_nota','Nomor Nota','trim|required|max_length[40]|alpha_numeric');
                    $this->form_validation->set_rules('tanggal','Date Time','trim|required');
                    
                    $no = 0;
                    foreach($_POST['kode-barang'] as $d)
                    {
                        if( ! empty($d))
                        {
                            $this->form_validation->set_rules('kode-barang['.$no.']','Item #'.($no + 1), 'trim|required');
                            $this->form_validation->set_rules('jumlah_beli['.$no.']','Qty #'.($no + 1), 'trim|numeric|required');
                        }

                        $no++;
                    }
                    
                    // $this->form_validation->set_rules('cash','Cash Amount', 'trim|numeric|required|max_length[17]');

                    if($this->form_validation->run() == TRUE)
                    {
                        // print_ar($this->input->post());
                        $nomor_nota = $this->input->post('nomor_nota');
                        $tanggal    = $this->input->post('tanggal');
                        $userid     = $this->input->post('userid');
                        // $vehicleid  = $this->input->post('vehicleid');
                        // $bayar      = toFloat($this->input->post('cash'));
                        $subtotal   = toFloat($this->input->post('subtotal'));
                        $totaldisc  = toFloat($this->input->post('totaldisc'));
                        $grandtotal = toFloat($this->input->post('grand_total'));
                        // echo $grandtotal;
                        $status     = $this->input->post('status');

                        // if($bayar < $grandtotal)
                        // {
                        //  $this->query_error("Cash Kurang");
                        // }
                        // else
                        // {
                            $no_array = 0;
                            $details  = array();
                            foreach($_POST['kode-barang'] as $k)
                            {
                                if( ! empty($k))
                                {
                                    $kode_barang  = $_POST['kode-barang'][$no_array];
                                    $jumlah_beli  = $_POST['jumlah_beli'][$no_array];
                                    $harga_satuan = $_POST['harga_satuan'][$no_array];
                                    $discount     = $_POST['diskon'][$no_array];
                                    $sub_total    = $_POST['sub_total'][$no_array];
                                    
                                    $details[] = array(
                                        'retailid'   => $kode_barang,
                                        'qty'      => $jumlah_beli,
                                        'harga'    => $harga_satuan,
                                        'diskon'   => $discount,
                                        'subtotal' => $sub_total,
                                    );
                                }

                                $no_array++;
                            }

                            $retaildata = array(
                                'nota'       => $nomor_nota,
                                'tanggal'    => $tanggal,
                                'userid'     => $userid,
                                // 'vehicleid'  => $vehicleid,
                                'subtotal'   => toFloat($subtotal),
                                'discount'   => toFloat($totaldisc),
                                'grandtotal' => toFloat($grandtotal),
                                // 'cash'       => toFloat($bayar),
                                'detail'     => json_encode($details),

                            );

                            $retailid = $id;
                            $this->global_model->_update('tb_retail', $retaildata, ['id' => decode($id)]);

                            if($this->db->affected_rows() > 0)
                            {
                                $source = [
                                    'tb_retail' => $retailid,
                                ];
                                $query = "UPDATE tb_payments set tagihan = '".toFloat($grandtotal)."' WHERE JSON_EXTRACT(source, '$.tb_retail') = '".decode($id)."'";
                                $this->db->query($query);
                                echo json_encode(array('status' => 1, 'pesan' => "Transaksi berhasil diedit !", 'retailid' => $id));
                            }
                            else
                            {
                                echo $this->db->last_query();
                                // $this->query_error($this->db->last_query());
                            }
                        // }
                    }
                    else
                    {
                        echo json_encode(array('status' => 0, 'pesan' => validation_errors("<font color='red'>- " , "</font><br />") ));
                    }
                }
                else
                {
                    $this->query_error("Harap masukan minimal 1 kode barang !");
                }
            }
            else
            {
                $this->query_error("Harap masukan minimal 1 kode barang !");
            }
        }
    }
}