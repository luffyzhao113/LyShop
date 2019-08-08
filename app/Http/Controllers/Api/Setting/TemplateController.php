<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 9:14
 */

namespace App\Http\Controllers\Api\Setting;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\TemplateRequest;
use App\Http\Searchs\Api\Setting\TemplateSearch;
use App\Repositories\Areas;
use App\Repositories\Express;
use App\Repositories\ExpressCompany;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function view(ExpressCompany $company)
    {
        return $this->response([
            'companies' => $company->get(['id', 'name']),
        ]);
    }

    /**
     * index
     * @param TemplateSearch $search
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
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
            'areas' => $areas->getByLevel(0, ['area_code as key', 'name as label'])
        ]);
    }

    /**
     * @param TemplateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:33
     */
    public function store(TemplateRequest $request)
    {
        return $this->response(
            DB::transaction(function () use ($request) {
                return $this->express->create(
                    $request->only([
                        'name', 'description', 'type', 'status', 'company_id', 'details'
                    ])
                );
            })
        );
    }

    /**
     * edit
     * @param ExpressCompany $company
     * @param Areas $areas
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit(ExpressCompany $company, Areas $areas, $id)
    {
        return $this->response([
            'companies' => $company->get(['id', 'name']),
            'areas' => $areas->getByLevel(0, ['area_code as key', 'name as label']),
            'row' => $this->express->editFind($id)
        ]);
    }

    /**
     * update
     * @param TemplateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     * @author luffyzhao@vip.126.com
     */
    public function update(TemplateRequest $request, $id)
    {
        return $this->response(
            DB::transaction(function () use ($request, $id) {
                return $this->express->update(
                    $id,
                    $request->only([
                        'name', 'description', 'type', 'status', 'company_id', 'details'
                    ])
                );
            })
        );
    }

    /**
     * destroy
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function destroy($id)
    {
        return $this->response(
            DB::transaction(function () use ($id) {
                return $this->express->delete($id);
            })
        );
    }
}