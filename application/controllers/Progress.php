<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $data['badges'] = $this->get_badges();

        $this->load->view('header');
        $this->load->view('progress', $data);
        $this->load->view('footer');
    }

    /**
     * Collect badge progress data. In a real implementation this would
     * be hydrated from a model using the active user's progress, but for now
     * we normalize stubbed data so the view can render consistently.
     *
     * @return array<int,array<string,mixed>>
     */
    private function get_badges()
    {
        return [
            [
                'title' => 'Streak Starter',
                'description' => 'Complete 3 challenges in a row to build momentum.',
                'icon' => 'fa-bolt',
                'earned' => true,
            ],
            [
                'title' => 'Brain Builder',
                'description' => 'Score 80% or more in any logic game.',
                'icon' => 'fa-puzzle-piece',
                'earned' => false,
            ],
            [
                'title' => 'Speed Runner',
                'description' => 'Finish a timed challenge with more than 30 seconds left.',
                'icon' => 'fa-tachometer',
                'earned' => true,
            ],
            [
                'title' => 'Perfect Session',
                'description' => 'Earn full points in a practice session without hints.',
                'icon' => 'fa-star',
                'earned' => false,
            ],
            [
                'title' => 'Community Helper',
                'description' => 'Share feedback on 3 different challenges.',
                'icon' => 'fa-heart',
                'earned' => false,
            ],
            [
                'title' => 'Focus Master',
                'description' => 'Maintain a 10-day active streak.',
                'icon' => 'fa-eye',
                'earned' => true,
            ],
        ];
    }
}
