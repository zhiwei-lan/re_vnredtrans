<?php

namespace App\Services\Backend;

use App\Models\SiteModel;
use App\Models\SiteDomainModel;
use Config\Database;

class SiteService
{
    protected SiteModel $SiteModel;
    protected SiteDomainModel $SiteDomainModel;

    public function __construct()
    {
        $this->SiteModel  = new SiteModel();
        $this->SiteDomainModel     = new SiteDomainModel();
    }

    //datatable形式 表单列表
    public function getDataTable(array $params): array
    {
        $start  = (int) ($params['start'] ?? 0);
        $length = (int) ($params['length'] ?? 10);
        $search = $params['search']['value'] ?? null;
        $query = $this->SiteModel
            ->like('name',$search)
            ->orderBy('created_at','desc')
            ->limit($length, $start);
        $rows = $query->get()->getResultObject();
        $response = [
            'draw'            => (int) $params['draw'],
            'recordsTotal'    => $this->SiteModel->countAllResults(),
            'recordsFiltered' => $this->SiteModel->like('name',$search)->countAllResults(),
            'data'            => $rows,
        ];
        return $response;
    }
    /**
     * 查看
     */
    public function read(int $id): array
    {
        $site = $this->SiteModel->find($id);
        $site['domain'] = $this->SiteDomainModel->where('site_id',$id)->find();
        return $site;
    }
    /**
     * 删除
     */
    public function delete(int $siteId): int
    {
        $db = Database::connect();
        $db->transBegin();
        try {
            //del site
            if(!$this->SiteModel->delete($siteId)){
                throw new \RuntimeException(json_encode($this->SiteModel->errors()));
            }
            //del domain
            if(!$this->SiteDomainModel->where('site_id',$siteId)->delete()){
                throw new \RuntimeException(json_encode($this->SiteDomainModel->errors()));
            }
            $db->transCommit();
            return $siteId;
        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }
    /**
     * 创建 / 更新（统一入口）
     */
    public function save(array $params, ?int $siteId = null): int
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            if ($siteId === null) {
                //save site 
                if(!$this->SiteModel->insert($params)){
                     throw new \RuntimeException(json_encode($this->SiteModel->errors()));
                }
                $siteId = $this->SiteModel->getInsertID();
                //save domain
                if($params['domain']){
                    $domains = json_decode($params['domain'], true);
                    foreach($domains as $domain){
                        $domainList = [
                            'site_id' => $siteId,
                            'domain' => $domain['domain'],
                            'is_primary' => $domain['is_primary'],
                            'active' => 1
                        ];
                        if(!$this->SiteDomainModel->insert($domainList)){
                            throw new \RuntimeException(json_encode($this->SiteDomainModel->errors()));
                        }
                    }
                }
            } else {
                //update site 
                if(!$this->SiteModel->update($siteId,$params)){
                     throw new \RuntimeException(json_encode($this->SiteModel->errors()));
                }
                //del all domain
                if(!$this->SiteDomainModel->where('site_id',$siteId)->delete()){
                    throw new \RuntimeException(json_encode($this->SiteDomainModel->errors()));
                }
                //save domain
                if($params['domain']){
                    $domains = json_decode($params['domain'], true);
                    foreach($domains as $domain){
                        $domainList = [
                            'site_id' => $siteId,
                            'domain' => $domain['domain'],
                            'is_primary' => $domain['is_primary'],
                            'active' => 1
                        ];
                        if(!$this->SiteDomainModel->insert($domainList)){
                            throw new \RuntimeException(json_encode($this->SiteDomainModel->errors()));
                        }
                    }
                }
            }
            $db->transCommit();
            return $siteId; 
        } catch (\Throwable $e) {
            $db->transRollback();
            throw $e;
        }
    }
}
