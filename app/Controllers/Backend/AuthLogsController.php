<?php

namespace App\Controllers\Backend;

use App\Controllers\Backend\AdminBaseController;
use App\Models\AuthLogsModel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\UserAgentDisplay;

/**
 * Class AuthLogs.
 */
class AuthLogsController extends AdminBaseController
{
    use ResponseTrait;
    /** @var \App\Models\UserModel */
    protected $authlogsmodel;

    public function __construct()
    {
        $this->authlogsmodel = new AuthLogsModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAJAX()) {

            $start  = (int) $this->request->getGet('start');
            $length = (int) $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $dir    = $this->request->getGet('order[0][dir]') ?? 'desc';
            $order  = 'id';

            $rows = $this->authlogsmodel->getDataTableData(
                $start,
                $length,
                $order,
                $dir,
                $search
            );

            /* ---------- 格式化输出 ---------- */

            foreach ($rows as &$row) {
                if (!empty($row['user_agent'])) {
                    $row['user_agent'] = UserAgentDisplay::format($row['user_agent']);
                }

                if (!empty($row['created_at'])) {
                    $row['created_at'] = date('Y-m-d H:i', strtotime($row['created_at']));
                }

                $row['ip_address'] = $row['ip_address'] ?? '-';
            }
            unset($row);

            return $this->respond([
                'draw'            => (int) $this->request->getGet('draw'),
                'recordsTotal'    => $this->authlogsmodel->countAllData(),
                'recordsFiltered' => $this->authlogsmodel->countFilteredData($search),
                'data'            => $rows,
            ]);
        }

        return view('Backend/Logs/auth', [
            'title'    => 'Auth Logs',
            'subtitle' => 'Logs',
        ]);
    }

}
