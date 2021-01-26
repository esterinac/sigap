<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reviewer_model extends MY_Model
{
    protected $per_page = 10;

    public function get_validation_rules()
    {
        $validation_rules = [
            [
                'field' => 'user_id',
                'label' => $this->lang->line('form_user_name'),
                'rules' => 'trim|required|callback_unique_data[user_id]',
            ],
            [
                'field' => 'faculty_id',
                'label' => $this->lang->line('form_faculty_name'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'reviewer_name',
                'label' => $this->lang->line('form_reviewer_name'),
                'rules' => 'trim|required|min_length[1]|max_length[256]',
            ],
            [
                'field' => 'reviewer_nip',
                'label' => $this->lang->line('form_reviewer_nip'),
                'rules' => 'trim|required|min_length[1]|max_length[256]|callback_unique_data[reviewer_nip]',
            ],
            [
                'field' => 'reviewer_degree_front',
                'label' => $this->lang->line('form_reviewer_degree_front'),
                'rules' => 'trim|min_length[2]|max_length[256]',
            ],
            [
                'field' => 'reviewer_degree_back',
                'label' => $this->lang->line('form_reviewer_degree_back'),
                'rules' => 'trim|min_length[2]|max_length[256]',
            ],
            [
                'field' => 'reviewer_contact',
                'label' => $this->lang->line('form_reviewer_contact'),
                'rules' => 'trim|max_length[20]|callback_unique_data[reviewer_contact]',
            ],
            [
                'field' => 'reviewer_email',
                'label' => $this->lang->line('form_reviewer_email'),
                'rules' => 'trim|valid_email|callback_unique_data[reviewer_email]',
            ],
            [
                'field' => 'reviewer_expert[]',
                'label' => $this->lang->line('form_reviewer_expert'),
                'rules' => 'trim|required',
            ],
        ];

        return $validation_rules;
    }

    public function get_default_values()
    {
        return [
            'reviewer_nip'          => null,
            'reviewer_name'         => null,
            'reviewer_degree_front' => null,
            'reviewer_degree_back'  => null,
            'faculty_id'            => null,
            'reviewer_contact'      => null,
            'reviewer_email'        => null,
            'user_id'               => null,
            'reviewer_expert'       => [],
        ];
    }

    public function get_data($keywords, $page = null)
    {
        $query = $this->select('reviewer_id,reviewer_nip,reviewer_name,reviewer_degree_front,reviewer_degree_back,reviewer_expert,faculty_name,username')
            ->like('reviewer_nip', $keywords)
            ->or_like('reviewer_name', $keywords)
            ->or_like('reviewer_expert', $keywords)
            ->or_like('faculty_name', $keywords)
            ->or_like('username', $keywords)
            ->join('faculty')
            ->join('user')
            ->order_by('faculty.faculty_id')
            ->order_by('reviewer_name');

        return [
            'data'  => $query->paginate($page)->get_all(),
            'count' => $this
                ->like('reviewer_nip', $keywords)
                ->or_like('reviewer_name', $keywords)
                ->or_like('reviewer_expert', $keywords)
                ->or_like('faculty_name', $keywords)
                ->or_like('username', $keywords)
                ->join('faculty')
                ->join('user')
                ->count(),
        ];
    }

    public function get_draft_reviewers($draft_id)
    {
        return $this->select(['draft_reviewer_id', 'draft_reviewer.reviewer_id', 'reviewer_name', 'reviewer_nip', 'faculty_name'])
            ->join('faculty')
            ->join_table('draft_reviewer', 'reviewer', 'reviewer')
            ->join_table('draft', 'draft_reviewer', 'draft')
            ->where('draft_reviewer.draft_id', $draft_id)
            ->get_all();
    }

    public function api_get_reviewers()
    {
        return $this->select('reviewer_id,reviewer_nip,reviewer_name,reviewer_degree_front,reviewer_degree_back,faculty_name,username,reviewer.user_id')
            ->join('faculty')
            ->join('user')
            ->order_by('reviewer.faculty_id')
            ->order_by('reviewer_name')
            ->get_all();
    }
}