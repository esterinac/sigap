<?php defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends MY_Model
{
    public $per_page = 10;

    public function add_invoice()
    {
        $date_created       = date('Y-m-d H:i:s');
        //$user_created       = $_SESSION['username'];

        $add = [
            'number'            => $this->input->post('number'),
            'customer_id'       => $this->input->post('customer-id'),
            'due_date'          => $this->input->post('due-date'),
            'type'              => $this->input->post('type'),
            'status'            => 'waiting',
            'issued_date'       => $date_created
            // 'user_created'      => $user_created
        ];
        $this->db->insert('invoice', $add);

        $invoice_id = $this->db->insert_id();

        // Jumlah Buku di Faktur
        $countsize = $this->input->post('invoice_book_id');

        for ($i = 0; $i < $countsize; $i++) {
            $book = [
                'invoice_id'    => $invoice_id,
                'book_id'       => $this->input->post('invoice_book_id')[$i],
                'qty'           => $this->input->post('invoice_qty')[$i],
                'discount'      => $this->input->post('invoice_discount')[$i]
            ];
            $this->db->insert('invoice_book', $book);
        }
        return TRUE;
    }

    public function update_status($invoice_id, $status)
    {
        if($status == 'confirm')
        {
            $edit = [
                'status'          => $status,
                'confirm_date'    => date('Y-m-d H:i:s'),
                //'user_edited'   => $_SESSION['username']
            ];    
        }

        $this->db->set($edit)->where('invoice_id', $invoice_id)->update('invoice');
        return TRUE;
    }

    // public function initial_stock($logistic_id, $stock_warehouse, $stock_production, $stock_other, $user_created, $date_created)
    // {
    //     $insert = [
    //         'logistic_id'       => $logistic_id,
    //         'stock_warehouse'   => $stock_warehouse,
    //         'stock_production'  => $stock_production,
    //         'stock_other'       => $stock_other,
    //         'input_notes'       => 'Input awal dari stok logistik.',
    //         'input_type'        => 'logistic',
    //         'input_user'        => $user_created,
    //         'input_date'        => $date_created
    //     ];

    //     $this->db->insert('logistic_stock', $insert);
    // }

    // public function edit_logistic($logistic_id)
    // {
    //     $edit = [
    //         'name'          => $this->input->post('name'),
    //         'type'          => $this->input->post('type'),
    //         'category'      => $this->input->post('category'),
    //         'notes'         => $this->input->post('notes'),
    //         'date_edited'   => date('Y-m-d H:i:s'),
    //         'user_edited'   => $_SESSION['username']
    //     ];

    //     $this->db->set($edit)->where('logistic_id', $logistic_id)->update('logistic');
    //     return TRUE;
    // }

    // public function delete_logistic($logistic_id)
    // {
    //     $this->db->where('logistic_id', $logistic_id)->delete('logistic');
    //     return TRUE;
    // }

    public function fetch_invoice_id($invoice_id)
    {
        return $this->db
            ->select('*')
            ->from('invoice')
            ->where('invoice_id', $invoice_id)
            ->get()
            ->row();
    }

    public function fetch_invoice_book($invoice_id)
    {
        return $this->db
            ->select('invoice_book.*, book.book_title, book.harga')
            ->from('invoice_book')
            ->join('book', 'book.book_id = invoice_book.book_id')
            ->where('invoice_id', $invoice_id)
            ->get()
            ->result();
    }

    public function fetch_book_info($book_id)
    {
        return $this->db
            ->select('book_title')
            ->from('book')
            ->where('book_id', $book_id)
            ->get()
            ->row();
    }

    // public function fetch_stock_by_id($logistic_id)
    // {

    //     $stock_history    = $this->db->select('*')->from('logistic_stock')->where('logistic_id', $logistic_id)->order_by("UNIX_TIMESTAMP(input_date)", "DESC")->get()->result();
    //     $stock_last       = $this->db->select('*')->from('logistic_stock')->where('logistic_id', $logistic_id)->order_by("UNIX_TIMESTAMP(input_date)", "DESC")->limit(1)->get()->row();
    //     return [
    //         'stock_history' => $stock_history,
    //         'stock_last'    => $stock_last
    //     ];
    // }

    // public function add_logistic_stock()
    // {
    //     $logistic_id            = $this->input->post('logistic_id');
    //     $initial_warehouse      = intval($this->input->post('initial_warehouse'));
    //     $initial_production     = intval($this->input->post('initial_production'));
    //     $initial_other          = intval($this->input->post('initial_other'));
    //     $modifier_warehouse     = intval($this->input->post('modifier_warehouse'));
    //     $modifier_production    = intval($this->input->post('modifier_production'));
    //     $modifier_other         = intval($this->input->post('modifier_other'));
    //     $final_warehouse        = $initial_warehouse + $modifier_warehouse;
    //     $final_production       = $initial_production + $modifier_production;
    //     $final_other            = $initial_other + $modifier_other;

    //     if ($modifier_warehouse < 0) {
    //         $modifier_warehouse  =   ' - ' . abs($modifier_warehouse);
    //     } elseif ($modifier_warehouse >= 0) {
    //         $modifier_warehouse  =   ' + ' . abs($modifier_warehouse);
    //     }

    //     if ($modifier_production < 0) {
    //         $modifier_production  =   ' - ' . abs($modifier_production);
    //     } elseif ($modifier_production >= 0) {
    //         $modifier_production  =   ' + ' . abs($modifier_production);
    //     }

    //     if ($modifier_other < 0) {
    //         $modifier_other  =   ' - ' . abs($modifier_other);
    //     } elseif ($modifier_other >= 0) {
    //         $modifier_other  =   ' + ' . abs($modifier_other);
    //     }

    //     $edit   =   [
    //         'stock_warehouse'   => intval($final_warehouse),
    //         'stock_production'  => intval($final_production),
    //         'stock_other'       => intval($final_other)
    //     ];

    //     $add    =   [
    //         'logistic_id'       => $logistic_id,
    //         'stock_warehouse'   => $initial_warehouse . $modifier_warehouse,
    //         'stock_production'  => $initial_production . $modifier_production,
    //         'stock_other'       => $initial_other . $modifier_other,
    //         'input_notes'       => $this->input->post('input_notes'),
    //         'input_type'        => 'logistic_stock',
    //         'input_user'        => $_SESSION['username']
    //     ];

    //     $this->db->set($edit)->where('logistic_id', $logistic_id)->update('logistic');
    //     $this->db->insert('logistic_stock', $add);
    //     return TRUE;
    // }

    // public function delete_logistic_stock($logistic_stock_id)
    // {
    //     $this->db->where('logistic_stock_id', $logistic_stock_id)->delete('logistic_stock');
    //     return TRUE;
    // }

    public function get_book($book_id)
    {
        return $this->select('book.*')
            ->where('book_id', $book_id)
            ->get('book');
    }

    public function get_customer($customer_id)
    {
        return $this->select('customer.*')
            ->where('customer_id', $customer_id)
            ->get('customer');
    }

    public function get_last_invoice_number($type)
    {
        $initial = '';
        switch ($type) {
            case 'credit':
                $initial = 'K';
                break;
            case 'cash':
                $initial = 'T';
                break;
            case 'online':
                $initial = 'TO';
                break;
            case 'showroom':
                $initial = 'S';
                break;
        }
        $date_created       = substr(date('Ymd'), 2);
        $data = $this->db->select('*')->where('type', $type)->count_all_results('invoice') + 1;
        $invoiceNumber = $initial . $date_created . '-' . str_pad($data, 6, 0, STR_PAD_LEFT);
        return $invoiceNumber;
    }

    public function filter_invoice($filters, $page)
    {
        $invoice = $this->select(['invoice_id', 'number', 'issued_date', 'due_date', 'status', 'type'])
            ->when('keyword', $filters['keyword'])
            ->when('type', $filters['type'])
            ->when('status', $filters['status'])
            ->order_by('invoice_id')
            ->paginate($page)
            ->get_all();

        $total = $this->select(['invoice_id', 'number'])
            ->when('keyword', $filters['keyword'])
            ->when('type', $filters['type'])
            ->when('status', $filters['status'])
            ->order_by('invoice_id')
            ->count();

        return [
            'invoice'  => $invoice,
            'total' => $total
        ];
    }

    public function when($params, $data)
    {
        // jika data null, maka skip
        if ($data != '') {
            if ($params == 'keyword') {
                $this->group_start();
                $this->or_like('invoice_id', $data);
                $this->or_like('number', $data);
                $this->or_like('customer_name', $data);
                $this->or_like('customer_number', $data);
                $this->group_end();
            } else {
                $this->group_start();
                $this->or_like('type', $data);
                $this->or_like('status', $data);
                $this->group_end();
            }
        }
        return $this;
    }
}