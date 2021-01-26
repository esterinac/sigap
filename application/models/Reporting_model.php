
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting_model extends MY_Model{

  public function __construct()
  {
    parent::__construct();
  }

  /*Model for fetching data to the table*/

  public function fetch_data()
  {
    $query = $this->db->query("SELECT * FROM draft ORDER BY entry_date ASC");
    return $query->result();
  }

  public function fetch_data_baru()
  {
    $query = $this->db->query("SELECT * FROM draft ORDER BY entry_date ASC");
    return $query->result();
  }

  public function fetch_data_ulang()
  {
    $query = $this->db->query("SELECT * FROM draft ORDER BY entry_date ASC");
    return $query->result();
  }

  public function fetch_data_draft()
  {
    $query = $this->db->query("SELECT * FROM draft ORDER BY entry_date DESC LIMIT 5");
    return $query->result();
  }

  public function fetch_data_book()
  {
    $query = $this->db->query("SELECT * FROM book ORDER BY published_date DESC LIMIT 5");
    return $query->result();
  }

  public function fetch_data_author()
  {
    $query = $this->db->query("SELECT * FROM author ORDER BY author_id DESC LIMIT 10");
    return $query->result();
  }

  public function fetch_data_hibah()
  {
    $query = $this->db->query("SELECT * FROM category ORDER BY category_id ASC LIMIT 10");
    return $query->result();
  }

  public function fetch_performa_editor()
  {
    $query = $this->db->query("SELECT * FROM draft ORDER BY edit_start_date DESC LIMIT 5");
    return $query->result();
  }

  public function fetch_performa_layouter()
  {
    $this->db->select('*');
    $this->db->from('draft');
    $query = $this->db->get();
    return $query->result();
  }

  /*model for graph*/
  public function getSummary($year)
  {
    $query = $this->db->query("SELECT * FROM draft WHERE YEAR(entry_date) = $year");
    return $query->result();
  }

  public function getSummaryUlang($year)
  {
    $query = $this->db->query("SELECT * FROM draft WHERE YEAR(entry_date) = $year and is_reprint = 'y'");
    return $query->result();
  }

  public function getSummaryBaru($year)
  {
    $query = $this->db->query("SELECT * FROM draft WHERE YEAR(entry_date) = $year and is_reprint = 'n'");
    return $query->result();
  }

  public function getDraft($month, $year)
  {
    $query = $this->db->query("SELECT draft_id, draft_title, entry_date FROM draft WHERE MONTH(entry_date) = $month and YEAR(entry_date) = $year");
    return $query->result();
  }

  public function getBook($month, $year)
  {
    $query = $this->db->query("SELECT book_id, book_title, published_date FROM book WHERE Month(published_date) = $month and YEAR(published_date) = $year");
    return $query->result();
  }

  public function getAuthor()
  {
    $query = $this->db->query("SELECT author_id, author_name, author_email FROM author ");
    return $query->result();
  }

  public function getHibah($year)
  {
    $query = $this->db->query("SELECT category_type FROM draft JOIN category ON draft.category_id = category.category_id WHERE YEAR(entry_date) = $year");
    return $query->result();
  }
}
