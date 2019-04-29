<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 14:01
 */

namespace App\Http\Controllers\Api\Setting;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\Express\Company\StoreRequest;
use App\Http\Requests\Api\Setting\Express\Company\UpdateRequest;
use App\Http\Searchs\Api\Setting\CompanySearch;
use App\Repositories\ExpressCompany;

class ExpressCompanyController extends Controller
{
    /**
     * @var ExpressCompany
     */
    private $company;

    public function __construct(ExpressCompany $company)
    {
        $this->company = $company;
    }

    /**
     * index
     * @author luffyzhao@vip.126.com
     * @param CompanySearch $search
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CompanySearch $search){
        return $this->response(
            $this->company->paginate($search->toArray())
        );
    }


    /**
     * store
     * @param StoreRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request){
        return $this->response(
            $this->company->create(
                $request->only(['name', 'view', 'code', 'description'])
            )
        );
    }

    /**
     * edit
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        return $this->response(
            $this->company->find($id)
        );
    }

    /**
     * update
     * @param UpdateRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id){
        return $this->response(
            $this->company->update($id, $request->only([
                'name', 'view', 'code', 'description'
            ]))
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 19:21
     * @throws \Exception
     */
    public function destroy($id){
        return $this->response(
            $this->company->delete($id)
        );
    }
}