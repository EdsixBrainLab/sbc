<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $progressPayload = $this->get_progress_payload();
        $data['badges'] = $progressPayload['badges'];
        $data['progressPayload'] = $progressPayload;

        $this->load->view('header');
        $this->load->view('progress', $data);
        $this->load->view('footer');
    }

    /**
     * Load a cached payload if available; otherwise refresh via the model layer.
     *
     * @return array<string,mixed>
     */
    private function get_progress_payload()
    {
        $cacheTtl = 600; // 10 minutes
        $cached = $this->session->userdata('progress_cache');

        if (!empty($cached['timestamp']) && (time() - $cached['timestamp']) < $cacheTtl) {
            return $cached['payload'];
        }

        $userId = $this->session->userdata('userId');
        $contestLevelId = $this->session->userdata('userContestLevelId');
        $payload = $this->Dashboard_model->get_progress_payload($userId, $contestLevelId);

        $this->session->set_userdata('progress_cache', [
            'payload' => $payload,
            'timestamp' => time(),
        ]);

        return $payload;
    }
}
