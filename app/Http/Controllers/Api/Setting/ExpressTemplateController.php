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
     * create
     * @param ExpressCompany $company
     * @param Areas $areas
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function create(ExpressCompany $company, Areas $areas){
        return $this->response([
            'companies' => $company->get(['id', 'name']),
            'areas' => $areas->getByLevel(1, ['id', 'name'])
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
                    'name', 'description', 'type', 'status', 'company_id'
                ])
            )
        );
    }
}