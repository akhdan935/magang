<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;
        $perPage = 8;

        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $users = $this->usersModel->searchUsers($keyword);
        } else {
            $users = $this->usersModel;
        }

        $data = [
            'title' => 'User List',
            'users' => $users->paginate($perPage, 'users'),
            'pager' => $this->usersModel->pager,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'keyword' => $keyword
        ];

        return view('admin/index', $data);
    }
    public function addUsers()
    {
        $data = [
            'title' => 'Add Users',
            'validation' => session()->get('validation')
        ];

        return view('admin/addUsers', $data);
    }
    public function saveUsers()
    {
        if(!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username must be filled',
                    'is_unique' => 'Username already registered'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password must be filled',
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('admin/addusers')->withInput()->with('validation', $validation);
        }

        $this->usersModel->save([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'type' => $this->request->getVar('type')
        ]);

        session()->setFlashdata('message', 'Record succesfully added');

        return redirect()->to('admin');
    }
    public function deleteUsers($id)
    {
        $this->usersModel->delete($id);
        session()->setFlashdata('message', 'Record succesfully deleted');
        return redirect()->to('admin');
    }
    public function editUsers($id)
    {
        $data = [
            'title' => 'Edit Users',
            'validation' => session()->get('validation'),
            'users' => $this->usersModel->getUsers($id)
        ];

        return view('admin/editUsers', $data);
    }
    public function updateUsers($id)
    {
        $oldUsers = $this->usersModel->getUsers($id);
        if($oldUsers['username'] == $this->request->getVar('username')){
            $title_rules = 'required';
        } else {
            $title_rules = 'required|is_unique[users.username]';
        }

        if($this->request->getVar('password') == null){
            $password = $oldUsers['password'];
        } else {
            $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        if(!$this->validate([
            'username' => [
                'rules' => $title_rules,
                'errors' => [
                    'required' => 'Username must be filled',
                    'is_unique' => 'Username already registered'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('admin/editusers/' . $id)->withInput()->with('validation', $validation);
        }

        $this->usersModel->save([
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'password' => $password,
            'type' => $this->request->getVar('type')
        ]);

        session()->setFlashdata('message', 'Record succesfully edited');

        return redirect()->to('admin');
    }
    public function detailUsersFirst($id)
    {
        $user = $this->usersModel->find($id);
        $presence = $this->presenceModel->getByUsername($user['username']);
        $date = "2020/01/01";

        $data = [
            'title' => 'Detail Users',
            'presence' => $presence,
            'date' => $date,
            'id' => $id,
            'username' => $user['username']
        ];

        return view('admin/detailfirst', $data);
    }

    public function detailUsersSecond($id, $year)
    {
        $user = $this->usersModel->find($id);
        $presence = $this->presenceModel->getByUsername($user['username']);
        $date = $year . "/01/01";

        $data = [
            'title' => 'Detail Users',
            'presence' => $presence,
            'date' => $date,
            'id' => $id,
            'username' => $user['username']
        ];

        return view('admin/detailsecond', $data);
    }

    public function detailUsersLast($id, $year, $month)
    {
        $user = $this->usersModel->find($id);
        $date = $year . "-" . $month;
        $model = $this->presenceModel->getByDate($user['username'], $date);
        $presence = ceil(count($model) / 2);
        $absent = $this->absentModel->findHard($user['username'], $date);
        $days = 0;
        foreach($absent as $abs){
            $days += $abs['days'];
        }

        $data = [
            'title' => 'Detail Users',
            'presence' => $presence,
            'user' => $user,
            'id' => $id,
            'days' => $days
        ];

        return view('admin/detaillast', $data);
    }
    public function absent($id)
    {
        $user = $this->usersModel->find($id);

        $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;
        $perPage = 3;

        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $absent = $this->absentModel->search($keyword, $user['username'])->orderBy('id', 'DESC');
        } else {
            $absent = $this->absentModel->searchByUsername($user['username'])->orderBy('id', 'DESC');
        }

        $data = [
            'title' => 'Absent Record',
            'absents' => $absent->paginate($perPage, 'absent'),
            'pager' => $this->absentModel->pager,
            'keyword' => $keyword,
            'id2' => $id
        ];

        return view('admin/absent', $data);
    }
    public function deleteAbsent($id, $id2)
    {
        $absent = $this->absentModel->find($id);

        unlink('img/absent/' . $absent['image']);

        $this->absentModel->delete($id);
        session()->setFlashdata('message', 'Absent succesfully deleted');
        return redirect()->to('admin/absent/' . $id2);
    }
}