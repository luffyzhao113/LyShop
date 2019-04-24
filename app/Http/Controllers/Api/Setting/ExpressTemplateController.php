<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 9:14
 */

namespace App\Http\Controllers\Api\Setting;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\Express\Template\StoreRequest;
use App\Http\Requests\Api\Setting\Express\Template\UpdateRequest;
use App\Http\Searchs\Api\Setting\TemplateSearch;
use App\Repositories\Areas;
use App\Repositories\Express;
use App\Repositories\ExpressCompany;

class ExpressTemplateController extends Controller
{
    /**
     * @var Express
     */
    private $express;

    public function __construct(Express $express)
    {
        $this->express = $express;
    }


    /**
     * view
     * @param ExpressCompany $company
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(ExpressCompany $company){
        return $this->response([
            'companies' => $company->get(['id', 'name']),
        ]);
    }

    /**
     * index
     * @author luffyzhao@vip.126.com
     * @param TemplateSearch $search
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(TemplateSearch $search)
    {
        return $this->response(
            $this->express->paginate($search->toArray())
        );
    }

    /**
     * create
     * @param ExpressCompany $company
     * @param Areas $areas
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function create(ExpressCompany $company, Areas $areas)
    {
        return $this->response([
            'companies' => $company->get(['id', 'name']),
            'areas' => $areas->getByLevel(0, ['id as key', 'name as label'])
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:33
     */
    public function store(StoreRequest $request)
    {
        return $this->response(
            $this->express->create(
                $request->only([
                    'name', 'description', 'type', 'status', 'company_id', 'details'
                ])
            )
        );
    }

    /**
     * edit
     * @param ExpressCompany $company
     * @param Areas $areas
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(ExpressCompany $company, Areas $areas, $id)
    {
        return $this->response([
            'companies' => $company->get(['id', 'name']),
            'areas' => $areas->getByLevel(0, ['id as key', 'name as label']),
            'row' => $this->express->editFind($id)
        ]);
    }

    /**
     * update
     * @param UpdateRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->response(
            $this->express->update(
                $id,
                $request->only([
                    'name', 'description', 'type', 'status', 'company_id', 'details'
                ])
            )
        );
    }

    /**
     * destroy
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        return $this->response(
            $this->express->delete($id)
        );
    }
}