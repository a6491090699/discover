<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContractBuyPrint extends RowAction
{
    /**
     * @return string
     */
	protected $title = '<i class="feather icon-printer" title="采购合同打印"></i>';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // dump($this->getKey());
        $contract_id = $this->getKey();

        return $this->response()
            // ->success('Processed successfully: '.$this->getKey())
            ->redirect(route('order.contractPrint' , [$contract_id ,'type'=>'buy']));
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		// return ['提示', ''];
	}

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
