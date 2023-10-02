<?php

namespace App\Controllers;

use App\Models\FolderModel;

date_default_timezone_set('Asia/Jakarta');

class User extends BaseController
{
    protected $folderModel;
    public function __construct()
    {
        $this->folderModel = new FolderModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_folder') ? $this->request->getVar('page_folder') : 1;
        $perPage = 8;

        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $folders = $this->folderModel->getFolder($keyword);
        } else {
            $folders = $this->folderModel->orderBy('date', 'DESC');
        }

        $data = [
            'title' => 'Presence Folders',
            'validation' => session()->get('validation'),
            'folders' => $folders->paginate($perPage, 'folder'),
            'pager' => $this->folderModel->pager,
            'keyword' => $keyword
        ];

        return view('user/index', $data);
    }
    public function deleteFolder($id)
    {
        $this->folderModel->delete($id);
        session()->setFlashdata('message', 'Folder succesfully deleted');
        return redirect()->to('user');
    }
    public function addFolder()
    {
        if(!$this->validate([
            'date' => [
                'rules' => 'required|is_unique[folder.date]',
                'errors' => [
                    'required' => 'Date must be selected',
                    'is_unique' => 'Folder already registered'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('user')->with('validation', $validation);
        }

        $time = strtotime($this->request->getVar('date'));

        $name = date('D, d M Y ', $time);
        $segment = date('Y/m/d', $time);
        $date = $this->request->getVar('date');

        $this->folderModel->save([
            'name' => $name,
            'segment' => $segment,
            'date' => $date
        ]);

        session()->setFlashdata('message', 'Folder succesfully added');

        return redirect()->to('user');
    }
    public function record($year, $month, $day)
    {
        $dateFolder = $year."/".$month."/".$day;
        $datePresence = $year."-".$month."-".$day;

        $currentPage = $this->request->getVar('page_record') ? $this->request->getVar('page_record') : 1;
        $perPage = 8;

        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $record = $this->presenceModel->getPresence($keyword, $datePresence);
        } else {
            $record = $this->presenceModel->orderBy('created_at', 'DESC')->like('created_at', $datePresence);
        }

        $data = [
            'title' => 'Presence Record',
            'presences' => $record->paginate($perPage, 'record'),
            'pager' => $this->presenceModel->pager,
            'keyword' => $keyword,
            'dateFolder' => $dateFolder
        ];

        return view('user/record', $data);
    }
    public function addRecord($year, $month, $day)
    {
        $dateFolder = $year."/".$month."/".$day;
        if(!$this->validate([
            'image' => [
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'File must be uploaded',
                    'is_image' => 'File must be an image',
                    'mime_in' => 'File must be an image',
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('warning-array', $validation->getErrors());
            return redirect()->to('user/record/'.$dateFolder);
        }

        $image = $this->request->getFile('image');

        $slug = $this->request->getVar('type') . "_" . session()->get('username_account') . "_" . $year."-".$month."-".$day;

        if($this->presenceModel->myValidate($slug)){
            session()->setFlashdata('warning', 'Presence has been added');
            return redirect()->to('user/record/' . $dateFolder);
        }

        $nameImage = $image->getRandomName();
        $image->move('img/presence', $nameImage);

        $this->presenceModel->save([
            'username' => session()->get('username_account'),
            'image_slug' => $slug,
            'image' => $nameImage
        ]);

        session()->setFlashdata('message', 'Presence added successfully');

        return redirect()->to('user/record/' . $dateFolder);
    }
    public function deleteRecord($id)
    {
        $record = $this->presenceModel->find($id);

        unlink('img/presence/' . $record['image']);

        $this->presenceModel->delete($id);
        session()->setFlashdata('message', 'Record successfully deleted');
        return redirect()->to('user/record/' . $this->request->getVar('date'));
    }
    public function absent()
    {
        if($this->request->getMethod() == 'post'){
            if(!$this->validate([
                'explanation' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Explanation must be filled',
                    ]
                ],
                'image' => [
                    'rules' => 'uploaded[image]|mime_in[image,image/png,image/jpeg,image/jpg,application/pdf]',
                    'errors' => [
                        'uploaded' => 'File must be uploaded',
                        'mime_in' => 'File must be an image or pdf'
                    ]
                ],
                'to' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Date \'to\' must be selected',
                    ]
                ],
                'from' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Date \'from\' must be selected',
                    ]
                ]
            ])){
                $validation = \Config\Services::validation();
                $explanation = $validation->getError('explanation');
                $to = $validation->getError('to');
                $from = $validation->getError('from');
                session()->setFlashdata('image', $validation->getError('image'));
                return redirect()->to('user/absent')->withInput()->with('explanation', $explanation)->with('to', $to)->with('from', $from);
            }

            $slug = $this->request->getVar('type') . "_" . $this->request->getVar('from') . "_to_" . $this->request->getVar('to');

            $absent = $this->absentModel->myValidate($slug);
            if($absent){
                session()->setFlashdata('warning', 'Absent already registered');
                return redirect()->to('user/absent');
            }

            $image = $this->request->getFile('image');

            $nameImage = $image->getRandomName();
            $image->move('img/absent', $nameImage);
            
            $from = strtotime($this->request->getVar('from'));
            $to = strtotime($this->request->getVar('to'));

            $timeDiff = abs($from - $to);

            $numberDays = $timeDiff/86400;

            $numberDays = intval($numberDays) + 1;
    
            $this->absentModel->save([
                'username' => session()->get('username_account'),
                'explanation' => $this->request->getVar('explanation'),
                'slug' => $slug,
                'days' => $numberDays,
                'image' => $nameImage
            ]);
    
            session()->setFlashdata('message', 'Absent succesfully added');
    
            return redirect()->to('user/absent');
        }

        $data = [
            'title' => 'Absent Form',
            'explanation' => session()->get('explanation'),
            'from' => session()->get('from'),
            'to' => session()->get('to'),
            'image' => session()->getFlashdata('image')
        ];

        return view('user/absent', $data);
    }
}